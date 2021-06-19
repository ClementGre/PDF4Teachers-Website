class ReleaseSection extends HTMLDivElement {
    constructor(){
        super();

    }
    connectedCallback(){
        console.log("connected")
    }
    disconnectedCallback(){

    }
}

customElements.define('release-section', ReleaseSection, { extends: 'div' });

function getTagSelector(tag){
    return '.release-' + replaceAll(tag, '.', '-');
}

async function loadDownloadPage(lastTag, toOpenTag, tags){

    for(let i = 0 ; i < tags.length ; i++){

        await $.ajax({
            url : "../php/releasePanel.php",
            type : "POST",
            data : "tag=" + tags[i],
            dataType : 'html',

            success : function(html){
                const tag = tags[i];
                // Return if the releases pane already exist
                if($(getTagSelector(tags[i])).length > 0) return;

                $('main').append(html);

                $('main a.replace-lastrelease').each(function(){
                    const newUrl = replaceAll($(this).attr("href"), '<lastRelease>', tag);
                    $(this).attr("href", newUrl);
                });

                $(document).on('click', getTagSelector(tag) + ' div.header', function(e){
                    const selector = getTagSelector(tag);
                    const icon = $(selector + ' i.fas');

                    if(!e.target.className.split(' ').includes("fas") && !e.target.className.split(' ').includes("accept-click")) return;
                    if($(icon).hasClass('animate')) return;

                    if($(icon).hasClass('fa-chevron-down')){
                        openReleaseSection()
                    }else if($(icon).hasClass('fa-chevron-up')){
                        closeReleaseSection(selector)
                    }
                });

                if(tag === toOpenTag){
                    $(getTagSelector(tag) + ' i.fas').trigger("click");
                    //$('html').scrollTop($(getTagSelector(tag)).offset().top - 200);
                }

            }
        });
    }


}

function openReleaseSection(tag){
    const selector = getTagSelector(tag);
    const section = $(selector);

    $(selector + ' i.fas').addClass('animate');

    if($(selector + ' .content').length){ // Simply open
        openDirectlyReleaseSection(selector, section);

    }else{ // Load content from GitHub
        getDownloadPageContents(tag, function callBack(html){
            section.append(html);
            $(getTagSelector(tag) + ' .content').fadeOut(0);
            $(getTagSelector(tag) + ' .content').slideDown(function complete(){
                openDirectlyReleaseSection(selector, section);
            });
        });
    }
}
function openDirectlyReleaseSection(selector, section){
    $(selector + ' .content').slideDown(function complete(){
        $(selector + ' i.fas').removeClass('animate');
        section.removeClass('fa-chevron-down');
        section.addClass('fa-chevron-up');
    });
}
function closeReleaseSection(selector){
    $(selector + ' i.fas').addClass('animate');
    $(getTagSelector(tag) + ' .content').slideUp(function complete(){
        $(getTagSelector(tag) + ' i.fas').removeClass('animate');
        $(getTagSelector(tag) + ' i.fas').removeClass('fa-chevron-up');
        $(getTagSelector(tag) + ' i.fas').addClass('fa-chevron-down');
    });
}


function getDownloadPageContents(tag, callBack){

    $.ajax({
        url : "https://api.github.com/repos/clementgre/PDF4Teachers/releases/tags/" + tag,
        dataType : 'json',

        success : function(json){
            const datas = new Map();
            for(let text of json.body.split('\r\n\r\n# ')){
                if(text.startsWith('# ')) text = text.replace('# ', '');
                const lang = text.substring(0, text.indexOf(' '));
                const desc = text.substring(text.indexOf('\r\n') + 1);
                datas.set(lang, desc);
            }

            let data;
            if(datas.has(getHtmlVar("language"))) data = datas.get(getHtmlVar("language"));
            else if(datas.has('en')) data = datas.get('en');
            else if(datas.has('fr')) data = datas.get('fr');
            else data = json.body + '<br/>';

            let list = false;
            let description = '';
            for(const line of data.split('## 🌐')[0].split('\r\n')){
                if(line.startsWith("- ")){
                    if(!list){
                        list = true;
                        description += "<ul>";
                    }
                    description += '<li>' + line.replace('- ', '') + '</li>';
                }else{
                    if(list){
                        list = false;
                        description += "</ul>";
                    }

                    if(line.startsWith("##")){
                        description += '<h2>' + line.replace('##', '') + '</h2>';
                    }else if(line === ""){
                        description += '<br/>';
                    }else{
                        description += '<p>' + line + '</p>';
                    }
                }
            }
            if(list) description += "</ul>";

            let date;
            if(getHtmlVar("tr-english-date") === "false"){
                const year = json.published_at.split('T')[0].split('-')[0];
                const month = json.published_at.split('T')[0].split('-')[1];
                const day = json.published_at.split('T')[0].split('-')[2];
                date = year + ' ' + day + '/' + month;
            }else{
                date = json.published_at.split('T')[0].replace('-', ' ').replace('-', '/');
            }

            let downloads = '';
            let downloadCount = 0;
            for(const asset of json.assets){
                downloads += '<div class="asset"><a href="' + asset.browser_download_url + '">' + asset.name + '</a><p>' + asset.download_count + ' ' + getHtmlVar("tr-downloads") + ' - ' + Math.floor(asset.size/1000000) + ' ' + getHtmlVar("tr-mb") + '</p></div>';
                downloadCount += asset.download_count;
            }
            downloads = '<div class="downloads"><div class="title"><h2>' + getHtmlVar("tr-files") + '</h2><p>' + date + ' | ' + downloadCount + ' ' + getHtmlVar("tr-downloads") + '</p></div><br/>' + downloads;

            downloads += '<div class="asset"><a href="https://github.com/ClementGre/PDF4Teachers/archive/' + tag + '.zip">' + getHtmlVar("tr-source-code") + ' (zip)</a></div>';
            downloads += '<div class="asset"><a href="https://github.com/ClementGre/PDF4Teachers/archive/' + tag + '.tar.gz">' + getHtmlVar("tr-source-code") + ' (tar.gz)</a></div>';
            downloads += '</div>';

            callBack('<div class="content">' + description + downloads + '</div>');
        }
    }).fail(function fail(){
        callBack("");
    });
}