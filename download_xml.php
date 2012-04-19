<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	$id = decode($_REQUEST['id']);
	$book = getRowById(getDBInstance(), 'books', $id);
	header("Content-type: text/xml");
	echo stripcslashes($book->xml);
?>