<?php 
	require_once 'util.php';
	require_once 'db_helper.php';


	function handle_file_upload($uploaded_file,$name,$size,$type) {
		//save to disk
		$pi = pathinfo($name);
		$url = UPLOAD_PREFIX.nowStr().randomStr(1,1000).'.'.$pi['extension'];
		$file_path = UPLOAD_PATH.$url;
		move_uploaded_file($uploaded_file, $file_path);
		//save to db
		$db = getDBInstance();
		$create_by = $_SESSION['user']->id;
		$id = saveAttachment($db, $name, $file_path, $url, $create_by, intval($size), $type);
		
		//add to the session ,for later use
		if(isset($_SESSION['attachments'])){
			$_SESSION['attachments'][$id] = array('url'=>$url,'path'=>$file_path);
		}else{
			$_SESSION['attachments'] = array($id=>array('url'=>$url,'path'=>$file_path));
		}
		return array(
			'id' => $id,
			'file_name' => $name,
			'file_size' => $size,
			'file_type' => $type,
			'file_url'  => $url,			
		);
	}

	header('Pragma: no-cache');
	header('Cache-Control: private, no-cache');
	header('Content-Disposition: inline; filename="files.json"');
	header('X-Content-Type-Options: nosniff');

	$upload = isset($_FILES['files']) ?
        $_FILES['files'] : array(
            'tmp_name' => null,
            'name' => null,
            'size' => null,
            'type' => null,
            'error' => null
        );
        
    $info = array();
       
    if (is_array($upload['tmp_name'])) {
        foreach ($upload['tmp_name'] as $index => $value) {
            $info[] = handle_file_upload(
                $upload['tmp_name'][$index],
                isset($_SERVER['HTTP_X_FILE_NAME']) ?
                    $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'][$index],
                isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                    $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index],
                isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                    $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index]
            );  
        }
    } else {
        $info[] = handle_file_upload(
            $upload['tmp_name'],
            isset($_SERVER['HTTP_X_FILE_NAME']) ?
                $_SERVER['HTTP_X_FILE_NAME'] : $upload['name'],
            isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'],
            isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type']
        );
    }
    
    header('Vary: Accept');
    if (isset($_SERVER['HTTP_ACCEPT']) &&
        (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
        header('Content-type: application/json');
    } else {
        header('Content-type: text/plain');
    }
    echo json_encode($info);
        
?>