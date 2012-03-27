<?php
require_once ('util.php');
require_once 'sns/google.php';
require_once 'sns/facebook.php';
require_once 'sns/qq.php';
//	require_once 'sns/yahoo.php';
require_once 'sns/lib/OAuth/OAuth.php';
require_once 'sns/lib/Yahoo/YahooOAuthApplication.class.php';

if ($_REQUEST ['v'] == 'GOOGLE') {
	$g = new GoogleUtil ();
	return redirect ( $g->authURL () );

} elseif ($_REQUEST ['v'] == 'FACEBOOK') {
	$f = new FacebookUtil ();
	return redirect ( $f->authURL () );

} elseif ($_REQUEST ['v'] == 'YAHOO') {
	$oauthapp = new YahooOAuthApplication ( YAHOO_CLIENT_ID, YAHOO_CLIENT_SECRET, YAHOO_APPID, LOGIN_CALLBACK_URL );
	$request_token = $oauthapp->getRequestToken ( LOGIN_CALLBACK_URL );
	$redirect_url = $oauthapp->getAuthorizationUrl ( $request_token );
	$_SESSION ['oauthapp'] = $oauthapp;
	$_SESSION ['request_token'] = serialize ( $request_token );
	return redirect ( $redirect_url );

} elseif ($_REQUEST ['v'] == 'QQ') {
	$q = new QQUtil ();
	return redirect ( $q->authURL () );

} else {
	message ( _ ( "Don't support such login method now!" ) );
	redirect ( 'login.php' );
}
?>