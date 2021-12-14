
<?php
	session_commit();

	$pNewStock = $_GET["pNewStock"];
	$pID = $_GET["pID"];
	include('databaseConnection.php');

	$sql = $conn->prepare("UPDATE products SET pStock = ? WHERE pID = ?");
	if (!$sql) {
	    printf("Error: %s\n", mysqli_error($conn));
	    exit();
	}
	$sql->bind_param('ii', $pNewStock, $pID);
	$sql->execute();
	
	if ($conn->query($sql) === TRUE) {
		echo "<h1 style='color:white'>New stock added</h1>";
	} else {
	  	echo "<h1 style='color:white>Error</h1>";
	}
	header("Location:  ../php/admin.php");
?>