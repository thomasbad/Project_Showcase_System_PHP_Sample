<?php
$dbservername = "localhost";
$dbuser = "admin";
$dbpass = "adminpassword";
$dbname = "showcasedb";
global $conn;
$conn = mysqli_connect($dbservername, $dbuser, $dbpass, $dbname);
?>