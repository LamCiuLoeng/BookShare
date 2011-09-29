<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$id = $_SESSION['user']->id;
	$db = getDBInstance();
	$upload_books = getUploadBooks($db,$id);
	$download_books = getDownloadBooks($db, $id);
	
	$smarty = getSmartyInstance();
	$smarty->assign('upload_books',$upload_books);
	$smarty->assign('download_books',$download_books);
	$smarty->assign('menu_current','TAB_MYBOOKS');
	$smarty->display('mybooks.html');
?>