jQuery(document).ready(function () {

  jQuery("#calendarform").datepicker({

    beforeShowDay: noSunday, // disable to select all sunday
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: new Date(),
    yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
  });
  jQuery("#meeting_date").datepicker({

    beforeShowDay: noSunday, // disable to select all sunday
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: new Date(),
    yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
  });

  jQuery(".start-service").click(function () {
    var className = $(this).attr('class');
    var servicecat = $(this).attr('id');
    var serviceval = $(this).data('mydata'); // current element h6 tag value
    jQuery('input[name=service_value]').val($.trim(serviceval)); // assign value to hidden input 
    jQuery('input[name=primary_cat]').val(servicecat.replace('_',' '));
    jQuery(this).addClass("active");
    jQuery(".start-service").not(this).removeClass("active");
    $(".sel_service").removeClass("error");
    $('.sel_service').css('display', 'none');
  });

  jQuery(".select_loc").click(function () {
    jQuery('.select_loc_show').toggle();

  });

  jQuery(document).on("click", function (e) {
    if ($(e.target).is(".select_loc_show, .select_loc") === false) {
      jQuery(".select_loc_show").hide();
    }
  });

  jQuery(".pick_time").click(function () {
    jQuery('.pick_time_show').toggle();

  });

  jQuery(document).on("click", function (e) {
    if ($(e.target).is(".pick_time_show, .pick_time") === false) {
      jQuery(".pick_time_show").hide();
    }
  });

  jQuery(".pick_time_show ul li a").click(function () {
    var time = $(this).text();
    jQuery('input[name=pick_time]').val(time); // assign value to hidden input
    $("#pick_time").removeClass("error");
    jQuery('.pick_time_show').hide();
  });

  jQuery(".sel_interest").click(function () {
    jQuery('.sel_interest_show').toggle();

  });

  jQuery(document).on("click", function (e) {
    if ($(e.target).is(".sel_interest_show, .sel_interest") === false) {
      jQuery(".sel_interest_show").hide();
    }
  });

  jQuery(".sel_interest_show ul li a").click(function () {
    var interestin = $(this).data('mydata');
    jQuery(this).addClass('active');
    jQuery(".sel_interest_show ul li a").not(this).removeClass("active");
    jQuery(".sel_interest").text(interestin);
    jQuery('.sel_interest').addClass('value-selected');
    jQuery('input[name=user_interest]').val(interestin); // assign value to hidden input
    $(".sel_interest").removeClass("error");
    jQuery('.sel_interest_show').hide();
  });

  jQuery('.input-value').on('input', function () {
    var inputval = jQuery(this).val();
    $(this).removeClass('error');
  });

  jQuery('#isterm').change(function () {
    if ($(this).prop("checked")) {
      $("#isterm").removeClass("error");
    }

  });

});

/** Schedule meeting form code **/
jQuery(document).ready(function () {

  jQuery('#schedule').change(function () {
    if ($(this).prop("checked")) {
      $("#schedule").removeClass("error");
    }
  });

  jQuery("#schedule_meeting .usertype").click(function () {
    var className = $(this).attr('class');
    var selrole = $(this).data('mydata'); // current element h6 tag value

    jQuery('input[name=your_role]').val($.trim(selrole)); // assign value to hidden input  
    jQuery(this).addClass("active");
    jQuery("#schedule_meeting .usertype").not(this).removeClass("active");

    jQuery('input[name=schedule_service]').val(''); // assign value to hidden input

    $('.nav-tabs a').each(function () {
      if ($(this).hasClass('active'))
        var activetab = $(this).attr('id');
      jQuery('#' + activetab).removeClass("active");
      var tabcontent = $(this).attr('href');
      jQuery('#schedule_meeting' + ' ' + tabcontent).removeClass("show active");

    });

    var activerole = $.trim(selrole);

    if (activerole == "a Student") {
      $('#nav-Ed-tab').addClass('active');
      $('.tab-content #nav-Ed').addClass('show active');
    }

    if (activerole == "an Investor") {
      $('#nav-Investment-tab').addClass('active');
      $('.tab-content #nav-Investment').addClass('show active');
    }

    if (activerole == "a Partner") {
      $('#nav-Partnerships-tab').addClass('active');
      $('.tab-content #nav-Partnerships').addClass('show active');
    }

  });

  jQuery(".schedule_time").click(function () {
    jQuery('.schedule_time_show').toggle();

  });

  jQuery(document).on("click", function (e) {
    if ($(e.target).is(".schedule_time_show, .schedule_time") === false) {
      jQuery(".schedule_time_show").hide();
    }
  });

  jQuery(".schedule_time_show ul li a").click(function () {
    var seltime = $(this).text();
    jQuery('input[name=schedule_time]').val(seltime); // assign value to hidden input
    jQuery('input[name=userschedule_time]').val(seltime); // assign value to hidden input
    $("#schedule_time").removeClass("error");
    jQuery('.schedule_time_show').hide();
  });

  jQuery("#schedule_meeting .choose-service").click(function () {
    var className = $(this).attr('class');
    var idName = $(this).attr('id');
    var servicetype = $(this).data('mydata'); // current element h6 tag value

    jQuery('input[name=schedule_service]').val($.trim(servicetype)); // assign value to hidden input 
    jQuery('input[name=parent_cat]').val($.trim(idName)); 
    $(".user_choice").removeClass("error");
    $(".user_choice").css('display', 'none');
    jQuery(this).addClass("active");
    jQuery("#schedule_meeting .choose-service").not(this).removeClass("active");
  });

  jQuery('#schedule_loc').change(function () {
    if ($(this).prop("checked")) {
      $(".enbale-location").css('display', 'none');
    }
    else {
      $(".enbale-location").css('display', 'block');
    }
  });

  jQuery('#schedule_check').change(function () {
    if ($(this).prop("checked")) {
      $(".hide-location").css('display', 'none');
    }
    else {
      $(".hide-location").css('display', 'block');
    }
  });

jQuery('.test-preparation').click(function () {
    $(".learn-sub-tab").css('display', 'block');
    $(".english-language-sub-tab").css('display', 'none');
    $(".career-sub-tab").css('display', 'none');
    jQuery('input[name=test_preparation_val]').val('');
  });
  
  jQuery('.english-language-preparation').click(function () {
    $(".english-language-sub-tab").css('display', 'block');
    $(".learn-sub-tab").css('display', 'none');
    $(".career-sub-tab").css('display', 'none');
    jQuery('input[name=test_preparation_val]').val('');
  });

  jQuery('.career-preparation').click(function () {
    $(".english-language-sub-tab").css('display', 'none');
    $(".learn-sub-tab").css('display', 'none');
    $(".career-sub-tab").css('display', 'block');
    jQuery('input[name=test_preparation_val]').val('');
  });

  jQuery('.learn-other').click(function () {
    $(".english-language-sub-tab").css('display', 'none');
    $(".learn-sub-tab").css('display', 'none');
    $(".career-sub-tab").css('display', 'none');
    jQuery('input[name=test_preparation_val]').val(''); 
  });

jQuery(".choosen-box.select-preparation").click(function () {
    var className = $(this).attr('class');
    var test_type = $(this).data('mydata'); // current element h6 tag value

    jQuery('input[name=test_preparation_val]').val($.trim(test_type)); // assign value to hidden input 
    jQuery('input[name=preparation_val]').val($.trim(test_type)); // assign value to hidden input  
    jQuery(this).addClass("active");
    jQuery(".choosen-box.select-preparation").not(this).removeClass("active");
  });


  /** Journey - Global learning **/
  jQuery('.start-career').click(function () {
    $(".global-sub-service, .start_lang-preparation, .start_test-preparation").css('display', 'none');
    $(".start_career-preparation").css('display', 'block');
    $(".sel_interest").text('Select');
    $(".sel_interest_show ul li a").removeClass("active");
    jQuery('input[name=user_interest]').val('');
  });

  jQuery('.start-lan-service').click(function () {
    $(".global-sub-service, .start_career-preparation, .start_test-preparation").css('display', 'none');
    $(".start_lang-preparation").css('display', 'block');
    $(".sel_interest").text('Select');
    $(".sel_interest_show ul li a").removeClass("active");
    jQuery('input[name=user_interest]').val('');
  });

  jQuery('.start-test-service').click(function () {
    $(".global-sub-service, .start_career-preparation, .start_lang-preparation").css('display', 'none');
    $(".start_test-preparation").css('display', 'block');
    $(".sel_interest").text('Select');
    jQuery('input[name=user_interest]').val('');
    $(".sel_interest_show ul li a").removeClass("active");
  });

  jQuery('.start-other-service').click(function () {
    $(".start_test-preparation, .start_career-preparation, .start_lang-preparation").css('display', 'none');
    $(".global-sub-service").css('display', 'block');
    $(".sel_interest").text('Select');
    jQuery('input[name=user_interest]').val('');
    $(".sel_interest_show ul li a").removeClass("active");
  });

});


function next_section(id, nextid, sbar, sbaricon, spName, sdevice) {

  var nameReg = /^[A-Za-z ]+$/;
  var numberReg = /^[0-9]+$/;
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  var ufname = $('#user_fname').val();
  var ulname = $('#user_lname').val();
  var uemail = $('#user_email').val();
  var uphone = $('#user_mobile').val();
  var ischeck = document.getElementById("schedule");
  var pickdate = $('#meeting_date').val();
  var usel_time = $('#schedule_time').val();
  var user_role = $('#your_role').val();

  var locfield = $('#selectloc_field').val();
  var isVerify = $('input[name="schedule_loc"]:checked').length;

  var isError = '';

  if (id == 'first_detail_section') {

		if (ufname == "") {
		  $("#user_fname").addClass("error");
		  isError = 1;
		}
		else if (!nameReg.test(ufname)) {
		  $("#user_fname").addClass("error");
		  isError = 1;
		}

		if (ulname == "") {
		  $("#user_lname").addClass("error");
		  isError = 1;
		}
		else if (!nameReg.test(ulname)) {
		  $("#user_lname").addClass("error");
		  isError = 1;
		}

		if (uemail == "") {
		  $("#user_email").addClass("error");
		  isError = 1;
		}
		else if (!emailReg.test(uemail)) {
		  $("#user_email").addClass("error");
		  isError = 1;
		}

		if (uphone == "") {
		  $("#user_mobile").addClass("error");
		  isError = 1;
		}
		else if (!numberReg.test(uphone)) {
		  $("#user_mobile").addClass("error");
		  isError = 1;
		}

		if (numberReg.test(uphone)) {
		  if (uphone.length < 10) {
			$("#user_mobile").addClass("error");
			isError = 1;
		  }
		  if (uphone.length > 12) {
			$("#user_mobile").addClass("error");
			isError = 1;
		  }
		}

		if (!ischeck.checked) {
		  isError = 1;
		  $("#schedule").addClass("error");
		}
		else {
		  $("#schedule").removeClass("error");
		}

		if (user_role == '') {
		  isError = 1;
		  $(".select_role").addClass("error");
		}
		else {
		  $(".select_role").removeClass("error");
		}
	}  

  if (id == 'second_detail_section') {

    if (pickdate == '') {
      $("#meeting_date").addClass("error");
      isError = 1;
    }
    if (usel_time == '') {
      $("#schedule_time").addClass("error");
      isError = 1;
    }

    /** location validation - start **/
    if(isVerify == 0){
      if(locfield == ''){
        $(".schuser_loc").addClass("error");
        isError = 1;
      }
    }
    else if(isVerify == 1){
      $(".schuser_loc").removeClass("error");
    }
  /** location end **/  

  }

  if (isError == '') {
	  
	if (id == 'first_detail_section') {	
		
		var schedule_from_data = { type: 'calenldlyScheduleMeeting', email: uemail, mobile: uphone }
		//console.log(schedule_from_data);		
		$.ajax({
			type: "POST",
			url: "/form/submit_form.php",
			data: schedule_from_data,
			cache: false,
			success: function (data) {

				var response = JSON.parse(data);		  
				//console.log(response);return false;
			  
				var message = response.result.message;
				var status = response.result.status;
				
				//console.log(status);

				if (status == 'success') {
					//$('#meeting_error').text(message);
					
					//alert('Hey it looks like you’ve already got an account with us. Sign into your Portal to e-meet with us!');	
 					$('.step-form-title').addClass('d-none');
					$('#schedule_meeting').addClass('d-none');
					$('#step-progress').addClass('d-none');

					$('.process-step').addClass('d-none');
					$('.already-acc').removeClass('d-none');

					$('.close').click(function(){
 					$('.already-acc').addClass('d-none');
					$('.step-form-title').removeClass('d-none');
					$('#schedule_meeting').removeClass('d-none');
					$('#step-progress').removeClass('d-none');

					$('.process-step').removeClass('d-none');
					});
	
					//$('#schedule_meeting').css('display', 'none');
					//$('.step-form-title').css('display', 'none');
					//$('.cnf-title').css('display', 'block');
					//$('#schedule_cnf').css('display', 'block');
					//$('.schedule-btn').removeAttr('disabled');
					
				} else {
					
					 var userdata = ufname + ' ' + ulname + ' , ' + user_role;

					if (user_role == 'a Student') {
					  $('#nav-Partnerships-tab,#nav-Workspace-tab, #nav-Investment-tab').css('display', 'none');
					  $('#nav-Ed-tab, #nav-Learning-tab').css('display', 'block');
					}

					if (user_role == 'an Investor') {
					  $('#nav-Ed-tab, #nav-Partnerships-tab, #nav-Learning-tab, #nav-Workspace-tab').css('display', 'none');
					  $('#nav-Investment-tab').css('display', 'block');
					}

					if (user_role == 'a Partner') {
					  $('#nav-Ed-tab,#nav-Investment-tab,#nav-Learning-tab').css('display', 'none');
					  $('#nav-Partnerships-tab,#nav-Workspace-tab').css('display', 'block');
					}

					if (sbaricon == 'schedulebaricon2') {
					  $('.step-form-title').html('Secondly…');
					  $('.first_userdetail').html(userdata);

					}
					if (sbaricon == 'schedulebaricon3') {
					  $('.step-form-title').html('Last but not least');
					}

					document.getElementById("first_detail_section").style.display = "none";
					document.getElementById("second_detail_section").style.display = "none";
					document.getElementById("third_detail_section").style.display = "none";

					$('.user_interest_section').css('display', 'block');
					$('.summary_section').css('display', 'none');

					jQuery("#" + nextid).fadeIn();
					document.getElementById(sbar).style.backgroundColor = "#d91f3d";
					$('#' + sbaricon).css({ "background-color": "#d91f3d", "color": "#FFF" });

					if (spName == 'global-ed') {
					  document.getElementById(sbar).style.backgroundColor = "#d91f3d";
					  $('#' + sbaricon).css({ "background-color": "#d91f3d", "color": "#FFF" });
					}
					else if (spName == 'global-learning') {
					  document.getElementById(sbar).style.backgroundColor = "#ff8906";
					  $('#' + sbaricon).css({ "background-color": "#ff8906", "color": "#FFF" });
					}
					else if (spName == 'global-investment') {
					  document.getElementById(sbar).style.backgroundColor = "#2c2556";
					  $('#' + sbaricon).css({ "background-color": "#2c2556", "color": "#FFF" });
					}
					else if (spName == 'global-workspace') {
					  document.getElementById(sbar).style.backgroundColor = "#4ccdc9";
					  $('#' + sbaricon).css({ "background-color": "#4ccdc9", "color": "#FFF" });
					}				
				}
			}
		}); 
	  
	}else{
		
		 var userdata = ufname + ' ' + ulname + ' , ' + user_role;

		if (user_role == 'a Student') {
		  $('#nav-Partnerships-tab,#nav-Workspace-tab, #nav-Investment-tab').css('display', 'none');
		  $('#nav-Ed-tab, #nav-Learning-tab').css('display', 'block');
		}

		if (user_role == 'an Investor') {
		  $('#nav-Ed-tab, #nav-Partnerships-tab, #nav-Learning-tab, #nav-Workspace-tab').css('display', 'none');
		  $('#nav-Investment-tab').css('display', 'block');
		}

		if (user_role == 'a Partner') {
		  $('#nav-Ed-tab,#nav-Investment-tab,#nav-Learning-tab').css('display', 'none');
		  $('#nav-Partnerships-tab,#nav-Workspace-tab').css('display', 'block');
		}

		if (sbaricon == 'schedulebaricon2') {
		  $('.step-form-title').html('Secondly…');
		  $('.first_userdetail').html(userdata);

		}
		if (sbaricon == 'schedulebaricon3') {
		  $('.step-form-title').html('Last but not least');
		}

		document.getElementById("first_detail_section").style.display = "none";
		document.getElementById("second_detail_section").style.display = "none";
		document.getElementById("third_detail_section").style.display = "none";

		$('.user_interest_section').css('display', 'block');
		$('.summary_section').css('display', 'none');

		jQuery("#" + nextid).fadeIn();
		document.getElementById(sbar).style.backgroundColor = "#d91f3d";
		$('#' + sbaricon).css({ "background-color": "#d91f3d", "color": "#FFF" });

		if (spName == 'global-ed') {
		  document.getElementById(sbar).style.backgroundColor = "#d91f3d";
		  $('#' + sbaricon).css({ "background-color": "#d91f3d", "color": "#FFF" });
		}
		else if (spName == 'global-learning') {
		  document.getElementById(sbar).style.backgroundColor = "#ff8906";
		  $('#' + sbaricon).css({ "background-color": "#ff8906", "color": "#FFF" });
		}
		else if (spName == 'global-investment') {
		  document.getElementById(sbar).style.backgroundColor = "#2c2556";
		  $('#' + sbaricon).css({ "background-color": "#2c2556", "color": "#FFF" });
		}
		else if (spName == 'global-workspace') {
		  document.getElementById(sbar).style.backgroundColor = "#4ccdc9";
		  $('#' + sbaricon).css({ "background-color": "#4ccdc9", "color": "#FFF" });
		}
		
		
	}

  }
  
}

function prev_section(previd, bar) {

  if (bar == 'schedulebar1') {
    $('.step-form-title').html('First things first');
  }
  if (bar == 'schedulebar2') {
    $('.step-form-title').html('Secondly…');
  }

  document.getElementById("first_detail_section").style.display = "none";
  document.getElementById("second_detail_section").style.display = "none";
  document.getElementById("third_detail_section").style.display = "none";
  jQuery("#" + previd).fadeIn();
  document.getElementById(bar).style.backgroundColor = "#D8D8D8";
}

function show_summary() {

  var ufname = $('#user_fname').val();
  var ulname = $('#user_lname').val();
  var uemail = $('#user_email').val();
  var uphone = $('#user_mobile').val();
  var pickdate = $('#meeting_date').val();
  var usel_time = $('#schedule_time').val();

  var date = new Date(pickdate);
  var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  var weekday = weekdays[date.getDay()];

  var personal_detail = '<h4>' + ufname + ' ' + ulname + '</h4><p>' + uemail + '<br>' + uphone + '</p>';
  var date_time = '<h4>' + pickdate + '</h4><p>' + weekday + ',' + usel_time + '</p>';
  $('.user-detail').html(personal_detail);
  $('.user-day').html(date_time);

  var service = $('#schedule_service').val();
  submitError = '';

  if (service == "") {
    $(".user_choice").addClass("error");
    $('.user_choice').css('display', 'block');
    submitError = 1;
  }
  else {
    $('.user_choice').css('display', 'none');
  }

  if (submitError == '') {
    $('.user_interest_section').css('display', 'none');
    $('.summary_section').css('display', 'block');
  }

}

function show_section() {
  $('.user_interest_section').css('display', 'block');
  $('.summary_section').css('display', 'none');

}

function onSchedule(device) {

  var preparation = '';
  var scheduleCheck = '';
  
  var ufname = $('#user_fname').val();
  var ulname = $('#user_lname').val();
  var uemail = $('#user_email').val();
  var uphone = $('#user_mobile').val();
  var user_role = $('#your_role').val();
  var pickdate = $('#meeting_date').val();
  var usel_time = $('#schedule_time').val();
  var loc = $('#schjourney_loc').val();
  var addr = $(".user-location-detail p").text();
  var cat_type = $('#parent_cat').val();
  var service = $('#schedule_service').val();
  var preparation = $('#test_preparation_val').val();
  var scheduleCheck = $('input[name="schedule_loc"]:checked').length;
  //var selected_interest_val = $('#user_interest').val();
  var trackid = $('#ProspectID').val();
  var current_page = $('#curPage').val();

  $('.schedule-btn').attr('disabled', 'disabled'); // disable multiple time form submit
  $(".btnLoader").css('display', 'block');

  var schedule_from_data = { type: 'scheduleMeeting', scheduleCheck: scheduleCheck, firstname: ufname, lastname: ulname, email: uemail, mobile: uphone, role: user_role, date: pickdate, time: usel_time, location: loc, address: addr, primary_category:cat_type, service: service, preparation: preparation, ProspectID:trackid, pagename: current_page }
  //console.log(schedule_from_data);
  $.ajax({
    type: "POST",
    url: "/form/submit_form.php",
    data: schedule_from_data,
    cache: false,
    success: function (data) {

      var response = JSON.parse(data);
      var message = response.result.message;
      var status = response.result.status;

      if (status == 'true') {
        $('#schedule_meeting').css('display', 'none');
        $('.step-form-title').css('display', 'none');
        $('.cnf-title').css('display', 'block');
        $('#schedule_cnf').css('display', 'block');

        $('.schedule-btn').removeAttr('disabled');
		
		// redirect to google after 3 seconds
		window.setTimeout(function() {
			window.location.href = 'https://calendly.com/tcglobal';
		}, 3000);
		
      } else {
        $('.schedule-btn').removeAttr('disabled');
        $(".btnLoader").css('display', 'none');
        $('#meeting_error').text(message);
      }
    },
    error: function (data) {
      $('.schedule-btn').removeAttr('disabled');
      $(".btnLoader").css('display', 'none');
      $('#meeting_error').text('An error occurred');
    }
  });

}

jQuery(document).ready(function() {
    jQuery("#schedule_trigger").click(function(){

      /** disable time based on current time **/
      var d = new Date();
      var n = d.getHours();

      var fixtime = n+1;
      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

      if(val >= fixtime){
          //console.log(index, val);
          jQuery('#dd_'+val).removeClass("taken")
        }else{
          jQuery('#dd_'+val).addClass("taken")
        }

      });
      
      document.getElementById('schedulebar1').style.backgroundColor = "#f1f1f2";
      $('#schedulebaricon2').css({ "background-color": "#edeeef", "color": "#a8a8a8" });
      document.getElementById('schedulebar2').style.backgroundColor = "#f1f1f2";
      $('#schedulebaricon3').css({ "background-color": "#edeeef", "color": "#a8a8a8" });

      $('#first_detail_section').css('display','block');
      $('#second_detail_section, #third_detail_section, #schedule_cnf').css('display','none');
      $('#schedule_meeting').css('display','block');
      $('.cnf-title').css('display','none');
      $('.step-form-title').css('display','block');

      $('.step-form-title').html('First things first');

     $("#schedule_meeting").closest('form').find("input[type=text], select, textarea, checkbox").val("");
      jQuery("#schedule_meeting .usertype").removeClass("active");

      jQuery("#schedule_meeting .choose-service").removeClass("active");
      jQuery(".choosen-box.select-preparation").removeClass("active");

      $(".english-language-sub-tab").css('display', 'none');
    $(".learn-sub-tab").css('display', 'none');
    $(".career-sub-tab").css('display', 'none');

    $(".enbale-location").css('display', 'block');

      jQuery('input[name=user_mobile]').val('');

      jQuery('input[name=your_role]').val(''); 
      jQuery('input[name=schedule_service]').val('');
      jQuery('input[name=test_preparation_val]').val('');
      jQuery('input[name=selectloc_field]').val('');    

      $("#schedule").prop('checked',false);
      $("#schedule_loc").prop('checked',false);
      
      });


    /** Start your journey form reset **/

    jQuery(".journey_formClear").click(function(){

      /** disable time based on current time **/
      var d = new Date();
      var n = d.getHours();
      var fixtime = n+1;
      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

      if(val >= fixtime){
          //console.log(index, val);
          jQuery('#ss_'+val).removeClass("taken")
        }else{
          jQuery('#ss_'+val).addClass("taken")
        }

      });
      
      document.getElementById('bar1').style.backgroundColor = "#f1f1f2";
      $('#baricon2').css({ "background-color": "#edeeef", "color": "#a8a8a8" });
      document.getElementById('bar2').style.backgroundColor = "#f1f1f2";
      $('#baricon3').css({ "background-color": "#edeeef", "color": "#a8a8a8" });

      $('#account_details').css('display','block');
      $('#user_details, #qualification, #Confirmation').css('display','none');
      $('#journey_form').css('display','block');
      $('.cnf-title').css('display','none');
      $('.step-form-title').css('display','block');
      $('.step-form-title').html('First things first');
      $("#journey_form").closest('form').find("input[type=text], select, textarea, checkbox").val("");

      jQuery(".start-service").removeClass("active");

      $(".hide-location").css('display', 'block');
      jQuery('input[name=journeyloc_field]').val('');
      $("#isterm").prop('checked',false);
      $("#schedule_check").prop('checked',false);
      jQuery('input[name=service_value]').val(''); 
      jQuery('input[name=user_interest]').val('');
      jQuery('.sel_interest').text('Select');
          
  });

$("#meeting_date").on("change",function(){
        var selectDate = $(this).val(); // get user selected date
        
        jQuery('input[name=schedule_time]').val('');

        /** Change date format for user selected date **/
        var newmonth = '';

        var parts =selectDate.split('-');
        var seldate = parts[0];
        var selmonth = parts[1];
        var selyear = parts[2];

        var verifyMonth = ['Jan','Feb','Mar','Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $.each(verifyMonth , function(index, val) {

         if(val == selmonth){
              newmonth = index+1;
            }
        });

      var newDate = selyear +'-'+ newmonth +'-'+seldate;
      var checktdate = new Date(newDate);

      /** get current date -start **/
      var today = new Date();
      /** get current date -end **/
      var curHour = today.getHours();
      var scheduleHour = curHour+1; // Add 1 hr form current hour

      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

        if(checktdate > today){
          jQuery('#dd_'+val).removeClass("taken")
        }

        else{

            if(val >= scheduleHour){
                jQuery('#dd_'+val).removeClass("taken")
            }
            else{
                jQuery('#dd_'+val).addClass("taken")
            }
        }
      });

  });

/** Start your journey form time disable based on current time **/
$("#calendarform").on("change",function(){

        var selectDate = $(this).val(); // get user selected date
        jQuery('input[name=pick_time]').val('');

        /** Change date format for user selected date **/
        var newmonth = '';

        var parts =selectDate.split('-');
        var seldate = parts[0];
        var selmonth = parts[1];
        var selyear = parts[2];

        var verifyMonth = ['Jan','Feb','Mar','Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $.each(verifyMonth , function(index, val) {

         if(val == selmonth){
              newmonth = index+1;
            }
        });

      var newDate = selyear +'-'+ newmonth +'-'+seldate;
      var checktdate = new Date(newDate);

      /** get current date -start **/
      var today = new Date();

      /** get current date -end **/

      var curHour = today.getHours();
      var scheduleHour = curHour+1; // Add 1 hr form current hour

      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

        if(checktdate > today){
          jQuery('#ss_'+val).removeClass("taken")
        }

        else{

            if(val >= scheduleHour){
                jQuery('#ss_'+val).removeClass("taken")
            }
            else{
                jQuery('#ss_'+val).addClass("taken")
            }
        }
      });

  });

});


/** meeting form validation come from email URL **/
jQuery(document).ready(function() {

jQuery("#usermeeting_date").datepicker({

    beforeShowDay: noSunday, // disable all sunday 
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: new Date(),
    yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
  });

});

jQuery(document).ready(function() {  

  jQuery(".meetuser_loc").click(function(){
  jQuery('.meetuser_loc_list').toggle();

});

  jQuery("#meetingtrigger").click(function(){

      /** disable time based on current time **/
      var d = new Date();
      var n = d.getHours();

      var fixtime = n+1;
      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

      if(val >= fixtime){
          //console.log(index, val);
          jQuery('#mm_'+val).removeClass("taken")
        }else{
          jQuery('#mm_'+val).addClass("taken")
        }

      });

      $('.step-form-title').html('First things first');
      $('#meeting_first_section').css('display','block');
      $('#meeting_cnf').css('display','none');
      $('.cnf-title').css('display','none');
      $('.step-form-title').css('display','block');

      $(".enbale-location").css('display', 'block');
      $("#checkbox_verify").prop('checked',false);

      jQuery('input[name=usermeeting_date]').val('');
      jQuery('input[name=userschedule_time]').val('');
      jQuery('input[name=meetingplace_field]').val('');
      $(".btnLoader").css('display', 'none');
      $('.schedule-btn').removeAttr('disabled');
      
    });

    $("#usermeeting_date").on("change",function(){

        var selectDate = $(this).val(); // get user selected date
        jQuery('input[name=userschedule_time]').val('');

        /** Change date format for user selected date **/
        var newmonth = '';

        var parts =selectDate.split('-');
        var seldate = parts[0];
        var selmonth = parts[1];
        var selyear = parts[2];

        var verifyMonth = ['Jan','Feb','Mar','Apr', 'May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $.each(verifyMonth , function(index, val) {

         if(val == selmonth){
              newmonth = index+1;
            }
        });

      var newDate = selyear +'-'+ newmonth +'-'+seldate;
      var checktdate = new Date(newDate);

        /** get current date -start **/
        var today = new Date();

      /** get current date -end **/
      var curHour = today.getHours();
      var scheduleHour = curHour+1; // Add 1 hr form current hour

      var scheduleTime = [10,11,12,13,14,15,16,17,18];

      $.each(scheduleTime , function(index, val) {

        if(checktdate > today){
          jQuery('#mm_'+val).removeClass("taken")
        }

        else{

            if(val >= scheduleHour){
                jQuery('#mm_'+val).removeClass("taken")
            }
            else{
                jQuery('#mm_'+val).addClass("taken")
            }
        }
      });

  });


jQuery('#checkbox_verify').change(function () {
    if ($(this).prop("checked")) {
      $(".enbale-location").css('display', 'none');
    }
    else {
      $(".enbale-location").css('display', 'block');
    }
  });
});


function UserMeetingSchedule(device) {

  var preparation = '';
  var scheduleCheck = '';
  var isError = '';

  var lead_val = $('#userleadid').val();
  var userEmail = $('#scheduleEmail').val();
  var source = jQuery('input[name=meetingSource]').val();
  
  var fixedDate = $('#usermeeting_date').val();
  var fixedTime = $('#userschedule_time').val();
  var location = $('#usermeetingplace').val();
  var address = $("#schedulemeeting_addr p").text();

  var locfield = $('#meetingplace_field').val();
  
  var isVerify = $('input[name="checkbox_verify"]:checked').length;
  
  if (fixedDate == '') {
      $("#usermeeting_date").addClass("error");
      isError = 1;
    }
    if (fixedTime == '') {
      $("#userschedule_time").addClass("error");
      isError = 1;
    }

    /** location validation - start **/
    if(isVerify == 0){
      if(locfield == ''){
        $(".meetuser_loc").addClass("error");
        isError = 1;
      }
    }
    else if(isVerify == 1){
      $(".meetuser_loc").removeClass("error");
    }
  /** location end **/ 

  if(isError == ''){

      $('.schedule-btn').attr('disabled', 'disabled'); // disable multiple time form submit
      $(".btnLoader").css('display', 'block');

      var meetingFromData = { type: 'MeetingConfirmation', scheduleCheck: isVerify, lead_id:lead_val, email: userEmail, source: source, date: fixedDate, time: fixedTime, location: location, address: address}
      
    $.ajax({
    type: "POST",
    url: "/form/submit_form.php",
    data: meetingFromData,
    cache: false,
    success: function (data) {

      var response = JSON.parse(data);
      var message = response.result.message;

      var status = response.result.status;
      
      if (status == 'true') {
        $('#meeting_first_section').css('display', 'none');
        $('.step-form-title').css('display', 'none');
        $('.cnf-title').css('display', 'block');
        $('#meeting_cnf').css('display', 'block');

        $('.schedule-btn').removeAttr('disabled');
      } else {
        $('.schedule-btn').removeAttr('disabled');
        $(".btnLoader").css('display', 'none');
        $('#scheduleError').text(message);
      }
    },
    error: function (data) {
      $('.schedule-btn').removeAttr('disabled');
      $(".btnLoader").css('display', 'none');
      $('#scheduleError').text('An error occurred');
    }
  });

}

}

/** events page location list **/
jQuery(document).ready(function() {

jQuery(".eventplace").click(function(){
    jQuery('.eventplace-show').toggle();
});

jQuery(".eventplace-show ul li a").click(function () {
    var selplace = $(this).text();
    jQuery(this).addClass('active');
    jQuery(".eventplace-show ul li a").not(this).removeClass("active");
    jQuery(".eventplace").text(selplace);
    jQuery('input[name=event_country]').val(selplace); // assign value to hidden input
    jQuery('.eventplace-show').hide();
  });

});

/** subscribe form data reset on click **/
jQuery(".form-reset").click(function(){
    $("#subscribe").closest('form').find("input[type=text], select, textarea, checkbox").val(""); 
    $(".inputcheckbox").prop('checked',false);
    jQuery('input[name=subscribe_topic]').val('');
    jQuery('#subscribe_topic_text').text('Choose topic');
    jQuery('#subscribe_error').val('');
});
/** portal form data reset on click **/
jQuery(".portal-form-reset").click(function(){
    $("#portalform").closest('form').find("input[type=text], select, textarea, checkbox").val(""); 
    $(".inputcheckbox").prop('checked',false);
    jQuery('input[name=student_service]').val('');
    jQuery('#student_service_text').text('Choose service');
    jQuery('#student_error').val('');
});

/** portal form add service data on investment page  **/
jQuery(".invest-portal-service").click(function(){

jQuery('input[name=student_service]').val('Global Investments');
jQuery('#student_service_text').text('Global Investments');
jQuery('#student_service_text').addClass('value-selected');

});

// disable to user select the all sunday's in datepicker
function noSunday(date){ 
    return [date.getDay() != 0, ''];
  }; 

/** custom_validation code goes here **/
jQuery(document).ready(function () {

jQuery(".cls-form").click(function() {
  jQuery('#contact-confirm').removeClass('show');
  jQuery('.removebackdrop').removeClass('show');
  jQuery('.removebackdrop').removeClass('modal-backdrop');
  jQuery('body').removeClass('modal-open');
  jQuery('#contact-confirm').css('display','none');

});
$(".number-field").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
     return false;
    }
});

$('.name-field').keypress(function (e) {

  if (e.which === 32 && !this.value.length)
        e.preventDefault();
    
    var regex = new RegExp("^[a-zA-Z ]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

$('.username-field').keypress(function (e) {
  if (e.which === 32 && !this.value.length)
    e.preventDefault();
    var regex = new RegExp("^[a-zA-Z. ]+$");
    var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(strigChar)) {
        return true;
    }
    return false
  });

jQuery('#TermsConditions').change(function(){
  if($(this).prop("checked")) {
    $("#termconditionerror").removeClass("error");
  }

});

  $('#name').val('');
  $('#email').val('');
  $('#mobile').val('');
  $('#service').val('');
  $('#message').val('');
  $("#TermsConditions").prop("checked", false);

  $('.submitform').click(function () {
    validateForm();
  });
  function selectedOptionImageDisplay() {
    $('.tickimage').each(function (event) {
      $(this).find('img').attr('style', 'display:none');
    })
  }
  selectedOptionImageDisplay();
  $('.input-value').change(function (event) {
    if ($(this).val()) {
      $(this).addClass('valid');
      $(this).removeClass('error');
    } else {
      $(this).removeClass('valid');
    }
  })
  $('.inputcheckbox').change(function (event) {
    console.log('$(this).prop("checked")', $(this).prop("checked"))
    if ($(this).prop("checked")) {
      $(this).next('label').removeClass('error');
    } else {
      $(this).next('label').addClass('error');
    }
  });
  function validateForm() {

    var nameReg = /^[A-Za-z ]+$/;
    var numberReg = /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var names = $('#name').val();
    var email = $('#email').val();
    var mobile = $('#mobile').val();
    var service = $('#contact-service').val();
    var message = $('#message').val();
    var termsConditions = $("#TermsConditions").prop('checked');
    var currentPage = $('#currentPage').val();
    var source = jQuery('input[name=pagesource]').val();
    var trackid = $('#ProspectID').val();
    var inputVal = new Array(names, email, mobile, service, message, termsConditions);

    var inputMessage = new Array("name", "email address", "mobile number", "service", "message", "Tterms & Conditions");
    $(".contact_form_field").removeClass("error");
    //$('.error').hide();
    var isError = '';

    if (inputVal[0] == "") {
      $("#name").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(names)) {
      $("#name").addClass("error");
      isError = 1;
    }
    if (inputVal[1] == "") {
      $("#email").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(email)) {
      $("#email").addClass("error");
      isError = 1;
    }
    if (inputVal[2] == "") {
      $("#mobile").addClass("error");
      isError = 1;
    }
    else if (!numberReg.test(mobile)) {
      $("#mobile").addClass("error");
      isError = 1;
    }

    if (numberReg.test(mobile)) {
        if(mobile.length < 10){
            $("#mobile").addClass("error");
            isError = 1;
        }
        if(mobile.length > 12){
            $("#mobile").addClass("error");
            isError = 1;
        }
      }

    if(service == ""){
      $(".contact-service").addClass("error");
      isError = 1;
    }

  if (inputVal[4] == "") {
      $("#message").addClass("error");
      isError = 1;
    }
    if (!$('#TermsConditions').is(':checked')) {
      $("#termconditionerror").addClass("error");
      isError = 1;
    }
    else {
      $("#termconditionerror").removeAttr("error");
    }
    
    if (isError == '') {

      var contact_from_data = { type: 'contact', name: names, email: email, mobileNumber: mobile, service: service, message: message, source: source, ProspectID:trackid, currentPage: currentPage }
      $(".btnLoader").css('display', 'block');
      $(".submitform").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: contact_from_data,
        cache: false,
        success: function (data) {
          var response = JSON.parse(data);
          var message = response.message;
          if (response.status) {

            $("#TermsConditions").prop('checked',false);
            if ($("#TermsConditions").is(':checked')){
                $("#TermsConditions").prop('checked',false);
              }

            $("#contactform").closest('form').find("input[type=text], select, textarea, checkbox").val(""); $("#contact_success").fadeOut(5000);
            jQuery(".contact-service").text('Choose Service');
            jQuery('input[name=contact-service]').val("");
            $('#contact-confirm').css('display','block');
            jQuery('body').addClass('modal-open');
            jQuery('#contact-confirm').addClass('show');
            jQuery('.modal-backdrop').addClass('show');
            jQuery('body').append("<div class='removebackdrop modal-backdrop fade show'></div>");

          } else {
            $('#contact_error').text('An error occurred');

          }
          $(".btnLoader").css('display', 'none');
          $(".submitform").attr("disabled", false);
        },
        error: function (data) {
          $(".btnLoader").css('display', 'none');
          $(".submitform").attr("disabled", false);
          $('#contact_error').text('An error occurred');
        }
      });
    }
  }

/** Portal or lead form validation and submission */
  $('.student_service').click(function (event) {
    selectedOptionImageDisplay();
    var mydata = $(this).data('mydata');
    $('#student_service_text').text(mydata);
    $('#student_service').val(mydata);
    $('#student_service_text').addClass('value-selected');
    $("#student_service_text").removeClass("error");
    $('.tickimage').removeClass('active');
    $(this).find('a').addClass('active');
    $(this).find('img').attr('style', 'display:block');

  })

$('.portalform').click(function () {
    $("#student_name").removeClass("error");
    $("#student_email").removeClass("error");
    $("#student_mobile").removeClass("error");
    $("#student_service_text").removeClass("error");
    $("#student_message").removeClass("error");
    validatePortalForm();
  });

function validatePortalForm() {
    var nameReg = /^[A-Za-z ]+$/;
    var numberReg = /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var names = $('#student_name').val();
    var email = $('#student_email').val();
    var mobile = $('#student_mobile').val();
    var service = $('#student_service').val();
    var message = $('#student_message').val();
    var termsConditions = $("#student_TermsConditions").prop('checked');
    var currentPage = $('#student_currentPage').val();
    var trackid = $('#ProspectID').val();
    var inputVal = new Array(names, email, mobile, service, message, termsConditions);

    var inputMessage = new Array("name", "email address", "mobile number", "service", "message", "Tterms & Conditions");

    var isError = '';
    if (inputVal[0] == "") {
      $("#student_name").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(names)) {
      $("#student_name").addClass("error");
      isError = 1;
    }

    if (inputVal[1] == "") {
      $("#student_email").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(email)) {
      $("#student_email").addClass("error");
      isError = 1;
    }

    if (inputVal[2] == "") {
      $("#student_mobile").addClass("error");
      isError = 1;
    }
    else if (!numberReg.test(mobile)) {
      $('#mobileLabel').after('<span class="error"> Numbers only</span>');
      $("#student_mobile").addClass("error");
      isError = 1;
    }
    if (inputVal[3] == "") {
      $("#student_service_text").addClass("error");
      isError = 1;
    }
    if (inputVal[4] == "") {
      $("#student_message").addClass("error");
      isError = 1;
    }
    if (!$('#student_TermsConditions').is(':checked')) {
      $("#student_termconditionerror").addClass("error");
      isError = 1;
    }
    if (isError == '') {
      $('.portalform').attr('disabled', 'disabled')
      var contact_from_data = { type: 'lead', name: names, email: email, mobileNumber: mobile, service: service, message: message, currentPage: currentPage, ProspectID:trackid, onboardLink: 'http://tcglobal.com/student-onboard' }
      $(".btnLoader").css('display', 'block');
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: contact_from_data,
        cache: false,
        success: function (data) {
          var response = JSON.parse(data);
          var message = response.result.message;
          $(".btnLoader").css('display', 'none');
          if (response.status) {
            $('#formsubmit').css('display', 'none');
            $('#formresult').css('display', 'block');
            $('#formsuccess').html("<p class='text-center fs-14'> Thanks for contacting us! We will reach you shortly and start our journey together</p>");
            $("#portalform").closest('form').find("input[type=text], select, textarea").val("");
            $('#student_service').val('');
            $('#student_service_text').text('Choose Service');
            $('#student_TermsConditions').prop('checked', false);
            setTimeout(() => {
              $('#formsubmit').css('display', 'block');
              $('#formresult').css('display', 'none');
              $('#checkeligible').modal('hide');
            }, 3000);
            $('.portalform').removeAttr('disabled');
          } else {
            $('.portalform').removeAttr('disabled');
            $('#student_error').text('An error occurred');
          }
        },
        error: function (data) {
          $('.portalform').removeAttr('disabled');
          $('#student_error').text('An error occurred');
        }
      });
    }
  }

/** Schedule meeting for validations starts here */
  $('#meeting_details').attr('style', 'display:none')
  $('#meeting_help').attr('style', 'display:none')
  $('#meeting_check_details').attr('style', 'display:none')
  $('#meeting_thanks_card').attr('style','display:none')

  $('.meeting_youare').click(function (event) {
    $('.meeting_youare_class').not(this).removeClass('active');
    var meeting_role = $(this).data('mydata');
    $('#meeting_role').val(meeting_role);
    //console.log('sdfs', $(this).find('.meeting_youare_class'))
    $(this).find('.meeting_youare_class').addClass('active');
  })
  $("#gobackbutton").click(function () {
    $('#meeting_basic_Details').attr('style', 'display:block');
    $('#meeting_details').attr('style', 'display:none')
  })
  $('#gobackToSecond').click(function () {
    $('#meeting_details').attr('style', 'display:block');
    $('#meeting_help').attr('style', 'display:none')
  })
  /** first step button action goes here */
  $('#stepone_button').click(function () {
    var nameReg = /^[A-Za-z ]+$/;
    var numberReg = /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var meeting_firstname = $('#meeting_firstname').val();
    var meeting_lastname = $('#meeting_lastname').val();
    var meeting_email = $('#meeting_email').val();
    var meeting_mobile = $('#meeting_mobile').val();
    var termsConditions = $("#meeting_terms").prop('checked');
    var meeting_role = $('#meeting_role').val();
    var currentPage = $('#currentPage').val();
    var inputVal = new Array(meeting_firstname, meeting_lastname, meeting_email, meeting_mobile, meeting_role,termsConditions);
    var isError = '';
    if (inputVal[0] == "") {
      $("#meeting_firstname").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(meeting_firstname)) {
      $("#meeting_firstname").addClass("error");
      isError = 1;
    }
    if (inputVal[1] == "") {
      $("#meeting_lastname").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(meeting_lastname)) {
      $("#meeting_lastname").addClass("error");
      isError = 1;
    }

    if (inputVal[2] == "") {
      $("#meeting_email").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(meeting_email)) {
      $("#meeting_email").addClass("error");
      isError = 1;
    }

    if (inputVal[3] == "") {
      $("#meeting_mobile").addClass("error");
      isError = 1;
    }
    else if (!numberReg.test(meeting_mobile)) {
      $("#meeting_mobile").addClass("error");
      isError = 1;
    }
    if (inputVal[4] == "") {
      $("#youare_error").attr("style","display:block");
      isError = 1;
    }
    else  {
      $("#youare_error").attr("style", "display:none");
    }

    if (!$('#meeting_terms').is(':checked')) {
      $("#meeting_termserror").addClass("error");
      isError = 1;
    }
    else {
      $("#meeting_termserror").removeAttr("error");
    }
    if (isError == '') {
      $('#meeting_details').attr('style', 'display:block')
      $('#meeting_basic_Details').attr('style', 'display:none')
      $('#first_step_icon').removeClass('active')
      $('#first_step_icon').addClass('complete')
      $('#second_step_icon').addClass('active');
      $('#second_step_icon').removeClass('disabled');

    }
  })

  /** Second step button action goes here */
  $('#step_two_button').click(function () {

    var calendarform = $('#calendarform').val();
    var pick_time = $('#pick_time').val();
    //console.log('calendarform', calendarform, 'pick_time', pick_time)
    var inputVal = new Array(calendarform, pick_time);
    var isError = '';
    if (inputVal[0] == "") {
      $("#calendarform").addClass("error");
      isError = 1;
    }
    else  {
      $("#calendarform").removeClass("error");
      isError = 1;
    }
    if (inputVal[1] == "") {
      $("#pick_time").addClass("error");
      isError = 1;
    }
    else  {
      $("#pick_time").removeClass("error");
      isError = 1;
    }
    if (!$('#meeting_schedule').is(':checked')) {
      $("#meeting_scheduleerror").addClass("error");
      isError = 1;
    }
    else {
      $("#meeting_scheduleerror").removeAttr("error");
    }
    if (isError == '') {
      $('#meeting_help').attr('style', 'display:block')
      $('#meeting_details').attr('style', 'display:none')
      $('#meeting_basic_Details').attr('style', 'display:none')
      $('#second_step_icon').removeClass('active')
      $('#second_step_icon').addClass('complete')
      $('#third_step_icon').addClass('active');
      $('#third_step_icon').removeClass('disabled');
    }
  })
});
