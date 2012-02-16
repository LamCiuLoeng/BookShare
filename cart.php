<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$book_ids = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();	
	$db = getDBInstance();
	$books = array();
	$book_points = 0;
	foreach ($book_ids as $id) {
		$t = getRowById($db, 'books', $id);
		array_push($books, $t);
		$book_points += $t->points;
	}
	
	$smarty = getSmartyInstance();
	$smarty->assign('books',$books);
	$smarty->assign('book_ids',join('|',$book_ids));
	$smarty->assign('book_points',$book_points);
	$smarty->display('cart.html');
?>