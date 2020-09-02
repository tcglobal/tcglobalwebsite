<?php

   /*define('APP_ID', '258024925452911');
   define('APP_SECRET', 'b41401a2e91dd75fe96cb96664b5381f');
   define('REDIRECT_URL','https://tcglobaldev.wpengine.com/login');*/

   define('APP_ID', '657065671544289');
   define('APP_SECRET', 'd889da67766b0315e9ae19e076429c04');
   define('REDIRECT_URL','https://tcglobal.com/login/');

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

  //session_start();

$fb_data = [];

if(empty($_GET['scope'])) // check if user request from fb
{  

  FacebookSession::setDefaultApplication(APP_ID,APP_SECRET);

  //$helper = new FacebookRedirectLoginHelper(REDIRECT_URL);

  $helper = new FacebookRedirectLoginHelper('https://tcglobal.com/login/');

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

        //$fb_api = "https://tcgstagingservice.optisolbusiness.com/api/SignUpByThirdParty";

        $fb_api = "https://portalapi.tcglobal.com/api/SignUpByThirdParty";

        $fbresult = fbpostFunction($fb_api,$fb_data);

        $fetcToken = json_decode($fbresult);
        $fbusertoken = $fetcToken->token;

        //portal redirect url after signin using gmail
        //$redirect_endpoint = 'http://spstaging.optisolbusiness.com/authentication/'.$fbusertoken;

        $redirect_endpoint = 'https://student.tcglobal.com/authentication/'.$fbusertoken;

        fbuserFunction($firstName,$lastName,$fbemail,'','facebook');
        
        echo '<script>window.location.href=\''.$redirect_endpoint.'\';</script>';

      } 

  }  


function fbpostFunction($url,$data)
{ 
      $header = array("Content-Type: application/json");
      
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($data),
      CURLOPT_HTTPHEADER => $header,
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl); 
      curl_close($curl);
      if ($err) {
        return null; 
      } else {
        return $response;
      }
  }

function fbuserFunction($reqfname,$reqlname,$reqemail,$reqmobile,$reqtype){

  $tcguserpost_api = 'https://api.tcglobal.com/portal/signup.php';

  $userpostdata = [];

  $userpostdata['apikey'] = 'sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345';
  $userpostdata['firstName'] = $reqfname;
  $userpostdata['lastName'] = $reqlname;
  $userpostdata['emailId'] = $reqemail;
  $userpostdata['mobileNumber'] = $reqmobile;
  $userpostdata['loginType'] = $reqtype;
  $userpostdata['stage'] = 'fresh';
  
  curlfbUser($tcguserpost_api,$userpostdata);

}


function curlfbUser($url,$data)
{    

    $header = array("content-type: multipart/form-data");
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => $header,
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl); 
  curl_close($curl);
  if ($err) {
    echo "cURL Error #:" . $err;  
  } else {
     return $response;
  }
}

?>
