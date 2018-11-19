<?php
$server = "localhost";
$username = "camagru";
$pass = "password";
$default_database = "camagru";
$con=mysqli_connect($server,$username,$pass,$default_database);
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
?>
