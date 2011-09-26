<?php
	require_once('util.php');
	require_once('model/__init__.php');

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$db = getDBInstance();
	
	$user = $db->get_results("select * from users where active=0 and email='$email' and password='$password';");
	$db->debug();
	if($db->num_rows == 1){
		session_start();
		$_SESSION['user'] = (object) Array();
		$_SESSION['user']->email = $user[0]->email;
		$_SESSION['logged'] = true;
		redirect('index.php');
	}else {
		redirect('login.php');
	}
?>
	