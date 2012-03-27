<?php
	require_once('util.php');

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$db = getDBInstance();
	
	$user = $db->get_results("select * from users where active=0 and email='$email' and password='$password' and account_type='normal';");
	$db->debug();
	if($db->num_rows == 1){
		loginUser($user[0]);
		redirect('index.php');
	}else {
		message(_('E-mail or password is wrong!'));
		redirect('login.php');
	}
?>
	