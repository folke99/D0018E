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
			            "uUserName VARCHAR(100) NOT NULL, ".
			            "uPassword VARCHAR(40) NOT NULL, ".
			            "PRIMARY KEY ( uID )); ";
			         if ($conn->query($sql)) {
			            printf("Table tutorials_tbl created successfully.<br />");
			         }

			$sql = "INSERT INTO users (Uusername, Upassword)
			VALUES (uname, psw)";
			// Create database
			/*$sql = "CREATE DATABASE myDB";
			if ($conn->query($sql) === TRUE) {
			  echo "Database created successfully";
			} else {
			  echo "Error creating database: " . $conn->error;
			}*/

			$conn->close();
		?>
	</body>
</html>