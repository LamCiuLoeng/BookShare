<?php
require_once ('util.php');
require_once 'db_helper.php';

if (! isset ( $_REQUEST ['bookid'] )) {
	$result = array ("version" => NULL, "state" => null, "msg" => "NO BOOK ID SUPPLIED" );
	echo json_encode ( $result );
	return;
}

$id = $_REQUEST ['bookid'];
$db = getDBInstance ();
$book = getRowById ( $db, 'books', $id );

if ($book) {
	$result = array ("version" => $book->version, "state" => 1 );
} else {
	$result = array ("version" => NULL, "state" => null, "msg" => "NO SUCH RECORD" );
}

echo json_encode ( $result );
return;
?>