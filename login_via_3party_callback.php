<?php 
	require_once 'util.php';
	require_once 'sns/google.php';
	


	
	$g = new GoogleUtil(WEBSITE_URL.'/login_via_3party_callback.php');
	$result = $g->getToken(urlencode($_REQUEST['code']));
	echo $result['access_token'];
	
?>



<!-- 
<form action="https://accounts.google.com/o/oauth2/token" method="post" enctype="application/x-www-form-urlencoded">
	<input type="hidden" name="code" value="<?php echo $_REQUEST['code']?>"/>
	<input type="hidden" name="client_id" value="373587493538.apps.googleusercontent.com"/>
	<input type="hidden" name="client_secret" value="ylA-JCsvTYNRqFyw4OFsJRjN"/>
	<input type="hidden" name="redirect_uri" value="<?php echo WEBSITE_URL?>/login_via_3party_callback.php"/>
	<input type="hidden" name="grant_type" value="authorization_code"/>

	
	<input type="submit" value="submit"/>
</form>
 -->