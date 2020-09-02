jQuery(document).ready(function () {
    //preffred leve lof study
    jQuery(".prefferd_level_studies").click(function () {
        var levelOfStudy = jQuery(this).data('mydata');
        jQuery('input[name=prefferd_level_study]').val(jQuery.trim(levelOfStudy)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_level_studies").not(this).removeClass("active");
    });
    //year of admission
    jQuery(".prefferd_year_admissions").click(function () {
        var yearOfAdmission = jQuery(this).data('mydata');
        jQuery('input[name=prefferd_year_admission]').val(jQuery.trim(yearOfAdmission)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_year_admissions").not(this).removeClass("active");
    });
    //preffered intakes
    jQuery(".prefferd_intakes").click(function () {
        var intakes = jQuery(this).data('mydata'); 
        jQuery('input[name=prefferd_intake]').val(jQuery.trim(intakes)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_intakes").not(this).removeClass("active");
    });
    //preffered area of study
    jQuery(".prefferd_area_studies").click(function () {
        var areaOfStudies = jQuery(this).data('mydata');
        jQuery('input[name=prefferd_area_study]').val(jQuery.trim(areaOfStudies)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_area_studies").not(this).removeClass("active");
    });
    //preffered global ed dest
    jQuery(".prefferd_global_ed_destinations").click(function () {
        var globalEdObject = jQuery('#prefferd_global_ed_destination').val();
        var levelOfStudy = jQuery(this).data('mydata');
        levelOfStudy = globalEdObject ? globalEdObject + ',' + levelOfStudy : levelOfStudy;
        jQuery('input[name=prefferd_global_ed_destination]').val(jQuery.trim(levelOfStudy)); // assign value to hidden input
        if (jQuery(this).hasClass('active')){
            jQuery(this).removeClass("active");
        }else{
            jQuery(this).addClass("active");
        }
    });
    //preffered time of conatct
    jQuery(".prefferd_time_contacts").click(function () {
        var timeContacts = jQuery(this).data('mydata');
        jQuery('input[name=prefferd_time_contact]').val(jQuery.trim(timeContacts)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_time_contacts").not(this).removeClass("active");
    });
    //preffered mode of conatct
    jQuery(".prefferd_mode_contacts").click(function () {
        var modeContacts = jQuery(this).data('mydata');
        jQuery('input[name=prefferd_mode_contact]').val(jQuery.trim(modeContacts)); // assign value to hidden input
        jQuery(this).addClass("active");
        jQuery(".prefferd_mode_contacts").not(this).removeClass("active");
    });
    //Nearest center
    jQuery(".exp_center").click(function () {
        jQuery('.exp_center_show').toggle();
    });
    jQuery(".exp_center_show ul li").click(function () {
        var expCenter = jQuery(this).text();
        jQuery(".exp_center").text(expCenter);
        jQuery('input[name=nearest_center]').val(expCenter); // assign value to hidden input
        jQuery('.exp_center_show').hide();
        $('.exp_center_show ul li').find('img').attr('style', 'display:none');
        $(this).find('img').attr('style', 'display:inline-block');
    });
	//purpose
	jQuery(".select_purpose").click(function () {
        jQuery('.purpose_show').toggle();
    });
    jQuery(".purpose_show ul li").click(function () {
        var purposeCenter = jQuery(this).text();
        jQuery(".select_purpose").text(purposeCenter);
        jQuery('input[name=purpose]').val(purposeCenter); // assign value to hidden input
        jQuery('.purpose_show').hide();
       // $('.purpose_show ul li').find('img').attr('style', 'display:none');
        //$(this).find('img').attr('style', 'display:inline-block');
		select_purpose(purposeCenter)
    });
	
	//purpose career
	jQuery(".career_purpose").click(function () {
        jQuery('.caree_purpose_show').toggle();
    });
    jQuery(".caree_purpose_show ul li").click(function () {
        var career_purposeCenter = jQuery(this).text();
        jQuery(".career_purpose").text(career_purposeCenter);
        jQuery('input[name=purpose]').val(career_purposeCenter); // assign value to hidden input
        jQuery('.caree_purpose_show').hide();
       // $('.purpose_show ul li').find('img').attr('style', 'display:none');
        //$(this).find('img').attr('style', 'display:inline-block');		
    });
    //current level of study
    jQuery(".curr_level_study").click(function () {
        jQuery('.curr_level_study_show').toggle();
    });
    jQuery(".curr_level_study_show ul li").click(function () {
        var center = jQuery(this).text();
        jQuery(".curr_level_study").text(center);
        jQuery('input[name=current_level_study]').val(center); // assign value to hidden input
        jQuery('.curr_level_study_show').hide();
        $('.curr_level_study_show ul li').find('img').attr('style', 'display:none');
        $(this).find('img').attr('style', 'display:inline-block');
    });

    jQuery(document).on("click", function (e) {
        if (jQuery(e.target).is(".curr_level_study_show, .curr_level_study") === false) {
            jQuery(".curr_level_study_show").hide();
        }
        if (jQuery(e.target).is(".exp_center_show, .exp_center") === false) {
            jQuery(".exp_center_show").hide();
        }
    });
    jQuery('.input-error').attr('style','display:none');
	
	 jQuery("#available_from_date").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    minDate: new Date(),
    yearRange: new Date().getFullYear() + ':+50', // OBS changed the from current year to next 50 years
  });

   jQuery("#user_dob").datepicker({
    dateFormat: 'dd-M-yy',
    changeMonth: true,
    changeYear: true,
    maxDate: new Date(),
    yearRange: "-60:+1", // OBS changed the from current year to next 50 years
  });
  
	 
	 jQuery("#select_purpose").click(function () {
		var select_purpose = jQuery(this).val();	
		if(select_purpose == 'Migration' || select_purpose == 'Other')
		{
			 jQuery('#isRequiredPurpose').attr('style','display:none');
		}
		else
		{
			jQuery('#isRequiredPurpose').attr('style','display:block');
		}
	});		
	 
	 function select_purpose(selVal)
	 {
		 if(selVal == 'Migration' || selVal == 'Other')
		{
			 jQuery('#isRequiredPurpose').attr('style','display:none');
		}
		else
		{
			jQuery('#isRequiredPurpose').attr('style','display:block');
		}
	 }
	 

})

    function removeActiveClasses() {
        jQuery(".prefferd_level_studies").removeClass("active");
        jQuery(".prefferd_year_admissions").removeClass("active");
        jQuery(".prefferd_intakes").removeClass("active");
        jQuery(".prefferd_area_studies").removeClass("active");
        jQuery(".prefferd_global_ed_destinations").removeClass("active");
        jQuery(".prefferd_time_contacts").removeClass("active");
        jQuery(".prefferd_mode_contacts").removeClass("active");
        $(".global_ed_objective:checked").each(function () {
            $(this).prop('checked',false);
        });
        jQuery(".exp_center").text('Choose Center');
        jQuery(".curr_level_study").text('Choose Current Level of Study');
    }
    //form submit method goes here
    function onBoardSubmit() {
        var nearest_center = $('#nearest_center').val();
		var purpose = $('#purpose').val();
		var available_from_date = $('#available_from_date').val();
        var DOB = $('#user_dob').val();
        var prefferd_level_study = $('#prefferd_level_study').val();
        var prefferd_year_admission = $('#prefferd_year_admission').val();
        var prefferd_intake = $('#prefferd_intake').val();
        var prefferd_area_study = $('#prefferd_area_study').val();
        var prefferd_global_ed_destination = $('#prefferd_global_ed_destination').val();
        var prefferd_time_contact = $('#prefferd_time_contact').val();
        var prefferd_mode_contact = $('#prefferd_mode_contact').val();
        var current_level_study = $('#current_level_study').val();
        var lead_id = $('#lead_id').val();
        var lead_email = $('#lead_email').val();
		var lead_type = $('#lead_type').val();
		var prep = $('#prep').val();
        var global_ed_objective='';
        $(".global_ed_objective:checked").each(function () {
            global_ed_objective += ($(this).val()) + ',';
        });
        jQuery('.exp_center').removeClass('error');
        jQuery('.curr_level_study').removeClass('error');
		jQuery(".onboard_date_field").removeClass("error");
        jQuery(".career_purpose").removeClass("error");
        jQuery(".select_purpose").removeClass("error");
        jQuery(".onboard_dob_field").removeClass("error");
		
		submitError = '';
        var level=1;
        var edSubField = '';

        if(lead_type == 'GlobalEd'){
            if(DOB == ''){
                jQuery(".onboard_dob_field").addClass("error");
                submitError = 1;
            }
        }

        if (!nearest_center){
            jQuery('.exp_center').addClass('error');
            submitError = 1;
            level = 1;
        }

        if(prep == 'career' || prep == 'test' || prep == 'english'){

            if(available_from_date == ''){
                jQuery(".onboard_date_field").addClass("error");
                submitError = 1;
            }
        }

        if(prep == 'english'){

            if(purpose == ''){
                jQuery(".select_purpose").addClass("error");
                submitError = 1;
            }
            if(purpose == 'Global Ed'){
                var edSubField = 1;
            }
        }
		
		if(prep == 'career'){

            if(purpose == ''){
                jQuery(".career_purpose").addClass("error");
                submitError = 1;
            }
        }
		 
    	if(prep == 'test' || edSubField == 1 || prep == '') 
        { 	
    		if (!prefferd_level_study) {
                submitError = 1;
                level = 1;
                $('.level_study').attr('style', 'display:block')
            }else{
                $('.level_study').attr('style','display:none')
            }
            if (!prefferd_year_admission) {
                submitError = 1;
                level = 1;
                $('.year_admission').attr('style', 'display:block')
            } else {
                $('.year_admission').attr('style', 'display:none')
            }
            if (!prefferd_intake) {
                submitError = 1;
                level = 1;
                $('.preff_intake').attr('style', 'display:block')
            } else {
                $('.preff_intake').attr('style', 'display:none')
            }
            if (!prefferd_area_study) {
                submitError = 1;
                level = 2;
                jQuery('.area_study').attr('style', 'display:block')
            } else {
                $('.area_study').attr('style', 'display:none')
            }
            if (!prefferd_global_ed_destination) {
                submitError = 1;
                level = 2;
                $('.country_list').attr('style', 'display:block')
            } else {
                jQuery('.country_list').attr('style', 'display:none')
            }
            if (!prefferd_time_contact) {
                submitError = 1;
                level = 3;
                $('.time_contact').attr('style', 'display:block')
            } else {
                $('.time_contact').attr('style', 'display:none')
            }
            if (!prefferd_mode_contact) {
                submitError = 1;
                level = 3;
                $('.mode_contact').attr('style', 'display:block')
            } else {
                $('.mode_contact').attr('style', 'display:none')
            }
            if (!global_ed_objective) {
                submitError = 1;
                level = 3;
                $('.global_object').attr('style', 'display:block')
            } else {
                $('.global_object').attr('style', 'display:none')
            }
            if (!current_level_study){
                $('.curr_level_study').addClass('error');
                submitError = 1;
                level = 3;
            }
        }   


        if (submitError == '') {

            var trackid = $('#ProspectID').val();

            prefferd_global_ed_destination = prefferd_global_ed_destination.replace(/,\s*$/, "");
            global_ed_objective = global_ed_objective.replace(/,\s*$/, "");
            $('.onboard-submit').attr('disabled', 'disabled'); // disable multiple time form submit
            $('.onboardloader').attr('style','display:block');
            var onboard_from_data = { type: 'onboard',  nearest_center: nearest_center,
                prefferd_level_study: prefferd_level_study, prefferd_year_admission: prefferd_year_admission,
                prefferd_intake: prefferd_intake, prefferd_area_study: prefferd_area_study, prefferd_global_ed_destination: prefferd_global_ed_destination,
                prefferd_time_contact: prefferd_time_contact, prefferd_mode_contact: prefferd_mode_contact, global_ed_objective: global_ed_objective,
                lead_id: lead_id, lead_email: lead_email, lead_type: lead_type,available_from_date: available_from_date,purpose: purpose,current_level_study: current_level_study, date_of_birth:DOB, ProspectID:trackid}
            $.ajax({
                type: "POST",
                url: "/form/submit_form.php",
                data: onboard_from_data,
                cache: false,
                success: function (data) {
                    var response = JSON.parse(data);
                    
                    var message = response.result.message;
                    $('.onboardloader').attr('style','display:none');
                    if (response.status) {
                        $("#onboard_form").closest('form').find("input[type=text], input[type=hidden],select, checkbox").val("");
                        removeActiveClasses();
                        $('.onboard-submit').removeAttr('disabled');
                        window.location.href = '/onboard-thank-you';
                         //$('#onboard_suucess').text(message);
                         $("#onboard_suucess").fadeOut(5000);
                    } else {
                        $('.onboard-submit').removeAttr('disabled');
                        $('#onboard_error').text('An error occurred');
                    }
                },
                error: function (data) {
                    $('.onboard-submit').removeAttr('disabled');
                    $('#onboard_error').text('An error occurred');
                }
            });

        }else{
            var errorDiv = $('.error:visible').first();
            var scrollPos = errorDiv.offset().top-150;
            $(window).scrollTop(scrollPos);
        }
    }
