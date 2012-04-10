<?php
require_once 'util.php';

function smarty_insert_menu_bar($params,&$smarty){
	$current =  $smarty->getTemplateVars('menu_current');
	if(!$current){
		$current = 'TAB_HOME';
	}
	
	if($current=='TAB_HOME'){
		$tab_home = '<li><a href="index.php"  title="Home" class="current">'._('Home').'</a></li>';
	}else{
		$tab_home = '<li><a href="index.php"  title="Home">'._('Home').'</a></li>';
	}
	
	if(!isUserLogin()){
		return '<ul id="menu">'.$tab_home.'</ul>';
	}
	
	if($current=='TAB_UPLOAD'){
		$tab_upload = '<li><a href="upload.php"  title="Upload" class="current">'._('Upload').'</a></li>';
	}else{
		$tab_upload = '<li><a href="upload.php"  title="Upload">'._('Upload').'</a></li>';
	}
	
	if($current=='TAB_MYBOOKS'){
		$tab_mybook = '<li><a href="mybooks.php"  title="My Books" class="current">'._('My Books').'</a></li>';
	}else{
		$tab_mybook = '<li><a href="mybooks.php"  title="My Books">'._('My Books').'</a></li>';
	}
	
	if($current=='TAB_PROFILE'){
		$tab_profile = '<li><a href="profile.php"  title="Profile" class="current">'._('Profile').'</a></li>';
	}else{
		$tab_profile = '<li><a href="profile.php"  title="Profile">'._('Profile').'</a></li>';
	}
	
	if(inGroup('ADMIN')){
		$tab_admin = '<li><a href="admin/users.php"  title="Admin">'._('Admin').'</a></li>';
	}else{
		$tab_admin = '';
	}
		

	$html = '<ul id="menu">'.$tab_home.$tab_upload.$tab_mybook.$tab_profile.$tab_admin.'</ul>';
	return $html;
}
?>