<?php /* Template Name: Onboard Form */
get_header();
global $current_pageName, $current_page_url, $post;
$leadEmail=$_GET['lead_email'];
$leadId=$_GET['lead_id'];
$lead_type=$_GET['lead_type'];
$prep=$_GET['prep'];
if(!$leadEmail || !$leadId){
?>
 <h2 class="main-heading m-b-30 m-t-60">Access denied</h2>
 <?php
}else{
include($_SERVER['DOCUMENT_ROOT'].'/form/onboard-form-api.php');
$calendar_img = get_template_directory_uri().'/images/calendar-icon.png';

//Global Learning config
$available = 'style="display:none"';
$prep_test = 'style="display:none"';
$prep_english = 'style="display:none"';
$psychometrics = 'style="display:none"';
$isRequiredPurpose  = 'style="display:block"';
$userDOB = 'style="display:none"';

if($lead_type == 'GlobalLearning' && ($prep == 'english' || $prep == 'test' || $prep == 'career'))
{
	$available = 'style="display:block"';
}
if($lead_type == 'GlobalLearning' && $prep == 'english')
{
	$prep_english = 'style="display:block"';
}
if($lead_type == 'GlobalLearning' && $prep == 'test')
{
	$prep_test = 'style="display:block"';
}
if($lead_type == 'GlobalLearning' && $prep == 'career')
{
	$psychometrics = 'style="display:block"';
	$isRequiredPurpose = 'style="display:none"';
}
if($lead_type == 'GlobalEd'){
  $userDOB = 'style="display:block"';
}
?>

<!-- End of desktop navigation -->
  <section class="desktop-mainsection">
    <div class="onboard-questions-section">
      <div class="container">
        <div class="start-journeymodal book-appointment position-relative m-b-50">
          <h3 class="smallheading-modal position-relative left-0">Onboard with us!</h3>
          <h2 class="main-heading m-b-30 p-t-80">We have few simple questions for you.</h2>
         <form name="onboard_form"  id="onboard_form" method="post" action="">
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <label class="control-label">Nearest Branch Office</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <input type="hidden" name="nearest_center" value='' id="nearest_center">
					<input type="hidden" name="lead_type" value='<?php echo $lead_type?>' id="lead_type">
					<input type="hidden" name="prep" value='<?php echo $prep?>' id="prep">
                    <input type="hidden" name="lead_id" value='<?php echo $leadId?>' id="lead_id">
                    <input type="hidden" name="lead_email" value='<?php echo $leadEmail?>' id="lead_email">
                    <input type='hidden' name='current_page' id='currentPage' value='<?php echo $current_pageName?>'>
                    <button class="btn btn-secondary dropdown-toggle exp_center" type="button">Choose Center</button>
                    <div class="dropdown-menu exp_center_show">

                      <?php echo $branch_list; ?>

                    </div>
                  </div>
                </div>

				 <div class="col-sm-3" <?php echo $available?>>
                  <label class="control-label">Available From (Date)</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20 onboard_date_field">
                     <input style="height:38px;" type="text" name="available_from_date" value='' id="available_from_date" class='clsDatePicker onboard_from_date'  readonly>
				           	 <img class='icon float-right' src="<?php echo $calendar_img ?>" />
                  </div>
                </div>

                <div class="col-sm-3" <?php echo $userDOB; ?>>
                  <label class="control-label">Date of Birth </label>
                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20 onboard_dob_field">
                     <input type="text" name="user_dob" value='' id="user_dob" class='clsDatePicker onboard_user_dob'  readonly>
                      <img class='icon' src="<?php echo $calendar_img ?>" />
                  </div>
                </div>   

				 <!--<div class="col-sm-3" <?php //echo $prep_test?>>
                  <label class="control-label">Purpose</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <input type="text" name="purpose" value='' id="purpose">
                  </div>
                </div>-->
				<input type="hidden" name="purpose" value='' id="purpose">
				<div class="col-sm-3" <?php echo $prep_english?>>
                  <label class="control-label">Purpose</label>
				  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <button class="btn btn-secondary dropdown-toggle select_purpose" type="button">Choose Purpose</button>
                    <div class="dropdown-menu purpose_show">
                       <ul>
					   <li>Global Ed</li>
					   <li>Migration</li>
					   <li>Other</li>
					   </ul>
                    </div>
                  </div>
				</div>

				<div class="col-sm-3" <?php echo $psychometrics?>>
                  <label class="control-label">Purpose</label>
				  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <button class="btn btn-secondary dropdown-toggle career_purpose" type="button">Choose Purpose</button>
                    <div class="dropdown-menu caree_purpose_show">
                       <ul>
					   <li>School Subject Stream Planning</li>
					   <li>Career Selection</li>
					   <li>Career Change Planning</li>
					   </ul>
                    </div>
                  </div>
				</div>
				  <!-- <div class="col-sm-3" <?php echo $prep_english?>>
                  <label class="control-label">Purpose</label>
               			<div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <select name="select_purpose" value='' id="select_purpose">
					<option value="">--</option>
					<option value="Global Ed">Global Ed</option>
					<option value="Migration">Migration</option>
					<option value="Other">Other</option>
					</select>
                  </div>
                </div>-->

				<!--<div class="col-sm-3" <?php echo $psychometrics?>>
                  <label class="control-label">Purpose</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                    <select name="select_psychometrics" value='' id="select_psychometrics">
					<option value="">--</option>
					<option value="School Subject Stream Planning">School Subject Stream Planning</option>
					<option value="Career Selection">Career Selection</option>
					<option value="Career Change Planning">Career Change Planning</option>
					</select>
                  </div>
                </div>-->

				<div id="isRequiredPurpose" <?php echo $isRequiredPurpose?>>
                <div class="col-sm-12">
                  <label class="control-label">Preffered Level of Study</label>
                  <input type="hidden" name="prefferd_level_study" value='' id="prefferd_level_study">
                  <?php echo $level_study_list?>
                  <label class="error level_study input-error">This field is required</label>
                </div>
                <div class="col-sm-12">
                  <label class="control-label">Preffered Year of Admission</label>
                   <input type="hidden" name="prefferd_year_admission" value='' id="prefferd_year_admission">
                    <?php echo $admission_list  ?>
                    <label class="error year_admission input-error">This field is required</label>
                </div>
                <div class="col-sm-12">
                  <label class="control-label">Preffered Intake</label>
                  <input type="hidden" name="prefferd_intake" value='' id="prefferd_intake">
                  <ul class="select-list ">
                    <li><a class="prefferd_intakes" data-mydata="Apr-Jul">Apr - Jul<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                    <li><a class="prefferd_intakes" data-mydata="Aug-Nov">Aug - Nov<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                    <li><a class="prefferd_intakes" data-mydata="Dec-Mar">Dec - Mar<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                  </ul>
                   <label class="error preff_intake input-error">This field is required</label>
                </div>
                <div class="col-sm-12">
                  <label class="control-label">Preffered Area of Study</label>
                    <input type="hidden" name="prefferd_area_study" value='' id="prefferd_area_study">
                    <?php echo $area_list?>
                  <label class="error area_study input-error">This field is required</label>
              </div>
              <div class="col-sm-12">
                <label class="control-label">Preffered Global Ed Destination(s)</label>
                    <input type="hidden" name="prefferd_global_ed_destination"  id="prefferd_global_ed_destination">
                    <?php echo $country_name?>
                    <label class="error country_list input-error">This field is required</label>
              </div>
              <div class="col-sm-3">
                <label class="control-label">Current Level of Study</label>
                <div class="dropdown select-theme filter-dropdown pl-0 m-b-20">
                  <input type="hidden" name="current_level_study"  id="current_level_study">
                  <button class="btn btn-secondary dropdown-toggle curr_level_study" type="button">Choose Current Level of Study</button>
                  <div class="dropdown-menu curr_level_study_show">
                    <ul>
                    <?php echo $current_level_study_list;?>
                    </ul>
                  </div>
                </div>
              </div>
            <div class="col-sm-12">
              <label class="control-label">Global Ed Objectives</label>
              <div class="row">
                <div class="col-sm-9">
                  <div class="row ">
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" value="World Class Education Experience" name="global_ed_objectives" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">World Class Education Experience</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" name="global_ed_objectives" id="customCheck2" value="Short-medium term work experience">
                        <label class="custom-control-label" for="customCheck2">Short-medium term work experience</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" name="global_ed_objectives" id="customCheck3" value="Career Change or Development">
                        <label class="custom-control-label" for="customCheck3">Career Change or Development</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" name="global_ed_objectives" id="customCheck4" value="Migration">
                        <label class="custom-control-label" for="customCheck4">Migration</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" name="global_ed_objectives" id="customCheck5" value="International Exposure">
                        <label class="custom-control-label" for="customCheck5">International Exposure</label>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input global_ed_objective" name="global_ed_objectives" id="customCheck6" value="Other">
                        <label class="custom-control-label" for="customCheck6">Other</label>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
                    <label class="error global_object input-error">This field is required</label>
            </div>
            <div class="col-sm-12">
              <label class="control-label">Preffered time of contact</label>
                <input type="hidden" name="prefferd_time_contact" value='' id="prefferd_time_contact">
              <ul class="select-list ">
                <li><a class="prefferd_time_contacts" data-mydata="Morning (8AM - Midday)">
                  <img class="mr-2 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-mrng.jpg" />
                  <img class="mr-2 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-mrng-red.jpg" />
                  Morning (8AM - Midday)<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                  <li><a  class="prefferd_time_contacts" data-mydata="Afternoon (Midday - 4PM)">
                    <img class="mr-2 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-noon.jpg" />
                    <img class="mr-2 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-noon-red.jpg" />
                    Afternoon (Midday - 4PM)<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                    <li><a  class="prefferd_time_contacts" data-mydata="Evening (4PM - 9PM)">
                      <img class="mr-2 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-eve.jpg" />
                      <img class="mr-2 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-eve-red.jpg" />
                      Evening (4PM - 9PM)<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                    </ul>
                  <label class="error time_contact input-error">This field is required</label>
                  </div>
                  <div class="col-sm-12">
                    <label class="control-label">Preffered mode of contact</label>
                      <input type="hidden" name="prefferd_mode_contact" value='' id="prefferd_mode_contact">
                    <ul class="select-list ">
                      <li><a class="prefferd_mode_contacts" data-mydata="Email">
                        <img class="mr-3 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-mail.jpg" />
                        <img class="mr-3 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-mail-red.jpg" />
                        Email<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                        <li><a class="prefferd_mode_contacts" data-mydata="Chat">
                          <img class="mr-3 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-msg.jpg" />
                          <img class="mr-3 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-msg-red.jpg" />
                          Chat<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                          <li><a class="prefferd_mode_contacts" data-mydata="Phone">
                            <img class="mr-3 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-phone.jpg" />
                            <img class="mr-3 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-phone-red.jpg" />
                            Phone<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                            <li><a class="prefferd_mode_contacts" data-mydata="All">
                              <img class="mr-3 default-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-th.jpg" />
                              <img class="mr-3 active-img" src="<?php echo bloginfo('template_url') ?>/images/onboard-th-red.jpg" />
                              All<img class="badge-active" src="<?php echo bloginfo('template_url') ?>/images/badge-red.png" /></a></li>
                            </ul>
                          <label class="error mode_contact input-error">This field is required</label>
                          </div>
						  </div>
                        </div>
                      </div>
                      <input type='hidden' name='ProspectID' id='ProspectID' >
                    </div>
</form>
                    <div class='group m-b-20' id='onboard_suucess'></div>
                    <div class='group m-b-20' id='onboard_error'></div>
                    <div class="row justify-content-center m-t-70">
                      <div class="col-sm-2 p-0">
                        <button type="button" onclick="onBoardSubmit()" class="btn btn-theme onboard-submit w-100">onboard<img class="" src="<?php echo bloginfo('template_url') ?>/images/right-whitearrow.png" />
						<i class='onboardloader fa fa-spinner fa-spin ml-3' style='display:none'></i>
						</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

<script src="/form/onboard_form_validation.js"></script>
<?php  }
?>
   <?php get_footer();
