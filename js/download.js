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

        this.addEventListener('click', this.onHeaderClick)
    }
    disconnectedCallback(){
        this.removeEventListener('click', this.onHeaderClick)
    }

    setup(clazz){
        this.selector = "." + clazz;
        this.tag = replaceAll(clazz.replace("release-", ""), "-", ".").replace(".pre", "-pre");
    }

    onHeaderClick(e){

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
            $.ajax({
                url : "https://api.github.com/repos/clementgre/PDF4Teachers/releases/tags/" + this.tag,
                dataType : 'json',
                success : (json) => {
                    this.innerHTML += parseReleaseJson(this.tag, json);
                    $(this.selector + ' .content').fadeOut(0);
                    this.openNow()
                }
            }).fail(() => {
                this.innerHTML += '<div class="content"><p>Unable to get release description</p></div>';
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

/**
 * @param tags A list of all the tags
 * @param lastReleaseTag The tag of the last release
 * @param toOpenTag The tag to open directly. If null, the last release will be opened
 */
async function loadDownloadPage(tags, lastReleaseTag, toOpenTag){

    await $.ajax({
        url : "../php/downloadButton.php",
        dataType : 'html',
        success : function(downloadButtonHTML){

            tags.forEach((tag) => {
                // Return if the releases pane already exist
                if($(getTagSelector(tag)).length > 0) return;

                $('main').append(getReleaseSectionHeaderHTML(tag, downloadButtonHTML));

                // Replace links for download button
                $('main a.replace-lastrelease').each(function(){
                    const newUrl = replaceAll($(this).attr("href"), '<lastRelease>', tag);
                    $(this).attr("href", newUrl);
                });
            })

            // Open section if toOpenTag
            setTimeout(() => {
                if(tags.includes(toOpenTag)){
                    $(getTagSelector(toOpenTag) + ' i.fas').trigger("click");
                    const inter = setInterval(() => {
                        $('html').scrollTop($(getTagSelector(toOpenTag)).offset().top - 31);
                    }, 50);
                    setTimeout(() => {
                        clearInterval(inter);
                    }, 1000);
                }else if(tags.includes(lastReleaseTag)){
                    $(getTagSelector(lastReleaseTag) + ' i.fas').trigger("click");
                }
            }, 500)
        }
    });
}

function getReleaseSectionHeaderHTML(tag, downloadButtonHTML){

    const pre = tag.includes('-pre');
    let title = (!pre) ? ('v' + tag) : ('pre-release ' + tag.split('-pre')[0] + "-" + tag.split('-pre')[1]);

    return '<div is="release-section" class="info release-' + replaceAll(tag, ".", "-") + (pre ? ' pre-release' : '') + '">' +
            '<div class="header accept-click">' +
                '<div class="accept-click">' +
                    '<i class="fas fa-chevron-down"></i>' +
                    '<h2 class="accept-click">' + title + '</h2>' +
                '</div>' +
                '<div>' +
                    '<a href="https://github.com/ClementGre/PDF4Teachers/releases/tag/' + tag + '" target="_blank"><i class="fab fa-github"></i></a>' +
                    '<div>' + downloadButtonHTML + '</div>' +
                '</div>' +
            '</div>' +
        '</div><br>'
}


////////////////////////////////////////////////////////////////////
/////////// PARSE RELEASE DESCRIPTION / ASSETS SYSTEM //////////////
////////////////////////////////////////////////////////////////////

function parseReleaseJson(tag, json){

    const data = markdownBoldItalicToHTML(getMatchingLanguageDescriptionPart(json));

    let list = false;
    let intoHeader = false;
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
                intoHeader = true;
                description += '<h2>' + line.replace('##', '') + '</h2>';
            }else if(line === ""){
                description += '<br/>';
            }else{
                if(intoHeader) description += '<p style="padding-left: 15px;">' + line + '</p>';
                else description += '<p>' + line + '</p>';
            }
        }
    }
    if(list) description += "</ul>";

    let downloads = parseReleaseDownloadSectionJson(tag, json);

    return '<div class="content">' + description + '<br/>' + downloads + '</div>';
}

function markdownBoldItalicToHTML(markdown){
    return markdownSurroundingsToHTML(
            markdownSurroundingsToHTML(
                markdownSurroundingsToHTML(markdown
                    , "**", "b")
                , "*", "i"),
        "__", "u");
}

/**
 * replace markdown surrounding keys (**, __, `` etc.) to html tags (<b> and </b>, <i> and </i> etc.)
 * @param markdown The source text to parse
 * @param surroundingKey The markdown surrounding key to replace (**, __, `` etc.)
 * @param htmlElement The name of the html flag to use (b, i etc...)
 * @returns {string} The html version of the markdown surroundings
 */
function markdownSurroundingsToHTML(markdown, surroundingKey, htmlElement){
    let parsed = "";
    if(markdown.startsWith(surroundingKey)) parsed = "</" + htmlElement + ">";
    let isToggled = markdown.startsWith(surroundingKey);

    for(let text of markdown.split(surroundingKey)){
        if(isToggled) parsed += text + "</" + htmlElement + ">";
        else parsed += text + "<" + htmlElement + ">";
        isToggled = !isToggled;
    }
    if(isToggled) parsed += "</" + htmlElement + ">";

    return parsed;
}

/**
 * Parse release json and generate HTML of the assets section under the description
 * @param tag The tag of the release to parse
 * @param json The JSON received from GitHub
 * @returns {string} The HTML version of the assets in the JSON
 */
function parseReleaseDownloadSectionJson(tag, json){
    // Parse date
    let date;
    if(getHtmlVar("tr-english-date") === "false"){
        const year = json.published_at.split('T')[0].split('-')[0];
        const month = json.published_at.split('T')[0].split('-')[1];
        const day = json.published_at.split('T')[0].split('-')[2];
        date = year + ' ' + day + '/' + month;
    }else{
        date = json.published_at.split('T')[0].replace('-', ' ').replace('-', '/');
    }

    // Parse assets list
    let downloads = '';
    let downloadCount = 0;
    for(const asset of json.assets){
        downloads += '<div class="asset"><a href="' + asset.browser_download_url + '">' + asset.name + '</a><p>' + asset.download_count + ' ' + getHtmlVar("tr-downloads") + ' - ' + Math.floor(asset.size/1000000) + ' ' + getHtmlVar("tr-mb") + '</p></div>';
        downloadCount += asset.download_count;
    }

    // Compose HTML
    return '<div class="downloads">' +
        '<div class="title">' +
        '<h2>' + getHtmlVar("tr-files") + '</h2>' +
        '<p>' + date + ' | ' + downloadCount + ' ' + getHtmlVar("tr-downloads") + '</p>' +
        '</div><br/>' +
        downloads +
        '<div class="asset"><a href="https://github.com/ClementGre/PDF4Teachers/archive/' + tag + '.zip">' + getHtmlVar("tr-source-code") + ' (zip)</a></div>' +
        '<div class="asset"><a href="https://github.com/ClementGre/PDF4Teachers/archive/' + tag + '.tar.gz">' + getHtmlVar("tr-source-code") + ' (tar.gz)</a></div>' +
        '</div>';
}

function getMatchingLanguageDescriptionPart(json){
    // Mapping description data by language
    const dataByLanguage = new Map();
    for(let text of json.body.split('\r\n\r\n# ')){
        if(text.startsWith('# ')) text = text.replace('# ', '');

        const lang = text.substring(0, text.indexOf(' '));
        const desc = text.substring(text.indexOf('\r\n') + 1);
        dataByLanguage.set(lang, desc);
    }

    // Get the matching language in the map
    if(dataByLanguage.has(getHtmlVar("language"))) return dataByLanguage.get(getHtmlVar("language"));
    else if(dataByLanguage.has('en')) return dataByLanguage.get('en');
    else if(dataByLanguage.has('fr')) return dataByLanguage.get('fr');
    else return json.body;
}
