<?php 
	require_once('util.php');
	require_once 'libs/Smarty.class.php';
	
	if(!isUserLogin()){
		redirect('login.php');
	}
	if(isset($_SESSION['attachments'])){ unset($_SESSION['attachments']); }
	$smarty = new Smarty();
	$smarty->assign('menu_current','TAB_UPLOAD');
	$smarty->display('upload.html');
?>