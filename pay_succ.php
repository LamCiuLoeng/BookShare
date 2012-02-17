<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$user_id = $_REQUEST['user_id'];
	$points = $_REQUEST['points'];
	
	$db = getDBInstance();
	updateUserPoints($db, $user_id, $points);
	
	message('Successfully pay the points!');
	if(isset($_SESSION['cart'])){
		unset($_SESSION['cart']);
	}
	
	if(isset($_SESSION['user'])){
		$_SESSION['user']->points += floatval($points);
	}
	
	redirect('cart.php');
?>