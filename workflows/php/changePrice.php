<?php
	
	session_commit();

	$pNewPrice = $_GET["pNewPrice"];
	$pID = $_GET["pID"];
	include('databaseConnection.php');


	$sql = $conn->prepare("UPDATE products SET pPrice = ? WHERE pID = ?");

	if (!$sql) {
	    printf("Error: %s\n", mysqli_error($conn));
	    exit();
	}

	$sql->bind_param('ii', $pNewPrice, $pID);
	$sql->execute();
	
	if ($sql == TRUE) {
		echo "<h1 style='color:white'>Price updated!</h1>";
	} else {
	  	echo "<h1 style='color:white>Error</h1>";
	}
	header("Location:  ../php/admin.php");

?>