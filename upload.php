<?php 
	require_once('util.php');
	require_once 'libs/Smarty.class.php';
	
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$smarty = new Smarty();
	$smarty->assign('menu_current','TAB_UPLOAD');
	$smarty->display('upload.html');
?>