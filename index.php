<?php 
	//session_start();
	require_once('util.php');
	$smarty = getSmartyInstance();
	
	$qty = 7;
	
	$db = getDBInstance();
	$new_books = $db->get_results("select * from books order by create_time desc limit $qty;");
	$art_books = $db->get_results("SELECT b.* FROM books b, categories c ,book_category bc where b.id=bc.book_id and c.id=bc.category_id and c.name='art' LIMIT $qty;");	
	$comic_books = $db->get_results("SELECT b.* FROM books b, categories c ,book_category bc where b.id=bc.book_id and c.id=bc.category_id and c.name='comic' LIMIT $qty;");

//
//	if(isset($_SESSION['locale'])){
//		echo $_SESSION['locale'];
//	}
	
	$smarty->assign('new_books',$new_books);
	$smarty->assign('art_books',$art_books);
	$smarty->assign('comic_books',$comic_books);
	$smarty->display('index.html');
?>