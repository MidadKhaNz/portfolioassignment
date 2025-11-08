<?php
$server   = "localhost";
$username = "root";
$password = "";
$dbname   = "webcoding";

$con = mysqli_connect($server, $username, $password, $dbname);
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
