<?php
	session_start();

    $rComment = $_GET["rComment"];
    $rRating = $_GET["rRating"];
	$username = $_SESSION['username'];
	$pID = $_GET['product'];

    $servername = "utbweb.its.ltu.se";
	$username = "19980724";
	$password = "19980724";
	$dbName = "db19980724";

    // Create connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$userID = mysqli_query($conn, "SELECT uID FROM users WHERE uUserName = $username");
	while($row = mysqli_fetch_array($userID)){

		$uID = $row['uID'];
	}

	$sql = "INSERT INTO reviews (uID, pID, rRating, rComment)
    VALUES ('$uID', '$pID', '$rRating', '$rComment')";

	if ($conn->query($sql) == TRUE) {
		header("Location:  product.php");
	} else {
	  echo "<h1 style='color:Black>Failed to create account</h1>";
}

    $conn->close();

?>