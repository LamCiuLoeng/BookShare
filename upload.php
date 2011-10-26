<?php 
	require_once('util.php');
	require_once 'db_helper.php';
	
	if(!isUserLogin()){
		redirect('login.php');
	}
	if(isset($_SESSION['attachments'])){ unset($_SESSION['attachments']); }
	
	$categories = getAllRows(getDBInstance(), 'categories');
	
	$smarty = getSmartyInstance();
	$smarty->assign('menu_current','TAB_UPLOAD');
	$smarty->assign('categories',$categories);
	$smarty->display('upload.html');
?>