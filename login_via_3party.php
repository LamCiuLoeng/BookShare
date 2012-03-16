<?php 
	require_once('util.php');
	require_once 'sns/google.php';
	require_once 'sns/facebook.php';
	require_once 'sns/qq.php';
	require_once 'sns/yahoo.php';
	
	if($_REQUEST['v']=='GOOGLE'){	
		$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		return redirect($g->authURL());

	}elseif ($_REQUEST['v']=='FACEBOOK') {
		$f = new FacebookUtil( WEBSITE_URL . '/login_via_3party_callback.php' );
		return redirect($f->authURL());
		
	}elseif ($_REQUEST['v']=='YAHOO') {
		//yahoo only supoort the OAuth 1.0
		$y = new YahooUtil('http://bookshare.sys2do.com/login_via_3party_callback.php');
		$result = $y->getToken();
		
		$token = $result['oauth_token'];
		$_SESSION['oauth_token_secret'] = $result['oauth_token_secret'];	
		
		return redirect($y->authURL($token));		
	}elseif ($_REQUEST['v']=='QQ') {
		$q = new QQUtil(WEBSITE_URL . '/login_via_3party_callback.php');
		return redirect($q->authURL());
	
	}else{
		message(_("Don't support such login method now!"));
		redirect('login.php');
	}
?>