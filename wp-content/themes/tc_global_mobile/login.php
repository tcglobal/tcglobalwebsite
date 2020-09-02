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
               <!-- <div class="col-12 col-sm-6 role_section p-0">
                   <div class="login_left col-sm-12">
                       <div class="login-left-inner p-t-60 p-b-30 global-space">
                        <h1>Log in as a ...</h1>
                        <ul class="mt_4 enduser_type">
                            <li><a><span>Student</span></a></li>
                            <li class="mt_1 mb_1"><a><span>Relationship Mananger</span></a></li>
                            <li class="mt_1 mb_1"><a><span>Partner</span></a></li>
                        </ul>
                        <div class="in-height height-300">&nbsp;</div>
                        <div class="w-100 text-center">
                         <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
                       </div>
                       </div>
                   </div>
               </div> -->
               <div class="col-12 col-sm-6">
                <div class="login-form-sec register p-t-40 global-space">

                    <div id="loginerror"></div>
                    <div id="activatemsg"></div>

                    <img src="<?php echo get_template_directory_uri();?>/images/globaled-icon-red2.png" class="mx-auto d-block">

                    <form class="log-form m-t-50" id="user_login_form" action="" method="post" enctype="multipart/form-data">
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
                          <img class="changeimg" onclick="changedata('userInputPassword','changeimg');" src="<?php echo get_template_directory_uri();?>/images/show.png" class="" />
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
                        <div class="col line m-t-50 m-b-30">
                            <div class="mx-auto col-3 text-center">
                                <span>Or</span>
                            </div>
                        </div>
                    </div>

                      <a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>" class="d-block s-icon pt-3 pb-3 mb-3"><span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/g-img.jpg"/></span> Continue using google</a>

                      <a href="<?php echo $helper->getLoginUrl(array('scope' => 'email')); ?>" class="d-block s-icon pt-3 pb-3"><span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/f-img.jpg"/></span> Continue using facebook</a>

                      <div class="w-100 text-center m-t-30 m-b-30">
                      <a href="/sign-up" class="color_theme z-pro fs-12">Don't have an account? Sign Up <img src="<?php echo get_template_directory_uri();?>/images/red-arrow.jpg" class="pl-2"></a>
                      </div>
                   </div>
            </div>
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
