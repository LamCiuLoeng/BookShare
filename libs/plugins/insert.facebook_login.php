<?php
require_once 'util.php';


function smarty_insert_facebook_login($params,&$smarty){
	$appid = $smarty->getTemplateVars('APPID');
	$locale = get_locale();	
	$lang = $locale == 'en' ? 'en_US' : $locale ;

	$html = '<div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];';
	$html.= 'if (d.getElementById(id)) { return; }js = d.createElement(s); js.id = id;';
	$html.= 'js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1&appId='.$appid.'";';
	$html.= 'fjs.parentNode.insertBefore(js, fjs);';
	$html.= "}(document, 'script', 'facebook-jssdk'));</script>";
	$html.='<fb:login-button show-faces="false" width="200" max-rows="1"></fb:login-button>';
	return $html;
}
?>