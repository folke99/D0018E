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
			$uname 	  = $_GET["uname"];
			$psw 	  = $_GET["psw"];
			$admin 	  = $_GET["admin"];
			$uBalance = $_GET["uBalance"];
			$uID = "";
			$user_exist_res[] = "";
			
			include('databaseConnection.php');
			$user_exist = $conn->prepare("SELECT uUserName FROM users WHERE uUserName=?");
			$user_exist->bind_param('s', $uname);
			$user_exist->execute();
			$user_exist->bind_result($unames);
			//echo $user_exist->fetch();
	        while ($user_exist->fetch()) {
	        	
	        	array_push($user_exist_res, $unames);

	        }
	        $user_exist->free_result();

			if(count($user_exist_res)>1){

				echo "<h1 style='color:white'>Username already in use</h1>";

			}
			else{
				$sql = $conn->prepare("INSERT INTO users (uUserName, uPassword, uIsAdmin, uBalance)
				VALUES (?, ?, ?, ?)");
				$sql->bind_param('ssii', $uname, $psw ,$admin ,$uBalance);
				$sql->execute();

				if ($sql == TRUE) {
					//Create a shopping cart for the user
					$get = $conn->prepare("SELECT uID FROM users WHERE uUserName=?");
					$get->bind_param('s', $uname);
					$get->execute();
					$get->bind_result($uIDs);

			        if ($get->fetch()) {
			          $uID = $uIDs;
			        }
			        $get->free_result();
			        echo $uID;

			        $add = "INSERT INTO cart (cuID)
					VALUES ($uID)";

			        if ($conn->query($add) === TRUE) { 
			        	header("Location:  ../html/login.html");
			        } else {
			        	echo "<h1 style='color:white'>Failed to create shopping cart</h1>";
			        	$delete = mysqli_query($conn, "DELETE FROM users WHERE uID = $uID");
			        }
				} else {
				  	echo "<h1 style='color:white'>Failed to create account</h1>";
				}			
			}
			

			$conn->close();
		?>
        </center>
    </body>
</html>