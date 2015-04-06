<?php
if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}
/* require_once(APPPATH . 'libraries/gmail/src/autoload.php' );
require_once(APPPATH . 'libraries/gmail/src/Service.php' );
require_once(APPPATH . 'libraries/gmail/src/Google_Service_Resource.php' );
require_once(APPPATH . 'libraries/gmail/src/collection.php' );
require_once(APPPATH . 'libraries/gmail/src/googleConfig.php' );
require_once(APPPATH . 'libraries/gmail/src/model.php' ); */
require_once( APPPATH . 'libraries/gmail/src/Google/autoload.php' );
require_once(APPPATH . 'libraries/gmail/src/Google/Client.php' );
require_once(APPPATH . 'libraries/gmail/src/Google/Auth/OAuth2.php' );

class gmail {

	
public function login_gmail(){
	
// Fill CLIENT ID, CLIENT SECRET ID, REDIRECT URI from Google Developer Console
 $client_id = '562969423009-hiriftgkevatb4lg5buitaqlan35hbui.apps.googleusercontent.com';
 $client_secret = 'bkMVBPJu_iTFShMnOmcyXgRK';
 $redirect_uri = 'http://localhost/index.php/welcome';
 $simple_api_key = 'AIzaSyA-bLGG3xgbvMHrzsjkE-4jAhkkpMaeJ1A';
 
//Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName("GmailOnetrack");
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setDeveloperKey($simple_api_key);
$client->addScope("https://www.googleapis.com/auth/userinfo.email");
//Send Client Request

	$objOAuthService = new Google_Service_Oauth2($client);
//Logout
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
  $client->revokeToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
}

//Authenticate code from Google OAuth Flow
//Add Access Token to Session
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

//Set Access Token to make Request
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
}

//Get User Data from Google Plus
//If New, Insert to Database
if ($client->getAccessToken()) {
  $userData = $objOAuthService->userinfo->get();
  if(!empty($userData)) {
	$objDBController = new DBController();
	$existing_member = $objDBController->getUserByOAuthId($userData->id);
	if(empty($existing_member)) {
		$objDBController->insertOAuthUser($userData);
	}
  }
  $_SESSION['access_token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  return $authUrl;
}
//require_once("header.php")
}
}