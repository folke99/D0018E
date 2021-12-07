<?php 
include('databaseConnection.php');
session_start();
$pID = $_GET["pID"];

$delete = $conn->prepare("DELETE FROM products WHERE pID = ?");
$delete->bind_param('s', $pID);
$delete->execute();

$delete = mysqli_query($conn, "DELETE FROM reviews WHERE rpID = ?");

if($delete)
{
$delete->bind_param('s', $pID);
$delete->execute();
}


header("Location:  ../php/admin.php");
?>