<?php 
	require_once '../util.php';

	$smarty = getSmartyInstance();
	$smarty->assign('menu_current','TAB_SYSTEM');
	$smarty->display('admin/system.html');
?>