<?php
require_once '../util.php';

function smarty_insert_admin_menu_bar($params,&$smarty){
	$current =  $smarty->getTemplateVars('menu_current');
	if(!$current){
		$current = 'TAB_USER';
	}

	$tab_home = '<li><a href="../index.php"  title="Home">'._('Home').'</a></li>';
	
	if($current=='TAB_USER'){
		$tab_user = '<li><a href="users.php"  title="User Management" class="current">'._('User').'</a></li>';
	}else{
		$tab_user = '<li><a href="users.php"  title="User Management">'._('User').'</a></li>';
	}
	
	if($current=='TAB_GROUP'){
		$tab_group = '<li><a href="groups.php"  title="Group Management" class="current">'._('Group').'</a></li>';
	}else{
		$tab_group = '<li><a href="groups.php"  title="Group Management">'._('Group').'</a></li>';
	}
	
	if($current=='TAB_BOOK'){
		$tab_book = '<li><a href="books.php"  title="Books Management" class="current">'._('Book').'</a></li>';
	}else{
		$tab_book = '<li><a href="books.php"  title="Books Management">'._('Book').'</a></li>';
	}
	
	if($current=='TAB_CATEGORY'){
		$tab_category = '<li><a href="category.php"  title="Category Management" class="current">'._('Category').'</a></li>';
	}else{
		$tab_category = '<li><a href="category.php"  title="Category Management">'._('Category').'</a></li>';
	}
	
	if($current=='TAB_SYSTEM'){
		$tab_system = '<li><a href="system.php"  title="System Management" class="current">'._('System').'</a></li>';
	}else{
		$tab_system = '<li><a href="system.php"  title="System Management">'._('System').'</a></li>';
	}

	$html = '<ul id="admin_menu">'.$tab_home.$tab_user.$tab_group.$tab_book.$tab_category.$tab_system.'</ul>';
	return $html;
}
?>