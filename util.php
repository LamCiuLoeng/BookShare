<?php
	include_once 'model/ez_sql_core.php';
	//include_once 'model/ez_sql_sqlite.php';
	include_once 'model/ez_sql_mysql.php';
	include_once 'libs/Smarty.class.php';
	require_once 'config.php';
	
	function getDBInstance() {
		return new ezSQL_mysql(DB_USER,DB_PASSWORD,DB_NAME,DB_IP);
	}

	function redirect($url) {
		header("location:".$url);
	}
	
	function getSmartyInstance(){
		$smarty =  new Smarty();
		$smarty->template_dir = dirname(__FILE__).'/templates';
		$smarty->compile_dir = dirname(__FILE__).'/templates_c';
//		$smarty->debugging = true;
		return $smarty;		
	}
	
	function message($msg){
		//session_start();
		$_SESSION['message'] = $msg;
	}
	
//	function fireMessage(){		
//		if(isset($_SESSION['message'])){
//			$msg = $_SESSION['message'];
//			unset($_SESSION['message']);
//			return $msg;
//		}else{
//			return NULL;
//		}
//	}
	
	function get_val($name) {
		if (!get_magic_quotes_gpc()) {
		    return addslashes($_REQUEST[$name]);
		}
		return $_REQUEST[$name];
	}
	
	
	function nowStr() {
		return date('YmdGis');
	}
	
	function randomStr($min,$max) {
		return (string) rand($min,$max);
	}
	
	function isUserLogin() {
		if(isset($_SESSION['logged']) && $_SESSION['logged']){
			return true;
		}
		return false;
	}
	
	function handleUpload($field_name) {
		try{
			$pi = pathinfo($_FILES[$field_name]['name']);
			$url = '/public/upload/'.nowStr().randomStr(1,1000).'.'.$pi['extension'];	
			$fn = $_SERVER["DOCUMENT_ROOT"].$url;
			if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $fn)) {
			    return $url;
			} 
		}catch (Exception $e){
			throw $e;
			return NULL;
		}
		return NULL;
	}
	
	function download($file_name,$file_full_path){
		try {
			$path_parts = pathinfo($file_full_path);
			$name = $path_parts["basename"];		
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".filesize($file_full_path));
			Header("Content-Disposition: attachment; filename=".$name);
			$file = fopen($file_full_path,"rb");
			echo fread($file,filesize($file_full_path));
			fclose($file);
		} catch (Exception $e) {
			throw $e;
		}		
	}
	
	
	function paginate($db,$sql,$current,$perpage=16){
		$result = array();
		$db->get_results($sql);	
		$total = $db->num_rows ;
		$start = $perpage * ($current-1);
		$selectsql = "select temp.* from ($sql) temp limit $start,$perpage";	
		
		$result['data'] = $db->get_results($selectsql);

		$result['totalpages'] = ceil( $total/$perpage );
		$result['current'] = $current;
		$result['total'] = $total;
				
		if($current>1){
			$result['pre'] = $current - 1;
		}
		
		if($current<$result['totalpages']){
			$result['next'] = $current + 1;
		}
		return $result;
		
	}
		
?>