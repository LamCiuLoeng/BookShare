<?php
	require_once('util.php');
	require_once 'db_helper.php';
	
	if(!isUserLogin()){
		return redirect('login.php');
	}
	
	if(!isset($_REQUEST['points'])){
		message(_('Please input the points you want to exchange!'));
		return redirect('profile.php');
	}
	
	$points = floatval($_REQUEST['points']);
	$total_points = $_SESSION['user']->points;


	if($points > $total_points){
		message(_('The points you want to exchange are more than your total points!'));
		return redirect('profile.php');
	}
	
	
	
	$db = getDBInstance();
	$affected = updateUserPoints($db, $_SESSION['user']->id, $points * (-1));
	$log_id = addExchangeLog($db, $_SESSION['user']->id, $points);
	
	
	if($log_id){
		$_SESSION['user']->points -= $points;
		message(_('Your request has been accepted ,please wait for the approval.'));
		return redirect('profile.php');
	}else{
		updateUserPoints($db, $_SESSION['use']->id, $points);
		message(_('The service is not avaiable now,please try it later.'));
		return redirect('profile.php');
	}
	
?>