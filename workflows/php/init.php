<html>
	<body>
		<?php
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
			            "ruID INT NOT NULL, ".
			            "rpID INT NOT NULL, ".
			            "rRating INT NOT NULL, ".
			            "rComment VARCHAR(100),".
			            "PRIMARY KEY ( ruID, rpID )); ";
			         if ($conn->query($sql)) {
			            printf("Table reviews created successfully.<br />");
			         }


			$sql = "CREATE TABLE products( ".
			            "pID INT NOT NULL AUTO_INCREMENT, ".
			            "pName VARCHAR(20) NOT NULL, ".
			            "pOverallRating INT NOT NULL, ".
			            "pPrice INT NOT NULL, ".
			            "pDescription VARCHAR(200) NOT NULL,".
			            "pImg VARCHAR(100) NOT NULL,".
			            "PRIMARY KEY ( pID )); ";
			         if ($conn->query($sql)) {
			            printf("Table products created successfully.<br />");
			         }
			         else{
			         	 printf("Error product table creation.<br />");
			         }

/****************************************************************************************************************************/

			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Apple', 1, 0, 'Rund röd grej går att äta', '../images/products/apple.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account1</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Banana',
							2,
							0,
							'Gul böjd grej, skala först!',
							'../images/products/banana.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account2</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Kiwi',
							3,
							0,
							'Hårig liten boll liknande frukt',
							'../images/products/kiwi.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account3</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Mango',
							4,
							0,
							'Gul på insidan, stor som en stor tennisboll',
							'../images/products/mango.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account4</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Orange',
							5,
							0,
							'Gul på utsidan, stor som en normalstor tennisboll',
							'../images/products/orange.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account5</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pOverallRating, pDescription, pImg)
					VALUES ('Pear',
							6,
							0,
							'Grön frukn som är päron formad',
							'../images/products/pear.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account6</h1>";
					}

			$conn->close();
		?>
	</body>
</html>