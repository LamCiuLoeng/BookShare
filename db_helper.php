<?php
	//**********************************
	//public function
	//**********************************	
	function getRowById($db,$table,$id){
		$sql = "select * from $table where id=$id";
		return $db->get_row($sql);
	}
	
	function getAllRows($db,$table,$order_by){
		$sql = "select * from $table where active=0 order by $order_by;";
		return $db->get_results($sql);
	}

	//**********************************
	//function related to the user
	//**********************************	
	function getUserInfo($db,$user_id){
		$sql = "select * from users where id=$user_id";
		return $db->get_row($sql);
	}
	
	function getAllUsers($db) {
		$sql = "select * from users where active=0 order by email;";
		return $db->get_results($sql);
	}

	function updateUserPoints($db,$user_id,$points){
		$sql = "update users set points=points+($points) where id=$user_id";
		$db->query($sql);
		return $db->rows_affected;
	}
	
	
	//**********************************
	//function related to the group
	//**********************************	
	function saveGroup($db,$type,$id,$name,$desc){
		if($type=='UPDATE'){
			$sql = "update groups set name='$name',description='$desc' where id=$id;";
		}elseif($type == 'NEW'){
			$sql = "insert into groups (name,description) values ('$name','$desc');";
		}elseif ($type == 'DELETE') {
			$sql = "update groups set active = 1 where id=$id;";
		}
		$db->query($sql);
		return $db->rows_affected;
	}
	
	//**********************************
	//function related to the book
	//**********************************
	function getAllBooks($db){
		$sql = "SELECT b.*,u.email from books b,users u WHERE b.active=0 and u.active=0 and b.create_by=u.id";
		return $db->get_results($sql);
	}
	
	function addBook($db,$name,$desc,$short_desc,$point,$create_by,$pages){
		$sql = "insert into books(name,description,short_description,points,create_by,pages) values ('$name','$desc','$short_desc',$point,$create_by,'$pages');";
		$db->query($sql);
		return $db->insert_id;
	}
	
	
	
	//**********************************
	//function related to the category
	//**********************************

	function saveCateogry($db,$type,$id,$name,$desc,$create_by){
		if($type=='UPDATE'){
			$sql = "update categories set name='$name',description='$desc' where id=$id;";
		}elseif($type == 'NEW'){
			$sql = "insert into categories (name,description,create_by) values ('$name','$desc',$create_by);";
		}elseif ($type == 'DELETE') {
			$sql = "update categories set active = 1 where id=$id;";
		}
		$db->query($sql);
		return $db->rows_affected;
	}
	
	
	//**********************************
	//function related to the process
	//**********************************
	function getDownloadBooks($db,$user_id){
		$sql = "SELECT b.* from books b, user_book ub where ub.active=0 and b.id=ub.book_id and ub.user_id=$user_id";
		return $db->get_results($sql);
	}
	
	function getUploadBooks($db,$user_id){
		$sql = "SELECT b.* from books b , user_book ub where b.active=0 and b.id=ub.book_id and ub.user_id=$user_id";
		return $db->get_results($sql);
	}
	
	function getDownloadBook($db,$user_id,$book_id) {
		$sql = "select * from user_book where user_id=$user_id and book_id=$book_id";
		return $db->get_row($sql);
	}
	
	
	
	function addDownloadTime($db,$book_id){
		$sql = "update books set download_times=download_times+1 where id=$book_id";
		$db->query($sql);
		return $db->rows_affected;
	}
	
	function addDownloadHistory($db,$user_id,$book_id,$points){
		$sql = "insert into user_book (user_id,book_id,points) values ($user_id,$book_id,$points)";
		$db->query($sql);
		return $db->rows_affected;
	}
	
	
	//**********************************
	//function related to the attachments
	//**********************************
	function saveAttachment($db,$file_name,$file_path,$file_url,$create_by,$file_size,$file_type) {
		$sql = "insert into attachments(name,file_path,file_url,create_by,file_size,file_type) values('$file_name','$file_path','$file_url',$create_by,$file_size,'$file_type');";
		$db->query($sql);
		return $db->insert_id;
	}
	
?>