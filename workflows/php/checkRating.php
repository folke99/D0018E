<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<?php
		
		//rating
        $rating = mysqli_query($conn, "SELECT rRating FROM reviews WHERE rpID=$i");
        $amountOfReviews = mysqli_query($conn, "SELECT COUNT(*) FROM reviews WHERE rpID=$i");


        /** Check Rating **/

        $totRating = 0;
        $countReviews = 0;


        while($rowR = mysqli_fetch_array($rating)){ 

          if ($rowC = mysqli_fetch_array($amountOfReviews)) {
            $totRating += $rowR['rRating'];
            $countReviews = $rowC['COUNT(*)'];
          }
          
        }      

        if($countReviews != 0)
          $averageRating = $totRating/$countReviews;
        else
          $averageRating = 0;

	?>

</body>
</html>