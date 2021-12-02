<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<?php

        $p = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i");


           while($row = mysqli_fetch_array($p)){

           	  	//Product ID i
	          $p_ID = $row['pID'];
	          $p_name = $row['pName'];
	          $p_price = $row['pPrice'];
	          $p_description = $row['pDescription'];
	          $p_img = $row['pImg'];
	          $p_button = $p_name . "Button";
           }

	?>

</body>
</html>