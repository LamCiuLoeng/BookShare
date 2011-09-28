<?php 
	require_once('util.php');
	
	if ($_FILES['file_01']['tmp_name']) {
		$f = handleUpload('file_01');
		if(!$f){
				//message('Error occur when uploading the image!');
				return redirect('upload.php');		
			}
	}else{
		$f = '';
	}
	
	
	$db = getDBInstance();
	$name = $_REQUEST['name'];
	$desc = $_REQUEST['description'];
	$short_desc = $_REQUEST['short_description'];
	
	$sql = "insert into books(name,description,short_description,path) values ('$name','$desc','$short_desc','$f');";
	echo $sql;
	$db->query($sql);
	$db->debug();
	
	//header("location:".'index.php');
	
?>