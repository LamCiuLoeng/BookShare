<?php
require_once 'util.php';
require_once 'db_helper.php';

$id = $_REQUEST['id'];
$sn = $_REQUEST['sn'];
$pw = $_REQUEST['password'];
$rpw = $_REQUEST['repassword'];

if($pw!=$rpw){
	message(_('The password and the confirmed password are not the same!'));
	return redirect('index.php');
}

$db = getDBInstance();
$sql = "update users set password='$pw',reset_str=null where id=$id;";
$db->query($sql);
message(_('Your password has been reset successfully!'));
return redirect('login.php');

?>