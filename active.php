<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	if(!isset($_REQUEST['id'])){
		message(_('No ID Supplied'));
		redirect('index.php');
	}else{
		$id = decode_and_int($_REQUEST['id']);
	}

	$db = getDBInstance();
	$row = getRowById($db, 'users', $id);
	
	if(!$row){
		message(_('No such record!'));
		redirect('index.php');
	}else if($row->register ==0 ){
		message(_('The record has been actived!'));
		redirect('index.php');
	}
	
// 	updateRecordActive($db,'users',$id,0); //active the account
	activeRegister($db,$id,0);
	$smarty = getSmartyInstance();
	$smarty->display('active_succ.html');
?>