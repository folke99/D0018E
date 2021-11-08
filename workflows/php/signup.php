<html>
	<body>
		<?php
			$uname = $_GET["uname"];
			$psw = $_GET["psw"];
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

			$sql = "INSERT INTO users (uUserName, uPassword)
			VALUES ('$uname', '$psw')";
			if ($conn->query($sql) === TRUE) {
			  echo "New record created successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . $conn->error;
			}

			echo $uname;
			echo $psw;

			$conn->close();
		?>
	</body>
</html>