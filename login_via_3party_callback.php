<?php
require_once 'util.php';
require_once 'db_helper.php';
require_once 'sns/google.php';

//create the auth url
$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
//exchange the code to token
$result = $g->getToken ( $_REQUEST ['code'] );

//get the userinfo by token
$userinfo = $g->getUserInfo ( $result->access_token );

//check the user in DB or not
$db = getDBInstance ();
$users = checkUserByEmail ( $db, $userinfo->email );
if (count ( $users ) < 1) {
	//if it's a new user,create it
	$locale = isset ( $_SESSION ['locale'] ) ? $_SESSION ['locale'] : DEFAULT_LOCALE;
	$user = addUser ( $db, $userinfo->email, nowStr().randomStr(100,999), $locale, 'GOOGLE' );
} else {
	$user = $users [0];
}

//var_dump($user);

//login the user
loginUser ( $user );
message ( 'Welocome!' );
redirect ( 'index.php' );
?>
