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
    $username = "19980724";
    $password = "19980724";
    $dbName = "db19980724";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbName);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			//Looks for usename in table
			$user_exist = "SELECT uUserName FROM users WHERE uUserName='$uname'";
			$user_exist_res = $conn->query($user_exist);

			//Checks if username is already in use
			if($user_exist_res->num_rows == 0){

				$sql = "INSERT INTO users (uUserName, uPassword)
				VALUES ('$uname', '$psw')";

				if ($conn->query($sql) === TRUE) {
					header("Location:  ../html/login.html");
				} else {
				  	echo "<h1 style='color:white>Failed to create account</h1>";
				}

			}
			else{
				echo "<h1 style='color:white'>Username already in use</h1>";
			}


			$conn->close();
		?>
        </center>
    </body>
</html>