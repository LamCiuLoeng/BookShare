<?php
	
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
	
	function getUserInfo($db,$user_id){
		$sql = "select * from users where id=$user_id";
		return $db->get_row($sql);
	}
	
	function getAllUsers($db) {
		$sql = "select * from users where active=0;";
		return $db->get_results($sql);
	}
	
	function getAllBooks($db){
		$sql = "SELECT b.*,u.email from books b,users u WHERE b.active=0 and u.active=0 and b.create_by=u.id";
		return $db->get_results($sql);
	}
	
	function addBook($db,$name,$desc,$short_desc,$path,$point,$create_by){
		$sql = "insert into books(name,description,short_description,path,points,create_by) values ('$name','$desc','$short_desc','$path',$point,$create_by);";
		$db->query($sql);
		return $db->rows_affected;
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
	
	function updateUserPoints($db,$user_id,$points){
		$sql = "update users set points=points+($points) where id=$user_id";
		$db->query($sql);
		return $db->rows_affected;
	}
	
	function getAllCategories($db){
		$sql = "select * from categories where active=0";
		return $db->get_results($sql);
	}
?>