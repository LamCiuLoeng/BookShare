<?php
	require_once 'util.php';
	//handle the bank gateway
	
	//just do nothing ,and return to succssfully page, it will change if the bank gateway is OK.
	$url = 'pay_succ.php?user_id='.$_SESSION['user']->id.'&points='.$_REQUEST['points'];
	
	redirect('pay_succ.php');
?>