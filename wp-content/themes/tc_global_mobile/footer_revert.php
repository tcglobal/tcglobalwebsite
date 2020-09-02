
<footer class="mobile-footer-section">
  <div class="gotop-btn">
   <a href="#goto-top"><img src="https://tcglobal.com/wp-content/uploads/2019/09/go-to-top.png" alt=""></a>
  </div>
<div class="footer-main">
  <div class="row">
    <div class="col-md-12">
      <?php dynamic_sidebar( 'footer_image' );
    dynamic_sidebar( 'footer-1' ); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <ul class="footer-dropdown">

        <?php dynamic_sidebar( 'footer-2' ); ?>
        <li class="dropdown">
          <?php dynamic_sidebar( 'footer-3' ); ?>
         </li>

        <?php dynamic_sidebar( 'footer-6' ); ?>
        <?php dynamic_sidebar( 'footer-5' ); ?>
        </ul>
    </div>
  </div>

  <div class="col-md-12 p-0">
    <?php dynamic_sidebar( 'find_us' ); ?>
  </div>

   <?php dynamic_sidebar( 'terms_condition' ); ?>


</div>
</footer>
<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" >  -->
  <link rel="preload" as="style" media="all" href="<?php echo get_stylesheet_uri(); ?>"  onload="this.onload=null;this.rel='stylesheet'">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootstrap.min.css" >
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/intlTelInput.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/demo.css" >
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/select2.min.css" >
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/jquery-ui.min.css" >
<script language="javascript" type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<!-- <script src="https://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script> -->
<script language="javascript" type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/additional-methods.min.js"></script>
<script type="text/javascript">
jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[A-Za-z ]+$/i.test(value);
}, "Field can contain only alphabet values.");

jQuery.validator.addMethod("numeric", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Field can contain only numeric values.");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
}, "Field can contain only alphanumeric values.");

jQuery.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'Maximum File Size Limit is 3MB.');

</script>
<script language="javascript" type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/tcscript.js"></script>
<script src="/form/form_validation.js"></script>
<script src="/form/custom_validation.js"></script>

<!-- video play function -->
<script type="text/javascript">
var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function videoFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "<img src='https://tcglobal.com/wp-content/uploads/2019/11/video-pause.png'>";
    jQuery('.videotext').css('display', 'none');

  } else {
    video.pause();
    btn.innerHTML = "<img src='https://tcglobal.com/wp-content/uploads/2019/08/video-play.png'>";
  }
}
</script>

<!--LeadSquared Tracking Code Start-->
<script type="text/javascript" src="https://web-in21.mxradon.com/t/Tracker.js"></script>
<script type="text/javascript"> pidTracker('38230'); </script>
<!--LeadSquared Tracking Code End-->
<script>
function SetProspectID(){
  if (typeof(MXCProspectId) !== "undefined")
  jQuery('input[name="ProspectID"]').attr('value',MXCProspectId); 
}
window.onload = function() {
  
  setTimeout (SetProspectID ,
   2000); 

  let searchParams = new URLSearchParams(window.location.search);
  let param = searchParams.get('id');
  
  if(param){
    document.getElementById('meetingtrigger').click();
    jQuery('#menu-item-1039').css('display','block');
    jQuery('#menu-item-130').css('display','none');
  }     

};
</script>  
<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" async></script>
<?php
echo do_shortcode( '[student_portal]' );
if (!is_front_page() ) {
echo do_shortcode( '[subscribe_form]' );
echo do_shortcode( '[express_interest_form]' );
echo do_shortcode( '[start_your_journey]' );
}
echo do_shortcode( '[schedule_meeting_form]' );
echo do_shortcode( '[meetingSchedule]' );

wp_footer()
?>

<!--HEADER-MENU-->

<div class="helpchat">  
  <img src="https://cdn.shortpixel.ai/client/q_glossy,ret_img,w_120,h_34/https://tcglobal.com/wp-content/uploads/chat.svg" >
</div>
<!-- Start of thechoprassupport Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=dc7656d1-f86f-4a8f-940f-698fe6b1a867" defer> </script>
<script>
  jQuery(document).ready(function() {
  zE('webWidget', 'hide');
      
  $('.helpchat').click(function(){
    javascript:void($zopim.livechat.window.show());
    zE(function() 
    {zE.hide();
     zE.activate({hideOnClose: true});
    });
  });   }); 
</script> 
<style>
  .helpchat img{ width:100%;}
  .helpchat {
    bottom:0; 
    cursor: pointer;
    position: fixed;
    right: 20px;
     z-index:999999;     
  }
</style>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/build/js/intlTelInput.js"></script>
<?php if (!is_front_page() ) { ?>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
       initialCountry: "in",
       separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
</script>
<?php } ?>
<?php if (!is_front_page() ) { ?>
<script>
    var input = document.querySelector(".countryflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
       initialCountry: "in",
       separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>
<?php } ?>
  <script>
    var input = document.querySelector(".scheduleflag");
    window.intlTelInput(input, {
      
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

  <script>
    var input = document.querySelector(".contactflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>
<?php if (!is_front_page() ) { ?>
<script>
    var input = document.querySelector(".expressflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>
  <?php } ?>
<?php if (!is_front_page() ) { ?>
  <script>
    var input = document.querySelector(".subscribeflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>
<?php } ?>
  <script>
    var input = document.querySelector(".portalflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

<?php if (!is_front_page() ) { ?>
  <script>
    var input = document.querySelector(".campcontactflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>
<?php } ?>
  
  
</body>
</html>
