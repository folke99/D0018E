<?php
	
	$p = mysqli_query($conn, "SELECT * FROM products");

	echo "<ul>";

   	while($row = mysqli_fetch_array($p)){
      $pID = $row['pID'];
      $pName = $row['pName'];

      echo "<li> $pID: $pName </li>";

     }

    echo "</ul>";

?>