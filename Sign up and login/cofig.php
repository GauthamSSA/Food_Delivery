<?php

$servername = "localhost";
$username = "";
$password = "";
$dbname = "proj";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

?>