<?php
	require_once 'util.php';
	
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	$action = $_REQUEST['action'];
	$id = decode($_REQUEST['id']);
	
	if($action == 'ADD'){
		if(!in_array($id, $_SESSION['cart'])){
			array_push($_SESSION['cart'],$id);
		}
		if(isset($_REQUEST['type']) && $_REQUEST['type']=='json'){
			echo json_encode(array('flag' => 0,'msg'=>'OK'));
		}else{
			redirect('cart.php');
		}
			
	}elseif ($action == 'DELETE') {
		if(in_array($id, $_SESSION['cart'])){
			$offset = array_search($id,$_SESSION['cart']);
			array_splice($_SESSION['cart'], $offset,1);
		}
		redirect('cart.php');
	}
?>