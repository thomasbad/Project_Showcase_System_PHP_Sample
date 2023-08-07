<?php
$dbservername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "showcasedb";
global $conn;
$conn = mysqli_connect($dbservername, $dbuser, $dbpass, $dbname);
?>