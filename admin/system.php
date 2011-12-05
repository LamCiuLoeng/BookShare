<?php 
	require_once '../util.php';
	require_once '../db_helper.php';
	require_once 'check_login.php';
	
	$db = getDBInstance();

	$sql = "select l.*,u.email,u.points as user_points  from exchange_log l, users u where l.active=0 and u.id=l.user_id order by l.id desc";
	$current = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$result = paginate($db, $sql, $current,$perpage=6);
	

	$smarty = getSmartyInstance();
	$smarty->assign('menu_current','TAB_SYSTEM');
	$smarty->assign('result',$result);
	$smarty->assign('page_url','system.php');
	$smarty->display('admin/system.html');
?>