<?php 
	require_once('util.php');
	require_once 'sns/google.php';
	require_once 'sns/facebook.php';
	require_once 'sns/qq.php';
	
	if($_REQUEST['v']=='GOOGLE'){	
		$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
		return redirect($g->authURL());

	}elseif ($_REQUEST['v']=='FACEBOOK') {
		$f = new FacebookUtil( WEBSITE_URL . '/login_via_3party_callback.php' );
		return redirect($f->authURL());
		
	}elseif ($_REQUEST['v']=='YAHOO') {
		echo 'yahoo';
	}elseif ($_REQUEST['v']=='QQ') {
		$q = new QQUtil(WEBSITE_URL . '/login_via_3party_callback.php');
		return redirect($q->authURL());
	}else{
		message(_("Don't support such login method now!"));
		redirect('login.php');
	}
?>