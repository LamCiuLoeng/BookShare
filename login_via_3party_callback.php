<?php
require_once 'util.php';
require_once 'sns/google.php';
$g = new GoogleUtil ( WEBSITE_URL . '/login_via_3party_callback.php' );
$result = $g->getToken ( $_REQUEST ['code'] );

$result = json_decode ( $result );
echo $result->access_token;

echo '<p>finish</p>';
?>
