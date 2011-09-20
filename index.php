<?php 

	require_once 'model/__init__.php';
	require_once 'libs/Smarty.class.php';
	$smarty = new Smarty();
	
	$db = getDBInstance();
	
	//get promote book
	//$db->get_results('select * from books b,categories c,book_category bc where b.active=0 and c.active=0 and b.id=bc.book_id and c.id=bc.category_id and c.name=\'PROMOTED\'');
	
	putenv('LANG=zh_HK');
	bindtextdomain("default", "locale");
	textdomain("default");
	$smarty->display('index.html');
?>