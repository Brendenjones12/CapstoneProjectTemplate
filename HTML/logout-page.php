<?php
	session_start();
	if (empty($_SESSION))
	{
		header("Location: login-page.php");
	} else {
		session_destroy();
	}
?>