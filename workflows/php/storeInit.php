<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbName = "d0018e";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbName);
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$sql = "CREATE TABLE products( ".
		            "pID INT NOT NULL AUTO_INCREMENT, ".
		            "pName VARCHAR(20) NOT NULL, ".
		            "pOverallRating INT NOT NULL, ".
		            "pPrice INT NOT NULL, ".
		            "PRIMARY KEY ( pID )); ";
		         if ($conn->query($sql)) {
		            printf("Table products created successfully.<br />");
		         }

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Apple', 1)";

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Bannana', 2)";

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Kiwi', 3)";

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Mango', 4)";

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Orange', 5)";

		$sql = "INSERT INTO products (pName, pPrice)
				VALUES ('Pear', 6)";

		$sql = "CREATE TABLE reviews( ".
			            "rID NULL AUTO_INCREMENT".
			            "uID INT NOT, ".
			            "pID INT NOT NULL, ".
			            "rRating INT NOT NULL, ".
			            "rComment INT NOT NULL, ".
			            "PRIMARY KEY ( pID )); ";
			         if ($conn->query($sql)) {
			            printf("Table products created successfully.<br />");
		}
	?>
</body>
</html>