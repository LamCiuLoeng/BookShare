<?php
	require_once('util.php');

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$db = getDBInstance();
	
	$user = $db->get_results("select * from users where active=0 and email='$email' and password='$password';");
	$db->debug();
	if($db->num_rows == 1){
//		session_start();
		$_SESSION['user'] = (object) Array();
		$_SESSION['user']->email = $user[0]->email;
		$_SESSION['user']->id = $user[0]->id;
		$_SESSION['user']->points = $user[0]->points;
		$_SESSION['user']->locale = $user[0]->locale;
		$_SESSION['locale'] = $user[0]->locale;
		$_SESSION['logged'] = true;
		redirect('index.php');
	}else {
		message(_('E-mail or password is wrong!'));
		redirect('login.php');
	}
?>
	