<?php 
	require_once('util.php');
	if($_REQUEST['v']=='GOOGLE'){
		$url = 'https://accounts.google.com/o/oauth2/auth';
		$url.= '?client_id=373587493538.apps.googleusercontent.com';
		$url.= '&redirect_uri='.urldecode(WEBSITE_URL.'/login_via_3party_callback.php');
		$url.= '&response_type=code';
		$url.= '&scope='.urlencode('https://www.googleapis.com/auth/userinfo.profile');
		$url.= '&state=google';
		
		return redirect($url);

	}elseif ($_REQUEST['v']=='FACEBOOK') {
		echo 'facebook';
	}elseif ($_REQUEST['v']=='YAHOO') {
		echo 'yahoo';
	}elseif ($_REQUEST['v']=='QQ') {
		echo 'qq';
	}else{
		message(_("Don't support such login method now!"));
		redirect('login.php');
	}
?>