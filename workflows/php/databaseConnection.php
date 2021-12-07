<!-- dbconnection.php -->
<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbName     = "d0018e";

/*
$servername = "utbweb.its.ltu.se";
$username   = "19980724";
$password   = "19980724";
$dbName     = "db19980724";
*/
// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>