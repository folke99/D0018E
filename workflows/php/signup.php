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
			$admin = $_GET["admin"];
			
			include('databaseConnection.php');

			//Looks for usename in table
			$user_exist = "SELECT uUserName FROM users WHERE uUserName='$uname'";
			$user_exist_res = $conn->query($user_exist);

			//Checks if username is already in use
			if($user_exist_res->num_rows == 0){

				$sql = "INSERT INTO users (uUserName, uPassword, uIsAdmin)
				VALUES ('$uname', '$psw', $admin)";

				if ($conn->query($sql) === TRUE) {

					//Create a shopping cart for the user
					$get = mysqli_query($conn,"SELECT uID FROM users WHERE uUserName='$uname'");

			        if ($row = mysqli_fetch_array($get)) {
			          $uID = $row['uID'];
			        }

			        $add = "INSERT INTO cart (cuID)
			          VALUES ($uID)";

			         if ($conn->query($add) === TRUE) {
			        } else {
			        }

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