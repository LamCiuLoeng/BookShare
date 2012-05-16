<?php
require_once 'util.php';
require_once 'db_helper.php';

if(!isset($_REQUEST['email']) || !$_REQUEST['email']){
	message(_('Please input the e-mail address to reset password!'));
	return  redirect('reset_pw.php');
}

$email = $_REQUEST['email'];


$db = getDBInstance();
$users = checkUserByEmail($db,$email,'normal');
if(!$users){
	message(_('The account is not exist!'));
	return  redirect('reset_pw.php');
}

$user = $users[0];

$sn = encode(nowStr().randomStr(1000, 9999),FALSE);
$url = WEBSITE_URL.'/input_password.php?id='.encode($user->id).'&sn='.urlencode($sn);

$sql = "update users set reset_str='$sn' where id=".$user->id;
$db->query($sql);


function makeResetEmail($to, $from, $url) {
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= "To: $to \r\n";
	// $headers .= "Cc: 252211974@qq.com \r\n";
	$headers .= "From: $from" . "\r\n";

	$subject = "=?UTF-8?B?" . base64_encode ( _('Reset BookCat Password') ) . "?=";

	$content = '<html>
		<body>
			<p>'._('Please chick the link below to reset your passwrod.').'</p>
			<p><a href="'.$url.'">'._('Click Here').'</a></p>
		</body>
		</html>';
	$result = mail ( $to, $subject, $content, $headers );
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}

$result = makeResetEmail($email,EMAIL_FROM,$url);
$smarty = getSmartyInstance();
$smarty->display('send_reset_email.html');
?>
