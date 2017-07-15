<?php
	session_start();

	if (isset($_SESSION['user_id'])) {
		session_destroy();
		header("location: ../index.php"); //estemos donde estemos nos redirije al index
	}

?>