<?php
include("loginserv.php");
unset($_SESSION['login']);
unset($_SESSION['role']);
unset($_SESSION['name']);
	   
// Finally, destroy the session.
session_destroy();
header("location: index.php");
?>