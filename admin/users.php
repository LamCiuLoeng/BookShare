<?php
	require_once '../util.php';
	require_once '../db_helper.php';
	require_once 'check_login.php';
	
	$users = getAllUsers(getDBInstance());
	$smarty = getSmartyInstance();
	$smarty->assign('users',$users);
	$smarty->assign('menu_current','TAB_USER');
	$smarty->display('admin/users.html');
?>
	