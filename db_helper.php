<?php
	//**********************************
	//public function
	//**********************************	
	function getRowById($db,$table,$id){
		$sql = "select * from $table where id=$id";
		return $db->get_row($sql);
	}
	
	
	
	function getAllRows($db,$table,$order_by='name'){
		$sql = "select * from $table where active=0 order by $order_by;";
		return $db->get_results($sql);
	}
	
	function getRowsByCondition($db,$table,$where){	
		$sql = "select * from $table ";
		
		$w = "";
		for($i=0;$i<count($where);$i++){
			$w .= $where[$i].' ';
		}
		
		if($w){
			return $db->get_results($sql.' where '.$w);
		}else{
			return $db->get_results($sql);
		}
		
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
	
	function addExchangeLog($db,$user_id,$points){
		$sql = "Insert into exchange_log(user_id,points) values($user_id,$points);";
		$db->query($sql);
		return $db->insert_id;
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

	function saveCateogry($db,$type,$id,$name,$desc,$create_by,$promote){
		if($type=='UPDATE'){
			$sql = "update categories set name='$name',description='$desc',promote=$promote where id=$id;";
		}elseif($type == 'NEW'){
			$sql = "insert into categories (name,description,create_by,promote) values ('$name','$desc',$create_by,$promote);";
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

	
	//**********************************
	//function related to the exchange points
	//**********************************
	
	//$status  : 0 is new ,1 is approved, -1 is cancel, 2 is not disapproved.
	function getExchangeLog($db,$user_id,$status) {
		$sql = "select l.*,u.email,u.points as user_points  from exchange_log l, users u where l.active=0 and u.id=l.user_id ";
		$conditions = array();
		
		if($user_id){
			array_push($conditions," user_id=$user_id ");
		}
		if($status){
			array_push($conditions, " status=$status");
		}
		
		if(sizeof($conditions) > 0){
			$sql .= join(' and ', $conditions);
		}
		
		$sql .= ' order by id DESC ;';
		return $db->get_results($sql);
	}
	
	
	
	function processExchangeLog($db,$id,$status) {
		$sql = "update exchange_log set status=$status where id=$id; ";
		$db->query($sql);
		return $db->rows_affected;
	}
?>