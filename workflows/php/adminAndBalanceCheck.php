<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<?php

		//Admin Check
	    $admin = mysqli_query($conn, "SELECT uIsAdmin FROM users WHERE uUserName='$uname'");
	    while($adminRow = mysqli_fetch_array($admin))
	    {
	      $adminCheck = $adminRow['uIsAdmin'];
	    }

	    //Balance Check
	    $balance = mysqli_query($conn, "SELECT uBalance FROM users WHERE uUserName='$uname'");
	    while($balanceRow = mysqli_fetch_array($balance))
	    {
	      $balanceCheck = $balanceRow['uBalance'];
	    }


	?>

</body>
</html>