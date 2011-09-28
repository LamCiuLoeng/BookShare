<?php
	require_once 'util.php';
	$id = $_REQUEST['id'];
	
	$db = getDBInstance();
	$book = $db->get_row("select * from books where id=$id");
//	$db->debug();
	$smarty = getSmartyInstance();
	$smarty->assign('book',$book);
	$smarty->display('book.html');
?>