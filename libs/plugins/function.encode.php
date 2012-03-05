<?php
	require_once 'util.php';
	function smarty_function_encode($params, &$smarty){
		if (empty($params)) {
	        trigger_error("encode: missing parameter",E_USER_WARNING);
	        return;
	    } else {
	        return encode($params);
	    }
	}
	
?>