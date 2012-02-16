<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	$smarty = getSmartyInstance();
	$smarty->assign('points',$_REQUEST['points']);
	$smarty->assign('10pm',point2money(10, $_SESSION['locale']));
	$smarty->assign('20pm',point2money(20, $_SESSION['locale']));
	$smarty->assign('50pm',point2money(50, $_SESSION['locale']));
	$smarty->assign('pm',point2money(floatval($_REQUEST['points']), $_SESSION['locale']));
	
	$smarty->display('prepare_pay.html');
?>	