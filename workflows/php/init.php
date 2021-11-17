<html>
	<body>
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbName = "D0018E";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbName);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			$sql = "CREATE TABLE users( ".
			            "uID INT NOT NULL AUTO_INCREMENT, ".
			            "uUserName VARCHAR(20) NOT NULL, ".
			            "uPassword VARCHAR(20) NOT NULL, ".
			            "PRIMARY KEY ( uID )); ";
			         if ($conn->query($sql)) {
			            printf("Table users created successfully.<br />");
			         }

			$sql = "CREATE TABLE cart( ".
			            "uID INT NOT NULL,".
			            "pID INT NOT NULL, ".
			            "pPrice INT NOT NULL, ".
			            "cQuantity INT NOT NULL,".
			            "PRIMARY KEY ( uID )); ";
			         if ($conn->query($sql)) {
			            printf("Table cart created successfully.<br />");
			         }
			$sql = "CREATE TABLE reviews( ".
			            "uID INT NOT NULL, ".
			            "pID INT NOT NULL, ".
			            "rRating INT NOT NULL, ".
			            "rComment VARCHAR(100),".
			            "PRIMARY KEY ( uID, pID )); ";
			         if ($conn->query($sql)) {
			            printf("Table reviews created successfully.<br />");
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

/****************************************************************************************************************************/

			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Apple', 1, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Bannana', 2, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Kiwi', 3, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Mango', 4, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Orange', 5, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating)
					VALUES ('Pear', 6, 0)";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account</h1>";
					}

			$conn->close();
		?>
	</body>
</html>