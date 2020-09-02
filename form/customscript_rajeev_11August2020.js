var $j = jQuery.noConflict();

$j().ready(function () { //validation script start

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
      
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: event_from_data,
        cache: false,
        success: function (data) {
          
          var response = JSON.parse(data);
          var message = response.message;
          var resstate =  response.result.status;
          var resmsg =  response.result.message;
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

}); //validation script end

/** career form script - start **/
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

jQuery(document).ready(function () { //jquery onload start

  jQuery('.campcontact-service').click(function(){
    jQuery('.campcontact-service-show').toggle();
  });
  jQuery("#campaign-service li a").click(function() {
      $(this).addClass("active");
      $("#campaign-service li a").not(this).removeClass("active");
  });
  jQuery("#campaign-service li").click(function() {
      var value = $(this).attr('id');
      jQuery('input[name=campcontact-service]').val(value); 
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

  function subscribeImageDisplay() {
    $('.tickimage').each(function (event) {
      $(this).find('img').attr('style', 'display:none');
    })
  }

  $('.subscribe_topic').click(function (event) {
    subscribeImageDisplay();
    var mydata = $(this).data('mydata');
    $('#subscribe_topic_text').text(mydata);
    $('#subscribe_topic_text').addClass('value-selected');
    $('#subscribe_topic').val(mydata);
    $('#subscribe_topic_text').removeClass('error');
    $('.tickimage').removeClass('active');
    $(this).find('a').addClass('active');
    $(this).find('img').attr('style', 'display:block');
  })
  $('.subscribeform').click(function () {
    $("#subscribe_name").removeClass("error");
    $("#subscribe_email").removeClass("error");
    $("#subscribe_mobile").removeClass("error");
    $("#subscribe_topic_text").removeClass("error");
    $("#subscribe_termconditionerror").removeClass("error");
    validateSubscribeForm();
  });

  function validateSubscribeForm() {
    var nameReg = /^[A-Za-z ]+$/;
    var numberReg = /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var names = $('#subscribe_name').val();
    var email = $('#subscribe_email').val();
    var mobile = $('#subscribe_mobile').val();
    var topic = $('#subscribe_topic').val();
    var termsConditions = $("#subscribe_TermsConditions").prop('checked');
    var trackid = $('#ProspectID').val();
    var inputVal = new Array(names, email, mobile, topic, termsConditions);

    var inputMessage = new Array("name", "email address", "Tterms & Conditions");

    var isError = '';
    if (inputVal[0] == "") {
      $("#subscribe_name").addClass("error");
      isError = 1;
    }
    else if (!nameReg.test(names)) {
      $("#subscribe_name").addClass("error");
      isError = 1;
    }

    if (inputVal[1] == "") {
      $("#subscribe_email").addClass("error");
      isError = 1;
    }
    else if (!emailReg.test(email)) {
      $("#subscribe_email").addClass("error");
      isError = 1;
    }

    if (inputVal[2] == "") {
      $("#subscribe_mobile").addClass("error");
      isError = 1;
    }

    else if (!numberReg.test(mobile)) {
      $("#subscribe_mobile").addClass("error");
      isError = 1;
    }
    if (numberReg.test(mobile)) {
      if (mobile.length < 10) {
        $("#subscribe_mobile").addClass("error");
        isError = 1;
      }
      if (mobile.length > 12) {
        $("#subscribe_mobile").addClass("error");
        isError = 1;
      }
    }
    if (inputVal[3] == "") {
      $("#subscribe_topic_text").addClass("error");
      isError = 1;
    }

    if (!$('#subscribe_TermsConditions').is(':checked')) {
      $("#subscribe_termconditionerror").addClass("error");
      isError = 1;
    }

    if (isError == '') {
      $('.subscribeform').attr('disabled', 'disabled')
      $(".subbtnLoader").css('display', 'block');
      var subscribe_from_data = { type: 'subscripe', name: names, email: email, mobileNumber: mobile, choos_topic:topic, ProspectID:trackid }
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: subscribe_from_data,
        cache: false,
        success: function (data) {
          var response = JSON.parse(data);
          var message = response.result.message;
          if (response.status) {
            $(".subbtnLoader").css('display', 'none');
            $('#subscribesubmit').css('display', 'none');
            $('#subscriberesult').css('display', 'block');
            $('#subscribeformsuccess').html("<p class='text-center fs-14'> Thanks for signing up on TC Global Insights! We’ll be hitting your inbox soon. Welcome aboard</p>");
            $("#subscribe").find("input[type=text], select, textarea").val("");
            $("#subscribe_topic_text").text('Choose topic');
            $('#subscribe_topic').val('');
            $("#subscribe_TermsConditions").prop('checked', false);
            setTimeout(() => {
              $('#subscribeModal').modal('hide');
              $('#subscribesubmit').css('display', 'block');
              $('#subscriberesult').css('display', 'none');
            }, 3000);
            $('.subscribeform').removeAttr('disabled');
          } else {
            $('.subscribeform').removeAttr('disabled');
            $('#subscribe_error').text('An error occurred');
            $(".subbtnLoader").css('display', 'none');
          }
        },
        error: function (data) {
          $('.subscribeform').removeAttr('disabled');
          $(".subbtnLoader").css('display', 'none');
          $('#subscribe_error').text('An error occurred');
        }
      });
    }
  }

  $('.express_service').click(function (event) {
    var mydata  =   $(this).data('mydata');
    $('#express_service_text').text(mydata);
    $('#express_service_text').addClass('value-selected');
    $('#express_service').val(mydata);
  });
  $('.express_university').click(function (event) {
      var mydata  =   $(this).data('mydata');
      $('#express_university_text').text(mydata);
      $('#express_university').val(mydata);
  });
  $('.expressform').click(function () {
    $("#express_name").removeClass("error");
    $("#express_email").removeClass("error");
    $("#express_mobile").removeClass("error");
    $("#express_service_text").removeClass("error");
    $("#express_message").removeClass("error");
    $("#express_university_text").removeClass("error");
    $("#express_TermsConditions_error").removeClass("error");
    validateExpressForm();
  });

  function validateExpressForm() {

    var nameReg = /^[A-Za-z ]+$/;
    var numberReg =  /^[0-9]+$/;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var names = $('#express_name').val();
    var email = $('#express_email').val();
    var mobile = $('#express_mobile').val();
    var service = $('#express_service').val();
    var message = $('#express_message').val();
    var university = $("#express_university").select2("val");
    university=university?university.toString():'';
    var termsConditions = $("#express_TermsConditions").prop('checked');
    var currentPage = $('#student_currentPage').val();
    var trackid = $('#ProspectID').val();

    var inputVal = new Array(names, email, mobile, service, message, university, termsConditions);

    var isError = '';
    if(inputVal[0] == ""){
      $("#express_name").addClass("error");
      isError = 1;
    }
    else if(!nameReg.test(names)){
      $("#express_name").addClass("error");
      isError = 1;
    }
    if(inputVal[1] == ""){
      $("#express_email").addClass("error");
      isError = 1;
    }
    else if(!emailReg.test(email)){
      $("#express_email").addClass("error");
      isError = 1;
    }
    if(mobile == ''){
      $("#express_mobile").addClass("error");
      isError = 1;
    }
    else if(!numberReg.test(mobile)){
      $("#express_mobile").addClass("error");
      isError = 1;
    }
    if(inputVal[3] == ""){
      $("#express_service_text").addClass("error");
      isError = 1;
    }
    if(inputVal[4] == ""){
      $("#express_message").addClass("error");
      isError = 1;
    }
    if(inputVal[5] == ""){
      $("#express_university").addClass("error");
      isError = 1;
    }
    if (!$('#express_TermsConditions').is(':checked'))  {
      $("#express_TermsConditions_error").addClass("error");
      isError = 1;
    }
    if(isError ==''){
      $('.expressform').attr('disabled','disabled')
      $(".expressbtnLoader").css('display', 'block');
      var express_from_data = {type:'expressform',name:names,email:email,mobileNumber:mobile,service:service,message:message,university:university,currentPage:currentPage,ProspectID:trackid,onboardLink:'http://tcglobal.com/student-onboard'}
      
      $.ajax({
        type: "POST",
        url: "/form/submit_form.php",
        data: express_from_data,
        cache: false,
        success: function(data){
          var response = JSON.parse(data);
          var message = response.result.message;
          if(response.status){
            $('#expresssubmit').css('display','none');
            $('#expressformresult').css('display','block');
            $(".expressbtnLoader").css('display', 'none');
            $('#expressformsuccess').html("<p class='text-center fs-14'> Thanks for contacting us! We will reach you shortly and start our journey together. </p>");
            $("#express_form").find("input[type=text], select, textarea").val("");
            $("#express_university").val('').trigger('change');
            setTimeout(() => {
                $('#expressModal').modal('hide');
                 $('#expresssubmit').css('display','block');
                 $('#expressformresult').css('display','none');
            }, 5000);
            $('.expressform').removeAttr('disabled');
          } else{
            $('.expressform').removeAttr('disabled');
            $('#express_error').text('An error occurred');
          }
        },
        error: function(data) {
            $('.expressform').removeAttr('disabled');
          $('#express_error').text('An error occurred');
        }
      });
    }
}

}); //jquery onload end

// start your journey form script
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
    
    document.getElementById("account_details").style.display = "none";
    document.getElementById("user_details").style.display = "none";
    document.getElementById("qualification").style.display = "none";
    jQuery("#" + nextid).fadeIn();
    
    if (pName == 'global-ed') {
      document.getElementById(bar).style.backgroundColor = "#d91f3d";
      $('#' + baricon).css({ "background-color": "#d91f3d", "color": "#FFF" });
    }
    else if (pName == 'global-learning') {
      document.getElementById(bar).style.backgroundColor = "#ff8906";
      $('#' + baricon).css({ "background-color": "#ff8906", "color": "#FFF" });
    }
    else if (pName == 'global-investment') {
      document.getElementById(bar).style.backgroundColor = "#2c2556";
      $('#' + baricon).css({ "background-color": "#2c2556", "color": "#FFF" });
    }
    else if (pName == 'global-workspace') {
      document.getElementById(bar).style.backgroundColor = "#4ccdc9";
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
    $('.journey-btn').attr('disabled', 'disabled'); 
    $(".btnLoader").css('display', 'block');

    var journey_from_data = { type: 'startJourney', scheduleCheck: scheduleCheck, firstname: firstname, lastname: lastname, email: useremail, mobile: usermobile, date: sel_date, time: sel_time, location: loc, address: addr, service: selected_service, interested_in: selected_interest_val, primary_category:catName, ProspectID:trackid, pagename: current_page, source:pagesource, onboardLink: 'https://tcglobal.com/student-onboard' }
    $.ajax({
      type: "POST",
      url: "/form/submit_form.php",
      data: journey_from_data,
      cache: false,
      success: function (data) {

        var response = JSON.parse(data);
        var message = response.result.message;
        var status = response.result.status;
        
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






