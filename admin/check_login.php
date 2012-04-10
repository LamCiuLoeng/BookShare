<?php
	require_once '../util.php';
	
	if(!isUserLogin() || !inGroup('ADMIN')){
		redirect('../login.php');
	}
?>