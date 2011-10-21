<?php
	require_once '../util.php';
	require_once '../db_helper.php';
	
	$action = isset($_REQUEST['q']) ? $_REQUEST['q'] : 'LIST';
	
	if($action=='LIST'){
		$groups = getAllRows(getDBInstance(), 'groups', 'name');
		$smarty = getSmartyInstance();
		$smarty->assign('groups',$groups);
		$smarty->assign('menu_current','TAB_GROUP');
		$smarty->display('admin/groups.html');
	}elseif ($action == 'EDIT'){
		$smarty = getSmartyInstance();
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
			$db = getDBInstance();
			$g = getRowById($db, 'groups', $id);
			$smarty->assign('group',$g);
			$smarty->assign('type','UPDATE');
		}else{
			$smarty->assign('type','NEW');
		}
		$smarty->assign('menu_current','TAB_GROUP');
		$smarty->display('admin/groups_edit.html');		
		
	}elseif ($action == 'SAVE') {
		if(!isset($_REQUEST['type'])){
			message('No such action type!');
			redirect('groups.php');
		}
		
		$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
		$type = $_REQUEST['type'];
		$name = $_REQUEST['name'];		
		$desc = $_REQUEST['desc'];
		$create_by = $_SESSION['user']->id;
		$db = getDBInstance();
		saveGroup($db,$type, $id, $name, $desc, $create_by);
		$db->debug();
		$msg = $_REQUEST['type'] == 'UPDATE' ? 'Update the record successfully!' : 'Add the record successfully!';
		message($msg);
		redirect('groups.php');
	}elseif ($action == 'DELETE') {
		$id = $_REQUEST['id'];
		$db = getDBInstance();
		saveGroup($db, 'DELETE', $id, null , null, null);
		echo json_encode(array('flag' => 0));
	}else{
		message('No such action!');
		redirect('groups.php');
	}
	
	
?>
	