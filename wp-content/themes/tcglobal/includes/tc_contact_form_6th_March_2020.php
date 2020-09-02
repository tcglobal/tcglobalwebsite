<?php
// display the join movement post content
function get_footer_content(){
  global $current_pageName, $current_page_url, $post, $currentPageID;
  $sourceVal = $_GET['source'];

  $backPageURL = $current_page_url;
  if($sourceVal!='')
  {
    $backPageURL = $current_page_url.'?source='.$sourceVal;
  }
  
  $args = array( 'post_type' => 'join_content', 'order' => 'ASC');
  $content = new WP_Query( $args );
  $first_title = get_post_meta( '110', 'first_heading', true );
  $second_title = get_post_meta( '110', 'second_heading', true );
  $third_title = get_post_meta( '110', 'third_heading', true );
  $join_title = nl2br($first_title."\n".$second_title."\n".$third_title);

  $form_title = get_post_meta( '114', 'first_heading', true );
  $form_subtitle = get_post_meta( '114', 'second_heading', true );

  $servicetype = get_post_meta( $currentPageID, 'choose_service_type', true );

  if($servicetype){
    $serviceBtn = $servicetype;
    $select_service = $servicetype;
    $service_cls = 'active';
    $activeService = 'value-selected';
  }
  else{
    $serviceBtn = 'Choose Service';
    $select_service = "";
    $service_cls ="";
    $activeService ="";
  }

  $movement='';

  $movement .='<div class="contactblock m-t-80 p-b-30" id="reachus">';
  $movement .='<div class="container">';
  $movement .='<div class="row">';
  $movement .='<div class="col-md-6">';
  $movement .='<div class="leftsideform">';
  $movement .='<div class="boldheading m-b-60">';
  $movement .= $join_title;
  $movement .='</div>';

  while ( $content->have_posts() ) : $content->the_post();

    $join_arrow = get_post_meta( $post->ID, 'join_icon', true );
    $join = wp_get_attachment_image_src($join_arrow);

    $movement .='<div class="singleitem m-b-30 d-flex align-items-start">';
    $movement .='<div class="icon"><img src="'.$join[0].'" alt="" width="36"></div>';
    $movement .='<div>';
    $movement .='<div class="subheadingitem">'.get_the_title( $post->ID ).'</div>';
    $movement .='<div class="subheadingitemcontent">'.get_post_field('post_content', $post->ID).'</div>';
    $movement .='</div>';
    $movement .='</div>';

  endwhile;
  wp_reset_postdata();

  $movement .='</div>';
  $movement .='</div>';

  $movement .='<div class="col-md-6">';
  $movement .='<div class="formbottom">';
  $movement .='<div class="formheading m-b-40">'.$form_title.'<br>'.$form_subtitle.'</div>';

	$movement .='
<form action="" name="contactform" id="contactform" method="post" class="wpcf7-form wpcf7-acceptance-as-validation theme_1 noErrorMsg">
            <div class="group">
               <input type="text"  class="w-100 input-value contact_form_field name-field" novalidate name="name" id="name" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your name</label>
            </div>
            <div class="group">
               <input type="text"  class="w-100 input-value contact_form_field" novalidate name="email" id="email" required>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your e-mail</label>
            </div>
            <div class="group enter-mobile-number contact-number">
               <input type="text" placeholder="Your mobile number" class="w-100 input-value contact_form_field number-field contactflag" minlength="10" maxlength="10" novalidate name="mobile" id="mobile" size="15" required>
            </div>
            <div class="group">
               <div class="dropdown select-theme filter-dropdown select-box pl-0">
                <button class="btn btn-secondary dropdown-toggle contact-service '.$activeService.'" type="button">'.$serviceBtn.'</button>
                <div class="dropdown-menu contact-service-show" style="display: none;">
                  <ul id="sel-contact-service">
                    <li id="Global Education"><a class='.$service_cls.'><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Education</a></li>
                    <li id="Global Learning"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Learning</a></li>
                    <li id="Global Investments"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Global Investments</a></li>
                    <li id="WorkSpace"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">WorkSpace</a></li>
                  </ul>
                </div>
                <input type="hidden" name="contact-service" id="contact-service" value="'.$select_service.'">
              </div>

            </div>
            <div class="group m-b-20">
               <textarea class="w-100 contact-textarea input-value contact_form_field" placeholder="" name="message" id="message" rows="4"></textarea>
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Your message</label>
            </div>
            <div class=" termslink m-b-30">
               <div class="customcheckbox">
                  <input type="checkbox" id="TermsConditions" name="TermsConditions">
				  
                  <label for="TermsConditions" id="termconditionerror" class="" ><span >Accept TC Global&apos;s <a  data-toggle="modal" data-target="#TermsConditionsCustom"  data-keyboard="false" data-backdrop="static" style="text-decoration: underline;" >Terms & Conditions</a> and <a data-toggle="modal" data-target="#PrivacyCustom"  data-keyboard="false" data-backdrop="static" style="text-decoration: underline;">Privacy Policy</a></span></label>
				  
               </div>
            </div>
			<div class="group m-b-20" id="contact_success"></div>
			<div class="group m-b-20" id="contact_error"></div>
            <div class="group ">
			<input type="hidden" value="'.ucfirst($post->post_name).'" name="currentPage" id="currentPage">
      <input type="hidden" value="'.$sourceVal.'" name="pagesource" >
      <input type="hidden" name="ProspectID" id="ProspectID" >
               <button type="button" class="redbtn w-100 d-flex align-items-center justify-content-center text-uppercase text-decoration-none submitform">SEND <i class="btnLoader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
            </div>
         </form>';

    $movement .='<div class="modal fade contact-popup" id="contact-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body">
          <div class="smallheading text-uppercase text-center m-t-60">that’s it!</div>
          <div class="text-center w-100">
            <div class="boldheading m-b-30">Thank you for your trust.</div>
            <div class="path"></div>
          </div>
          <p class="text-center fs-14 font-regular m-t-60 pb-3">Thanks for contacting us! We will reach you shortly and start our journey together.</p>
          <div class="row justify-content-center m-t-50">
              <div class="col-sm-4 p-0">
                <a class="text-white" href='.$backPageURL.'><button type="button" class="btn btn-theme w-100">BACK TO '.$current_pageName.'
                <img class="" src="/wp-content/themes/tcglobal/images/whiteforward.png"></button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';
	
	
	$movement .='<div class="modal fade TermsConditionsCustom-popup" id="TermsConditionsCustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
		<h3 class="smallheading-modal step-form-title" >Terms of Service</h3><br>
		
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body"  style="margin:-25px; margin-top: 10px;">
          <div class="smallheading text-uppercase text-left">Last revised date: January 1st, 2020</div>
             <div class="list-term">


<div>“TC Global”, “we”, “our” or “us” refers to the Company, The Chopras Global Holdings PTE Ltd. and its affiliates. “You” or “your” refers to the user or customer accessing our website and services.</div>
&nbsp;
<ol>
 	<li><strong>Applicability </strong>
<ol>
 	<li>These Terms govern your access and use of our website [https://tcglobal.com/]. By accessing or using our website in any way, including as an unregistered website visitor, you agree to be bound by these Terms and our Privacy Policy (also available on the website). These Terms apply to your use of our website, and the content made available on or through the website. Other services offered by us may require you to execute separate agreements or agree to other terms as applicable.</li>
 	<li>We reserve our right to change or revise these Terms at any time by making changes on our website. We encourage you to revisit and review these Terms and stay informed of any changes. Your continued use of the website following the posting of any changes to the Terms constitutes acceptance of those changes.</li>
</ol>
</li>
 	<li><strong>Legally binding </strong>
<ol>
 	<li>These Terms constitute a legally binding contract. The Terms shall be in effect as on the date you use or access any of our services.</li>
</ol>
</li>
 	<li><strong>Content</strong>
<ol>
 	<li>The text, images, videos, audio clips, software and other content generated, provided, or otherwise made accessible on or through the website (collectively, “Content”) are contributed by us and our licensors. The Content is protected by international copyright laws. We and our licensors retain all proprietary rights in the website and the Content made available on or through the website, and, no rights are granted to any Content. Subject to these Terms, we grant each user of the website a worldwide, non-exclusive, non-sublicensable and non-transferable license to use (i.e., to download and display locally) Content solely for viewing, browsing and using the functionality of the website. Any commercial or promotional distribution, publishing or exploitation of our services or content related to our services is strictly prohibited.</li>
 	<li>All Content is for general informational purposes only. We reserve the right, but do not have any obligation to monitor, remove, edit, modify or remove any Content, in our sole discretion, at any time for any reason or for no reason at all.</li>
</ol>
</li>
 	<li><strong>Third Party Products and Services</strong>
<ol>
 	<li>Our services may contain links to third party information, websites, products, services or resources that are not owned or controlled by us. We do not endorse any such third party content. If you access or use such third party content through our services, you do so at your own risk. You agree that we have no responsibility arising from your access to or use of any such third party information, websites, products, services or resources.</li>
</ol>
</li>
 	<li><strong>Limitation</strong><strong> of Liability; Disclaimer</strong>
<ol>
 	<li>To the extent permitted by law, we and our affiliates, successors and each of our and their employees, assignees, officers, agents and directors (collectively, the “TC Global Parties”) disclaim all warranties and terms, express or implied, with respect to the website, Content or services (including third party services) on or accessible through the website, including any warranties or terms of merchantability, fitness for a particular purpose, title, non-infringement and any implied warranties, or arising from course of dealing, course of performance or usage in trade.</li>
 	<li>In no event shall the TC Global Parties be liable under contract, tort, strict liability, negligence or any other legal or equitable theory with respect to the website for (a) any special, indirect, incidental, punitive, compensatory or consequential damages of any kind whatsoever (however arising) or (b) damages in excess of (in the aggregate) INR 2,000/-.</li>
</ol>
</li>
 	<li><strong>Governing Law </strong>
<ol>
 	<li>These Terms shall be governed by, construed and interpreted in accordance with the laws of India without regard to or application of its conflict of law provisions or your state or country of residence and the courts of New Delhi shall have exclusive jurisdiction.</li>
</ol>
</li>
 	<li><strong>Miscellaneous</strong>
<ol>
 	<li><u>Severability</u> - If any term, condition or provision of these Terms is held to be invalid, unenforceable or illegal in whole or in part for any reason, that provision shall be enforced to the maximum extent permissible so as to effect the intent of the parties. The validity and enforceability of the remaining terms, conditions or provisions, or portions of them, shall not be affected.</li>
 	<li><u>Waiver</u> – If you fail to exercise or enforce any provisions or rights under these Terms, it will be deemed as a waiver of future enforcement of that or any other provision or right.</li>
</ol>
</li>
 	<li><strong>Contact Information</strong>
<ol>
 	<li>If you wish to provide us with any comments, feedback, or suggestions you may send it to [feedback@thechoprasglobal.com] or by post at [19 Tanglin Road 11-03 Tanglin Shopping Centre, Singapore, 247909].</li>
</ol>
</li>
</ol>
</div>
         
          
          </div>
        </div>
      </div>
    </div>';
	
	$movement .='<div class="modal fade PrivacyCustom-popup" id="PrivacyCustom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog insights-modal contactform-modal modal-lg" role="document">
      <div class="modal-content start-journeymodal book-appointment">
        <div class="modal-header">
		<h3 class="smallheading-modal step-form-title" >Privacy Policy</h3>
          <button type="button" class="close cls-form" data-dismiss="modal" aria-label="Close">
            <img src="'.get_template_directory_uri().'/images/map-close.png" />
          </button>
        </div>
        <div class="modal-body"  style="margin:-25px; margin-top: 30px;">
          <div class="list-term">
<div>The Chopras Global Holdings PTE Ltd. and its affiliates (&ldquo;TC Global&rdquo;, &ldquo;we&rdquo;, &ldquo;our&rdquo; or &ldquo;us&rdquo;) care about your privacy. We are committed to maintaining your trust by protecting your personal information. This Privacy Policy (&lsquo;Policy&rsquo;) describes the information we gather on our website or through our website services, applications, or other services as well as any offline products, programs or courses, how we use such information, and the steps we take to protect such information. By visiting our website, using our online services, by downloading our mobile app, or by purchasing or using our services, you accept the privacy practices described in this Policy.</div></br>
<ol class="p-0">
<li><strong>. The Information We Collect</strong>
	
	<ol >
	<div>We collect different information depending on our engagement with you and the requirements of applicable law as described below.</div>		
<li>When you use our website, you provide us data through a variety of ways. This information includes your name, number, e-mail and service interest. We also collect information regarding your profile.</li>
<li>We collect the information: (a) that you provide to us directly; (b) that your parent, or guardian provides to us; (c) about your use of our services, and (d) If you opt in to certain features or depending on your device settings, we obtain geo-location data.</li>	
</ol>
	</li>

	
<li><strong>. Usage of the Information</strong>
	<ol>
	<div>We use the information we collect to operate our business and provide you with quality service. The extent of our usage is contingent on which services you use, how you use them, and any preferences you may have. Illustratively, we use your information to:</div>	
	<li><u>Provide services and improve your experience:</u> We use information about you to respond to your queries, comments and concerns, provide customer and technical support, and operate and maintain the services.</li>
		<li><u>Improve our services and customer support</u>: We use the information to understand and analyze the usage trends and queries received from you to improve our services and support.</li>
		<li><u>Send emails and other communications:</u> We may also send communications to notify you of new information and improvements in our services.</li>
		<li><u>Comply with applicable law:</u> We use the information to comply with our legal obligations and enforce our legal rights, such as, among other things, to exercise contractual rights, to comply with financial reporting obligations in accordance with applicable law.</li>
	</ol>
	
	
	</li>	

	<li><strong>. To Whom We Disclose Information</strong>
	
	<ol>
<li>We disclose your information in limited circumstances to members of TC Global, our service providers, and other end users, in order to provide our services and to improve your experience. Where required by applicable law, we will only share your information with particular third parties with your consent.</li>
<li>In exceptional circumstances, we may share information about you with a third party if we believe that sharing is reasonably necessary to (a) comply with any applicable law, regulation, or court order, (b) enforce our agreements, policies and terms of service, (c) defend ourselves against any claims or allegations, and (d) protect TC Global from fraudulent, abusive, or unlawful use or activity.</li>	
</ol>
	
	</li>
	
	<li><strong>. How to Access Information </strong>
	
	
	<ol>
<li>You may request details of personal information we hold about you under applicable law. You may object to our use of your information (including for marketing purposes), or to request the modification, restriction or deletion of your information. If you wish to do so, please contact us via our contact details provided below.</li>
</ol>
	
	</li>
	
	
	<li><strong>. Security</strong>
	
	<ol>
<li>We follow generally accepted industry standards to protect the information submitted to us, both during transmission and once we receive it. TC Global takes reasonable steps endeavoring to use appropriate technical or organizational measures to protect your information, including against unauthorized or unlawful processing and accidental loss, destruction, or damage.</li>
	
<li>Whilst we will endeavor to maintain security, given the nature of communications and information processing technology, we cannot guarantee that information, during transmission through the Internet or while stored on our systems or otherwise in our care, will be absolutely safe from intrusion by others.</li>	
<li>TC Global is not responsible for the content or accuracy of the personal data contained in the information provided by you and stored on its servers nor is TC Global responsible for the manner in which users collect, handle disclosure, distribute or otherwise process such information.</li>	
	
</ol>
	
	</li>
	
	<li><strong>. Collection of Information from Children</strong>
	
	<ol>
<li>Generally, our online services are not directed to children, and we do not knowingly collect personal information from children except as permitted under applicable law.</li>
<li>If we become aware that a child under has provided us with information, we will delete such information from our files or obtain parental consent in accordance with applicable law.</li>	
</ol>
	
	</li>
<li><strong>. Third </strong><strong>Parties</strong>
	
	<ol>
<li>This Privacy Policy does not apply to services provided by third parties. We display advertisements and other content from third parties or partners that link to third-party websites that we do not own or operate. We provide links to these third-party sites as a convenience to you. They are not intended as an endorsement of or referral to the linked services. The linked services are subject to their separate and independent privacy statements, notices, and terms. Additionally, third parties may sell goods or offer services at our facilities or in combination with our services. We are not responsible for that third parties&rsquo; services or their privacy practices.</li>
<li>We cannot control or be held responsible for third parties&rsquo; privacy practices and content. Please read their privacy policies to find out how they collect and process your information. We are not responsible for the data collection, privacy, and information sharing policies and procedures or content of such third-party websites.</li>	
</ol>
	
	</li>
	<li><strong>. Transferring </strong><strong>Your</strong><strong> Data</strong>
	<ol>	
	<li>TC Global is headquartered in India, and has operations, entities and service providers in India and other parts of the world. As such, we and our service providers may transfer your personal information to, or access it in, jurisdictions (including India) that may not provide equivalent levels of data protection as your home jurisdiction. We will take steps to ensure that your personal information receives an adequate level of protection in the jurisdictions in which we process it, including through compliance with applicable law.</li>
	</ol>
	</li>
	<li><strong>. Changes to our Privacy Policy</strong>
	<ol>
<li>Please revisit this page periodically to stay aware of any changes to this Policy which we may update from time to time. We will post any changes by a notice on our homepage or by sending you an email notification.</li>
<li>Your continued use of the website following the posting of any changes to the Website Terms constitutes acceptance of those changes.</li>	
</ol>
	
	</li>
	<li><strong>. Contact Us</strong>
	<ol>
<li>Please feel free to contact us if you have any questions, concerns or complaints about this Policy, our practices, or are interested in excising your rights. You may email us at [feedback@thechoprasglobal.com] or contact us at our mailing address below:
		<div>[19 Tanglin Road 11-03 Tanglin Shopping Centre, Singapore, 247909]</div>
		</li>
</ol>

	
	</li>
	<li><strong>. Country-</strong><strong>Specific</strong><strong> Terms for India</strong>
	<ol>
<li>Indian law defines &lsquo; sensitive personal information&rsquo; to mean information relating to: (i) passwords; (ii) financial information such as bank account/credit card/debit card details; (iii) physical, physiological and mental health condition; (iv) sexual orientation; (v) medical records and history; (vi) biometric information; (vii) any details relating to the above clauses as required for providing you with access to TC Global&rsquo;s platform; and (viii) any of the information received under above clauses for processing, stored or processed under lawful contract or otherwise. Unless otherwise specified in the Privacy Policy, &lsquo;personal information&rsquo; will include &lsquo;sensitive personal information&rsquo; as well. By using our platform and TC Global services, you will be deemed to have consented to TC Global&rsquo;s collection, disclosure and transfer of your personal information. By way of illustration, you will have provided us such consent by your conduct if you choose to share your personal information while using the TC Global platform, such as by including sensitive personal information in your content or by providing sensitive personal information in your registration information.</li>
	
<li>While transferring personal information collected from individuals in India, we will ensure that it is transferred to entities that offer at least the same levels of data protection as adhered to by us.</li>	
	
</ol>
	
	</li>
	
	
	
</ol>
</div>
          
       
          
          </div>
        </div>
      </div>
    </div>';

  $movement .='</div>';
  $movement .='</div>';

  $movement .='</div>';
  $movement .='</div>';
  $movement .='</div>';
return $movement;
}
add_shortcode('join_movement', 'get_footer_content');


?>
