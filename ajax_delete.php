<?php
	require_once 'util.php';
	
	$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : null;
	
	if(!$id){
		echo json_encode(array('flag' => 1));
		return;
	}
	
	if(!isset($_SESSION['attachments']) || !$_SESSION['attachments']){
		echo json_encode(array('flag' => 1));
		return;
	}
	
	if(array_key_exists($id, $_SESSION['attachments'])){
		unset($_SESSION['attachments'][$id]);
		echo json_encode(array('flag' => 0)); //delete success!
	}else{
		echo json_encode(array('flag' => 1));
		return;
	}
?>
