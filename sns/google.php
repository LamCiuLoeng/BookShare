<?php
require_once 'config.php';
require_once 'util.php';

class GoogleUtil {
	var $auth_url = "https://accounts.google.com/o/oauth2/auth";
	var $token_url = "https://accounts.google.com/o/oauth2/token";
	var $userinfo_url = "https://www.googleapis.com/oauth2/v1/userinfo";
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
	
	function authURL() {
		$params = array (
			'client_id' => GOOGLE_CLIENT_ID, 
			'redirect_uri' => $this->redirect_uri, 
			'response_type' => 'code', 
			'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email', 
			'state' => 'google', 
//			'access_type' => 'offline', 
			'approval_prompt' => 'force' 
		);
		
		$s = http_build_query ( $params );
		$url = $this->auth_url . '?' . $s;
		return $url;
	}
	
	function getToken($code) {
		$data = array ('code' => $code, 'client_id' => $this->client_id, 'client_secret' => $this->client_secret, 'redirect_uri' => $this->redirect_uri, 'grant_type' => 'authorization_code' );
		
		$result = json_decode(http_post ( $this->token_url, $data ));
		return $result->access_token;
	
	}
	
	function getUserInfo($token) {
		$url = $this->userinfo_url.'?access_token='.$token;
		$result = http_get($url);
		return json_decode($result);
	}
}

?>