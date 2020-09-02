jQuery(document).ready(function () {

jQuery(".cls-form").click(function() {
  jQuery('#contact-confirm').removeClass('show');
  //jQuery('.modal-backdrop').removeClass('show');
  jQuery('.removebackdrop').removeClass('show');
  jQuery('.removebackdrop').removeClass('modal-backdrop');
  jQuery('body').removeClass('modal-open');
  jQuery('#contact-confirm').css('display','none');

});
/*jQuery('#sel-contact-service li').click(function(){
  var contact_service_val=jQuery('#contact-service').val();
  if(contact_service_val){
    jQuery('.contact-service ').addClass('value-selected');
  }else{
    jQuery('.contact-service ').removeClass('value-selected');
  }
});*/

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
			//$('#nameLabel').after('<span class="error"> Please enter your ' + inputMessage[0] + '</span>');
			$("#name").addClass("error");
			isError = 1;
		}
		else if (!nameReg.test(names)) {
			//$('#nameLabel').after('<span class="error"> Letters only</span>');
			$("#name").addClass("error");
			isError = 1;
		}


		if (inputVal[1] == "") {
			//$('#emailLabel').after('<span class="error"> Please enter your ' + inputMessage[2] + '</span>');
			$("#email").addClass("error");
			isError = 1;
		}
		else if (!emailReg.test(email)) {
			//$('#emailLabel').after('<span class="error"> Please enter a valid email address</span>');
			$("#email").addClass("error");
			isError = 1;
		}

		if (inputVal[2] == "") {
			//$('#mobileLabel').after('<span class="error"> Please enter your ' + inputMessage[3] + '</span>');
			$("#mobile").addClass("error");
			isError = 1;
		}
		else if (!numberReg.test(mobile)) {
			//$('#mobileLabel').after('<span class="error"> Numbers only</span>');
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

		/*if (inputVal[3] == "") {
			// $('#serviceLabel').after('<span class="error"> Please enter your ' + inputMessage[1] + '</span>');
			$("#service").addClass("error");
			isError = 1;
		}*/


		if(service == ""){
			$(".contact-service").addClass("error");
			isError = 1;
		}


		if (inputVal[4] == "") {
			//$('#messageLabel').after('<span class="error"> Please enter your ' + inputMessage[4] + '</span>');
			$("#message").addClass("error");
			isError = 1;
		}
		if (!$('#TermsConditions').is(':checked')) {
			//$('#messageLabel').after('<span class="error"> Please enter your ' + inputMessage[4] + '</span>');
			$("#termconditionerror").addClass("error");
			isError = 1;
		}
		else {
			$("#termconditionerror").removeAttr("error");
		}
		//else { $("input").removeAttr("error"); $("#contactform").submit() }
		if (isError == '') {

			var contact_from_data = { type: 'contact', name: names, email: email, mobileNumber: mobile, service: service, message: message, source: source, ProspectID:trackid, currentPage: currentPage }
			//console.log(contact_from_data)
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

						//$('#contact_success').text(message); $("#TermsConditions").prop("checked", false);
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




	$('.subscribe_topic').click(function (event) {
		selectedOptionImageDisplay();
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
			//$('#mobileLabel').after('<span class="error"> Numbers only</span>');
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
    //var university = $('#express_university').val();
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
      //$("#express_TermsConditions").addClass("error");
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
        	
        	//console.log(data);

          var response = JSON.parse(data);
          var message = response.result.message;
          if(response.status){
            $('#expresssubmit').css('display','none');
            $('#expressformresult').css('display','block');
			$(".expressbtnLoader").css('display', 'none');
            $('#expressformsuccess').html("<p class='text-center fs-14'> Thanks for contacting us! We will reach you shortly and start our journey together. </p>");
            $("#express_form").find("input[type=text], select, textarea").val("");
            $("#express_university").val('').trigger('change');
            // $("#subscribe_success").fadeOut(5000);
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


/*$('.expressbtn').click(function () {

$('#express_name').val('');
$('#express_email').val('');
$('#express_mobile').val('');
$('#express_service').val('');
$('#express_message').val('');
$('#express_university').empty();
$("#express_TermsConditions").prop("checked", false);
$('#express_service_text').text('Choose Service');

});


$.ajax({
  type: 'post',
  url:  '/wp-content/plugins/searchtool/fetch.php',
    data: {
      country:'',
      page_type:'second_level_filter'
  },
  success: function (result) {
    $('#express_university').prop('disabled', false);
    if(result){
      var appenddata="";
      var countryList=JSON.parse(result);
      for (var i = 0; i < countryList.list.length; i++) {
          appenddata += "<option value = '" + countryList.list[i].university + " '>" + countryList.list[i].university + " </option>";
      }
     // var  univdata=$("#express_university").select2("val");
      $("#express_university").empty();
      $("#express_university").append(appenddata);
      //$("#express_university").val( univdata).trigger('change');
    }
  }}) */


  /** Schedule meeting for validations starts here */

	// $('#meeting_basic_Details').attr('style', 'display:none')
	$('#meeting_details').attr('style', 'display:none')
	$('#meeting_help').attr('style', 'display:none')
	$('#meeting_check_details').attr('style', 'display:none')
	$('#meeting_thanks_card').attr('style','display:none')



	$('.meeting_youare').click(function (event) {
		$('.meeting_youare_class').not(this).removeClass('active');
		var meeting_role = $(this).data('mydata');
		$('#meeting_role').val(meeting_role);
		console.log('sdfs', $(this).find('.meeting_youare_class'))
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
		console.log('calendarform', calendarform, 'pick_time', pick_time)
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
