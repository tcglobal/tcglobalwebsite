<?php
/*
Template Name: Login Page
*/

  session_start();

  //$fb_data = [];

  $login_dir = $_SERVER["DOCUMENT_ROOT"].'/fb-login/index.php';
  $google_dir = $_SERVER["DOCUMENT_ROOT"].'/gmail-login/index.php';

   include $login_dir;
   include $google_dir;

   /* define('APP_ID', '258024925452911');
   define('APP_SECRET', 'b41401a2e91dd75fe96cb96664b5381f');
   define('REDIRECT_URL','https://tcglobaldev.wpengine.com/login');

    //INCLUDING LIBRARIES
    require_once('lib/Facebook/FacebookSession.php');
    require_once('lib/Facebook/FacebookRequest.php');
    require_once('lib/Facebook/FacebookResponse.php');
    require_once('lib/Facebook/FacebookSDKException.php');
    require_once('lib/Facebook/FacebookRequestException.php');
    require_once('lib/Facebook/FacebookRedirectLoginHelper.php');
    require_once('lib/Facebook/FacebookAuthorizationException.php');
    require_once('lib/Facebook/FacebookAuthorizationException.php');
    require_once('lib/Facebook/GraphObject.php');
    require_once('lib/Facebook/GraphUser.php');
    require_once('lib/Facebook/GraphSessionInfo.php');
    require_once('lib/Facebook/Entities/AccessToken.php');
    require_once('lib/Facebook/HttpClients/FacebookCurl.php');
    require_once('lib/Facebook/HttpClients/FacebookHttpable.php');
    require_once('lib/Facebook/HttpClients/FacebookCurlHttpClient.php');

    //USING NAMESPACES
    use Facebook\FacebookSession;
    use Facebook\FacebookRedirectLoginHelper;
    use Facebook\FacebookRequest;
    use Facebook\FacebookResponse;
    use Facebook\FacebookSDKException;
    use Facebook\FacebookRequestException;
    use Facebook\FacebookAuthorizationException;
    use Facebook\GraphObject;
    use Facebook\GraphUser;
    use Facebook\GraphSessionInfo;
    use Facebook\HttpClients\FacebookHttpable;
    use Facebook\HttpClients\FacebookCurlHttpClient;
    use Facebook\HttpClients\FacebookCurl;

  if(empty($_GET['scope'])) // check if user request from fb
  {

    FacebookSession::setDefaultApplication(APP_ID,APP_SECRET);
    //$helper = new FacebookRedirectLoginHelper(REDIRECT_URL);
    $helper = new FacebookRedirectLoginHelper('https://tcglobaldev.wpengine.com/login/');
    //$sess = $helper->getSessionFromRedirect();

    $_SESSION['FBRLH_state']=$_GET['state'];
        // see if a existing session exists
      if ( isset( $_SESSION ) && isset( $_SESSION['fb_token'] ) ) {
        // create new session from saved access_token
        $session = new FacebookSession( $_SESSION['fb_token'] );

        // validate the access_token to make sure it's still valid
        try {
          if ( !$session->validate() ) {
            $session = null;
          }
        } catch ( Exception $e ) {
          // catch any exceptions
          $session = null;
        }

      } else {
        // no session exists

        try {
          $session = $helper->getSessionFromRedirect();
        } catch( FacebookRequestException $ex ) {
          // When Facebook returns an error
        } catch( Exception $ex ) {
          // When validation fails or other local issues
          //echo $ex->message;
        }

      }

    // see if we have a session
    if ( isset( $session ) ) {

      // save the session
      $_SESSION['fb_token'] = $session->getToken();
      // create a session using saved token or the new one we generated at login
      $session = new FacebookSession( $session->getToken() );

        // graph api request for user data
        $request  = new FacebookRequest($session, 'GET', '/me?fields=first_name,last_name,email,link');
        $response = $request->execute();
        $graphObject = $response->getGraphObject();

         $id = $graphObject->getProperty('id');
         $firstName = $graphObject->getProperty('first_name');
         $lastName = $graphObject->getProperty('last_name');
         $emailId = $graphObject->getProperty('email');
         $profileId = $graphObject->getProperty('link');

         if($emailId){
          $fbemail = $emailId;
         }
         else{
          $fbemail ="";
         }

        $photourl = "";
        if($id){
          $photourl = 'http://graph.facebook.com/'.$id.'/picture';
        }

        $fb_data['firstName'] = $firstName;
        $fb_data['lastName'] = $lastName;
        $fb_data['email'] = $fbemail;
        $fb_data['photoUrl'] = $photourl;
        $fb_data['provider'] = "FACEBOOK";
        $fb_data['id'] = $id;

        $fb_api = "https://tcgstagingservice.optisolbusiness.com/api/SignUpByThirdParty";
        $fbresult = fbpostFunction($fb_api,$fb_data);

        $fetcToken = json_decode($fbresult);
        $fbusertoken = $fetcToken->token;

        //portal redirect url after signin using gmail
        echo $redirect_endpoint = 'http://spstaging.optisolbusiness.com/authentication/'.$fbusertoken;

    //echo '<script>window.location.href=\''.$redirect_endpoint.'\';</script>';

      }

  } */

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
                          <!-- <img src="<?php echo get_template_directory_uri();?>/images/eye-icon-open.png" class="" /> -->
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
                        <div class="col line m-t-50 mb-4">
                            <div class="mx-auto col-3 text-center">
                                <span>Or</span>
                            </div>
                        </div>
                    </div>

                      <!--<a href="#" class="d-block s-icon pt-3 pb-3 mb-3"><span class="pull-left ml-4"><img src="<?php //echo get_template_directory_uri();?>/images/g-img.jpg"/></span> Continue using google</a>-->

                      <a class="d-block s-icon pt-3 pb-3 mb-3" href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"> <span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/g-img.jpg"/></span>Continue using google</a>

                      <a href="<?php echo $helper->getLoginUrl(array('scope' => 'email')); ?>" class="d-block s-icon pt-3 pb-3"><span class="pull-left ml-4"><img src="<?php echo get_template_directory_uri();?>/images/f-img.jpg"/></span> Continue using facebook</a>

                      <!--<a href="#" class="d-block s-icon pt-3 pb-3"><span class="pull-left ml-4"><img src="<?php //echo get_template_directory_uri();?>/images/f-img.jpg"/></span> Continue using facebook</a>-->
                      
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
