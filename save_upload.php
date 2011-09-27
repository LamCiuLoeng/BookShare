<?php 
	require_once('util.php');
	$db = getDBInstance();
	
	$name = $_REQUEST['name'];
	$desc = $_REQUEST['desc'];
	$short_desc = $_REQUEST['short_desc'];
	
	$sql = "insert into books(name,desc,short_desc) values ('$name','$desc','$short_desc');";
	echo $sql;
	$db->query("insert into books(name,desc,short_desc) values ('$name','$desc','$short_desc');");
	$db->debug();
	
	header("location:".'index.php');
	
?>