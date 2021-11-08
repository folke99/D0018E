<html>
	<body>
		<?php
			$servername = "utbweb.its.ltu.se";
			$username = "19990719";
			$password = "19990719";
			$dbName = "db19990719";

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

			$sql = "CREATE TABLE products( ".
			            "pID INT NOT NULL AUTO_INCREMENT, ".
			            "pName VARCHAR(100) NOT NULL, ".
			            "pOverallRating DOUBLE NOT NULL, ".
			            "pPrice INT NOT NULL,".
			            "PRIMARY KEY ( pID )); ";
			         if ($conn->query($sql)) {
			            printf("Table products created successfully.<br />");
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


			$sql = "CREATE TABLE review( ".
			            "uID INT NOT NULL, ".
			            "pID INT NOT NULL, ".
			            "rRating INT NOT NULL, ".
			            "rComment VARCHAR(100),".
			            "PRIMARY KEY ( uID, pID )); ";
			         if ($conn->query($sql)) {
			            printf("Table review created successfully.<br />");
			         }
			$conn->close();
		?>
	</body>
</html>