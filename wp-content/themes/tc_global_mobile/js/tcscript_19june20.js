jQuery(document).ready(function(){jQuery('[data-toggle="popover"]').popover();jQuery("#datepicker").datepicker({dateFormat:"dd.mm.yy",changeMonth:!0,changeYear:!0,yearRange:new Date().getFullYear()+":+50"})});jQuery(".mobile-menu, .overlay").click(function(){jQuery(".mobile-menu").toggleClass("clicked");jQuery("#mobile-nav").toggleClass("show")});jQuery(document).ready(function(){jQuery("#menu-item-125").addClass("dropdown");jQuery("#menu-item-125 > a").after("<span class='toggle-submenu'></span>");jQuery("#menu-item-125 > a + .toggle-submenu").addClass("dropdown-toggle");jQuery("#menu-item-125 > a + .toggle-submenu").attr("data-toggle","dropdown");jQuery("#menu-item-125 > a + .toggle-submenu").attr("aria-expanded","false");jQuery("#menu-item-125 > a + .toggle-submenu").attr("aria-haspopup","true");jQuery(".sub-menu").addClass("dropdown-menu");jQuery("#menu-item-130 a").addClass("btn btn-primary btn-theme allformtrigger");jQuery("#menu-item-1039 a").addClass("btn btn-primary btn-theme allformtrigger");jQuery("#menu-item-1039").css("display","none")});jQuery(document).ready(function(){jQuery(".carousel").slick({dots:!0,infinite:!0,speed:300,centerPadding:"30px",slidesToShow:1,slidesToScroll:1,focusOnSelect:!0,centerMode:!0});jQuery(".carousel-tab").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:2,slidesToScroll:1,focusOnSelect:!0});jQuery(".investor-tab").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});jQuery(".carousel-faqtab").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:2,slidesToScroll:1,focusOnSelect:!0});jQuery(".timeline_carousel").slick({dots:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});jQuery(".carousel-icon").slick({dots:!0,infinite:!0,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});jQuery(".carousel-tab-career").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});jQuery(".testimonial_carousel").slick({dots:!0,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});jQuery(".loc_carousel").slick({dots:!0,infinite:!0,arrows:!0,speed:300,centerPadding:"30px",slidesToShow:1,slidesToScroll:1,focusOnSelect:!0,centerMode:!0});jQuery(".single-carousel").slick({dots:!0,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1});jQuery(".carousel-tab-career.slider.nav-tabs .nav-link").click(function(){var curitem=$(this).parent();$(".nav-link").addClass("active");$(".nav-link").removeClass("active")});jQuery(".carousel-tab.slider.nav-tabs .nav-link").click(function(){var item=$(this).parent();jQuery(".nav-link").addClass("active");jQuery(".nav-link").removeClass("active")});jQuery(".investor-tab.slider.nav-tabs .nav-link").click(function(){var item=$(this).parent();jQuery(".nav-link").addClass("active");jQuery(".nav-link").removeClass("active")});jQuery(".carousel-faqtab.slider.nav-pills .nav-link").click(function(){var item=$(this).parent();jQuery(".nav-link").addClass("active");jQuery(".nav-link").removeClass("active")});jQuery("#media_image-2 img").removeClass("m-b-20");jQuery("#text-4 .footerheading").addClass("dropdown-toggle");jQuery("#text-4 .footerheading").attr("data-toggle","dropdown");jQuery("#text-4 .footerheading").attr("aria-expanded","false");jQuery("#text-4 .footerheading").attr("aria-haspopup","true");jQuery("#text-4 .footermenu").addClass("dropdown-menu");jQuery("#text-10 .footerheading").addClass("dropdown-toggle");jQuery("#text-10 .footerheading").attr("data-toggle","dropdown");jQuery("#text-10 .footerheading").attr("aria-expanded","false");jQuery("#text-10 .footerheading").attr("aria-haspopup","true");jQuery("#text-10 .footermenu").addClass("dropdown-menu");jQuery("p:empty").remove();jQuery(".global-workspace p:last").removeClass("pl-5 ml-3");jQuery(".executive-content").hide();jQuery(".inter-content").hide();jQuery(".leader li a").click(function(){jQuery(".leader li a").removeClass("active");jQuery(this).addClass("active")});jQuery("#leader li a").click(function(){var cur_id=jQuery(this).attr("id");if(cur_id=="executive"){jQuery(".executive-content").show();jQuery(".board-content").hide();jQuery(".inter-content").hide()}
if(cur_id=="inter"){jQuery(".executive-content").hide();jQuery(".board-content").hide();jQuery(".inter-content").show()}
if(cur_id=="board"){jQuery(".executive-content").hide();jQuery(".board-content").show();jQuery(".inter-content").hide()}});jQuery(".topic-btn").click(function(){jQuery(".topic-show").toggle()});jQuery(".business-btn").click(function(){jQuery(".business-show").toggle()});jQuery(".filter-btn").click(function(){jQuery(".filter-events-form").css("display","block");jQuery(".filter-btn").hide()});jQuery("#event_topic li").click(function(){var selected_topics_val=$(this).attr("id");jQuery("input[name=topics]").val(selected_topics_val);jQuery(".topic-btn span").text(selected_topics_val);jQuery("#event_topic").hide()});jQuery("#selc_event_business li").click(function(){var selected_business_val=$(this).attr("id");jQuery("input[name=event_business]").val(selected_business_val);jQuery(".business-btn span").text(selected_business_val);jQuery("#selc_event_business").hide()});jQuery(".insight-topic").click(function(){jQuery(".insight-topic-show").toggle()});jQuery(".insight-business").click(function(){jQuery(".insight-business-show").toggle()});jQuery(".insight-type").click(function(){jQuery(".insight-type-show").toggle()});jQuery("#selc_insignt_type li a").click(function(){var selected_type_val=$(this).text();jQuery("input[name=type]").val(selected_type_val);jQuery("#insight_btn1 span").text(selected_type_val);jQuery(".insight-type-show").hide();jQuery(this).addClass("active");jQuery("#selc_insignt_type li a").not(this).removeClass("active")});jQuery("#selc_insight_topic li a").click(function(){var selc_topic_val=$(this).text();jQuery("input[name=insight_topic]").val(selc_topic_val);jQuery("#insight_btn2 span").text(selc_topic_val);jQuery(".insight-topic-show").hide();jQuery(this).addClass("active");jQuery("#selc_insight_topic li a").not(this).removeClass("active")});jQuery("#selc_insight_business li a").click(function(){var selc_business_val=$(this).text();jQuery("input[name=insight_business]").val(selc_business_val);jQuery("#insight_btn3 span").text(selc_business_val);jQuery(".insight-business-show").hide();jQuery(this).addClass("active");jQuery("#selc_insight_business li a").not(this).removeClass("active")});jQuery("#clear_field").click(function(){jQuery("input[name=type]").val("");jQuery("input[name=insight_topic]").val("");jQuery("input[name=insight_business]").val("");jQuery("#insight_search_form").submit()});jQuery("#clear_ins_type").click(function(){jQuery("input[name=type]").val("");jQuery("#insight_search_form").submit()});jQuery("#clear_ins_topic").click(function(){jQuery("input[name=insight_topic]").val("");jQuery("#insight_search_form").submit()});jQuery("#clear_ins_business").click(function(){jQuery("input[name=insight_business]").val("");jQuery("#insight_search_form").submit()});jQuery(".event-popular-topic a").click(function(){var popular_topic_val=$(this).attr("id");jQuery("input[name=topics]").val(popular_topic_val);jQuery("#event_search_form").submit()});jQuery("#event_search_form").submit(function(){jQuery("html, body").animate({scrollTop:$("#event-result").offset().top},2000);var eventloc=window.location.href.split("#")[0];window.location=eventloc+"#event-result"});jQuery(".show_team_btn").click(function(){jQuery(".career_team_hide").show();jQuery(".career_team_show").hide()});jQuery(".hide_team_btn").click(function(){jQuery(".career_team_hide").hide();jQuery(".career_team_show").show()});jQuery(".career_team_hide").hide();jQuery(".career-tab-name a").click(function(){var sliderID=$(this).attr("id");if(sliderID==""){jQuery("#be-consumer-centric-tab").addClass("active")}});jQuery(".carousel-section-two, .carousel-section-three, .carousel-section-four").hide();jQuery(".career_section_tab a").click(function(){var active_slider_id=$(this).attr("id");jQuery(this).addClass("active");jQuery(".career_section_tab a").not(this).removeClass("active");if(active_slider_id=="carousel-section-one"){jQuery(".carousel-section-one").show();jQuery(".carousel-section-two, .carousel-section-three, .carousel-section-four").hide()}
if(active_slider_id=="carousel-section-two"){jQuery(".carousel-section-two").show();jQuery(".carousel-section-one, .carousel-section-three, .carousel-section-four").hide();jQuery(".carousel-section-two").slick({dots:!1,arrows:!0,infinite:!1,speed:300,slidesToShow:1,slidesToScroll:1})}
if(active_slider_id=="carousel-section-three"){jQuery(".carousel-section-three").show();jQuery(".carousel-section-one, .carousel-section-two, .carousel-section-four").hide();jQuery(".carousel-section-three").slick({dots:!1,arrows:!0,infinite:!1,speed:300,slidesToShow:1,slidesToScroll:1})}
if(active_slider_id=="carousel-section-four"){jQuery(".carousel-section-four").show();jQuery(".carousel-section-one, .carousel-section-two, .carousel-section-three").hide();jQuery(".carousel-section-four").slick({dots:!1,arrows:!0,infinite:!1,speed:300,slidesToShow:1,slidesToScroll:1})}});jQuery(".tc_career-team").click(function(){jQuery(".tc_career-team-show").toggle()});jQuery(".career_country").click(function(){jQuery(".career_country_show").toggle()});jQuery(".career_city").click(function(){jQuery(".career_city_show").toggle()});jQuery(".sub-career").click(function(){jQuery(".sub-career-show").toggle()});jQuery(".sub-country").click(function(){jQuery(".sub-country-show").toggle()});jQuery(".job-sort").click(function(){jQuery(".job-sort-show").toggle()});jQuery(".job-position").click(function(){jQuery(".job-position-show").toggle()});jQuery("#selc_job_country li a").click(function(){var job_team_val=$(this).text();jQuery("input[name=job_country]").val(job_team_val);jQuery("#job_btn1 span").text(job_team_val);jQuery("#job_btn1").addClass("value-selected");jQuery(this).addClass("active");jQuery("#selc_job_country li a").not(this).removeClass("active");jQuery(".career_country_show").hide()});jQuery("#selc_job_city li").click(function(){var job_team_val=$(this).attr("id");jQuery("input[name=job_city]").val(job_team_val);jQuery("#job_btn2 span").text(job_team_val);jQuery(".career_city_show").hide()});jQuery("#selc_job_team li a").click(function(){var job_team_val=$(this).text();jQuery("input[name=job_team]").val(job_team_val);jQuery("#job_btn3 span").text(job_team_val);jQuery(this).addClass("active");jQuery("#selc_job_team li a").not(this).removeClass("active");jQuery("#job_btn3").addClass("value-selected");jQuery(".tc_career-team-show").hide()});jQuery("#selc_career_team li").click(function(){var carteam_val=$(this).attr("id");jQuery("input[name=career_team]").val(carteam_val);jQuery("#subteam span").text(carteam_val);jQuery(".sub-career-show").hide()});jQuery("#selc_career_country li").click(function(){var country_val=$(this).attr("id");jQuery("input[name=career_country]").val(country_val);jQuery("#subctry span").text(country_val);jQuery(".sub-country-show").hide()});jQuery("#sel_sort_val li").click(function(){var jobsort_val=$(this).attr("id");jQuery("input[name=sort_val]").val(jobsort_val);jQuery("#career_list_form").submit()});jQuery("#selc_position li a").click(function(){var job_title_val=$(this).text();jQuery("input[name=job_position]").val(job_title_val);jQuery("#title-btn span").text(job_title_val);jQuery("#title-btn").addClass("value-selected");jQuery(this).addClass("active");jQuery("#selc_position li a").not(this).removeClass("active");jQuery(".job-position-show").hide()});jQuery(".job-loc").click(function(){jQuery(".job-loc-show").toggle()});jQuery(".job-exp").click(function(){jQuery(".job-exp-show").toggle()});jQuery(".job-course").click(function(){jQuery(".job-course-show").toggle()});jQuery(".job-course-spec").click(function(){jQuery(".job-course-spec-show").toggle()});jQuery(".pg-course").click(function(){jQuery(".pg-course-show").toggle()});jQuery(".pg-course-spec").click(function(){jQuery(".pg-course-spec-show").toggle()});jQuery(".currency_code").click(function(){jQuery(".currency_code_show").toggle()});jQuery("#sel-job-loc li a").click(function(){$(this).addClass("active");$("#sel-job-loc li a").not(this).removeClass("active")});jQuery("#sel-job-exp li a").click(function(){$(this).addClass("active");$("#sel-job-exp li a").not(this).removeClass("active")});jQuery("#sel-job-course li a").click(function(){$(this).addClass("active");$("#sel-job-course li a").not(this).removeClass("active")});jQuery("#sel-course-spec li a").click(function(){$(this).addClass("active");$("#sel-course-spec li a").not(this).removeClass("active")});jQuery("#sel-pg-course li a").click(function(){$(this).addClass("active");$("#sel-pg-course li a").not(this).removeClass("active")});jQuery("#sel-pg-spec li a").click(function(){$(this).addClass("active");$("#sel-pg-spec li a").not(this).removeClass("active")});jQuery("#sel-job-loc li").click(function(){var job_loc_val=$(this).attr("id");jQuery("input[name=job_apply_location]").val(job_loc_val);jQuery(".job-loc span").text(job_loc_val);jQuery(".job-loc").addClass("value-selected");$('label[for="job_apply_location"]').hide();jQuery(".job-loc-show").hide()});jQuery("#sel-job-exp li").click(function(){var job_exp_val=$(this).attr("id");jQuery("input[name=job_apply_experience]").val(job_exp_val);jQuery(".job-exp span").text(job_exp_val);jQuery(".job-exp").addClass("value-selected");$('label[for="job_apply_experience"]').hide();jQuery(".job-exp-show").hide()});jQuery("#sel-job-course li").click(function(){var job_course_val=$(this).attr("id");jQuery("input[name=job_apply_course]").val(job_course_val);jQuery(".job-course span").text(job_course_val);jQuery(".job-course").addClass("value-selected");jQuery(".job-course-show").hide()});jQuery("#sel-course-spec li").click(function(){var course_spec_val=$(this).attr("id");jQuery("input[name=job_apply_course_spec]").val(course_spec_val);jQuery(".job-course-spec span").text(course_spec_val);jQuery(".job-course-spec").addClass("value-selected");jQuery(".job-course-spec-show").hide()});jQuery("#sel-pg-course li").click(function(){var pg_course_val=$(this).attr("id");jQuery("input[name=job_pg_course]").val(pg_course_val);jQuery(".pg-course span").text(pg_course_val);jQuery(".pg-course").addClass("value-selected");jQuery(".pg-course-show").hide()});jQuery("#sel-pg-spec li").click(function(){var pg_spec_val=$(this).attr("id");jQuery("input[name=job_pg_course_spec]").val(pg_spec_val);jQuery(".pg-course-spec span").text(pg_spec_val);jQuery(".pg-course-spec").addClass("value-selected");jQuery(".pg-course-spec-show").hide()});jQuery("#sel_currency_code li").click(function(){var currency_val=$(this).attr("id");var newSrc=$(this).find("img").attr("src");$("#country_flag img").attr("src",newSrc);jQuery("input[name=ctc_currency_code]").val(currency_val);jQuery(".currency_code span").text(currency_val);jQuery(".currency_code").addClass("value-selected");jQuery(".currency_code_show").hide()});jQuery(document).ready(function(){jQuery("#menu-item-130").find("a").attr("data-toggle","modal");jQuery("#menu-item-130").find("a").attr("data-target","#schedule_form");jQuery("#menu-item-130").find("a").attr("data-keyboard","false");jQuery("#menu-item-130").find("a").attr("data-backdrop","static");jQuery("#menu-item-130").find("a").attr("id","schedule_trigger");jQuery("#menu-item-1039").find("a").attr("data-toggle","modal");jQuery("#menu-item-1039").find("a").attr("data-target","#meetingForm");jQuery("#menu-item-1039").find("a").attr("data-keyboard","false");jQuery("#menu-item-1039").find("a").attr("data-backdrop","static");jQuery("#menu-item-1039").find("a").attr("id","meetingtrigger")});jQuery(".carousel-section-one").slick({dots:!1,arrows:!0,infinite:!1,speed:300,slidesToShow:1,slidesToScroll:1});jQuery(".carousel-tab-link").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1,focusOnSelect:!0});$(".student_service").click(function(event){imageDisplay();var mydata=$(this).data("mydata");$("#student_service_text").text(mydata);$("#student_service").val(mydata);$(".tickimage").removeClass("active");$(this).find("a").addClass("active");$(this).find("img").attr("style","display:block")});function imageDisplay(){$(".tickimage").each(function(event){$(this).find("img").attr("style","display:none")})}
imageDisplay();jQuery(".show-resume-form").hide();jQuery("#htmlcheck").click(function(){if($(this).is(":checked")){jQuery(".show-resume-form").show()}else{jQuery(".show-resume-form").hide()}});$("#upload_resume").on("change",function(e){var resumename=$(this).val().replace(/C:\\fakepath\\/i,"");$("#sel_resume_name").html("<span>"+resumename+"</span>")});$("#upload_letter").on("change",function(e){var lettername=$(this).val().replace(/C:\\fakepath\\/i,"");$("#sel_letter_name").html("<span>"+lettername+"</span>")});jQuery(".contact-service").click(function(){jQuery(".contact-service-show").toggle()});jQuery("#sel-contact-service li a").click(function(){$(this).addClass("active");$("#sel-contact-service li a").not(this).removeClass("active")});jQuery("#sel-contact-service li").click(function(){var service_loc_val=$(this).attr("id");jQuery("input[name=contact-service]").val(service_loc_val);jQuery(".contact-service ").text(service_loc_val);jQuery(".contact-service ").addClass("value-selected");jQuery(".contact-service").removeClass("error");jQuery(".contact-service-show").hide()});jQuery(".schuser_loc").click(function(){jQuery(".schuser_loc_show").toggle()});jQuery(".schedule-btn-hide").click(function(){jQuery(".schedule-section-show").css("display","block");jQuery(".schedule-btn-hide").css("display","none")});jQuery(".hide-speaker-btn").click(function(){jQuery(".show-speaker-list").css("display","block");jQuery(".hide-speaker-btn").css("display","none")});jQuery(".allformtrigger").click(function(){jQuery(".helpchat").hide()});jQuery(".close").click(function(){jQuery(".helpchat").show()});jQuery(".close-btn").click(function(){jQuery(".helpchat").show()})})