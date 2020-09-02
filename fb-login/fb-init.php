
<?php


/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);*/

require_once 'vendor/autoload.php';

/*if (!session_id())
{
    session_start();
}*/

//session_start();

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '2912124532347915',
  'app_secret'     => 'c0d8782fa601ad71b53318b28f42ad9e',
  'default_graph_version'  => 'v2.10'
]);

//echo "fb test";

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
  //echo $_GET['code'];
  
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 print_r($facebook_user_info);
 
}

/*else
{
 // Get login url
    //$facebook_permissions = ['email']; // Optional permissions
    $facebook_permissions = []; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://greenhouses-pro.co.uk/demo/', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}*/

//$login_url = $facebook_helper->getLoginUrl('https://tcglobaldev.wpengine.com/fb-login/fb-init.php');

$login_url = $facebook_helper->getLoginUrl('https://tcglobaldev.wpengine.com/sign-up');


?>