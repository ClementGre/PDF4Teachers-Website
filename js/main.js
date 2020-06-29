var resizeWindowFunction = function(){
  if(document.body.clientWidth > 800){
    if($('.global-nav').hasClass('nav-hide')){ // Back to the inline view
      $(".global-nav").animate({left: 0}, 0);
      $('.filter').fadeOut(0); // hide filter
      $('.global-nav').addClass('nav-hide'); // Add hide nav info
      $('body').removeClass('bodyfix'); // Enable scroll on body
    }
    $('nav').removeClass('hamburger'); // Remove condensed nav info
  }else{
    if(!$('nav').hasClass('hamburger')){ // Back to the Hamburger view
      $(".global-nav").animate({left: -400}, 0);
      $('.filter').fadeOut(0); // hide filter
      $('.global-nav').addClass('nav-hide'); // Add hide nav info
      $('body').removeClass('bodyfix'); // Enable scroll on body
      $('nav').addClass('hamburger'); // Add condensed nav info
    }
  }
}
resizeWindowFunction();

function getCookie(cname){
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while(c.charAt(0) == ' '){
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

var readyFunction = function(){

  var pageName = document.location.href.split('/').reverse()[1];
  var lastRelease = "";

////////////////////////////////////////////////////////////////////
///////////////////////// NAV //////////////////////////////////////
////////////////////////////////////////////////////////////////////

///////////////// OUVERTURE /////////////////
	$(document).on('touchstart click', '.menu-link', function(e){
    e.preventDefault();

		if($('.global-nav').hasClass('nav-hide')){
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
///////////////////////// VARS definitions /////////////////////////
////////////////////////////////////////////////////////////////////

  var lastRelease = getCookie("lastRelease");
  console.log(document.cookie);
  console.log(getCookie("lastRelease"));
  if(lastRelease == ""){
    console.log("Using GitHub request to define last release");
    $.ajax({
      url : "https://api.github.com/repos/clementgre/PDF4Teachers/releases/latest",
      dataType : 'json',

      success : function(json, status){
        lastRelease = json.tag_name;

        var d = new Date();
        d.setTime(d.getTime() + (10*60*1000)); // Cookie expire in 10 minutes
        document.cookie = "lastRelease=" + lastRelease + "; expires=" + d.toUTCString() + "; sameSite=Strict; path=/";

        $('a.replace-lastrelease').each(function(index){
          var newUrl = $(this).attr("href").replace('<lastRelease>', lastRelease).replace('<lastRelease>', lastRelease);
          $(this).attr("href", newUrl);
        });
      }
    });
  }else{
    console.log("Using cookie to define last release");
    $('a.replace-lastrelease').each(function(index){
      var newUrl = $(this).attr("href").replace('<lastRelease>', lastRelease).replace('<lastRelease>', lastRelease);
      $(this).attr("href", newUrl);
    });
  }

////////////////////////////////////////////////////////////////////
///////////////////////// Language /////////////////////////////////
////////////////////////////////////////////////////////////////////

  $(document).on("touchstart click", "a.language-link", function(e){
      e.preventDefault();
      document.cookie = "language=" + $(this).attr('href') + "; sameSite=Strict; path=/";

      /*$.ajax({
        url : "php/translator.php",
        type : 'POST',
        data : "language=" + $(this).attr("href"),
        dataType : 'html',

        success : function(html, status){*/

          $.ajax({
    				url : document.location.href + "/index.php",
    				type : 'POST',
    				dataType : 'html',

    				success : function(html, status){
    			   	document.body.innerHTML = html;
              resizeWindowFunction();
    				}
    			});
        /*}
      }).fail(function(e){ document.body.innerHTML = JSON.stringify(e, null, 4); });*/
    });
}
$(document).ready(readyFunction);
