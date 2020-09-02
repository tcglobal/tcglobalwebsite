<?php
/*
Template Name: Forgot Password
*/
   get_header();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/user_register_form.css" >
<style type="text/css">
	header, footer, section.widget_text {display: none !important;}
</style>


<div class="container">
           <div class="row">
               <div class="col-6 pl-0">
                   <div class="login_left">
                       <div class="login-left-inner p-t-80 pb_5">
                        <h1 class="left">Log in as a ...</h1>
                        <ul class="mt_4 col-8">
                            <li><a href="#"><span style="border-bottom: 1px solid #000" >Student</span></a></li>
                            <li><a href="https://rmcommunity.tcglobal.com/login"><span style="border-bottom: 1px solid #000">Relationship Mananger </span></a></li>
                            <li><a href="#">Partner - <em class="upcmg" style="font-style: normal;color: #d91f3d;font-size: 12px;">Coming Soon!</em></a></li>
                        </ul>
                        <div class="in-height height-300">&nbsp;</div>
                       <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
                       </div>
                   </div>
               </div>
               <div class="col-6">
                <div class="login_right p-t-80 register">
                    <img src="<?php echo get_template_directory_uri();?>/images/globaled-icon-red2.png" class="mx-auto d-block">
                    <form class="log-form m-t-80 p-t-20" id="user_forgot_pass" action="" method="post" enctype="multipart/form-data">
                        <p class="font-light fs-14">Please provide email connected to your account-We’ll send you link for reseting password.</p>
                        <div class="form-group mb-4 mt_5">
                         <div class="group">
                          <input type="email" name="forgot_email" id="forgot_email" aria-describedby="emailHelp" class="w-100">
                            <span class="highlight"></span>
                            <label>Email</label>
                          </div>
                        </div>

                        <div id="forgoterror"></div>
                        <div id="forgotsuccess"></div>

                        <button type="submit" id="forgotSubmit" class="btn w-100 m-t-80 btn-theme">send new password <i class="forgot_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                        <div class="row">
                            <div class="col-12 text-center mt-5">
                                <a href="/login/" class="fs-12 color_theme z-pro"><img src="<?php echo get_template_directory_uri();?>/images/red-right-arrow.jpg" class="pr-2"> Back to login</a>
                            </div>
                        </div>
                      </form>
                   </div>
            </div>
           </div>

           <div class="bottom-logo mt_5 pb_2 d-block">
               <a href="/"><img src="/wp-content/uploads/2020/06/tc-global-final-logo-rgb.png"></a>
           </div>
           <div class="login-footer mt-2">
               <p class="pull-left">&copy;<?php echo date("Y")." ".get_option('copy'); ?></p>
               <ul class="pull-right d-block">
                   <li><a href="<?php echo get_option('terms_link'); ?>"><?php echo get_option('terms'); ?></a></li>
                   <li><a href="<?php echo get_option('privacy_link'); ?>"><?php echo get_option('privacy'); ?></a></li>
               </ul>
           </div>

       </div>


<script src="/form/user_form_validation.js"></script>

<?php get_footer(); ?>
