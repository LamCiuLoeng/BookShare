<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	//handle the bank gateway
	
	//insert the buy log
	$db = getDBInstance();

	$order_no = createOrderNo();
	$points = $_REQUEST['points'];
	$amount = point2money($points, $_SESSION['locale']);
	
	$order_id = createOrder($db,$points, $amount[0], $amount[1], '', $_REQUEST['pay_type'], $_SESSION['user']->id);
	//just do nothing ,and return to succssfully page, it will change if the bank gateway is OK.
	$url = 'pay_succ.php?user_id='.$_SESSION['user']->id.'&points='.$_REQUEST['points'].'&order_id='.$order_id;
	
	//echo $url;
	redirect($url);
?>