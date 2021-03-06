<html>
	<body>
		<?php
			include('databaseConnection.php');
			$sql = "CREATE TABLE users( ".
			            "uID INT NOT NULL AUTO_INCREMENT, ".
			            "uUserName VARCHAR(20) NOT NULL, ".
			            "uPassword VARCHAR(20) NOT NULL, ".
			            "uIsAdmin BIT NOT NULL,".
						"uBalance INT NOT NULL,".
			            "PRIMARY KEY ( uID )); ";
			         if ($conn->query($sql)) {
			            printf("Table users created successfully.<br />");
			         }

			$sql = "CREATE TABLE cart( ".
			            "cID INT NOT NULL AUTO_INCREMENT,".
			            "cuID INT NOT NULL,".
			            "PRIMARY KEY (cID)); ";
			         if ($conn->query($sql)) {
			            printf("Table cart created successfully.<br />");
			         }
			         else{
			         	echo "cart not successfull";
			         }

			$sql = "CREATE TABLE cartItem( ".
			            "ciID INT NOT NULL,".
			            "cipID INT NOT NULL, ".
			            "ciQuantity INT NOT NULL);";
			         if ($conn->query($sql)) {
			            printf("Table cart created successfully.<br />");
			         }


			$sql = "CREATE TABLE orderTable( ".
			            "oID INT NOT NULL AUTO_INCREMENT,".
			            "ouID INT NOT NULL,".
			            "oStatus VARCHAR(20),".
			            "oPrice INT NOT NULL,".
			            "PRIMARY KEY (oID)); ";
			         if ($conn->query($sql)) {
			            printf("Table order created successfully.<br />");
			         }
			         else{
			         	echo "order not successfull";
			         }


			$sql = "CREATE TABLE orderItem( ".
			            "oiID INT NOT NULL,".
			            "oipID INT NOT NULL, ".
			            "oipName VARCHAR(20), ".
			            "oiPrice INT NOT NULL, ".
			            "oiQuantity INT NOT NULL);";
			         if ($conn->query($sql)) {
			            printf("Table orderItem created successfully.<br />");
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
			            "pPrice INT NOT NULL, ".
						"pStock INT NOT NULL, ".
						"pOverallRating INT NOT NULL, ".
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

			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Apple', 
						1, 
						1000, 
						0, 
						'Rund r??d grej g??r att ??ta', 
						'../images/products/apple.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account1</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Banana',
							2,
							1000,
							0,
							'Gul b??jd grej, skala f??rst!',
							'../images/products/banana.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account2</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Kiwi',
							3,
							1000,
							0,
							'H??rig liten boll liknande frukt',
							'../images/products/kiwi.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account3</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Mango',
							4,
							1000,
							0,
							'Gul p?? insidan, stor som en stor tennisboll',
							'../images/products/mango.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account4</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Orange',
							5,
							1000,
							0,
							'Gul p?? utsidan, stor som en normalstor tennisboll',
							'../images/products/orange.png')";

					if ($conn->query($sql) === TRUE) {
						echo "<h1 style='color:white'>Account created successfully!</h1>";
					} else {
					  	echo "<h1 style='color:white>Failed to create account5</h1>";
					}
			$sql = "INSERT INTO products (pName, pPrice, pStock, pOverallRating, pDescription, pImg)
					VALUES ('Pear',
							6,
							1000,
							0,
							'Gr??n frukn som ??r p??ron formad',
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