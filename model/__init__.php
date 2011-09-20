<?php 
	include_once 'model/ez_sql_core.php';
	include_once 'model/ez_sql_sqlite.php';
	
	function getDBInstance() {
		return new ezSQL_sqlite('./','test.db');
	}
?>