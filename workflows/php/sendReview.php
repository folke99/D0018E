<?php
	session_start();

    $rComment = $_GET["rComment"];
    $rRating = $_GET["rRating"];
	$pID = $_GET['pID'];
	$uname = $_SESSION['username'];
	include('databaseConnection.php');
	$uID="";

	$userID = $conn->prepare("SELECT uID FROM users WHERE uUserName = ?");
	$userID->bind_param('s', $uname);
	$userID->execute();
	$userID->bind_result($unames);
	while ($userID->fetch()) {    	
	  	$uID =$unames;
	}

	$sql = $conn->prepare("INSERT INTO reviews (ruID, rpID, rRating, rComment)
	VALUES (?, ?, ?, ?)");
	$sql->bind_param('iiis', $uID, $pID, $rRating, $rComment);
	$sql->execute();



	if($sql)
		header("Location:  product.php?pID=$pID");
	else
		echo "<h1 style='color:Black>Failed to create review</h1>";

    $conn->close();

?>