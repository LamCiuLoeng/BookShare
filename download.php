<?php
	require_once 'util.php';
	
	$id = $_REQUEST['id'];
	
	$db = getDBInstance();
	
	$book = $db->get_row("select * from books where id=$id");
	
	download($book->name,$book->path);
?>