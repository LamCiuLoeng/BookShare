<?php 
	require_once('util.php');
	require_once 'db_helper.php';
	
	if ($_FILES['file_01']['tmp_name']) {
		$f = handleUpload('file_01');
		if(!$f){
				message('Error occur when uploading the image!');
				return redirect('upload.php');		
			}
	}else{
		$f = '';
	}
	
	
	$db = getDBInstance();
	$name = $_REQUEST['name'];
	$desc = $_REQUEST['description'];
	$short_desc = $_REQUEST['short_description'];
	$point = 1;
	$create_by = $_SESSION['user']->id;

	addBook($db, $name, $desc, $short_desc, $f, $point, $create_by);
	
	// add the point once the user upload the book
	updateUserPoints($db, $_SESSION['user']->id, $point);
	$new_points = $_SESSION['user']->points + $point;	
	$_SESSION['use']->points = $new_points;

	
	$db->debug();
	message('Upload successfully!');
	redirect('index.php');
	
?>