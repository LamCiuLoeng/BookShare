<?php
require_once 'util.php';
require_once 'db_helper.php';
require_once 'sns/google.php';
require_once 'sns/facebook.php';
require_once 'sns/qq.php';

if (isset ( $_REQUEST ['code'] )) {
	if ($_REQUEST ['state'] == 'google') {
		//create the auth url
		$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		//exchange the code to token
		$token = $g->getToken ( $_REQUEST ['code'] );
		//get the userinfo by token
		$userinfo = $g->getUserInfo ( $token );
		$email = $userinfo->email;
		$pic = $userinfo->picture;
	} elseif ($_REQUEST ['state'] == 'facebook') {
		$f = new FacebookUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		$token = $f->getToken ( $_REQUEST ['code'] );
		$userinfo = $f->getUserInfo ( $token );
		$email = $userinfo->email;
		$pic = $userinfo->picture;
	} elseif ($_REQUEST ['state'] == 'qq') {
		$q = new QQUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		$token = $q->getToken ( $_REQUEST ['code'] );		
		$openid = $q->getOpenID($token);		
		$email = $openid; //qq user the openid mapping to the qq number, and the email is the qq number @ qq.com
		$userinfo = $q->getUserInfo($token,$openid);
		$pic = $userinfo->figureurl;
	} else {
		message ( _ ( 'The auth type is not supported!' ) );
		redirect ( 'login.php' );
	}
	
	//check the user in DB or not
	$db = getDBInstance ();
	$users = checkUserByEmail ( $db, $email );
	if (count ( $users ) < 1) {
		//if it's a new user,create it
		$locale = isset ( $_SESSION ['locale'] ) ? $_SESSION ['locale'] : DEFAULT_LOCALE;
		$user = addUser ( $db, $email, nowStr () . randomStr ( 100, 999 ), $pic,$locale, $_REQUEST ['state'] );
	} else {
		$user = $users [0];
	}
	
	//login the user
	loginUser ( $user );
	redirect ( 'index.php' );

} elseif (isset ( $_REQUEST ['error'] )) {
	redirect ( 'login.php' );
} else {
	message ( _ ( 'Missing the required authorization code!' ) );
	redirect ( 'login.php' );
}
?>