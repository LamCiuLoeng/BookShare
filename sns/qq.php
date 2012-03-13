<?php
require_once 'util.php';

class QQUtil {
	var $auth_url = "https://graph.qq.com/oauth2.0/authorize";
	var $token_url = "https://graph.qq.com/oauth2.0/token";
	var $openid_url = "https://graph.qq.com/oauth2.0/me";
	var $userinfo_url = "https://graph.qq.com/user/get_user_info";
	
	var $client_id = NULL;
	var $client_secret = NULL;
	var $redirect_uri = NULL;
	var $response_type = NULL;
	var $scope = NULL;
	var $state = NULL;
	
	function __construct($redirect_uri) {
		$this->client_id = QQ_CLIENT_ID;
		$this->client_secret = QQ_CLIENT_SECRET;
		$this->redirect_uri = $redirect_uri;
	}
	
	function authURL() {
		$params = array ('client_id' => $this->client_id, 'redirect_uri' => $this->redirect_uri, 'response_type' => 'code', 'scope' => 'get_user_info', 'state' => 'qq' );
		$s = http_build_query ( $params );
		$url = $this->auth_url . '?' . $s;
		return $url;
	}
	
	function getToken($code) {
		$data = array ('code' => $code, 'client_id' => $this->client_id, 'client_secret' => $this->client_secret, 'redirect_uri' => $this->redirect_uri, 'grant_type' => 'authorization_code', 'state' => 'qq' );
		$s = http_build_query ( $data );
		$result = http_get ( $this->token_url . '?' . $s );
		parse_str ( $result );
	}
	
	function getOpenID($token) {
		$url = $this->openid_url . '?access_token=' . $token;
		$r = http_get ( $url );
		$r = str_replace ( 'callback(', '', $r );
		$r = str_replace ( ');', '', $r );
		$result = json_decode ( $r );
		return $result->openid;
	
	}
	
	function getUserInfo($token, $openid) {
		$data = array ('access_token' => $token, 'oauth_consumer_key' => $this->client_id, 'openid' => $openid, 'format' => 'json' );
		$s = http_build_query ( $data );
		$url = $this->userinfo_url . '?' . $s;
		$result = http_get ( $url );
		return json_decode ( $result );
	}
}
?>