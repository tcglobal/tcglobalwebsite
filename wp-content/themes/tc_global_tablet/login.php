<?php
/*
Template Name: Login Page
*/
   session_start();


   $login_dir = $_SERVER["DOCUMENT_ROOT"].'/fb-login/index.php';
   $google_dir = $_SERVER["DOCUMENT_ROOT"].'/gmail-login/index.php';

   include $login_dir;
   include $google_dir;

   get_header();
?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/user_register_form.css" >
<style type="text/css">
	header, footer, section.widget_text {display: none !important;}
</style>

<div class="container">
           <div class="row">
               <div class="col-12 col-sm-6 pl-0">
                   <div class="login_left">
                       <div class="login-left-inner p-t-80 pb_5">
                        <h1 class="left">Log in as a ...</h1>
                        <ul class="mt_4">
                            <!-- <li><a href="#" class="current"><img src="<?php echo get_template_directory_uri();?>/images/down_2.png"> <span>Student</span></a></li> -->
                            <li><a href="#"><span style="border-bottom: 1px solid #000">Student</span></a></li>
                            <li class="mt_1 mb_1"><a href="https://rmcommunity.tcglobal.com/login"><span style="border-bottom: 1px solid #000">Relationship Mananger </span></a></li>
                            <li class="mt_1 mb_1"><a href="#"><span>Partner - <em class="upcmg" style="font-style: normal;color: #d91f3d;font-size: 12px;">Coming Soon!</em></span></a></li>
                        </ul>
                        <div class="in-height height-300">&nbsp;</div>
                       <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
                       </div>
                   </div>
               </div>
               <div class="col-12 col-sm-6">
                <div class="login_right register p-t-80">

                    <div id="loginerror"></div>
                    <div id="activatemsg"></div>

                    <img src="<?php echo get_template_directory_uri();?>/images/globaled-icon-red2.png" class="mx-auto d-block">

                    <form class="log-form m-t-80 pt-2" id="user_login_form" action="" method="post" enctype="multipart/form-data">
                      <div class="group m-b-40">
                        <input type="email" name="useremail" id="userInputEmail" aria-describedby="emailHelp" class="w-100">
                        <span class="highlight"></span>
                        <label for="userInputEmail">Email</label>
                      </div>
                      <div class="group">
                        <input type="password" name="userpass" id="userInputPassword" class="w-100">
                        <span class="highlight"></span>
                        <label for="userInputPassword">Password</label>
                        <span class="password-showicon">
                          <img class="changeimg" onclick="changedata('userInputPassword','changeimg');" src="<?php echo get_template_directory_uri();?>/images/show.png" />
                        </span>
                      </div>
                        <div class="row pt-1">
                            <div class="col-12">
                                <a href="/login-via-phone/" class="pull-left fs-12 color_theme z-pro">Use phone to login</a>
                                <a href="/forgot-password" class="pull-right fs-12 color_theme z-pro">Forgot password?</a>
                            </div>
                        </div>
                        <button type="submit" id="loginSubmit" class="btn w-100 m-t-80 btn-theme">Log in <i class="login_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
                      </form>
                      <div class="row">
                        <div class="col line m-t-50 mb-4">
                            <div class="mx-auto col-3 text-center">
                                <span>Or</span>
                            </div>
                        </div>
                    </div>

                      <a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>" class="d-block s-icon pt-3 pb-3 mb-3"><span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/g-img.jpg"/></span> Continue using google</a>

                      <a href="<?php echo $helper->getLoginUrl(array('scope' => 'email')); ?>" class="d-block s-icon pt-3 pb-3"><span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/f-img.jpg"/></span> Continue using facebook</a>
                      
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
    function resendMail() {

      resendemail = jQuery('input[name=useremail]').val();
      var resendFormData = { type: 'resendEmail', email: resendemail}
       
        $.ajax({
            type: "POST",
            url: "/form/submit_form.php",
            data: resendFormData,
            cache: false,
            success: function (data) {
              
            var response = JSON.parse(data);

            if(response.msg){
                
                $("#loginerror").css('display', 'none');
                $("#activatemsg").css('display', 'block');
                
                $("#activatemsg").html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                  '<strong class="alert-heading">'+response.msg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                  '<span aria-hidden="true">&times;</span></button></div>');
                $("#activatemsg").fadeOut(4000,"linear");

              }
              else if(response.errorMsg){
               
                $("#activatemsg").css('display', 'none');
                $("#loginerror").css('display', 'block');
                $("#loginerror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.errorMsg+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                $("#loginerror").fadeOut(3000,"linear");
              }

            },
            error: function () {
              $("#loginerror").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">error<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            }

          }); 
  }
</script>



<?php get_footer(); ?>
