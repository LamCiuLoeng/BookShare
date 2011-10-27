<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$db = getDBInstance();
	if(!isset($_REQUEST['id'])){
		$sql = 'select * from books order by create_time desc';
		$title = _('New Upload Books');
		$category = null;
	}else{
		$id = $_REQUEST['id'];
		$sql = "SELECT b.* FROM books b, book_category bc where b.id=bc.book_id and bc.category_id=$id";
		$category = getRowById($db, 'categories', $id);
		$title = $category->name;
	}
	
	$current = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$books = paginate($db, $sql, $current,$perpage=6);
	
	$smarty = getSmartyInstance();
//	var_dump($books);
	$smarty->assign('books',$books);
	$smarty->assign('title',$title);
	$smarty->assign('category',$category);
	$smarty->assign('page_url',$category ? 'books.php?id='.$category->id : 'books.php?a=1');
	$smarty->display('books.html');
?>