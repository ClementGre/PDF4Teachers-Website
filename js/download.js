class ReleaseSection extends HTMLDivElement {

    constructor(){
        super();
    }
    connectedCallback(){
        this.className.split(" ").every((clazz) => {
            if(clazz.startsWith("release-")){
                this.setup(clazz);
                return false;
            }
            return true;
        })

        console.log(this.querySelector('div.header'))
        this.addEventListener('click', this.onHeaderClick)
    }
    disconnectedCallback(){
        this.removeEventListener('click', this.onHeaderClick)
    }

    setup(clazz){
        this.selector = "." + clazz;
        this.tag = replaceAll(clazz.replace("release-", ""), "-", ".");
    }

    onHeaderClick(e){
        console.log('toggeling ' + this.tag)

        // Accept click only on .fas and .accept-click elements
        if(!e.target.className.split(' ').includes("fas")
            && !e.target.className.split(' ').includes("accept-click")) return;

        // If the release section is currently opening / closing
        if(this.classList.contains('animate')) return;

        if(this.isOpen()) this.close()
        else this.open()
    }

    isOpen(){
        return this.getIcon().classList.contains('fa-chevron-up');
    }

    open(){
        this.classList.add('animate');

        if($(this.selector + ' .content').length){ // Simply open
            this.openNow();

        }else{ // Load content from GitHub
            getDownloadPageContents(this.tag, (html) => {
                this.innerHTML += html;
                $(this.selector + ' .content').fadeOut(0);
                this.openNow()
            });
        }
    }
    openNow(){
        $(this.selector + ' .content').slideDown(() => {
            this.classList.remove('animate');

            this.getIcon().classList.remove('fa-chevron-down');
            this.getIcon().classList.add('fa-chevron-up');
        });
    }
    close(){
        this.classList.add('animate');
        $(this.selector + ' .content').slideUp(() => {
            this.classList.remove('animate');

            this.getIcon().classList.remove('fa-chevron-up');
            this.getIcon().classList.add('fa-chevron-down');
        });
    }

    getIcon(){
        return this.querySelector('i.fas');
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

                if(tag === toOpenTag){
                    $(getTagSelector(tag) + ' i.fas').trigger("click");
                    $('html').scrollTop($(getTagSelector(tag)).offset().top - 200);
                }

            }
        });
    }


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
        callBack('<div class="content"><p>Unable to get release description</p></div>');
    });
}