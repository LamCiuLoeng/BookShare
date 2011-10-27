<?php
	require_once '../util.php';
	
	if(!isUserLogin()){
		redirect('../login.php');
	}
?>