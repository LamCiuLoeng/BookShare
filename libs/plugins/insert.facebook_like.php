<?php

function smarty_insert_facebook_like($params,&$smarty){
	$appid = $smarty->getTemplateVars('APPID');
	$url = $params['url'];
	$locale = get_locale();	
	$lang = $locale == 'en' ? 'en_US' : $locale ;
	
	$html = '<div id="fb-root"></div><script>(function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0];';
	$html .= 'if (d.getElementById(id)){ return; }js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/'.$lang.'/all.js#xfbml=1&appId='.$appid.'";';
	$html .= "fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>";
	$html .= '<fb:like href="'.$url.'" send="true" width="450" show_faces="true"></fb:like>';
	return $html;
}
?>