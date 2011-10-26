<?php
	require_once 'util.php';
	if(!isset($_REQUEST['lang'])){
		echo json_encode(array('flag' => 1));
	}else{
		$lang = $_REQUEST['lang'];
		$_SESSION['locale'] = $lang;
		if(isset($_SESSION['logged']) && $_SESSION['logged']){
			update_user_locale($_SESSION['user']->id,$_SESSION['locale']);
		}
		echo json_encode(array('flag' => 0));
	}