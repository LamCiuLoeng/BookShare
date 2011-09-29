<?php
	require_once '../util.php';
	require_once '../db_helper.php';
	
	$users = getAllUsers(getDBInstance());
	$smarty = getSmartyInstance();
	$smarty->assign('users',$users);
	$smarty->display('admin/users.html');
?>
	