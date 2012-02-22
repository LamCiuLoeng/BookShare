<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
//	$user_id = $_REQUEST['user_id'];
//	$points = $_REQUEST['points'];
	
	$db = getDBInstance();
	$order_id = $_REQUEST['order_id'];
	$row = getRowById($db, 'buy_log', $order_id);
	$user_id = $row->user_id;
	$points = $row->points;
	
	//update the user's points
	updateUserPoints($db, $user_id, $points);

	//update the buy log
	updateOrderStatus($db,$order_id, 1);
	
	if(isset($_SESSION['user'])){
		reloadUserInfo($db, $_SESSION['user']->id);
	}
	
	message(_('Successfully pay the points!'));
	redirect('cart.php');
?>