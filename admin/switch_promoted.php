<?php 
	require_once '../util.php';
	
	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
	if(!$id){
		echo json_encode(array('flag' => 1));
		return;
	}
	
	$db = getDBInstance();
	$db->query("update books set promote=0;");
	//set to promote
	if($_REQUEST['v']=='1'){
		$db->query("update books set promote=1 where id=$id;");
	}
//	$db->debug();
	
	echo json_encode(array('flag'=>0));
?>