<?php
	require_once '../util.php';
	require_once '../db_helper.php';
	
	$db = getDBInstance();
	$result = getAllCategories($db);
	$smarty = getSmartyInstance();
	$smarty->assign('categories',$result);
	$smarty->display('admin/category.html');
?>