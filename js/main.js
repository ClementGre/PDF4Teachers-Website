$(document).ready(function(){

  var pageName = document.location.href.split('/').reverse()[1];
  const req = new XMLHttpRequest();

  $(document).on("click", "a.language-link", function(e){
      //this == the link that was clicked
      e.preventDefault();
      var href = $(this).attr("href");
      document.cookie = "language=" + href + "; SameSite=strict";

      $('html').fadeOut(100);
      $.ajax({
				url : document.location.href + "/index.php",
				type : 'POST',
				dataType : 'html',

				success : function(html, status){

			   	document.body.innerHTML = html;
			   	$('html').fadeIn(100);

				}
			});

  });

});
