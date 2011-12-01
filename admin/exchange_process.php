<?php 
	require_once '../util.php';
	require_once '../db_helper.php';
	require_once 'check_login.php';
	
	$action = $_REQUEST['action'];
	if(!isset($action)){
		message(_('No such operation!'));
		redirect('index.php');
	}else{
		$action = intval($action);
	}
	
	$id = $_REQUEST['id'];
	if(!isset($id)){
		message(_('No id supplied for the record!'));
		redirect('index.php');
	}
	
	$db = getDBInstance();
	$affected = processExchangeLog($db, $id, $action);
	
	//give back the points to the user 
	if($action==2){
		$log = getRowById($db, 'exchange_log', $id);
		updateUserPoints($db, $log->user_id, $log->points);
	}
	
	message(_('Update the record successfully!'));
	redirect('system.php');
?>