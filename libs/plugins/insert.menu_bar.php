<?php
function smarty_insert_menu_bar($params,&$smarty){
	$current =  $smarty->getTemplateVars('menu_current');
	if(!$current){
		$current = 'TAB_HOME';
	}
	
	if($current=='TAB_HOME'){
		$tab_home = '<li><a href="index.php"  title="Home" class="current">Home</a></li>';
	}else{
		$tab_home = '<li><a href="index.php"  title="Home">Home</a></li>';
	}
	
	if($current=='TAB_UPLOAD'){
		$tab_upload = '<li><a href="upload.php"  title="Upload" class="current">Upload</a></li>';
	}else{
		$tab_upload = '<li><a href="upload.php"  title="Upload">Upload</a></li>';
	}
	
	if($current=='TAB_MYBOOKS'){
		$tab_mybook = '<li><a href="mybooks.php"  title="My Books" class="current">My Books</a></li>';
	}else{
		$tab_mybook = '<li><a href="mybooks.php"  title="My Books">My Books</a></li>';
	}
	
	if($current=='TAB_PROFILE'){
		$tab_profile = '<li><a href="profile.php"  title="Profile" class="current">Profile</a></li>';
	}else{
		$tab_profile = '<li><a href="profile.php"  title="Profile">Profile</a></li>';
	}
	
	$tab_admin = '<li><a href="admin/index.php"  title="Admin">Admin</a></li>';

	$html = '<ul id="menu">'.$tab_home.$tab_upload.$tab_mybook.$tab_profile.'</ul>';
	return $html;
}
?>