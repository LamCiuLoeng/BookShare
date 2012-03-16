<?php
require_once 'util.php';

class YahooUtil {
	var $token_url = "https://api.login.yahoo.com/oauth/v2/get_request_token";
	var $auth_url = "https://api.login.yahoo.com/oauth/v2/request_auth";
	var $exchange_url = "https://api.login.yahoo.com/oauth/v2/get_token";
	//var $guid_url = "http://social.yahooapis.com/v1/me/guid";
	var $userinfo_url = "http://social.yahooapis.com/v1/user/";
		
	
	var $client_id = NULL;
	var $client_secret = NULL;
	var $redirect_uri = NULL;

	
	function __construct($redirect_uri) {
		$this->client_id = YAHOO_CLIENT_ID;
		$this->client_secret = YAHOO_CLIENT_SECRET;
		$this->redirect_uri = $redirect_uri;
	}
	
	
	function getToken(){
		$timestr = time();
		$nonce = $timestr.randomStr(1000, 9999);
		$params = array (
				'oauth_consumer_key' => $this->client_id,
				'oauth_nonce' => $nonce,
				'oauth_signature_method' => 'plaintext',
				'oauth_signature' => $this->client_secret.'&',
				'oauth_timestamp' => $timestr,
				'oauth_version' => '1.0',
				'oauth_callback' => $this->redirect_uri,
		);
		$s = http_build_query ( $params );
		$url = $this->token_url. '?' . $s;
		$content = http_get($url);
		parse_str($content);
		$result = array('oauth_token'=>$oauth_token,'oauth_token_secret'=>$oauth_token_secret);
		return $result;
	}
	
	
	function authURL($token) {
		$url = $this->auth_url.'?oauth_token='.$token;
		return $url;
	}
		
	
	function exchangeToken($token,$oauth_verifier,$oauth_token_secret) {
		$timestr = time();
		$nonce = $timestr.randomStr(1000, 9999);		
		$data = array (
				'oauth_consumer_key' => $this->client_id, 
				'oauth_signature_method' => 'plaintext',
				'oauth_nonce' => $nonce,								
				'oauth_signature'=>$this->client_secret.'&'.$oauth_token_secret,
				'oauth_timestamp'=>$timestr,
				'oauth_verifier' => $oauth_verifier,
				'oauth_version' => '1.0',
				'oauth_token'=>$token,
				);
		
		$s = http_build_query ( $data );
		$content = http_get ( $this->exchange_url . '?' . $s );	
		parse_str ( $content );
		$result = array('oauth_token'=>$oauth_token,
						'oauth_session_handle'=>$oauth_session_handle,
						'xoauth_yahoo_guid' => $xoauth_yahoo_guid);
		return $result;		
	}

	
// 	function refreshToken($token) {
// 		$url = $this->openid_url . '?access_token=' . $token;
// 		$r = http_get ( $url );
// 		$r = str_replace ( 'callback(', '', $r );
// 		$r = str_replace ( ');', '', $r );
// 		$result = json_decode ( $r );
// 		return $result->openid;
	
// 	}

	function getGuid(){
		$content = http_get($this->guid_url);
		return $content;
	}
	
	function getUserInfo($guid,$token,$oauth_token_secret,$oauth_session_handle) {
		$timestr = time();
		$nonce = $timestr.randomStr(1000, 9999);
		
		$url = $this->userinfo_url.$guid.'/profile';
		$data = array (
				'format'=>'json',
				'Authorization'=>'OAuth',
				'realm'=>'yahooapis.com',
				'oauth_consumer_key'=>$this->client_id,
				'oauth_nonce'=>$nonce,
				'oauth_signature_method'=>"HMAC-SHA1",
				'oauth_timestamp'=>$timestr,
				'oauth_token'=>$token,
				'oauth_version'=>'1.0',
// 				'oauth_signature'=>$this->client_secret.'&'.$oauth_token_secret,
// 				'oauth_session_handle'=>$oauth_session_handle,
				);

		ksort($data);
		
		echo http_build_query($data).'<br /><br />';
		
		
		$data['oauth_signature'] = $this->generateSignature($this->userinfo_url, $data, $oauth_token_secret);
		$s = http_build_query ( $data );
		$url = $url . '?' . $s;
		
		
		
		echo $timestr.'<br /><br />';
		echo $nonce.'<br /><br />';
		
		
		echo $url.'<br /><br />';
		
		
		$result = http_get ( $url );
		return json_decode ( $result );
	}
	
	
	function generateSignature($url,$data,$oauth_token_secret){
// 		ksort($data);

		$params = '';
		foreach ($data as $k => $v) {
			$params.="$k=$v";
		}
		
		$baseStr ='GET&'.urlencode($url).'&'.urlencode($params);
		echo $baseStr.'<br /><br />';
		
		
		$key = $this->client_secret.'&'.$oauth_token_secret;
		echo $key.'<br /><br />';
		
		$sig = base64_encode(hash_hmac('sha1', $baseStr, $key,true));
		echo $sig.'<br /><br />';
		
		return base64_encode(hash_hmac('sha1', $baseStr, $key,true));
	}
}



?>