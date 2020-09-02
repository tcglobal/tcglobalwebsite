<?php

/*if (!session_id()) {
    session_start();
}*/

//session_start();

//session_start();

/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
ini_set('memory_limit', '-1');*/


// Include the autoloader provided in the SDK
require_once __DIR__ . '/facebook-php-sdk/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


/*$appId = '2756326817986891'; 
$appSecret = 'cbbb716fbe23fbe00feae3330050bf02';*/

/** portal **/

$appId = '2912124532347915'; 
$appSecret = 'c0d8782fa601ad71b53318b28f42ad9e';


//$redirectURL = 'YOUR CALLBACK URL'; //Callback URL
//$fbPermissions = array('email');  //Optional permissions

$fb = new Facebook(array(
'app_id' => $appId,
'app_secret' => $appSecret,
'default_graph_version' => 'v2.9',
));

$permissions = []; // optional
// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();


//$login_url = $helper->getLoginUrl("http://localhost/tcglobalstg/");

$login_url = $helper->getLoginUrl("https://tcglobaldev.wpengine.com/");


if(isset($_GET['code']))
{

	echo $_GET['code'];

 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $fb->setDefaultAccessToken($_SESSION['access_token']);
 }

 

 $graph_response = $fb->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 print_r($facebook_user_info);

 
 
}


//$login_url = $helper->getLoginUrl("https://spstaging.optisolbusiness.com/login");

// Redirect the user back to the same page if url has "code" parameter in query string
/*if (isset($_GET['code'])) {

  try {
        $profileRequest = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,locale,picture');
		$fbUserProfile = $profileRequest->getGraphNode()->asArray();

		print_r($fbUserProfile);
    } catch(FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        session_destroy();
        
    } catch(FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
}    
*/



    

?>

