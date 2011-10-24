<?php
	require_once 'util.php';
	require_once 'db_helper.php';
	
	if(!isUserLogin()){
		redirect('login.php');
	}
	
	$db = getDBInstance();
	$id = $_REQUEST['id'];
		
	$download_book = getDownloadBook($db, $_SESSION['user']->id, $id);
	$book = getRowById($db, 'books', $id);
	
	if($download_book){
		download($book->name,$book->file_path);
	}else{
		$new_point = $_SESSION['user']->points - $book->points;	
		if($new_point < 0){
			message('Your points is not enough to download this book!');
			redirect("book.php?id=$id");
		}
		//minus the user's points
		updateUserPoints($db, $_SESSION['user']->id, $book->points*-1);
		$_SESSION['user']->points = $new_point;
		
		//add the download history	
		addDownloadHistory($db, $_SESSION['user']->id, $id, $book->points);
			
		//update the book's download times
		addDownloadTime($db,$id);
		download($book->name,$book->file_path);
	}
?>