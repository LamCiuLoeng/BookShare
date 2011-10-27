<?php 
	require_once '../util.php';
	require_once 'check_login.php';

	$smarty = getSmartyInstance();
	$smarty->assign('menu_current','TAB_SYSTEM');
	$smarty->display('admin/system.html');
?>