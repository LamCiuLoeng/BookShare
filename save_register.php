<?php
	require_once('util.php');
	require_once('model/__init__.php');
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$repassword = $_REQUEST['repassword'];
	$db = getDBInstance();
	$db->query("insert into users (email,password) values ('$email','$password');");
	$db->debug();
	if($db->insert_id){
		redirect('login.php');
	}else {
		redirect('register.php');
	}
		
?>