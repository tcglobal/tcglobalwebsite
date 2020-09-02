<?php
/*
Template Name: Forgot Password
*/
   get_header();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/user_register_form.css" >

<style type="text/css">
	.mobile-menu{display:none}
  .mobile-menu-close.clicked{display:block !important}
  footer {
    display: none !important;
  }
  body {
    padding-bottom: 0 !important;
  }
</style>

<div class="container">
           <div class="row">
               <div class="col-12 m-t-60">
                 <div class="global-space">
                  <h2 class="main-heading">Reset Password</h2>
                 </div>
                </div>
               <div class="col-12">
                <div class="register global-space">
                    <form class="log-form p-t-20" id="user_forgot_pass" action="" method="post" enctype="multipart/form-data">
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
                            <div class="col-12 text-center my-5">
                                <a href="/login/" class="fs-12 color_theme z-pro"><img src="<?php echo get_template_directory_uri();?>/images/red-right-arrow.jpg" class="pr-2"> Back to login</a>
                            </div>
                        </div>
                      </form>
                   </div>
            </div>
           </div>

       </div>


<script src="/form/user_form_validation.js"></script>

<?php get_footer(); ?>
