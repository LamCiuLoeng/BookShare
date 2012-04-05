<?php
require_once 'util.php';
require_once 'db_helper.php';
require_once 'sns/google.php';
require_once 'sns/facebook.php';
require_once 'sns/qq.php';
require_once 'sns/lib/OAuth/OAuth.php';
require_once 'sns/lib/Yahoo/YahooOAuthApplication.class.php';

function checkAndLogin($email, $pic, $account_type) {
	//check the user in DB or not
	$db = getDBInstance ();
	$users = checkUserByEmail ( $db, $email, $account_type );
	if (count ( $users ) < 1) {
		//if it's a new user,create it
		$locale = isset ( $_SESSION ['locale'] ) ? $_SESSION ['locale'] : DEFAULT_LOCALE;
		$user = addUser ( $db, $email, nowStr () . randomStr ( 100, 999 ), $pic, $locale, $account_type );
	} else {
		$user = $users [0];
	}
	
	//login the user
	loginUser ( $user );

}

if (isset ( $_REQUEST ['code'] )) {
	if ($_REQUEST ['state'] == 'google') {
		//create the auth url
		$g = new GoogleUtil ();
		//exchange the code to token
		$token = $g->getToken ( $_REQUEST ['code'] );
		//get the userinfo by token
		$userinfo = $g->getUserInfo ( $token );
		$email = $userinfo->email;
		$pic = $userinfo->picture;
	} elseif ($_REQUEST ['state'] == 'facebook') {
		$f = new FacebookUtil ();
		$token = $f->getToken ( $_REQUEST ['code'] );
		$userinfo = $f->getUserInfo ( $token );
		$email = $userinfo->email;
		$pic = $f->getUserPic ( $userinfo->id );
	} elseif ($_REQUEST ['state'] == 'qq') {
		$q = new QQUtil ();
		$token = $q->getToken ( $_REQUEST ['code'] );
		$openid = $q->getOpenID ( $token );
		$email = $openid; //qq user the openid mapping to the qq number, and the email is the qq number @ qq.com
		$userinfo = $q->getUserInfo ( $token, $openid );
		$pic = $userinfo->figureurl;
	} else {
		message ( _ ( 'The auth type is not supported!' ) );
		redirect ( 'login.php' );
	}
	
	checkAndLogin ( $email, $pic, $_REQUEST ['state'] );
	redirect ( 'index.php' );

} elseif (isset ( $_REQUEST ['oauth_token'] ) && isset ( $_REQUEST ['oauth_verifier'] )) {
	
	$oauthapp = new YahooOAuthApplication ( YAHOO_CLIENT_ID, YAHOO_CLIENT_SECRET, YAHOO_APPID, LOGIN_CALLBACK_URL );
	
	$request_token = unserialize ( $_SESSION ['request_token'] );
	$access_token = $oauthapp->getAccessToken ( $request_token, $_REQUEST ['oauth_verifier'] );
	$oauthapp->token = $access_token;
	$userinfo = $oauthapp->getProfile ();
	
	$email = $userinfo->profile->emails [0]->handle;
	$pic = $userinfo->profile->image->imageUrl;
	checkAndLogin ( $email, $pic, 'yahoo' );
	redirect ( 'index.php' );

} elseif (isset ( $_REQUEST ['error'] )) {
	redirect ( 'login.php' );
} else {
	message ( _ ( 'Missing the required authorization code!' ) );
	redirect ( 'login.php' );
}
?>
