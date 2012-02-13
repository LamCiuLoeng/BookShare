<?php
	require_once 'util.php';
	
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	$action = $_REQUEST['action'];
	
	if($action == 'ADD'){
		if(!array_key_exists($_REQUEST['id'], $_SESSION['cart'])){
			array_push($_SESSION['cart'],$_REQUEST['id']);
		}
			
	}elseif ($action == 'DELETE') {
		$offset = array_search($_SESSION, $_REQUEST['id']);
		array_splice($_SESSION['cart'], $offset,1);
	}
	
	redirect('cart.php');
?>