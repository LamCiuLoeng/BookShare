<?php 
	//session_start();
	require_once('util.php');
	require_once 'db_helper.php';
	$smarty = getSmartyInstance();
	
	$qty = 6;
	
	$db = getDBInstance();
	$new_books = $db->get_results("select * from books order by create_time desc limit $qty;");
//	$art_books = $db->get_results("SELECT b.* FROM books b, categories c ,book_category bc where b.id=bc.book_id and c.id=bc.category_id and c.name='art' LIMIT $qty;");	
//	$comic_books = $db->get_results("SELECT b.* FROM books b, categories c ,book_category bc where b.id=bc.book_id and c.id=bc.category_id and c.name='comic' LIMIT $qty;");

	$promote_book = $db->get_row("select * from books where promote!=0;");
	
	$promote_categories = array();
	
// 	$categories = getRowsByCondition($db, 'categories', array(' promote!=0 '));
	
	$sql = "select * from categories where promote!=0 order by seq;";
	$categories = $db->get_results ( $sql );
	foreach ($categories as $c){
		$t = $db->get_results("SELECT b.* FROM books b, book_category bc where b.id=bc.book_id and bc.category_id=".$c->id." LIMIT $qty;");
		$promote_categories[$c->id] = array(
												'name' => $c->name,
												'data' => $t 
											 );
	}
	
	
	$smarty->assign('new_books',$new_books);
//	$smarty->assign('art_books',$art_books);
//	$smarty->assign('comic_books',$comic_books);
	$smarty->assign('promote_book',$promote_book);
	$smarty->assign('promote_categories',$promote_categories);
	$smarty->display('index.html');
?>