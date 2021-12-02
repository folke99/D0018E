<?php
include('databaseConnection.php');
session_start();
$uID = $_GET["uID"];
echo $uID;
$delete = mysqli_query($conn, "DELETE FROM users WHERE uID ='$uID'");
echo $delete;

header("Location:  ../php/admin.php");

?>