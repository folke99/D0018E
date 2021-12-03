<?php 
include('databaseConnection.php');
session_start();
$pID = $_GET["pID"];
$delete = mysqli_query($conn, "DELETE FROM products WHERE pID ='$pID'");

$delete = mysqli_query($conn, "DELETE FROM reviews WHERE rpID ='$pID'");

header("Location:  ../php/admin.php");
?>