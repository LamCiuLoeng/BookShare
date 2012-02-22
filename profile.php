<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$db = getDBInstance();
	$smarty = getSmartyInstance();
	$user_id = $_SESSION['user']->id;
	$info = getUserInfo($db, $user_id);
	
	if(!isset($_REQUEST['type']) || $_REQUEST['type']=='EXCHANGE'){
		$sql = "select l.* from exchange_log l where l.active=0 and l.user_id=$user_id order by l.id desc";
		$smarty->assign('page_url','profile.php');
		$smarty->assign('type','EXCHANGE');
	}else{
		$sql = "select * from buy_log where user_id=$user_id and active=0 order by create_time desc ";
		$smarty->assign('page_url','profile.php?type=BUY');
		$smarty->assign('type','BUY');
	}
	
	$current = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$result = paginate($db, $sql, $current,$perpage=6);
	$smarty->assign('info',$info);
	$smarty->assign('result',$result);
	$smarty->assign('menu_current','TAB_PROFILE');
	$smarty->display('profile.html');
?>