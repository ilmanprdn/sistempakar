<?php
	//Start session
	session_start();
	ini_set('error_reporting', 0);
	ini_set('display_errors', 0);
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USERNAME']) || (trim($_SESSION['SESS_USERNAME']) == '')) {
	    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php?page=haruslogin\">";
		exit();
	}
?>
