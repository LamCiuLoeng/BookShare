<?php
require_once 'config.php';
require_once 'util.php';

class FacebookUtil {
	var $auth_url = "https://www.facebook.com/dialog/oauth";
	var $token_url = "https://graph.facebook.com/oauth/access_token";
	var $userinfo_url = "https://graph.facebook.com/me";
	var $client_id = NULL;
	var $client_secret = NULL;
	var $redirect_uri = NULL;
	var $response_type = NULL;
	var $scope = NULL;
	var $state = NULL;
	
	function __construct($redirect_uri) {
		$this->client_id = FACEBOOK_CLIENT_ID;
		$this->client_secret = FACEBOOK_CLIENT_SECRET;
		$this->redirect_uri = $redirect_uri;
	}
	
	function authURL() {
		$params = array (
			'client_id' => FACEBOOK_CLIENT_ID, 
			'redirect_uri' => $this->redirect_uri, 
			'scope' => 'email',
			'state' => 'facebook', 
//			'approval_prompt' => 'force' 
		);
		
		$s = http_build_query ( $params );
		$url = $this->auth_url . '?' . $s;
		return $url;
	}
	
	function getToken($code) {
		$data = array (
			'code' => $code, 
			'client_id' => $this->client_id, 
			'client_secret' => $this->client_secret, 
			'redirect_uri' => $this->redirect_uri, 
		);
		
		$s = http_build_query($data);
		$result = http_get( $this->token_url.'?'.$s );
		parse_str($result);
		return $access_token;
	}
	
	function getUserInfo($token){
		$url = $this->userinfo_url.'?access_token='.$token;
		$result = http_get($url);
		return json_decode($result);
	}

}

?>