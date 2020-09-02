<?php
/*
Template Name: Mobile Login Page
*/

?>

<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/user_register_form.css" >
<style type="text/css">
  header, footer, section.widget_text {display: none;}
</style>

<div class="container">
       <div class="row">
           <div class="col-12 col-sm-6">
               <div class="login_left">
                   <div class="login-left-inner p-t-80 pb_5">
                    <h1>Log in as a ...</h1>
                    <ul class="mt_4">
                        <li><a herf="#" class="current"><img src="<?php echo get_template_directory_uri();?>/images/down_2.png"> <span>Student</span></a></li>
                        <li class="mt_1 mb_1"><a href="https://rmcommunity.tcglobal.com/login"><span>Relationship Mananger</span></a></li>
                        <li class="mt_1 mb_1"><a herf="#"><span>Partner - <em class="upcmg" style="font-style: normal;color:#d91f3d;font-size: 12px;">Coming Soon!</em></span></a></li>
                    </ul>
                    <div class="in-height height-300">&nbsp;</div>
                   <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
                   </div>
               </div>
            </div>
               <div class="col-12 col-sm-6">
                <div class="login_right register p-t-80">

                    <div id="otperror"></div>
                    <div id="otpsuccess"></div>

                    <img src="<?php echo get_template_directory_uri();?>/images/globaled-icon-red2.png" class="mx-auto d-block">

                    <p class="m-t-50">Please provide phone number connected to your account-we'll send you message with code to log in.</p>

                    <div class="otpsection">
                      <form class="log-form m-t-80 pt-2" id="mobile_login_form" action="" method="post" enctype="multipart/form-data">

                        <div class="group m-b-10">
                          <input type="text" name="phonelogin" id="phonelogin" minlength="10" maxlength="10"class="w-100 number-field">
                          <span class="highlight"></span>
                          <label for="userInputMobile">Mobile Number</label>
                        </div>
                        <div class="row pt-1">
                            <div class="col-12">
                                <a href="/login/" class="pull-left fs-12 color_theme z-pro">Use mail to login</a>
                            </div>
                        </div>

                        <button type="submit" id="mobileloginSubmit" class="btn w-100 m-t-40 btn-theme">SEND CODE<i class="phone_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                      </form>
                    </div>

                    <div class="otploginsection" style="display:none">
                      <form class="log-form m-t-80 pt-2" id="otp_login_form" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="otpmobile" value="">
                        <div class="group m-b-10">
                          <input type="text" name="otpnum" id="otpnum" minlength="4" maxlength="4"class="w-100 number-field">
                          <span class="highlight"></span>
                          <label for="userMobileCode">Code received</label>
                        </div>

                        <div class="row pt-1">
                            <div class="col-12">
                                <a href="/login/" class="pull-left fs-12 color_theme z-pro">Use mail to login</a>
                                <a onClick='submitDetailsForm()' class="pull-right fs-12 color_theme z-pro" style="color: #d91f3d;">Resend code</a>
                            </div>
                        </div>

                        <button type="submit" id="otploginSubmit" class="btn w-100 m-t-40 btn-theme">LOG IN<i class="otp_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                      </form>
                    </div>

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

<script language="javascript" type="text/javascript">
    function submitDetailsForm() {
      
      resendphone = jQuery('input[name=otpmobile]').val();
      var otpFormData = { type: 'mobileOTP', phone: resendphone}
       
        $.ajax({
            type: "POST",
            url: "/form/submit_form.php",
            data: otpFormData,
            cache: false,
            success: function (data) {
              
            var response = JSON.parse(data);

            if(response.msg){
                
                $("#otperror").css('display', 'none');
                $("#otpsuccess").css('display', 'block');
                $(".otpsection").css('display', 'none');
                $(".otploginsection").css('display', 'block');
                $("#otpsuccess").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                  '<strong class="alert-heading">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                  '<span aria-hidden="true">&times;</span></button></div>');
                $("#otpsuccess").fadeOut(3000,"linear");

              }
              else if(response.errorMsg){
               
                $("#otpsuccess").css('display', 'none');
                $("#otperror").css('display', 'block');
                $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $("#otperror").fadeOut(3000,"linear");
              }

            },
            error: function () {
              $("#otperror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">error<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }

          }); 

  }
</script>


<?php get_footer(); ?>
