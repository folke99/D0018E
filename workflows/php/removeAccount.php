<?php
include('databaseConnection.php');
session_start();
$uID = $_GET["uID"];
echo $uID;
$delete = $conn->prepare("DELETE FROM users WHERE uID =?");
$delete->bind_param('s', $uID);
$delete->execute();
$delete = $conn->prepare("DELETE FROM cart WHERE cuID =?");
$delete->bind_param('s', $uID);
$delete->execute();
header("Location:  ../php/admin.php");

?>