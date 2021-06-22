const global = {};

const resizeWindowFunction = function(){
    const nav = $('nav');
    const globalNav = $('.global-nav');

    if(document.body.clientWidth > 800){
        hideSideMenu();
        globalNav.animate({left: 400}, 0);
        nav.removeClass('hamburger'); // Remove condensed nav info
    }else{
        if(!nav.hasClass('hamburger')){ // Back to the Hamburger view
            globalNav.animate({left: -400}, 0);
            globalNav.addClass('nav-hide'); // Add hide nav info
            nav.addClass('hamburger'); // Add condensed nav info
        }
    }

};
resizeWindowFunction();

function getCookie(cname){
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++){
        let c = ca[i];
        while(c.charAt(0) === ' '){
            c = c.substring(1);
        }
        if(c.indexOf(name) === 0){
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

////////////////////////////////////////////////////////////////////
///////////////////////// RELEASES REQUEST /////////////////////////
////////////////////////////////////////////////////////////////////
function getLastReleaseTag(callBack){
    const lastRelease = getCookie("lastRelease");
    if(lastRelease === ""){
        console.log("Using GitHub request to define last release tag");
        $.ajax({
            url: "https://api.github.com/repos/clementgre/PDF4Teachers/releases/latest",
            dataType: 'json',

            success: function(json){
                const d = new Date();
                d.setTime(d.getTime() + (10 * 60 * 1000)); // Cookie expire in 10 Minutes
                document.cookie = "lastRelease=" + json.tag_name + "; expires=" + d.toUTCString() + "; sameSite=Strict; path=/";
                callBack(json.tag_name);
            }
        }).fail(function fail(){
            callBack("1.2.1");
        });
    }else{
        console.log("Using cookie to define last release tag");
        callBack(lastRelease);
    }
}

function updateReleaseLinks(lastTag){
    $('a.replace-lastrelease').each(function(){
        const newUrl = replaceAll($(this).attr("href"), '<lastRelease>', lastTag);
        $(this).attr("href", newUrl);
    });
}

function getReleasesTags(lastReleaseTag, callBack){
    const releasesTags = getCookie("releasesTags");
    if(releasesTags !== ""){
        if(releasesTags.split(",")[0] === lastReleaseTag || releasesTags.split(",")[1] === lastReleaseTag || releasesTags.split(",")[2] === lastReleaseTag){
            console.log("Using cookie to define releases tags");
            callBack(releasesTags.split(","));
            return;
        }
    }
    console.log("Using GitHub request to define releases tags");
    $.ajax({
        url: "https://api.github.com/repos/clementgre/PDF4Teachers/tags",
        dataType: 'json',

        success: function(json){

            var tags = [];
            for(var tag in json){
                tags.push(json[tag].name);
            }

            var d = new Date();
            d.setTime(d.getTime() + (24 * 60 * 60 * 1000)); // Cookie expire in 1 Day
            document.cookie = "releasesTags=" + tags.join(",") + "; expires=" + d.toUTCString() + "; sameSite=Strict; path=/";
            callBack(tags);
        }
    }).fail(function fail(){
        callBack([]);
    });
}

function replaceAll(text, pattern, replacement){
    const newText = text.replace(pattern, replacement);
    if(newText !== text){
        return replaceAll(newText, pattern, replacement);
    }
    return newText;
}

function getHtmlVar(key){
    return $('variable.' + key).text();
}

function getData(data, key){
    var value = data.split(key + "=");
    if(value.length >= 2){
        return value[1].split('&')[0];
    }
    return '';
}

function readyFunction(){

    const pageName = document.location.href.split('/').reverse()[1];
    const data = document.location.href.split('?').length >= 2 ? document.location.href.split('?')[1] : "";

////////////////////////////////////////////////////////////////////
///////////////////////// NAV //////////////////////////////////////
////////////////////////////////////////////////////////////////////

///////////////// OUVERTURE /////////////////
    $(document).on('touchstart click', '.menu-link', function(e){
        e.preventDefault();
        openSideMenu();
    });

///////////////// FERMETURE /////////////////
    $(document).on('click', 'div.filter', function(e){
        if(e.target != this) return; // only continue if the target itself has been clicked
        e.preventDefault();

        if($('.filter').html() !== ""){
            $('.filter').html("");
        }

        $('.filter').fadeOut(500); // Hide filter
        $('body').removeClass('bodyfix'); // Enable scroll on body

        hideSideMenu();
    });

///////////////// REDIMENTIONEMENT /////////////////

    $(window).resize(function(){
        resizeWindowFunction();
    });

////////////////////////////////////////////////////////////////////
///////////////////////// Releases /////////////////////////////////
////////////////////////////////////////////////////////////////////


    global.lastReleaseTag = "";
    global.tags = "";

    // GET LAST RELEASE TAG
    getLastReleaseTag(function callBack(tag){
        console.log("detected last release tag = " + tag);
        global.lastReleaseTag = tag;

        // CHANGE LINKS
        updateReleaseLinks(tag);

        // DOWNLOAD PAGE
        if(pageName === "Download"){
            getReleasesTags(tag, function callBack(tags){
                global.tags = tags;
                console.log("detected releases tags = " + tags);
                loadDownloadPage(tags, (getData(data, "v") === "" ? tag : getData(data, "v")));
            })
        }
    });

////////////////////////////////////////////////////////////////////
///////////////////////// Language /////////////////////////////////
////////////////////////////////////////////////////////////////////

    $(document).on("touchstart click", "a.language-link", function(e){
        e.preventDefault();
        document.cookie = "language=" + $(this).attr('href') + "; sameSite=Strict; domain=pdf4teachers.org;path=/";

        const hostUrl = location.href.split(".org", 2)[0];
        if(hostUrl.split(".").length === 2){
            location.href = "https://pdf4teachers.org" + location.href.split(".org", 2)[1];

        }else{

            $.ajax({
                url: document.location.href,
                type: 'POST',
                dataType: 'html',

                success: function(html){
                    document.body.innerHTML = html;
                    resizeWindowFunction();

                    // CHANGE LINKS
                    updateReleaseLinks(global.lastReleaseTag);

                    // DOWNLOAD PAGE
                    if(pageName === "Download"){
                        getReleasesTags(global.lastReleaseTag, function callBack(tags){
                            loadDownloadPage(global.tags, (getData(data, "v") === "" ? global.lastReleaseTag : getData(data, "v")));
                        })
                    }
                }
            });


        }


    });
}
$(document).ready(readyFunction);

function openSideMenu(){
    const nav = $('.global-nav');
    if(nav.hasClass('nav-hide')){
        $('nav').fadeIn(0);
        nav.animate({left: 0}, 500);
        setTimeout(function(){
            nav.removeClass('nav-hide'); // Remove hide nav info
        }, 500);

        showFilter()

    }
}
function hideSideMenu(){
    const nav = $('.global-nav');
    if(!nav.hasClass('nav-hide')){

        nav.addClass('nav-hide'); // Add hide nav info
        nav.animate({left: -400}, 500);

        hideFilter();
    }
}

function showFilter(){
    $('.filter').addClass("flex").fadeIn(500); // Hide filter
    $('body').addClass('bodyfix'); // Disable scroll on body
}
function hideFilter(){
    $('.filter').removeClass("flex").fadeOut(500); // Hide filter
    $('body').removeClass('bodyfix'); // Enable scroll on body
}

////////////////////////////////////////////////////////////////////
/////////////////////// E-mail popup ///////////////////////////////
////////////////////////////////////////////////////////////////////

function openEmailPopup(e){
    e.stopPropagation()
    e.preventDefault()
    console.log("Open email popup...")

    showFilter()


    $.ajax({
        url: "/php/emailPopup.php",
        dataType: 'html',
        success: (html) => {
            $('.filter').html(html);
        }
    });

}