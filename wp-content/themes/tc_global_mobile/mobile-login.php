<?php
/*
Template Name: Mobile Login Page
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
      <div class="col-12 col-sm-6">
        <div class="login-form-sec register p-t-40 global-space">

            <div id="otperror"></div>
            <div id="otpsuccess"></div>

            <img src="<?php echo get_template_directory_uri();?>/images/globaled-icon-red2.png" class="mx-auto d-block">

            <p class="m-t-50">Please provide phone number connected to your account-we'll send you message with code to log in.</p>

          <div class="otpsection">
            <form class="log-form m-t-50" id="mobile_login_form" action="" method="post" enctype="multipart/form-data">
              <div class="group m-b-10">
                <input type="text" name="phonelogin" id="phonelogin" minlength="10" maxlength="10" class="w-100 number-field">
                <span class="highlight"></span>
                <label for="userInputMobile">Mobile Number</label>
              </div>

              <div class="row pt-1">
                <div class="col-12">
                    <a href="/login/" class="pull-left fs-12 color_theme z-pro">Use mail to login</a>
                    
                  </div>
                </div>
                <button type="submit" id="mobileloginSubmit" class="btn w-100 m-t-80 btn-theme">SEND CODE<i class="phone_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
              </form>
            </div>

            <div class="otploginsection" style="display:none">
             <form class="log-form m-t-50" id="otp_login_form" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="otpmobile" value="">

              <div class="group m-b-10">
                <input type="text" name="otpnum" id="otpnum" minlength="4" maxlength="4" class="w-100 number-field">
                <span class="highlight"></span>
                <label for="userMobileCode">Code received</label>
              </div>

              <div class="row pt-1">
                <div class="col-12">
                    <a href="/login/" class="pull-left fs-12 color_theme z-pro">Use mail to login</a>
                    <a onClick='submitDetailsForm()' class="pull-right fs-12 color_theme z-pro" style="color: #d91f3d;">Resend code</a>
                  </div>
                </div>
                <button type="submit" id="otploginSubmit" class="btn w-100 m-t-80 btn-theme">LOG IN<i class="otp_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
              </form> 
            </div>

              <div class="w-100 text-center m-t-30 m-b-30">
              <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
              </div>

           </div>
    </div>
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
