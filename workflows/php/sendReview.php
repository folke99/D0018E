<?php
	session_start();

    $rComment = $_GET["rComment"];
    $rRating = $_GET["rRating"];
	$pID = $_GET['pID'];
	$uname = $_SESSION['username'];
	include('databaseConnection.php');

	$userID = mysqli_query($conn, "SELECT uID FROM users WHERE uUserName = '$uname'");
	if (!$userID) {
		printf("Error: %s\n", mysqli_error($conn));
		exit();
	}

	if($row = mysqli_fetch_array($userID)){

		$uID = $row['uID'];
	}

	$sql = "INSERT INTO reviews (ruID, rpID, rRating, rComment)
    VALUES ('$uID', '$pID', '$rRating', '$rComment')";

	if ($conn->query($sql) == TRUE) {
		header("Location:  product.php?pID=$pID");
	} else {
	  echo "<h1 style='color:Black>Failed to create review</h1>";
}

    $conn->close();

?>