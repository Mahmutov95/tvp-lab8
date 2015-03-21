<?php
session_start();
 
 
require_once( 'src/Facebook/FacebookSession.php' );
require_once( 'src/Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'src/Facebook/FacebookRequest.php' );
require_once( 'src/Facebook/FacebookResponse.php' );
require_once( 'src/Facebook/FacebookSDKException.php' );
require_once( 'src/Facebook/FacebookRequestException.php' );
require_once( 'src/Facebook/FacebookAuthorizationException.php' );
require_once( 'src/Facebook/GraphObject.php' );
 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
 
// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('1403157526657409','6e79d4d81541378d2dfbb7b90225b2d5');
 
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://www.metah.ch/' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  echo  print_r( $graphObject, 1 );
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl() . '">Login</a>';
}
?>