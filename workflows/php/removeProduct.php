<?php 
include('databaseConnection.php');
session_start();
$pID = $_GET["pID"];
$delete = mysqli_query($conn, "DELETE FROM products WHERE pID ='$pID'");

header("Location:  ../php/admin.php");
?>