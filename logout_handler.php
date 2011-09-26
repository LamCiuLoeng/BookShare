<?php
	require_once('util.php');
	session_start();
	unset($_SESSION['logged']);
	unset($_SESSION['user']);
	redirect('index.php');
?>