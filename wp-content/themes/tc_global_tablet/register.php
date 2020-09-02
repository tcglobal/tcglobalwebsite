<?php
/*
Template Name: SignUp Page
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

<div class="container register">
   <div class="row">
       <div class="col-12">
           <h1 class="text-center mt-5 mb-5">Sign up</h1>
       </div>
   </div>
   <div class="row">
    <div class="col line">
        <div class="mx-auto col-4 text-center">
            <span>With your social profiles</span>
        </div>
    </div>
  </div>
        <div class="row justify-content-center mt_2">
            <a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>" class="social-btn mr-5"><img src="<?php echo get_template_directory_uri();?>/images/g-img.jpg" > google </a>
            
            <a href="<?php echo $helper->getLoginUrl(array('scope' => 'email')); ?>" class="social-btn"><img src="<?php echo get_template_directory_uri();?>/images/f-img.jpg"> facebook </a>
      </div>
      <div class="row">
        <div class="col line mt_2 mb-4">
            <div class="mx-auto col-2 text-center">
                <span>Or</span>
            </div>
        </div>
    </div>

    <div id="errorres"></div>
    <div id="successres"></div>

    <div class="mx-auto col-10">
        <form class="log-form mt_2" id="user_singup_form" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6 mb-3">
                  <div class="group">
                    <input type="text" name="firstname" class="w-100 username-field">
                    <span class="highlight"></span>
                    <label>First Name</label>
                  </div>

                </div>
                <div class="col-6 mb-3">

                      <div class="group">
                        <input type="text" name="lastname" class="w-100 username-field">
                        <span class="highlight"></span>
                        <label>Last Name</label>
                      </div>

                </div>
                <div class="col-6 mb-3">

                  <div class="group">
                    <input type="text" name="custom_mail" aria-describedby="emailHelp" class="w-100">
                    <span class="highlight"></span>
                    <label>Email</label>
                  </div>

                </div>

                <div class="col-md-6 eventdetail-typenumber mb-3">
                    <div class="group">
                      <div class="map-form-in">
                        <input type="tel" name="telephone" id="txtPhone" class="number-field telephone" placeholder="Mobile Number" maxlength="13">
                        <span id="valid-msg" class="hide"></span>
                        <span id="error-msg" class="hide" style="font-size: 14px;color: #d91f3d !important;"></span>
                      </div>
                    </div>
                    <!-- <div style="display:none"><input type="hidden" name="countrynum" value=""></div> -->
                  </div>

                <div class="col-6">

                  <div class="group">
                    <input type="password" name="userpass" id="userpass" class="w-100" />
                    <span class="highlight"></span>
                    <label>Password</label>
                    <span class="password-showicon">
                      <img class="changeimg1" onclick="changedata('userpass','changeimg1');" src="<?php echo get_template_directory_uri();?>/images/show.png" class="" />
                    </span>
                  </div>

                </div>
                <div class="col-6">

                  <div class="group">
                    <input type="password" name="confirm_pass" id="reenterpass" class="w-100" />
                    <span class="highlight"></span>
                    <label>Confirm Password</label>
                    <span class="password-showicon">
                      <img class="changeimg2" onclick="changedata('reenterpass','changeimg2');" src="<?php echo get_template_directory_uri();?>/images/show.png" class="" />
                    </span>
                  </div>

                </div>

                <div class="col-12">
                  <div class="termslink">
                    <div class="customcheckbox">
                      <input type="checkbox" name="userterms" id="signupterm" />
                      <label for="signupterm" class=""><span>I agree to
                        <a target="_blank" href='<?php echo get_permalink(134); ?>'>Terms &amp; Conditions</a></span></label>
                    </div>
                  </div>

                </div>

              </div>

            <input type="hidden" id="country_code" name="country_code" value="91" />

            <div class="mx-auto col-6">
                <button type="submit" id="signupSubmit" class="btn w-100 mt-5 btn-theme">Sign up <i class="signup_loader fa fa-spinner fa-spin ml-3" style="display:none"></i></button>
            </div>
            <div class="row">
                <div class="col-12 text-center mt-4">
                    <a href="/login/" class="fs-12 color_theme z-pro ">Already have an account? Sign in</a>
                </div>
            </div>

          </form>
    </div>
        <div class="bottom-logo mt_5 pb_2 d-block">
          <a href="/"><img src="/wp-content/uploads/2020/06/tc-global-final-logo-rgb.png"></a>
       </div>
       <div class="login-footer">
           <p class="pull-left">&copy;<?php echo date("Y")." ".get_option('copy'); ?></p>
           <ul class="pull-right d-block">
               <li><a href="<?php echo get_option('terms_link'); ?>"><?php echo get_option('terms'); ?></a></li>
               <li><a href="<?php echo get_option('privacy_link'); ?>"><?php echo get_option('privacy'); ?></a></li>
           </ul>
       </div>

       </div>


<script type="text/javascript">
    $(document).ready(function () {
        $('#country-listbox li').click(function(){
        var dialcode = $(this).data('dial-code');
        //console.log(dialcode);
        $('#country_code').val(dialcode);

      });



    });
</script>

<script src="/form/user_form_validation.js"></script>

<?php get_footer(); ?>
