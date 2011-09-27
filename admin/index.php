<?php 
	session_start();
	require_once '../util.php';

	$smarty = getSmartyInstance();
	$db = getDBInstance();
	$result = $db->get_results("select * from books;");
	$smarty->assign('result',$result);
	$smarty->display('admin/index.html');
?>