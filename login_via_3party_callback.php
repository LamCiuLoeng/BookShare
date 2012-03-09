<?php
require_once 'util.php';
require_once 'db_helper.php';
require_once 'sns/google.php';
require_once 'sns/facebook.php';

if (isset ( $_REQUEST ['code'] )) {
	if ($_REQUEST ['state'] == 'google') {
		//create the auth url
		$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		//exchange the code to token
		$token = $g->getToken ( $_REQUEST ['code'] );
		//get the userinfo by token
		$userinfo = $g->getUserInfo ( $token );
	
	} elseif ($_REQUEST ['state'] == 'facebook') {
		$f = new FacebookUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		$token = $f->getToken ( $_REQUEST ['code'] );
		$userinfo = $f->getUserInfo ( $token );
	} else {
		message ( _ ( 'The auth type is not supported!' ) );
		redirect ( 'login.php' );
	}
	
	//check the user in DB or not
	$db = getDBInstance ();
	$users = checkUserByEmail ( $db, $userinfo->email );
	if (count ( $users ) < 1) {
		//if it's a new user,create it
		$locale = isset ( $_SESSION ['locale'] ) ? $_SESSION ['locale'] : DEFAULT_LOCALE;
		$user = addUser ( $db, $userinfo->email, nowStr () . randomStr ( 100, 999 ), $locale, $_REQUEST ['state'] );
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
