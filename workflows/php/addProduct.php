<?php
include("databaseConnection.php");
session_start();
if (isset($_POST['upload'])) {
	$msg = "";
	$filename = $_FILES["img"]["name"];   
	$folder = "../images/products/".$filename;
	$pName = $_POST["pName"];
	$pPrice = $_POST["pPrice"];
	$pDescription = $_POST["pDescription"];
	$pStock = $_POST["pStock"];

	$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
						VALUES ('$pName', $pPrice, $pStock, 0, '$pDescription', '$folder')";

						if ($conn->query($sql) === TRUE) {
							echo "<h1 style='color:white'>Account created successfully!</h1>";
						} else {
						  	echo "<h1 style='color:white>Failed to create account1</h1>";
}
header("Location:  ../php/admin.php");
}
?>
