<?php 
	require_once('util.php');
	require_once 'db_helper.php';
	
	$db = getDBInstance();
	$name = $_REQUEST['name'];
	$desc = $_REQUEST['description'];
	$short_desc = $_REQUEST['short_description'];
	$point = 1;
	$create_by = $_SESSION['user']->id;
	$attachment_ids = $_REQUEST['file_ids'];
	
	$id = addBook($db, $name, $desc, $short_desc,$point, $create_by,$attachment_ids);
	//create the XML content for ipad etc
	$xml = "<?xml version='1.0' encoding='utf-8'?><book id='$id' name='$name'>";
	$file_paths = array();
	foreach (explode('|', $attachment_ids) as $v) {	
		if(isset($_SESSION['attachments']) && isset($_SESSION['attachments'][$v])){
			$xml .= "<page url='".WEBSITE_URL.$_SESSION['attachments'][$v]['url']."' version='1'></page>";
			$file_paths[] = $_SESSION['attachments'][$v]['path'];
		}
	}
	$xml .= "</book>";
	
	if (!get_magic_quotes_gpc()) {
	    $xml = addslashes($xml);
	}
	
	//zip the pages into one zip
	if(count($file_paths) > 0){
		$zip = new ZipArchive();
		$zip_file_url = UPLOAD_PREFIX.nowStr().randomStr(1,1000).'.zip';
		$zip_file_path = UPLOAD_PATH.$zip_file_url;
		if ($zip->open($zip_file_path, ZIPARCHIVE::CREATE)!==TRUE) {
		    exit("cannot open <$zip_file_path>\n");
		}
		foreach ($file_paths as $fp){
			$zip->addFile($fp,basename($fp));
		}
		$zip->close();
		
	}else{
		$zip_file_path = null;
		$zip_file_url = null;
	}
		
	$sql = "update books set xml='$xml',file_path='$zip_file_path',file_url='$zip_file_url' where id=$id;";
	$db->query($sql);
	$db->debug();
		
	// add the point once the user upload the book
	updateUserPoints($db, $_SESSION['user']->id, $point);
	$new_points = $_SESSION['user']->points + $point;	
	$_SESSION['use']->points = $new_points;

	
	$db->debug();
	message('Upload successfully!');
	unset($_SESSION['attachments']); 
	redirect('index.php');
	
?>