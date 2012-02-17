<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$book_ids = $_REQUEST['books_ids'];
	$db = getDBInstance();
	$result = points2Books($db,$_SESSION['user']->id,explode('|',$book_ids));
	
	if($result[0] == 0){
		message('Successfully buy the books!');
		if(isset($_SESSION['cart'])){
			unset($_SESSION['cart']);
		}
		reloadUserInfo($db, $_SESSION['user']->id);
		redirect('mybooks.php?type=DOWNLOAD');
	}else{
		message('Something wrong when buying the books, your points is keey unchange. Please try again.');
		redirect('cart.php');
	}
?>