	<?php
	include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
	if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
	header("location:home");
	exit();
}
	?>