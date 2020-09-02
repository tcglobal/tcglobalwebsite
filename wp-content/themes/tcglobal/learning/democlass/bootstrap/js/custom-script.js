
(function($){
			$(window).on("load",function(){
				
				
				
				$(".scroll-custom").mCustomScrollbar({
					scrollButtons:{enable:false,scrollType:"stepped"},
					keyboard:{scrollType:"stepped"},
					mouseWheel:{scrollAmount:188},
					theme:"rounded-dark",
					autoExpandScrollbar:true,
					snapAmount:0,
					snapOffset:65
				});
				
			});
		})(jQuery);

$('.form-control-chosen').chosen({
		  allow_single_deselect: true,
		  width: '100%'
		});
		$('.form-control-chosen-required').chosen({
		  allow_single_deselect: false,
		  width: '100%'
		});
		$('.form-control-chosen-search-threshold-100').chosen({
		  allow_single_deselect: true,
		  disable_search_threshold: 100,
		  width: '100%'
		});
		$('.form-control-chosen-optgroup').chosen({
		  width: '100%'
		});
		
		$(function() {
		  $('[title="clickable_optgroup"]').addClass('chosen-container-optgroup-clickable');
		});
		$(document).on('click', '[title="clickable_optgroup"] .group-result', function() {
		  var unselected = $(this).nextUntil('.group-result').not('.result-selected');
		  if(unselected.length) {
		    unselected.trigger('mouseup');
		  } else {
		    $(this).nextUntil('.group-result').each(function() {
		      $('a.search-choice-close[data-option-array-index="' + $(this).data('option-array-index') + '"]').trigger('click');
		    });
		  }
		});
		  


$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
	
	
	
	
});


// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});




$(document).ready(function(){
	
	$('.Schedule-gr  a').click(function(){
		var location_id = $(this).attr('data-location');

		
		$('.location-content').removeClass('current');
		$('.close-sh').removeClass('current');

		
		$("#"+location_id).addClass('current');
	})

	$('.close-sh').click(function(){
		

		
		$('.location-content').removeClass('current');
		

		
		
	})
	
	
	$('.custom-dropdown select').change(function(){
		if($(this).val()=="")
		$(this).parent().removeClass('labeldrop');
		else
			$(this).parent().addClass('labeldrop');
	});
	
});

$(document).ready(function(){
  $(".phonechat").click(function(){
    $("#div1").fadeToggle();
    
  });
});


(function($) {
    
    $.fn.bmdIframe = function( options ) {
        var self = this;
        var settings = $.extend({
            classBtn: '.bmd-modalButton',
            defaultW: 740,
            defaultH: 960
        }, options );
      
        $(settings.classBtn).on('click', function(e) {
          var allowFullscreen = $(this).attr('data-bmdVideoFullscreen') || false;
          
          var dataVideo = {
            'src': $(this).attr('data-bmdSrc'),
            'height': $(this).attr('data-bmdHeight') || settings.defaultH,
            'width': $(this).attr('data-bmdWidth') || settings.defaultW
          };
          
          if ( allowFullscreen ) dataVideo.allowfullscreen = "";
          
          // stampiamo i nostri dati nell'iframe
          $(self).find("iframe").attr(dataVideo);
        });
      
        // se si chiude la modale resettiamo i dati dell'iframe per impedire ad un video di continuare a riprodursi anche quando la modale è chiusa
        this.on('hidden.bs.modal', function(){
          $(this).find('iframe').html("").attr("src", "");
        });
      
        return this;
    };
  
})(jQuery);




jQuery(document).ready(function(){
  jQuery("#myModal").bmdIframe();
});	  
	  
	 
