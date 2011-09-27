<?php 
	session_start();
	require_once('util.php');
	$smarty = getSmartyInstance();
	
	$db = getDBInstance();
	//echo var_dump($db);
	//get promote book
	//$db->get_results('select * from books b,categories c,book_category bc where b.active=0 and c.active=0 and b.id=bc.book_id and c.id=bc.category_id and c.name=\'PROMOTED\'');
	
//	putenv('LANG=zh_HK');
//	bindtextdomain("default", "locale");
//	textdomain("default");

	$result = $db->get_results("select * from books;");
	$smarty->assign('result',$result);
	$smarty->display('index.html');
?>