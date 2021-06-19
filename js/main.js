const global = {};

const resizeWindowFunction = function(){
    const nav = $('nav');

    if(document.body.clientWidth > 800){
        const globalNav = $('.global-nav');
        if(globalNav.hasClass('nav-hide')){ // Back to the inline view
            $(".global-nav").animate({left: 0}, 0);
            $('.filter').fadeOut(0); // hide filter
            globalNav.addClass('nav-hide'); // Add hide nav info
            $('body').removeClass('bodyfix'); // Enable scroll on body
        }
        nav.removeClass('hamburger'); // Remove condensed nav info
    }else{
        if(!nav.hasClass('hamburger')){ // Back to the Hamburger view
            $(".global-nav").animate({left: -400}, 0);
            $('.filter').fadeOut(0); // hide filter
            $('.global-nav').addClass('nav-hide'); // Add hide nav info
            $('body').removeClass('bodyfix'); // Enable scroll on body
            nav.addClass('hamburger'); // Add condensed nav info
        }
    }

};
resizeWindowFunction();

function getCookie(cname){
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++){
        var c = ca[i];
        while(c.charAt(0) == ' '){
            c = c.substring(1);
        }
        if(c.indexOf(name) == 0){
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
        var newUrl = replaceAll($(this).attr("href"), '<lastRelease>', lastTag);
        $(this).attr("href", newUrl);
    });
}

function getReleasesTags(lastReleaseTag, callBack){
    var releasesTags = getCookie("releasesTags");
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

        success: function(json, status){

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

var readyFunction = function(){

    var pageName = document.location.href.split('/').reverse()[1];
    var data = document.location.href.split('?').length >= 2 ? document.location.href.split('?')[1] : "";

////////////////////////////////////////////////////////////////////
///////////////////////// NAV //////////////////////////////////////
////////////////////////////////////////////////////////////////////

///////////////// OUVERTURE /////////////////
    $(document).on('touchstart click', '.menu-link', function(e){
        e.preventDefault();

        if($('.global-nav').hasClass('nav-hide')){
            $('nav').fadeIn(0);
            $(".global-nav").animate({left: 0}, 500);
            $('.filter').fadeIn(500); // Show filter
            $('body').addClass('bodyfix'); // Disable scroll on body
            setTimeout(function(){
                $('.global-nav').removeClass('nav-hide'); // Remove hide nav info
            }, 500);
        }

    });

///////////////// FERMETURE /////////////////
    $(document).on('touchstart click', 'div.filter', function(e){
        e.preventDefault();

        if(!$('.global-nav').hasClass('nav-hide')){
            $('.global-nav').addClass('nav-hide'); // Add hide nav info
            $(".global-nav").animate({left: -400}, 500);
            $('.filter').fadeOut(500); // Hide filter
            $('body').removeClass('bodyfix'); // Enable scroll on body
        }
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
                loadDownloadPage(tag, (getData(data, "v") === "" ? tag : getData(data, "v")), tags);
            })
        }
    });

////////////////////////////////////////////////////////////////////
///////////////////////// Language /////////////////////////////////
////////////////////////////////////////////////////////////////////

    $(document).on("touchstart click", "a.language-link", function(e){
        e.preventDefault();
        document.cookie = "language=" + $(this).attr('href') + "; sameSite=Strict; domain=pdf4teachers.org;path=/";

        var hostUrl = location.href.split(".org", 2)[0];
        if(hostUrl.split(".").length == 2){
            location.href = "https://pdf4teachers.org" + location.href.split(".org", 2)[1];

        }else{

            $.ajax({
                url: document.location.href + "/index.php",
                type: 'POST',
                dataType: 'html',

                success: function(html, status){
                    document.body.innerHTML = html;
                    resizeWindowFunction();

                    // CHANGE LINKS
                    updateReleaseLinks(global.lastReleaseTag);

                    // DOWNLOAD PAGE
                    if(pageName === "Download"){
                        getReleasesTags(global.lastReleaseTag, function callBack(tags){
                            loadDownloadPage(global.lastReleaseTag, (getData(data, "v") === "" ? global.lastReleaseTag : getData(data, "v")), global.tags);
                        })
                    }
                }
            });


        }


    });
}
$(document).ready(readyFunction);
