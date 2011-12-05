<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$db = getDBInstance();
	$user_id = $_SESSION['user']->id;
	$info = getUserInfo($db, $user_id);
	
	$sql = "select l.* from exchange_log l where l.active=0 and l.user_id=$user_id order by l.id desc";
	$current = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$result = paginate($db, $sql, $current,$perpage=6);
	
	
	$smarty = getSmartyInstance();
	$smarty->assign('info',$info);
	$smarty->assign('result',$result);
	$smarty->assign('page_url','profile.php');
	$smarty->assign('menu_current','TAB_PROFILE');
	$smarty->display('profile.html');
?>