<?php
function smarty_insert_fire_message($params,&$smarty){
	if(isset($_SESSION['message'])){
		$msg = $_SESSION['message'];
		unset($_SESSION['message']);
		return 'alert(\''.$msg.'\');';
	}else{
		return '';
	}
}
?>