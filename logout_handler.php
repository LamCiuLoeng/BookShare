<?php
	require_once('util.php');
	session_start();
	unset($_SESSION['logged']);
	unset($_SESSION['user']);
	unset($_SESSION['cart']);
	redirect('index.php');
?>