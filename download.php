<?php
require_once 'util.php';
require_once 'db_helper.php';

$db = getDBInstance ();
$id = decode_and_int( $_REQUEST ['id'] );

$book = getRowById ( $db, 'books', $id );

if(!$book){
	message(_('No such record!'));
	redirect('index.php');
}


if(isUserLogin()){
		//add the download history	
	//now all the book is free to download
	addDownloadHistory ( $db, $_SESSION ['user']->id, $id, 0 ); 	
}

//return;

//update the book's download times
addDownloadTime ( $db, $id );

download ( $book->name, $book->file_path );
?>