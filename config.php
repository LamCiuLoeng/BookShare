<?php
	//CONFIG FOR THE WEBSITE
	define('DB_USER', 'isofthk_book');
	define('DB_PASSWORD', 'Book709394');
	define('DB_NAME', 'isofthk_book');
	define('DB_IP', 'localhost');
	define('WEBSITE_URL', 'http://mobileapp.bookcat.hk');
	define('UPLOAD_PREFIX','/public/upload/');
	define('UPLOAD_PATH', $_SERVER["DOCUMENT_ROOT"]);
	define('DEFAULT_LOCALE', 'zh_CN');
	define('APPID', '188767117872337');
	define('PRIVATEKEY','1233211234567');
	
	//config for google auth
	define('LOGIN_CALLBACK_URL', WEBSITE_URL.'/login_via_3party_callback.php');
	
	define('GOOGLE_CLIENT_ID','373587493538.apps.googleusercontent.com');
	define('GOOGLE_CLIENT_SECRET','ylA-JCsvTYNRqFyw4OFsJRjN');

	define('FACEBOOK_CLIENT_ID', '188767117872337');
	define('FACEBOOK_CLIENT_SECRET', 'a66a597a4039b483880f7eacde84cf70');
	
	define('QQ_CLIENT_ID', '100257086');
	define('QQ_CLIENT_SECRET', '3844d1713e4807fe99b8098dfd5c9c5d');
	
	define('YAHOO_APPID', '7gEiFq6o');
	define('YAHOO_CLIENT_ID','dj0yJmk9aDhlNmEyQnBPQVpsJmQ9WVdrOU4yZEZhVVp4Tm04bWNHbzlPVFl4TVRrM05qSS0mcz1jb25zdW1lcnNlY3JldCZ4PTg3');
	define('YAHOO_CLIENT_SECRET','0b9da7113070e22dea818644273d5d93a11f4853');
?>