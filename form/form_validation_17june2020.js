var $j = jQuery.noConflict();

$j().ready(function () {

  $j("#apply_career_form").validate({

    ignore: "",
    rules: {
      user_first_name: {
        required: true,
        alphanumeric: true
      },
      user_last_name: {
        required: true,
        alphanumeric: true
      },
      user_email: {
        required: true,
        email: true

      },
      user_phone: {
        required: true,
        number: true,
        minlength: 10, // will count space 
        maxlength: 12
      },
      job_apply_location: {
        required: true
      },
      job_apply_experience: {
        required: true
      },
      resume: {
        extension: "docx|rtf|doc|pdf",
        filesize: 3000000, // max size 3MB 

      },
      current_company: {
        numeric: true
      },
      designation: {
        numeric: true
      },
      expected_ctc: {
        alphanumeric: true
      },
      cover_letter: {
        extension: "docx|rtf|doc|pdf",
        filesize: 3000000, // max size 3MB
      },
      terms: {
        required: true
      }

    },
    messages: {
      user_first_name: {
        required: "First name is required."
      },
      user_last_name: {
        required: "Last name is required."
      },
      user_email: {
        required: "Email address is required.",
        email: "Enter a valid email address."
      },
      user_phone: {
        required: "Phone number is required.",
        maxlength: "Please not enter more than 12 characters."
      },
      resume: {
        extension: "Please upload valid file formats."
      },
      cover_letter: {
        extension: "Please upload the doc,docx,pdf,rtf file only."
      }
    }
  });


  $j("#event_register_form").validate({

    ignore: "",
    rules: {
      firstname: {
        required: true,
        alphanumeric: true
      },
      lastname: {
        required: true,
        alphanumeric: true
      },
      email: {
        required: true,
        email: true
      },
      phone_num: {
        required: true,
        number: true,
        minlength: 10, // will count space 
        maxlength: 12
      },
      event_level_of_study: {
        required: true
      },
      event_areaofstudy: {
        required: true
      },
      country_name: {
        required: true
      },
      semester_year: {
        required: true
      },

      terms: {
        required: true
      }

    },
    messages: {
      firstname: {
        required: "First name is required."
      },
      lastname: {
        required: "Last name is required."
      },
      email: {
        required: "Email address is required.",
        email: "Enter a valid email address."
      },
      phone_num: {
        required: "Phone number is required.",
        maxlength: "Please not enter more than 12 characters."
      }

    },
    submitHandler: function (form) {

      $('#submit').attr('disabled', 'disabled'); // disable multiple time form submit 
      $(".btnLoader").css('display', 'block');

      var eventtime = '';
      var fname = $('#firstname').val();
      var lname = $('#lastname').val();
      var email = $('#email').val();
      var phoneno = $('#phone').val();
      var studyid = $('#event_level_id').val();
      var studyname = $('#event_level_of_study').val();
      var areaid = $('#event_area_id').val();
      var areastudy = $('#event_areaofstudy').val();
      var countryid = $('#country_id').val();
      var countryname = $('#country_name').val();
      var semid = $('#semid').val();
      var semyear = $('#semester_year').val();
      var venu = $('#event_venu').text();
      var eventtime = $('#event_time').text();
      var eventDate = $('#tcevent-date').text();
      var eventname = $('#event_name').val();
      var trackid = $('#ProspectID').val();

      var event_from_data = { type: 'event', firstname: fname, lastname: lname, emailaddress: email, mobileNumber: phoneno, level_id: studyid, level_of_study: studyname, aos_id: areaid, area_of_study: areastudy, country_id: countryid, country_preference: countryname, intake_id: semid, adminssion_year: semyear, event_venue: venu, time_slot: eventtime, event_date:eventDate, event_name: eventname, ProspectID:trackid }
      //console.log(event_from_data);

      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: event_from_data,
        cache: false,
        success: function (data) {
          //console.log(data);
          var response = JSON.parse(data);
          var message = response.message;

          //console.log(response);
          var resstate =  response.result.status;
          var resmsg =  response.result.message;
          //console.log(resstate);

          $("#event_register_form").closest('form').find("input[type=text], select, textarea, checkbox").val(""); 

          $("#html").prop('checked',false);
          jQuery('input[name=phone_num]').val('');
          jQuery('input[name=event_level_of_study]').val('');
          jQuery('input[name=event_level_of_study]').val('');
          jQuery('input[name=event_areaofstudy]').val('');
          jQuery('input[name=country_name]').val('');
          jQuery('input[name=semester_year]').val('');
          
          jQuery('.your_level_of_study').text('Your level of study');
          jQuery('.your_area_of_study').text('Choose area of study');
          jQuery('.prefer_country').text('Choose country preference');
          jQuery('.admis_year_list').text('Choose admission year');

          if (resstate == "true") {
            window.location.href = '/event-thank-you';
          }
          else {
            $(".btnLoader").css('display', 'none');
            $('#submit').attr('disabled', 'disabled'); 
            $('#event_error').text(resmsg);
          }

        },
        error: function () {
          $(".btnLoader").css('display', 'none');
          $('#submit').attr('disabled', 'disabled'); 
          $('#event_error').text('An error occurred');
        }

      });
      return false;

    }
  });

});

jQuery(".your_level_of_study").click(function () {
  jQuery('.your_level_of_study_show').toggle();
});

jQuery(".your_area_of_study").click(function () {
  jQuery('.your_area_of_study_show').toggle();
});

jQuery(".prefer_country").click(function () {
  jQuery('.prefer_country_show').toggle();
});

jQuery(".admis_year_list").click(function () {
  jQuery('.admis_year_list_show').toggle();
});

jQuery("#level-of-study li a").click(function () {
  $(this).addClass("active");
  $("#level-of-study li a").not(this).removeClass("active");
});

jQuery("#area-of-study li a").click(function () {
  $(this).addClass("active");
  $("#area-of-study li a").not(this).removeClass("active");
});

jQuery("#list-of-country li a").click(function () {
  $(this).addClass("active");
  $("#list-of-country li a").not(this).removeClass("active");
});

jQuery("#admission-list li a").click(function () {
  $(this).addClass("active");
  $("#admission-list li a").not(this).removeClass("active");
});


jQuery("#level-of-study li").click(function () {
  var levelid = $(this).attr('id');
  var level_of_study = $(this).text();
  jQuery(".your_level_of_study").text(level_of_study);
  jQuery('.your_level_of_study').addClass('value-selected');
  jQuery('input[name=event_level_id]').val(levelid); // assign value to hidden input
  jQuery('input[name=event_level_of_study]').val(level_of_study); // assign value to hidden input
  $('label[for="event_level_of_study"]').hide();
  jQuery('.your_level_of_study_show').hide();
});


jQuery("#area-of-study li").click(function () {
  var areaid = $(this).attr('id');
  var area_of_study = $(this).text();
  jQuery(".your_area_of_study").text(area_of_study);
  jQuery(".your_area_of_study").addClass('value-selected');
  jQuery('input[name=event_area_id]').val(areaid); // assign value to hidden input
  jQuery('input[name=event_areaofstudy]').val(area_of_study); // assign value to hidden input
  $('label[for="event_areaofstudy"]').hide();
  jQuery('.your_area_of_study_show').hide();
});

jQuery("#list-of-country li").click(function () {
  var countryid = $(this).attr('id');
  var countryname = $(this).text();
  jQuery(".prefer_country").text(countryname);
  jQuery(".prefer_country").addClass('value-selected');
  jQuery('input[name=country_id]').val(countryid); // assign value to hidden input
  jQuery('input[name=country_name]').val(countryname); // assign value to hidden input
  $('label[for="country_name"]').hide();
  jQuery('.prefer_country_show').hide();
});

jQuery("#admission-list li").click(function () {
  var admisid = $(this).attr('id');
  var admisyear = $(this).text();
  jQuery(".admis_year_list").text(admisyear);
  jQuery(".admis_year_list").addClass('value-selected');
  jQuery('input[name=semid]').val(admisid); // assign value to hidden input
  jQuery('input[name=semester_year]').val(admisyear); // assign value to hidden input
  $('label[for="semester_year"]').hide();
  jQuery('.admis_year_list_show').hide();
});


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

  /*jQuery(".select_loc_show ul li").click(function() {
      var location = $(this).text();
      jQuery(".select_loc").text(location);
      jQuery('input[name=journey_loc]').val(location); // assign value to hidden input
      $(".select_loc").removeClass("error");
      jQuery('.select_loc_show').hide();
  });*/

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


  /*jQuery(".confirm-btn").click(function() {
    jQuery('#Confirmation').removeClass('show');
    jQuery('body').removeClass('modal-open');
    jQuery('#Confirmation').css('display','none');
  });*/

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

function show_next(id, nextid, bar, baricon, pName, device) {

  var nameReg = /^[A-Za-z ]+$/;
  var numberReg = /^[0-9]+$/;
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var email = $('#useremail').val();
  var mobile = $('#userphone').val();
  var checkbox_validate = document.getElementById("isterm");
  var date = $('#calendarform').val();
  var user_time = $('#pick_time').val();
  var schedule = document.getElementById("schedule_check");
  var loc = $('#journey_loc').val();

  var startlocfield = $('#journeyloc_field').val();
  var startVerify = $('input[name="schedule"]:checked').length;

  var isError = '';

  if (id == 'account_details') {

    if (fname == "") {
      $("#fname").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(fname)) {
      $("#fname").addClass("error");
      isError = 1;
    }

    if (lname == "") {
      $("#lname").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(lname)) {
      $("#lname").addClass("error");
      isError = 1;
    }

    if (email == "") {
      $("#useremail").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(email)) {
      $("#useremail").addClass("error");
      isError = 1;
    }

    if (mobile == "") {
      $("#userphone").addClass("error");
      isError = 1;
    }
    else if (!numberReg.test(mobile)) {
      $("#userphone").addClass("error");
      isError = 1;
    }

    if (numberReg.test(mobile)) {
      if (mobile.length < 10) {
        $("#userphone").addClass("error");
        isError = 1;
      }
      if (mobile.length > 12) {
        $("#userphone").addClass("error");
        isError = 1;
      }
    }

    if (!checkbox_validate.checked) {
      isError = 1;
      $("#isterm").addClass("error");
    }
    else {
      $("#isterm").removeClass("error");
    }
  }

  if (id == 'user_details') {

    if (date == '') {
      $("#calendarform").addClass("error");
      isError = 1;
    }
    else if (user_time == '') {
      $("#pick_time").addClass("error");
      isError = 1;
    }

    if(device == 'web'){
        if(startVerify == 0){
            if(startlocfield == ''){
              $(".select_loc").addClass("error");
              isError = 1;
            }
        }
        else if(startVerify == 1){
          $(".select_loc").removeClass("error");
        }
    }

  }

  if (isError == '') {

    if (baricon == 'baricon2') {
      $('.step-form-title').html('Secondly…');
    }
    if (baricon == 'baricon3') {
      $('.step-form-title').html('Last but not least');
    }
    //alert(nextid);
    document.getElementById("account_details").style.display = "none";
    document.getElementById("user_details").style.display = "none";
    document.getElementById("qualification").style.display = "none";
    jQuery("#" + nextid).fadeIn();
    //$("#"+nextid).show();

    if (pName == 'global-ed') {
      document.getElementById(bar).style.backgroundColor = "#d91f3d";
      //document.getElementById(baricon).style.backgroundColor="#d91f3d";
      $('#' + baricon).css({ "background-color": "#d91f3d", "color": "#FFF" });
    }
    else if (pName == 'global-learning') {
      document.getElementById(bar).style.backgroundColor = "#ff8906";
      //document.getElementById(baricon).style.backgroundColor="#ff8906";
      $('#' + baricon).css({ "background-color": "#ff8906", "color": "#FFF" });
    }
    else if (pName == 'global-investment') {
      document.getElementById(bar).style.backgroundColor = "#2c2556";
      //document.getElementById(baricon).style.backgroundColor="#2c2556";
      $('#' + baricon).css({ "background-color": "#2c2556", "color": "#FFF" });
    }
    else if (pName == 'global-workspace') {
      document.getElementById(bar).style.backgroundColor = "#4ccdc9";
      //document.getElementById(baricon).style.backgroundColor="#4ccdc9";
      $('#' + baricon).css({ "background-color": "#4ccdc9", "color": "#FFF" });
    }

  }

}

function show_prev(previd, bar) {

  if (bar == 'bar1') {
    $('.step-form-title').html('First things first');
  }
  if (bar == 'bar2') {
    $('.step-form-title').html('Secondly…');
  }

  document.getElementById("account_details").style.display = "none";
  document.getElementById("user_details").style.display = "none";
  document.getElementById("qualification").style.display = "none";
  jQuery("#" + previd).fadeIn();
  document.getElementById(bar).style.backgroundColor = "#D8D8D8";
}

function onSubmit(device) {

  var userinterest = '';
  var catName = '';
  var firstname = $('#fname').val();
  var lastname = $('#lname').val();
  var useremail = $('#useremail').val();
  var usermobile = $('#userphone').val();
  var checkbox_validate = document.getElementById("isterm");
  var sel_date = $('#calendarform').val();
  var sel_time = $('#pick_time').val();
  var schedule = document.getElementById("schedule_check");
  var scheduleCheck = $('input[name="schedule"]:checked').length;
  var loc = $('#journey_loc').val();
  var addr = $("#current_addr p").text();
  var selected_service = $('#service_value').val();
  var selected_interest_val = $('#user_interest').val();
  var trackid = $('#ProspectID').val();
  var current_page = $('input[name=current_page]').val();

  var startlocfield = $('#journeyloc_field').val();
  var startVerify = $('input[name="schedule"]:checked').length;
  var catName = $('input[name=primary_cat]').val();
  var pagesource = jQuery('input[name=journeySource]').val();

  submitError = '';

  if (selected_service == "") {
    $(".sel_service").addClass("error");
    $('.sel_service').css('display', 'block');
    submitError = 1;
  }

  if(device != 'web'){

    if(startVerify == 0){
            if(startlocfield == ''){
              $(".select_loc").addClass("error");
              submitError = 1;
            }
        }
        else if(startVerify == 1){
          $(".select_loc").removeClass("error");
        }
  }

  if(current_page == 'Global Learning'){
      if (selected_interest_val == "") {
        $(".sel_interest").addClass("error");
        submitError = 1;
      }
  }

  if (submitError == '') {
    $('.journey-btn').attr('disabled', 'disabled'); // disable multiple time form submit
    $(".btnLoader").css('display', 'block');

    var journey_from_data = { type: 'startJourney', scheduleCheck: scheduleCheck, firstname: firstname, lastname: lastname, email: useremail, mobile: usermobile, date: sel_date, time: sel_time, location: loc, address: addr, service: selected_service, interested_in: selected_interest_val, primary_category:catName, ProspectID:trackid, pagename: current_page, source:pagesource, onboardLink: 'https://tcglobal.com/student-onboard' }
    //console.log(journey_from_data);
    $.ajax({
      type: "POST",
      url: "/form/submit_form.php",
      data: journey_from_data,
      cache: false,
      success: function (data) {

        var response = JSON.parse(data);
        var message = response.result.message;
        var status = response.result.status;
        //console.log(data);
        if (status == 'true') {
          $('#journey_form').css('display', 'none');
          $('.step-form-title').css('display', 'none');
          $('.cnf-title').css('display', 'block');
          $('#Confirmation').css('display', 'block');

          $('.journey-btn').removeAttr('disabled');
        } else {
          $('.journey-btn').removeAttr('disabled');
          $(".btnLoader").css('display', 'none');
          $('#journey_error').text('An error occurred');
        }
      },
      error: function (data) {
        $('.journey-btn').removeAttr('disabled');
        $(".btnLoader").css('display', 'none');
        $('#journey_error').text('An error occurred');
      }
    });

  }
}

/** Schedule meeting form code **/

jQuery(document).ready(function () {

  jQuery('#schedule').change(function () {
    if ($(this).prop("checked")) {
      $("#schedule").removeClass("error");
    }
  });

  /*jQuery('body .contact-popup').click(function () {
    jQuery(".contact-popup").css('display', 'none');
    jQuery('body').removeClass('modal-open');
    jQuery('div').removeClass('modal-backdrop fade show');
  });*/


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

/** Career - apply now form code **/
jQuery(document).on("click", function (e) {

  if ($(e.target).is(".job-loc-show, .job-loc") === false) {
    jQuery(".job-loc-show").hide();
  }
  if ($(e.target).is(".job-exp-show, .job-exp") === false) {
    jQuery(".job-exp-show").hide();
  }
  if ($(e.target).is(".job-course-show, .job-course") === false) {
    jQuery(".job-course-show").hide();
  }
  if ($(e.target).is(".job-course-spec-show, .job-course-spec") === false) {
    jQuery(".job-course-spec-show").hide();
  }
  if ($(e.target).is(".pg-course-show, .pg-course") === false) {
    jQuery(".pg-course-show").hide();
  }
  if ($(e.target).is(".pg-course-spec-show, .pg-course-spec") === false) {
    jQuery(".pg-course-spec-show").hide();
  }
  if ($(e.target).is(".currency_code_show, .currency_code") === false) {
    jQuery(".currency_code_show").hide();
  }
  if ($(e.target).is(".job-position-show, .job-position") === false) {
    jQuery(".job-position-show").hide();
  }
  if ($(e.target).is(".tc_career-team-show, .tc_career-team") === false) {
    jQuery(".tc_career-team-show").hide();
  }
  if ($(e.target).is(".career_country_show, .career_country") === false) {
    jQuery(".career_country_show").hide();
  }
  if ($(e.target).is(".sub-career-show, .sub-career") === false) {
    jQuery(".sub-career-show").hide();
  }
  if ($(e.target).is(".sub-country-show, .sub-country") === false) {
    jQuery(".sub-country-show").hide();
  }
  if ($(e.target).is(".insight-type-show, .insight-type") === false) {
    jQuery(".insight-type-show").hide();
  }
  if ($(e.target).is(".insight-topic-show, .insight-topic") === false) {
    jQuery(".insight-topic-show").hide();
  }
  if ($(e.target).is(".insight-business-show, .insight-business") === false) {
    jQuery(".insight-business-show").hide();
  }

  if ($(e.target).is(".topic-show, .topic-btn") === false) {
    jQuery(".topic-show").hide();
  }
  if ($(e.target).is(".business-show, .business-btn") === false) {
    jQuery(".business-show").hide();
  }

  /** career more option **/

  if ($(e.target).is(".career_country_show, .career_country") === false) {
    jQuery(".career_country_show").hide();
  }
  if ($(e.target).is(".career_city_show, .career_city") === false) {
    jQuery(".career_city_show").hide();
  }

  /** Event register page validation **/

  if ($(e.target).is(".your_level_of_study_show, .your_level_of_study") === false) {
    jQuery(".your_level_of_study_show").hide();
  }
  if ($(e.target).is(".your_area_of_study_show, .your_area_of_study") === false) {
    jQuery(".your_area_of_study_show").hide();
  }
  if ($(e.target).is(".prefer_country_show, .prefer_country") === false) {
    jQuery(".prefer_country_show").hide();
  }
  if ($(e.target).is(".admis_year_list_show, .admis_year_list") === false) {
    jQuery(".admis_year_list_show").hide();
  }

  if ($(e.target).is(".contact-service-show, .contact-service") === false) {
    jQuery(".contact-service-show").hide();
  }

  if ($(e.target).is(".eventplace-show, .eventplace") === false) {
    jQuery(".eventplace-show").hide();
  }

});


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

      //console.log(n);

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


  jQuery(document).ready(function () {

  jQuery('.campcontact-service').click(function(){
    jQuery('.campcontact-service-show').toggle();
});

jQuery("#campaign-service li a").click(function() {
    $(this).addClass("active");
    $("#campaign-service li a").not(this).removeClass("active");
});

jQuery("#campaign-service li").click(function() {
    var value = $(this).attr('id');
    jQuery('input[name=campcontact-service]').val(value); // assign value to hidden input
    jQuery(".campcontact-service").text(value);
     jQuery('.campcontact-service ').addClass('value-selected');
    jQuery(".campcontact-service").removeClass("error");
    jQuery('.campcontact-service-show').hide();
});

jQuery('#campaignTerms').change(function(){
  if($(this).prop("checked")) {
    $("#campaignTermserror").removeClass("error");
  }
});

$('#campaign_name').val('');
  $('#campaign_email').val('');
  $('#campaign_mobile').val('');
  //$('#campcontact-service').val('');
  $('#campmessage').val('');
  $("#campaignTerms").prop("checked", false);

  $('.campaignform').click(function () {
    formValidation();
  });

  function formValidation() {

    var nameReg = /^[A-Za-z ]+$/;
    var numberReg = /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var names = $('#campaign_name').val();
    var email = $('#campaign_email').val();
    var mobile = $('#campaign_mobile').val();
    var service = $('#campcontact-service').val();
    var message = $('#campmessage').val();
    var termsConditions = $("#campaignTerms").prop('checked');
    var currentPage = jQuery('input[name=currentPage]').val();
    var source = jQuery('input[name=pagesource]').val();
    var trackid = $('#ProspectID').val();
    var inputVal = new Array(names, email, mobile, service, message, termsConditions);

    var inputMessage = new Array("name", "email address", "mobile number", "service", "message", "Tterms & Conditions");
    $(".contact_form_field").removeClass("error");
   
    var isError = '';

    if (inputVal[0] == "") {
      
      $("#campaign_name").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(names)) {
      
      $("#campaign_name").addClass("error");
      isError = 1;
    }

    if (inputVal[1] == "") {
      
      $("#campaign_email").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(email)) {
      
      $("#campaign_email").addClass("error");
      isError = 1;
    }

    if (inputVal[2] == "") {
      
      $("#campaign_mobile").addClass("error");
      isError = 1;
    }
    else if (!numberReg.test(mobile)) {
      
      $("#campaign_mobile").addClass("error");
      isError = 1;
    }

    if (numberReg.test(mobile)) {
        if(mobile.length < 10){
            $("#campaign_mobile").addClass("error");
            isError = 1;
        }
        if(mobile.length > 12){
            $("#campaign_mobile").addClass("error");
            isError = 1;
        }
      }

  if(service == ""){
      $(".campcontact-service").addClass("error");
      isError = 1;
    }

  if (inputVal[4] == "") {
      
      $("#campmessage").addClass("error");
      isError = 1;
    }
    if (!$('#campaignTerms').is(':checked')) {
      
      $("#campaignTermserror").addClass("error");
      isError = 1;
    }
    else {
      $("#campaignTermserror").removeAttr("error");
    }
    
    if (isError == '') {

      var FromData = { type: 'campaignContact', name: names, email: email, mobileNumber: mobile, service: service, message: message, source: source, ProspectID:trackid, currentPage: currentPage }
      console.log(FromData)
      $(".spinLoader").css('display', 'block');
      $(".campaignform").attr("disabled", true);
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: FromData,
        cache: false,
        success: function (data) {
          var response = JSON.parse(data);
          var message = response.message;
          if (response.status) {

            $("#campaignTerms").prop('checked',false);
            if ($("#campaignTerms").is(':checked')){
                $("#campaignTerms").prop('checked',false);
              }

            $("#campcontactform").closest('form').find("input[type=text], select, textarea, checkbox").val(""); $("#camp_contact_success").fadeOut(5000);
            jQuery(".campcontact-service").text('Choose Service');
            jQuery('input[name=campcontact-service]').val("");
            

            $('#contact-confirm').css('display','block');
            jQuery('body').addClass('modal-open');
            jQuery('#contact-confirm').addClass('show');
            jQuery('.modal-backdrop').addClass('show');
            jQuery('body').append("<div class='removebackdrop modal-backdrop fade show'></div>");

          } else {
            $('#camp_contact_error').text('An error occurred');

          }
          $(".spinLoader").css('display', 'none');
          $(".campaignform").attr("disabled", false);
        },
        error: function (data) {
          $(".spinLoader").css('display', 'none');
          $(".campaignform").attr("disabled", false);
          $('#camp_contact_error').text('An error occurred');
        }
      });
    }
  }

});  