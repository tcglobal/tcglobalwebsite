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
        <li class="dropdown">
          <?php dynamic_sidebar( 'footer-7' ); ?>
        </li>
        </ul>
    </div>
  </div>
<div class="col-md-12 p-0">
    <?php dynamic_sidebar( 'find_us' ); ?>
  </div>
  <?php dynamic_sidebar( 'terms_condition' ); ?>
</div>
</footer>
<div class="modal fade Covid-19-popup" id="Covid-19" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
    <h3 class="smallheading-modal step-form-title" >We’re still live and connecting! </h3>
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="<?php echo get_template_directory_uri();?>/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body"  style="margin:0px; margin-top: 52px;">
          <div class="list-term">
   <p>We know Coronavirus (Covid-19) is making us all a little more cautious. In the midst of the Covid-19 crisis, we&rsquo;re still live, and ready to service our community. <br> <br>
 To protect the wellbeing of our student, university and people community, we&rsquo;ve introduced a digital infrastructure so you can connect with us, our partners and our people, online! Our learning facilities too are now virtual so everything runs seamlessly while we together navigate and get through this global health crisis.  <br> <br>
 If you want to connect or to discuss anything related to your Global Ed, Learning or Mobility journey, you can Schedule a meeting with us and all of these bookings will be done virtually now! Once you&rsquo;ve sent us your info, we will send you a link so you can log in for your slot!  <br> <br>
This crisis impacts us all in our global community, so let&rsquo;s be responsible, take the precautions and get through this together! We will get through this! <br> <br>
 Here are our guidelines to stay safe, <em><a href="https://api.tcglobal.com/img_16/Coronavirus%20%E2%80%93%20Guidelines%20on%20How%20to%20Stay%20Safe_%20Advisory.pdf">Click here</a></em></p>
</div>
          </div>
        </div>
      </div>
    </div>
<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/intlTelInput.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/build/css/demo.css"> -->
<script language="javascript" type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.min.js"></script>
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
<!-- <script type="text/javascript">
jQuery(document).ready(function(){
  // Check if the current URL contains '#'
    if(document.URL.indexOf("#")==-1)
    {
        // Set the URL to whatever it was plus "#".
        console.log('refresh');
        url = document.URL+"#";
        location = "#";

        //Reload the page
         location.reload(true);
    }
});
</script> -->
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
<!--<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" async></script>-->
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

<script src="<?php echo get_stylesheet_directory_uri(); ?>/build/js/intlTelInput.js"></script>
<?php if (!is_front_page() ) { ?>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
       initialCountry: "in",
       separateDialCode: true,
      utilsScript: "build/js/utils.js",
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

<div class="helpchat" style="display: none">
  <img src="https://tcglobal.com/wp-content/uploads/chat.svg" >
</div>
<!-- Start of thechoprassupport Zendesk Widget script -->

<script>
function Chat(){
var script = document.createElement("script"); //Make a script DOM node
script.id ="ze-snippet"
script.src = "https://static.zdassets.com/ekr/snippet.js?key=dc7656d1-f86f-4a8f-940f-698fe6b1a867";
document.head.appendChild(script);
setTimeout ( function(){ $('.helpchat').css('display','block'); zE('webWidget', 'hide');},1000); 
}
setTimeout (
  function(){
      Chat();        
        $('.helpchat').click(function(){
          javascript:void($zopim.livechat.window.show());
          zE(function() 
          {zE.hide();
           zE.activate({hideOnClose: true});
          });
        });  
        
    },3000)
</script>

<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=dc7656d1-f86f-4a8f-940f-698fe6b1a867"> </script>
<script>
  zE('webWidget', 'hide');
      
  $('.helpchat').click(function(){
    javascript:void($zopim.livechat.window.show());
    zE(function() 
    {zE.hide();
     zE.activate({hideOnClose: true});
    });
  });   
</script> -->
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
<script>
$(document).ready(function() {

  if(window.location.href.indexOf('#subscribeModal') != -1) {
    $('#subscribeModal').modal('show');}
if(window.location.href.indexOf('#start_journey_form') != -1) {
    $('#start_journey_form').modal('show');}
if(window.location.href.indexOf('#schedule_form') != -1) {
    $('#schedule_form').modal('show');}

});
</script>
<?php if (!is_front_page() ) { ?>
<link rel="stylesheet" href="/wp-content/plugins/searchtool/css/stylemobile.css">
<link rel="stylesheet" href="/wp-content/plugins/searchtool/js/jquery-ui.css">
<?php } ?>
</body>
</html>