<?php
	require_once('util.php');

	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	
	$db = getDBInstance();
	$user = $db->get_results("select * from users where active=0 and email='$email' and password='$password' and account_type='normal';");
	$db->debug();
	if($db->num_rows == 1){
		$sql = "select g.* from groups g,user_group ug where g.id=ug.group_id and ug.user_id=".$user[0]->id;
		$groups = $db->get_results ( $sql );
		loginUser($user[0],$groups);
		redirect('index.php');
	}else {
		message(_('E-mail or password is wrong!'));
		redirect('login.php');
	}
?>
	