<?php
require_once 'config.php';
require_once 'util.php';

class GoogleUtil {
	var $auth_url = "https://accounts.google.com/o/oauth2/auth";
	var $token_url = "ssl://accounts.google.com";
	var $client_id = NULL;
	var $client_secret = NULL;
	var $redirect_uri = NULL;
	var $response_type = NULL;
	var $scope = NULL;
	var $state = NULL;
	
	function __construct($redirect_uri) {
		$this->client_id = GOOGLE_CLIENT_ID;
		$this->client_secret = GOOGLE_CLIENT_SECRET;
		$this->redirect_uri = $redirect_uri;
	}
	
	function getToken($code) {
		$fp = fsockopen( $this->token_url , 443, $errno, $errstr, 30);
		$post = 'code='.$code;
		$post.= '&client_id='.$this->client_id;
		$post.= '&client_secret='.$this->client_secret;
		$post.= '&redirect_uri='.urldecode($this->redirect_uri);
		$post.= '&grant_type=authorization_code';
		$len = strlen($post);
		
		echo $post;
		
		if (!$fp) {
		    throw new Exception('Can not open the request!');
		} else {
			$receive = '';
		    $out = "POST /o/oauth2/token HTTP/1.1\r\n";
		    $out .= "Host: accounts.google.com\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "Connection: close\r\n";
			$out .= "Content-Length: $len\r\n";
			$out .="\r\n";
			$out .= $post."\r\n";
			
		    fwrite($fp, $out);
		    while (!feof($fp)) {
		        $receive .= fgets($fp, 128);
		    }
		    fclose($fp);
		    echo '<p><b>Received -begin</b></p>';
		    echo $receive;
		    echo '<p><b>Received -end</b></p>';		    
		    return json_decode($receive);
		    
		}
	}
	
	function getCode($redirect_uri, $scope, $state = NULL) {
			
	}

}

?>