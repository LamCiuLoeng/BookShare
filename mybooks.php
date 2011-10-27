<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$id = $_SESSION['user']->id;
	$db = getDBInstance();
	
	$type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'UPLOAD';
	
	$smarty = getSmartyInstance();
	if($type=='UPLOAD'){
		$upload_books = getUploadBooks($db,$id);
		$smarty->assign('books',$upload_books);
	}else{
		$download_books = getDownloadBooks($db, $id);
		$smarty->assign('books',$download_books);
	}
	$smarty->assign('type',$type);
	$smarty->assign('menu_current','TAB_MYBOOKS');
	$smarty->display('mybooks.html');
?>