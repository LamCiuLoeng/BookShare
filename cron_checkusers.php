<?php
require_once 'util.php';
function makeActiveEmail($to, $from, $subject) {
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "To: $to \r\n";
	// $headers .= "Cc: 252211974@qq.com \r\n";
	$headers .= "From: $from" . "\r\n";
	
	$subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	
	$content = 'Check Cron Job,from Cron';
	$result = mail ( $to, $subject, $content, $headers );
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}

#$check_time = date_create ();
#date_sub ( $check_time, new DateInterval ( "P30D" ) );
#$time_str = $check_time->format ( 'Y-m-d' );


$time_str = date("Y-m-d",strtotime("-30 days"));
$sql = "update users set active=1 where account_type='normal' and active=0 and register!=0 and create_time < '$time_str';";
$db = getDBInstance ();
$db->query ( $sql );
$total = $db->rows_affected;
$result = makeActiveEmail ( "lamciuloeng@gmail.com", "info@bookcat.hk", "Total $total records are changed to inactive!" );
if ($result) {
	echo 'OK,from cron';
} else {
	echo 'Error';
}

?>