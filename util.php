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
		//set the global var
		$smarty->assign('SUPPORTED_LANG',get_supported_lang());
		$smarty->assign('WEBSITE_URL',WEBSITE_URL);
		$smarty->assign('APPID',APPID);
//		$smarty->debugging = true;
		set_locale_env();
		return $smarty;		
	}
	
	function message($msg){
		//session_start();
		$_SESSION['message'] = $msg;
	}
	
	function get_locale(){
		//if login
		if(isset($_SESSION['locale'])){
			return $_SESSION['locale'];
		}else{
			$langs =  explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			switch ($langs[0]) {
				case 'zh-cn':
					$lang = 'zh_CN';
					break;
				case 'zh-hk':
					$lang = 'zh_HK';
					break;
				default:
					$lang = 'en';
			}
			$_SESSION['locale'] = $lang;
			return $lang;
		}
	}
	
	function set_locale_env(){
		$locale = get_locale();
		putenv("LANG=$locale");
		putenv("LANGUAGE=$locale"); //add this to solve the problem on english ubuntu
		setlocale(LC_ALL, $locale);
		bindtextdomain("default", "locale");
		bind_textdomain_codeset("default", 'UTF-8'); 
		textdomain("default");
	}
	
	function get_supported_lang(){
		return array('en'=>'English','zh_CN'=>'简体中文','zh_HK'=>'繁體中文');
	}

	function update_user_locale($id,$locale){
		$db = getDBInstance();
		$sql = "update users set locale='$locale' where id=$id";
		$db->query($sql);
		return $db->rows_affected;
	}
	
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
	
	function reloadUserInfo($db,$user_id){
		$user = getRowById($db, 'users', $user_id);
		if(isset($_SESSION['user'])){
			unset($_SESSION['user']);
		}
		
		$_SESSION['user'] = (object) Array();
		$_SESSION['user']->email = $user->email;
		$_SESSION['user']->id = $user->id;
		$_SESSION['user']->points = $user->points;
		$_SESSION['user']->locale = $user->locale;
		$_SESSION['locale'] = $user->locale;
		
		return true;
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
	
	function point2money($points,$locale) {
		//1 point == 1 USD
		$result = array();
		if( $locale == 'en'){
			array_push($result,'USD');
			array_push($result ,$points);
		}elseif ( $locale == 'zh_CN') {
			array_push($result,'RMB');
			array_push($result,$points * 6.3);
		}elseif ( $locale == 'zh_HK'){
			array_push($result, 'HKD');
			array_push($result , $points * 7.7);
		}else{
			$result[] = 'USD';
			$result[] = $points;
		}
// 		var_dump($result);
		return $result;
	}
	
	
	function encode($v) {
		$key = md5(PRIVATEKEY);
		$iv_size = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB );
		$iv = mcrypt_create_iv ( $iv_size, MCRYPT_RAND );
		$passcrypt = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, $key, $v, MCRYPT_MODE_ECB, $iv );
		$passcrypt = base64_encode ( $passcrypt );
		return urlencode($passcrypt);
	}
	
	function decode($v) {		
		$key = md5(PRIVATEKEY);
		$v = base64_decode($v);
		$iv_size = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB );
		$iv = mcrypt_create_iv ( $iv_size, MCRYPT_RAND );
		$passcrypt = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, $key, $v, MCRYPT_MODE_ECB, $iv );
		return $passcrypt;
	}
	
	function decode_and_int($v){
		return intval(decode($v));
	}
?>