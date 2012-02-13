<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$book_ids = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
	$db = getDBInstance();
	$books = array();
	foreach ($book_ids as $id) {
		array_push($books, getRowById($db, 'books', $id));
	}
	
	$smarty = getSmartyInstance();
	$smarty->assign('books',$books);
	$smarty->display('cart.html');
?>