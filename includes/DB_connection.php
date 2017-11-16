<?php
//Databse configuration
//Define host address
$host = "localhost";
//Define user login for DB connection
$login = "root";
//Define user password for DB connection
$password = "root";
//Define database name
$dbname = "roomallocation";
//--------------------------------------

//Connection to database commands. Do not modify!
$conn = mysqli_connect($host, $login, $password);
$db = mysqli_select_db($conn, $dbname);
?>