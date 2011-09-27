<?php
	include_once 'model/ez_sql_core.php';
	//include_once 'model/ez_sql_sqlite.php';
	include_once 'model/ez_sql_mysql.php';
	include_once 'libs/Smarty.class.php';
	
	function getDBInstance() {
		//return new ezSQL_sqlite('./','test.db');
		return new ezSQL_mysql('root','admin','bookshare','192.168.21.157');
	}

	function redirect($url) {
		header("location:".$url);
	}
	
	function getSmartyInstance(){
		$smarty =  new Smarty();
		$smarty->template_dir = dirname(__FILE__).'\templates';
		$smarty->compile_dir = dirname(__FILE__).'\templates_c';
//		$smarty->debugging = true;
		return $smarty;		
	}
	
?>