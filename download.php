<?php
require_once 'util.php';
require_once 'db_helper.php';

$db = getDBInstance ();
$id = decode ( $_REQUEST ['id'] );
$book = getRowById ( $db, 'books', $id );

//update the book's download times
addDownloadTime ( $db, $id );
download ( $book->name, $book->file_path );
?>