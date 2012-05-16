<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$id = decode_and_int($_REQUEST['id']);
	$sn = $_REQUEST['sn'];
	$db = getDBInstance();
	$user = getRowById($db, 'users', $id);
	
	
	if(!$user){
		message(_('No such record!'));
		return redirect('index.php');
	}elseif (!$user->reset_str) {
		message(_('The account no need to reset password!'));
		return redirect('index.php');
	}elseif ($user->reset_str != $sn){
		message(_('Your action is illegal!'));
		return redirect('index.php');
	}
	
	$smarty = getSmartyInstance();
	$smarty->assign('id',$id);
	$smarty->assign('sn',$sn);
	$smarty->display('input_password.html');
?>