<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$db = getDBInstance();
	$info = getUserInfo($db, $_SESSION['user']->id);
	$smarty = getSmartyInstance();
	$smarty->assign('info',$info);
	$smarty->assign('menu_current','TAB_PROFILE');
	$smarty->display('profile.html');
?>