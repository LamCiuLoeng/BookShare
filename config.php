<?php
	//CONFIG FOR THE WEBSITE
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'admin');
	define('DB_NAME', 'bookshare');
	define('DB_IP', '192.168.21.157');
	define('WEBSITE_URL', 'http://localhost');
	define('UPLOAD_PREFIX','/public/upload/');
	define('UPLOAD_PATH', $_SERVER["DOCUMENT_ROOT"]);
	define('DEFAULT_LOCALE', 'zh_CN');
	define('APPID', '188767117872337');
	define('PRIVATEKEY','1233211234567');
	define('EMAIL_FROM', 'r-track@r-pac.com');
	
	//config for google auth
	define('LOGIN_CALLBACK_URL', WEBSITE_URL.'/login_via_3party_callback.php');
	
	define('GOOGLE_CLIENT_ID','373587493538.apps.googleusercontent.com');
	define('GOOGLE_CLIENT_SECRET','ylA-JCsvTYNRqFyw4OFsJRjN');

	define('FACEBOOK_CLIENT_ID', '188767117872337');
	define('FACEBOOK_CLIENT_SECRET', 'a66a597a4039b483880f7eacde84cf70');
	
	define('QQ_CLIENT_ID', '100257086');
	define('QQ_CLIENT_SECRET', '3844d1713e4807fe99b8098dfd5c9c5d');
	
	define('YAHOO_APPID', 'L5de6536');
	define('YAHOO_CLIENT_ID','dj0yJmk9YzFjSDMyMVZLOWFNJmQ9WVdrOVREVmtaVFkxTXpZbWNHbzlNVEV4T1RNME5qVTJNZy0tJnM9Y29uc3VtZXJzZWNyZXQmeD0xOA--');
	define('YAHOO_CLIENT_SECRET','bcb05523702536ce4504125886de9a9450d12eff');
?>