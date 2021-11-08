<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/createAccount.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
        	html{
        		padding-top: 10%;
        	}

        </style>
    </head>
    <body>
        <center>
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
			  echo "<h1 style='color:white'>Account created successfully!</h1>";
			} else {
			  echo "<h1 style='color:white>Failed to create account</h1>";
			}

			$conn->close();
		?>
		<a href="../html/index.html">
        	<button class="createAccountButton" type="submit">Go to home page</button>
        </a>
        </center>
    </body>
</html>