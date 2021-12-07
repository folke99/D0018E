<?php


  	//Check what button has been clicked
    
    $result =  mysqli_query($conn,"SELECT pName FROM products");


    while($row = mysqli_fetch_array($result)){

        if(isset($_POST[$row['pName']."Button"])){

	    	$amount = $_POST["amount"];
	    	$pName = $row['pName'];


	    	if ($amount > 0) {
	    	
	    		//Get pID
		        $get = mysqli_query($conn,"SELECT pID FROM products WHERE pName='$pName'");

		        if ($row = mysqli_fetch_array($get)) {
		          $pID = $row['pID'];
		        }


		        //Get uID
		        $uname = $_SESSION['username'];
		        $get = mysqli_query($conn,"SELECT uID FROM users WHERE uUserName='$uname'");

		        if ($row = mysqli_fetch_array($get)) {
		          $uID = $row['uID'];
		        }



		        //Get cID (The cart connected to the user)
		        $get = mysqli_query($conn,"SELECT cID FROM cart WHERE cuID='$uID'");

		        if ($row = mysqli_fetch_array($get)) {
		          $cID = $row['cID'];
		        }



		        //Get current quantity of the product
		        $get = mysqli_query($conn,"SELECT ciQuantity FROM cartItem WHERE ciID=$cID AND cipID=$pID");

	            if ($row = mysqli_fetch_array($get)) {
	              $ciQuantity = $row['ciQuantity'];
	            }


	            //Can't remove more than you have
	            //Instead removes the item from your cart
		        if (($ciQuantity - $amount) <= 0) {
		        	
		        	$delete = mysqli_query($conn, "DELETE FROM cartItem WHERE ciID=$cID and cipID=$pID");
		        	echo '<script>alert("Items removed!")</script>';
		        	header("Location:  shoppingCart.php");
		        }
		        else{

		        	//update cart

			    	$sql = "UPDATE cartItem SET ciQuantity=ciQuantity-$amount WHERE ciID=$cID AND cipID=$pID";

			        if ($conn->query($sql) === TRUE) {
			            echo '<script>alert("Items removed!")</script>';
			            header("Location:  shoppingCart.php");
			        } else {
			            
			            echo '<script>alert("Could not remove items")</script>';
			        }
		        }

		        

	    	}

        	break;
	    }
    }

?>