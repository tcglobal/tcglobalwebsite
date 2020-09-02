<?php
$method=$_SERVER['REQUEST_METHOD'];
if($method!='GET') {
$token="sdghzfdvnbjsad789ngZcvasuyFZDhbasyu345";
$username="optisol";
$password="7ae632e6-a11a-4e3c-b01d-02901d5ab1c1";

//$data = json_decode(file_get_contents("php://input"));
$client_token=$_REQUEST['token'];
$client_username=$_REQUEST['username'];
$client_password=$_REQUEST['password'];
$country=$_REQUEST['country'];

if($token==$client_token && $username==$client_username && $password==$client_password)
{
header("Access-Control-Allow-Origin: https://www.tcglobal.com/globalapi/country.php");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/countrymain.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$user = new User($db);
 
// submitted data will be here
 
// set product property values

$c = $user->CountryList($country);
}
else
{

$c=array('Error' =>"Authentication Failed");

}
echo $country=json_encode($c);
}
else
{
$c=array('message' =>"The requested resource does not support http method 'GET'.");
echo $country=json_encode($c);

}
