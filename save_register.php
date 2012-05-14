<?php
require_once ('util.php');
require_once ('db_helper.php');

function makeActiveEmail($to, $from, $subject, $url) {
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "To: $to \r\n";
	// $headers .= "Cc: 252211974@qq.com \r\n";
	$headers .= "From: $from" . "\r\n";
	
	$subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	
	$content = 'Dear User :<br />';
	$content .= 'Thank you for registering with BookCat.<br />';
	$content .= 'Please click on the link below to verify this email address.<br />';
	$content .= 'After verifying your email address, you will be able to login to the site.<br />';
	$content .= "Click here : <a href='$url' target='_blank'>$url</a><br />";
	
	$result = mail ( $to, $subject, $content, $headers );
//	echo $result;
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}

$email = $_REQUEST ['email'];
$password = $_REQUEST ['password'];
$repassword = $_REQUEST ['repassword'];

$msg = array ();

// heck the email format
if (! preg_match ( "/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email )) {
	array_push ( $msg, _ ( 'Please provide a valid email address!' ) );
}

if ($password != $repassword) {
	array_push ( $msg, _ ( 'Password and Confirmed Password are not the same!' ) );
}

if (count ( $msg ) > 0) {
	message ( implode ( '\n', $msg ) );
	return redirect ( 'register.php' );
}

$db = getDBInstance ();
$check = checkUserByEmail ( $db, $email, 'normal' );
if (count ( $check ) > 0) {
	message ( _ ( 'This account has been registered!' ) );
	return redirect ( 'register.php' );
}

$user = addUser ( $db, $email, $password, null, null, 'normal', 0,1 );
if ($user) {
	// message(_('Register successfully,please login.'));
	// redirect('login.php');
	// send email to the account
	$to = $email;
	$from = EMAIL_FROM;
	$subject = "Confirm your BookCat account";
	$url = WEBSITE_URL . '/active.php?id=' . encode ( $user->id );
	$result = makeActiveEmail ( $to, $from, $subject, $url );
	if (! $result) {
		message(_('There is some problem when sending e-mail to this address, please try it again.'));
		updateRecordActive($db, 'users', $user->id, -1);
		redirect('register.php');
	} else {
		$smarty = getSmartyInstance ();
		$smarty->display ( 'register_succ.html' );
	}
} else {
	redirect ( 'register.php' );
}

?>