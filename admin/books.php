<?php
	require_once '../util.php';
	require_once '../db_helper.php';
	require_once 'check_login.php';
	
	$books = getAllBooks(getDBInstance());
	$smarty = getSmartyInstance();
	$smarty->assign('books',$books);
	$smarty->assign('menu_current','TAB_BOOK');
	$smarty->display('admin/books.html');
?>
	