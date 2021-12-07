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
	$pOverallRating = 0;


	$sql = $conn->prepare("INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
		     			VALUES (?, ?, ?, ?, ?, ?)");
						$sql->bind_param('siiiss', $pName, $pPrice ,$pStock, $pOverallRating ,$pDescription, $folder);
						$sql->execute();

						if ($conn->query($sql) === TRUE) {
							echo "<h1 style='color:white'>Account created successfully!</h1>";
						} else {
						  	echo "<h1 style='color:white>Failed to create account1</h1>";
}
header("Location:  ../php/admin.php");
}
?>
