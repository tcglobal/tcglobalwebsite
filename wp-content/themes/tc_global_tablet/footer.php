

<footer class="tablet-footer-section">
  <div class="gotop-btn">
   <a href="#goto-top"><img src="https://tcglobal.com/wp-content/uploads/2019/09/go-to-top.png" alt=""></a>
  </div>
<div class="footer-main">

<div class="row">
  <div class="col-md-5">
    <?php dynamic_sidebar( 'footer_image' );
    dynamic_sidebar( 'footer-1' ); ?>
  </div>
  <div class="col-md-7">
    <?php dynamic_sidebar( 'find_us' ); ?>
  </div>
</div>

<div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col">
              <?php dynamic_sidebar( 'footer-2' ); ?>
            </div>
            <div class="col">
              <?php dynamic_sidebar( 'footer-3' ); ?>
            </div>
            <div class="col">
              <?php dynamic_sidebar( 'footer-4' ); ?>
            </div>
            <div class="col">
              <?php dynamic_sidebar( 'footer-5' ); ?>
            </div>
            <div class="col">
              <?php dynamic_sidebar( 'footer-7' ); ?>
            </div>
            <div class="col">
              <?php dynamic_sidebar( 'footer-6' ); ?>
            </div>
          </div>
        </div>
      </div>

<div class="secondary-footer">

  <?php dynamic_sidebar( 'terms_condition' ); ?>
</div>

</div>
</footer>

<?php if (!is_front_page() ) { ?>
<script language="javascript" type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script src="https://ajax.microsoft.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
<script type="text/javascript">

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[A-Za-z ]+$/i.test(value);
}, "Field can contain only alphabet values.");

jQuery.validator.addMethod("customid", function(value, element) {
    return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
    }, "Enter a valid email address");

jQuery.validator.addMethod("numeric", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Field can contain only numeric values.");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
}, "Field can contain only alphanumeric values.");

jQuery.validator.addMethod("alphadot", function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9. ]+$/.test(value);
    }, "Field can contain only alphanumeric and dot values.");

jQuery.validator.addMethod("numfield", function(value, element) {
    return this.optional(element) || /^[0-9]+$/.test(value);
    }, "Please enter only number");

jQuery.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'Maximum File Size Limit is 3MB.');

</script>
<?php } ?>

<script src="/form/form_validation.js"></script>

<?php if (!is_front_page() ) { ?>
  <script src="/form/customscript.js"></script>
<?php } ?>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery( "#datepicker" ).datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
      });
  });
</script>

<script type="text/javascript">
  jQuery('.tablet-menu, .overlay').click(function () {
    jQuery('.tablet-menu').toggleClass('clicked');

    jQuery('#tablet-nav').toggleClass('show');

  });
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    centerPadding: '100px',
    slidesToShow: 2,
    slidesToScroll: 1,
    focusOnSelect: true,
    centerMode: true,
    responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
  ]
  });
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.team-carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    centerPadding: '206px',
    slidesToShow: 1,
    slidesToScroll: 1,
    focusOnSelect: true,
    centerMode: true,
  });

  jQuery('.companyname-carousel').slick({
    dots: false,
    arrows: true,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
  });
  
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.carousel-place').slick({
  dots: true,
  infinite: true,
  arrows: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  slidesToScroll: 1,
  focusOnSelect: true,
});
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.loc_carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    centerPadding: '179px',
    slidesToShow: 1,
    slidesToScroll: 1,
    focusOnSelect: true,
    centerMode: true,
  });
});
</script>



<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#media_image-2 img').removeClass("m-b-20");

  jQuery('.footerheading').addClass("mb-4 pb-2");
  jQuery('#text-9 .footerheading').removeClass("mb-4 pb-2");
  jQuery('p:empty').remove();
  jQuery('.global-workspace p:last').removeClass("pl-5");
  jQuery('.global-workspace p:last').addClass("pl-4");

});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('#member_show').hide();
  jQuery('#inter_member_show').hide();
  jQuery('#hide-board').hide();
});
</script>
<script type="text/javascript">
jQuery(".show_team_mem").click(function(){
  jQuery('#see_mem_btn').hide();
  jQuery('#member_show').show();
  jQuery('#inter_member_show').show();
  jQuery('#hide-board').show();
});
</script>
<script type="text/javascript">
jQuery("#hide-board").click(function(){
  jQuery('#see_mem_btn').show();
  jQuery('#member_show').hide();
  jQuery('#inter_member_show').hide();
  jQuery('#hide-board').hide();
});

jQuery(".topic-btn").click(function(){
  jQuery('.topic-show').toggle();

});

jQuery(".business-btn").click(function(){
  jQuery('.business-show').toggle();

});

jQuery("#event_topic li").click(function() {

    var selected_topics_val = $(this).attr('id');
    jQuery('input[name=topics]').val(selected_topics_val); // assign value to hidden input
    jQuery( "#event_search_form" ).submit(); // submit event form
});

jQuery("#selc_event_business li").click(function() {

    var selected_business_val = $(this).attr('id');
    jQuery('input[name=event_business]').val(selected_business_val); // assign value to hidden input
    jQuery( "#event_search_form" ).submit(); // submit event form
});

jQuery(".insight-topic").click(function(){
    jQuery('.insight-topic-show').toggle();
});

jQuery(".insight-business").click(function(){
    jQuery('.insight-business-show').toggle();
});
jQuery(".insight-type").click(function(){
    jQuery('.insight-type-show').toggle();
});

jQuery("#selc_insignt_type li").click(function() {
    var selected_type_val = $(this).attr('id');
    jQuery('input[name=type]').val(selected_type_val); // assign value to hidden input
     jQuery( "#insight_search_form" ).submit(); // submit event form
});

jQuery("#selc_insight_topic li").click(function() {
    var selc_topic_val = $(this).attr('id');
    jQuery('input[name=insight_topic]').val(selc_topic_val); // assign value to hidden input
    jQuery( "#insight_search_form" ).submit(); // submit event form
});

jQuery("#selc_insight_business li").click(function() {
    var selc_topic_val = $(this).attr('id');
    jQuery('input[name=insight_business]').val(selc_topic_val); // assign value to hidden input
    jQuery( "#insight_search_form" ).submit(); // submit event form
});

jQuery("#clear_field").click(function() {
    jQuery('input[name=type]').val(''); // assign empty value to hidden input
    jQuery('input[name=insight_topic]').val(''); // assign value to hidden input
    jQuery('input[name=insight_business]').val(''); // assign value to hidden input
    jQuery( "#insight_search_form" ).submit(); // submit event form
});

jQuery("#clear_ins_type").click(function() {
    jQuery('input[name=type]').val('');
    jQuery( "#insight_search_form" ).submit();
});

jQuery("#clear_ins_topic").click(function() {
    jQuery('input[name=insight_topic]').val('');
    jQuery( "#insight_search_form" ).submit();
});

jQuery("#clear_ins_business").click(function() {
    jQuery('input[name=insight_business]').val('');
    jQuery( "#insight_search_form" ).submit();
});

/** popular topics **/
jQuery(".event-popular-topic a").click(function() {

    var popular_topic_val = $(this).attr('id');
    jQuery('input[name=topics]').val(popular_topic_val); // assign value to hidden input
    jQuery( "#event_search_form" ).submit(); // submit event form
});

</script>

<script>
jQuery(document).ready(function() {
  jQuery('#event_search_form').submit(function() {
      jQuery('html, body').animate({
                      scrollTop: $("#event-result").offset().top
                  }, 2000);
      var eventloc = window.location.href.split('#')[0]; // remove the current page id element
      window.location = eventloc + "#event-result";
    });
});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.career_team_hide').hide();
  jQuery('.carousel-section-two, .carousel-section-three, .carousel-section-four').hide();

});

jQuery(".show_team_btn").click(function() {
    jQuery('.career_team_hide').show();
    jQuery('.career_team_show').hide();
});

jQuery('.hide_team_btn').click(function() {
    jQuery('.career_team_hide').hide();
    jQuery('.career_team_show').show();
});

jQuery(".career_section_tab a").click(function () {
  var active_slider_id = $(this).attr('id');

    jQuery(this).addClass("active");
    jQuery(".career_section_tab a").not(this).removeClass("active");

    if(active_slider_id == 'carousel-section-one'){
      jQuery('.carousel-section-one').show();
      jQuery('.carousel-section-two, .carousel-section-three, .carousel-section-four').hide();

    }

    if(active_slider_id == 'carousel-section-two'){
      jQuery('.carousel-section-two').show();
      jQuery('.carousel-section-one, .carousel-section-three, .carousel-section-four').hide();

      jQuery('.carousel-section-two').slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
    });
  }
  if(active_slider_id == 'carousel-section-three'){
      jQuery('.carousel-section-three').show();
      jQuery('.carousel-section-one, .carousel-section-two, .carousel-section-four').hide();

      jQuery('.carousel-section-three').slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

  }
    if(active_slider_id == 'carousel-section-four'){
      jQuery('.carousel-section-four').show();
      jQuery('.carousel-section-one, .carousel-section-two, .carousel-section-three').hide();

      jQuery('.carousel-section-four').slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

  }

});
</script>

<script type="text/javascript">
jQuery(document).ready(function() {

  jQuery(".tc_career-team").click(function(){
    jQuery('.tc_career-team-show').toggle();
});

jQuery(".career_country").click(function(){
    jQuery('.career_country_show').toggle();
});

jQuery(".career_city").click(function(){
    jQuery('.career_city_show').toggle();
});

jQuery(".sub-career").click(function(){
    jQuery('.sub-career-show').toggle();
});

jQuery(".sub-country").click(function(){
    jQuery('.sub-country-show').toggle();
});

jQuery(".job-sort").click(function(){
    jQuery('.job-sort-show').toggle();
});

jQuery(".job-position").click(function(){
    jQuery('.job-position-show').toggle();
});

jQuery("#selc_job_country li a").click(function() {
    var job_team_val = $(this).text();
    jQuery('input[name=job_country]').val(job_team_val); // assign value to hidden input
    jQuery("#job_btn1 span").text(job_team_val);
    jQuery('#job_btn1').addClass('value-selected');
    jQuery(this).addClass("active");
    jQuery("#selc_job_country li a").not(this).removeClass("active");
    jQuery('.career_country_show').hide();
});

jQuery("#selc_job_city li").click(function() {
    var job_team_val = $(this).attr('id');
    jQuery('input[name=job_city]').val(job_team_val); // assign value to hidden input
    jQuery("#job_btn2 span").text(job_team_val);
    jQuery('.career_city_show').hide();
});

jQuery("#selc_job_team li a").click(function() {
    var job_team_val = $(this).text();
    jQuery('input[name=job_team]').val(job_team_val); // assign value to hidden input
    jQuery("#job_btn3 span").text(job_team_val);
    jQuery(this).addClass("active");
    jQuery("#selc_job_team li a").not(this).removeClass("active");
    jQuery('#job_btn3').addClass('value-selected');
    jQuery('.tc_career-team-show').hide();
});

jQuery("#selc_career_team li").click(function() {
    var carteam_val = $(this).attr('id');
    jQuery('input[name=career_team]').val(carteam_val); // assign value to hidden input
    //jQuery("#carerr_btn1 span").text(carteam_val);
    jQuery( "#career_search_form" ).submit(); // submit form
});

jQuery("#selc_career_country li").click(function() {
    var country_val = $(this).attr('id');
    jQuery('input[name=career_country]').val(country_val); // assign value to hidden input
    jQuery( "#career_search_form" ).submit();
});

jQuery("#sel_sort_val li").click(function() {
    var jobsort_val = $(this).attr('id');
    jQuery('input[name=sort_val]').val(jobsort_val); // assign value to hidden input
    jQuery( "#career_list_form" ).submit();
});

jQuery("#selc_position li a").click(function() {
    var job_title_val = $(this).text();
    jQuery('input[name=job_position]').val(job_title_val); // assign value to hidden input
    jQuery("#title-btn span").text(job_title_val);
    jQuery('#title-btn').addClass('value-selected');
    jQuery(this).addClass("active");
    jQuery("#selc_position li a").not(this).removeClass("active");
    jQuery('.job-position-show').hide();
});

jQuery(".job-loc").click(function(){
    jQuery('.job-loc-show').toggle();
});

jQuery(".job-exp").click(function(){
    jQuery('.job-exp-show').toggle();
});
jQuery(".job-course").click(function(){
    jQuery('.job-course-show').toggle();
});

jQuery(".job-course-spec").click(function(){
    jQuery('.job-course-spec-show').toggle();
});

jQuery(".pg-course").click(function(){
    jQuery('.pg-course-show').toggle();
});

jQuery(".pg-course-spec").click(function(){
    jQuery('.pg-course-spec-show').toggle();
});

jQuery(".currency_code").click(function(){
    jQuery('.currency_code_show').toggle();
});

jQuery(".toggle-navheader .btn-link").click(function(){
    jQuery('.primarynavblock__ul').toggle();
});

/** add active class to current element **/
jQuery("#sel-job-loc li a").click(function() {
    $(this).addClass("active");
    $("#sel-job-loc li a").not(this).removeClass("active");
});
jQuery("#sel-job-exp li a").click(function() {
    $(this).addClass("active");
    $("#sel-job-exp li a").not(this).removeClass("active");
});
jQuery("#sel-job-course li a").click(function() {
    $(this).addClass("active");
    $("#sel-job-course li a").not(this).removeClass("active");
});
jQuery("#sel-course-spec li a").click(function() {
    $(this).addClass("active");
    $("#sel-course-spec li a").not(this).removeClass("active");
});
jQuery("#sel-pg-course li a").click(function() {
    $(this).addClass("active");
    $("#sel-pg-course li a").not(this).removeClass("active");
});
jQuery("#sel-pg-spec li a").click(function() {
    $(this).addClass("active");
    $("#sel-pg-spec li a").not(this).removeClass("active");
});

jQuery("#sel-job-loc li").click(function() {
    var job_loc_val = $(this).attr('id');
    jQuery('input[name=job_apply_location]').val(job_loc_val); // assign value to hidden input
    jQuery(".job-loc span").text(job_loc_val);
    jQuery('.job-loc').addClass('value-selected');
    $('label[for="job_apply_location"]').hide();
    jQuery('.job-loc-show').hide();
});

jQuery("#sel-job-exp li").click(function() {
    var job_exp_val = $(this).attr('id');
    jQuery('input[name=job_apply_experience]').val(job_exp_val); // assign value to hidden input
    jQuery(".job-exp span").text(job_exp_val);
    jQuery('.job-exp').addClass('value-selected');
     $('label[for="job_apply_experience"]').hide();
    jQuery('.job-exp-show').hide();
});

jQuery("#sel-job-course li").click(function() {
    var job_course_val = $(this).attr('id');
    jQuery('input[name=job_apply_course]').val(job_course_val); // assign value to hidden input
    jQuery(".job-course span").text(job_course_val);
    jQuery('.job-course').addClass('value-selected');
    jQuery('.job-course-show').hide();
});

jQuery("#sel-course-spec li").click(function() {
    var course_spec_val = $(this).attr('id');
    jQuery('input[name=job_apply_course_spec]').val(course_spec_val); // assign value to hidden input
    jQuery(".job-course-spec span").text(course_spec_val);
    jQuery('.job-course-spec').addClass('value-selected');
    jQuery('.job-course-spec-show').hide();
});

jQuery("#sel-pg-course li").click(function() {
    var pg_course_val = $(this).attr('id');
    jQuery('input[name=job_pg_course]').val(pg_course_val); // assign value to hidden input
    jQuery(".pg-course span").text(pg_course_val);
    jQuery('.pg-course').addClass('value-selected');
    jQuery('.pg-course-show').hide();
});

jQuery("#sel-pg-spec li").click(function() {
    var pg_spec_val = $(this).attr('id');
    jQuery('input[name=job_pg_course_spec]').val(pg_spec_val); // assign value to hidden input
    jQuery(".pg-course-spec span").text(pg_spec_val);
    jQuery('.pg-course-spec').addClass('value-selected');
    jQuery('.pg-course-spec-show').hide();
});

jQuery("#sel_currency_code li").click(function() {
    var currency_val = $(this).attr('id');
    var newSrc= $(this).find('img').attr('src');
    $('#country_flag img').attr("src",newSrc);
    jQuery('input[name=ctc_currency_code]').val(currency_val); // assign value to hidden input
    jQuery(".currency_code span").text(currency_val);
    jQuery('.currency_code').addClass('value-selected');
    jQuery('.currency_code_show').hide();
});


});
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('.show-resume-form').hide();
jQuery('#htmlcheck').click(function() {
  if ($(this).is(':checked')) {
    jQuery('.show-resume-form').show();
  }
  else{ jQuery('.show-resume-form').hide(); }
});

$('#upload_resume').on('change', function(e) {
   var resumename = $(this).val().replace(/C:\\fakepath\\/i, '');
   $('#sel_resume_name').html('<span>'+ resumename +'</span>');
  });

$('#upload_letter').on('change', function(e) {
   var lettername = $(this).val().replace(/C:\\fakepath\\/i, '');
   $('#sel_letter_name').html('<span>'+ lettername +'</span>');
  });

});
</script>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.carousel-section-one').slick({
      dots: false,
        arrows: true,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

function imageDisplay(){
  $('.tickimage').each(function (event) {
      $(this).find('img').attr('style','display:none');
  })
}
imageDisplay();
$('.input-value').change(function (event) {
    if($(this).val()){
        $(this).addClass('valid');
        $(this).removeClass('error');
    }else{
       $(this).removeClass('valid');
    }
})



});
</script>

<script type="text/javascript">
jQuery(document).ready(function(){
 
 jQuery('.contact-service').click(function(){
    jQuery('.contact-service-show').toggle();
});

jQuery("#sel-contact-service li a").click(function() {
    $(this).addClass("active");
    $("#sel-contact-service li a").not(this).removeClass("active");
});

jQuery("#sel-contact-service li").click(function() {
    var service_loc_val = $(this).attr('id');
    jQuery('input[name=contact-service]').val(service_loc_val); // assign value to hidden input
    jQuery(".contact-service").text(service_loc_val);
    jQuery('.contact-service ').addClass('value-selected');
    jQuery(".contact-service").removeClass("error");
    jQuery('.contact-service-show').hide();
});

jQuery(".schuser_loc").click(function(){
    jQuery('.schuser_loc_show').toggle();
});

jQuery(".allformtrigger").click(function() {
      jQuery('.helpchat').hide();
    });
jQuery(".close").click(function() {
    jQuery('.helpchat').show();
  });
jQuery(".close-btn").click(function() {
    jQuery('.helpchat').show();
  });

});
</script>

<!-- video play function -->
<script type="text/javascript">

  function changedata(req1,req2) {
  var x=document.getElementById(req1);
  if (x.type == "password") {
    x.type = "text";
    $('.'+req2).attr('src', 'https://tcglobal.com/wp-content/themes/tc_global_tablet/images/eye-icon-open.png');
  } else {
    x.type = "password";
    $('.'+req2).attr('src', 'https://tcglobal.com/wp-content/themes/tc_global_tablet/images/show.png');
  }
}
 

var video = document.getElementById("myVideo");
var btn = document.getElementById("myBtn");

function videoFunction() {
  if (video.paused) {
    video.play();
    btn.innerHTML = "<img src='https://tcglobal.wpengine.com/wp-content/uploads/2019/11/video-pause.png'>";
    jQuery('.videotext').css('display', 'none');

  } else {
    video.pause();
    btn.innerHTML = "<img src='https://tcglobal.wpengine.com/wp-content/uploads/2019/08/video-play.png'>";
  }
}
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/build/js/intlTelInput.js"></script>
<script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
       initialCountry: "in",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true,
      utilsScript: "build/js/utils.js",
    });
  </script>

<!-- <script src="/form/custom_validation.js"></script> -->

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
  }      

};

</script>  
<?php
echo do_shortcode( '[student_portal]' );
echo do_shortcode( '[subscribe_form]' );
echo do_shortcode( '[express_interest_form]' );
echo do_shortcode( '[start_your_journey]' );
echo do_shortcode( '[schedule_meeting_form]' );
echo do_shortcode( '[meetingSchedule]' );
wp_footer()

?>

<script>
    var input = document.querySelector(".countryflag");
    window.intlTelInput(input, {
      // allowDropdown: false,
      // autoHideDialCode: false,
      autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["us"],
      // formatOnDisplay: false,
      // geoIpLookup: function(callback) {
      //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      //     var countryCode = (resp && resp.country) ? resp.country : "";
      //     callback(countryCode);
      //   });
      // },
      // hiddenInput: "full_number",
       initialCountry: "in",
      // localizedCountries: { 'de': 'Deutschland' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      // preferredCountries: ['cn', 'jp'],
       separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

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

  <script>
    var input = document.querySelector(".expressflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

  <script>
    var input = document.querySelector(".subscribeflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

  <script>
    var input = document.querySelector(".portalflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

  <script>
    var input = document.querySelector(".campcontactflag");
    window.intlTelInput(input, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
    });
  </script>

<?php if (!is_front_page() ) { ?>
<script>
    var input8 = document.querySelector(".telephone");
    window.intlTelInput(input8, {
      autoPlaceholder: "off",
      initialCountry: "in",
      separateDialCode: true,
      utilsScript: "<?php echo get_stylesheet_directory_uri(); ?>/build/js/utils.js",
  });

</script>
<?php } ?>

<script type="text/javascript">
  jQuery(document).ready(function(){
     jQuery('.carousel-card-group').slick({
       dots: false,
       arrows: false,
       infinite: true,
       speed: 300,
       centerPadding: '100px',
       slidesToShow: 2,
       slidesToScroll: 1,
     });
  }); 


</script>

<script type="text/javascript"> 
$(document).ready(function() {

  if(window.location.href.indexOf('#subscribeModal') != -1) {
    $('#subscribeModal').modal('show');}
if(window.location.href.indexOf('#start_journey_form') != -1) {
    $('#start_journey_form').modal('show');}
if(window.location.href.indexOf('#schedule_form') != -1) {
    $('#schedule_form').modal('show');}

});

		
	</script>


</body>
</html>
