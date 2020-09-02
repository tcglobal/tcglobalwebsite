jQuery(document).ready(function() {
    jQuery( "#datepicker" ).datepicker({
            dateFormat: 'dd.mm.yy',
            changeMonth: true,
            changeYear: true,
            yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
      });
  });
jQuery(window).scroll(function() {
      var scroll = jQuery(window).scrollTop();
      if (scroll >= 160) {
          jQuery(".navblock").addClass("desktop-fixedheader");
      } else {
          jQuery(".navblock").removeClass("desktop-fixedheader");
      }
  });
jQuery('.toggle-menu, .overlay').click(function () {
  	jQuery('.toggle-menu').toggleClass('clicked');
  	jQuery('.secondarynavblock').toggleClass('show');
  });
jQuery(document).ready(function(){

  jQuery('#text-2 .description').addClass("m-b-20");
  jQuery('.footerheading').addClass("m-b-20");
  jQuery('.footermenu').addClass("m-t-25");
  jQuery('p:empty').remove();
  jQuery('#member_show').hide();
  jQuery('#inter_member_show').hide();
  jQuery('#hide-board').hide();

	  jQuery('.multiple-items').slick({
	    slidesToShow: 4,
	    slidesToScroll: 1,
	    infinite: true,
	    arrows: true,
	    responsive: [
	      {
	        breakpoint: 1200,
	          settings:{
	          slidesToShow: 3,
	          slidesToScroll: 1,
	          infinite: true,
	        }
	      }
	    ]

	  });

	jQuery('.carousel').slick({
	    dots: false,
	    infinite: true,
	    speed: 300,
	    slidesToShow: 3,
	    slidesToScroll: 1,
	});
	jQuery('.carousel-section-one').slick({
      dots: false,
      arrows: true,
      infinite: false,
      speed: 300,
      slidesToShow: 1,
      slidesToScroll: 1,
    });

    jQuery('.companyname-carousel').slick({
	    dots: false,
	    arrows: true,
	    infinite: true,
	    speed: 300,
	    slidesToShow: 5,
	    slidesToScroll: 1,
	 });

	jQuery(".show_team_mem").click(function(){
	  jQuery('#see_mem_btn').hide();
	  jQuery('#member_show').show();
	  jQuery('#inter_member_show').show();
	  jQuery('#hide-board').show();
	});

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
	    jQuery( "#insight_search_form" ).submit(); // submit insight form
	});

	jQuery("#selc_insight_topic li").click(function() {
	    var selc_topic_val = $(this).attr('id');
	    jQuery('input[name=insight_topic]').val(selc_topic_val); // assign value to hidden input
	    jQuery( "#insight_search_form" ).submit();
	});

	jQuery("#selc_insight_business li").click(function() {
	    var selc_topic_val = $(this).attr('id');
	    jQuery('input[name=insight_business]').val(selc_topic_val); // assign value to hidden input
	    jQuery( "#insight_search_form" ).submit();
	});
	jQuery("#clear_field").click(function() {
	    jQuery('input[name=type]').val(''); // assign empty value to hidden input
	    jQuery('input[name=insight_topic]').val(''); // assign value to hidden input
	    jQuery('input[name=insight_business]').val(''); // assign value to hidden input
	    jQuery( "#insight_search_form" ).submit(); // submit insight form
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
	jQuery(".event-popular-topic a").click(function() {
		var popular_topic_val = $(this).attr('id');
	    jQuery('input[name=topics]').val(popular_topic_val); // assign value to hidden input
	    jQuery( "#event_search_form" ).submit(); // submit event form
	});
	jQuery('#event_search_form').submit(function() {
	    jQuery('html, body').animate({
	                scrollTop: $("#event-result").offset().top
	            }, 2000);
	    var eventloc = window.location.href.split('#')[0]; // remove the current page id element
	    window.location = eventloc + "#event-result";
	});

	jQuery('.career_team_hide').hide();
  	jQuery('.carousel-section-two, .carousel-section-three, .carousel-section-four').hide();

  	jQuery(".show_team_btn").click(function() {
	    jQuery('.career_team_hide').show();
	    jQuery('.career_team_show').hide();
	});

	jQuery(".hide_team_btn").click(function() {
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


});