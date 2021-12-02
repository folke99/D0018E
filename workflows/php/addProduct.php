<?php
include('databaseConnection.php');
session_start();
$pName = $_GET["pName"];
$pPrice = $_GET["pPrice"];
$pDescription = $_GET["pDescription"];
$img = $_GET["img"];
echo $img;
echo "hej";

$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ($pName, $pPrice, 0, $pDescription, '../images/products/apple.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Product created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Product to create account1</h1>";
					}

//header("Location:  ../php/admin.php");
?>