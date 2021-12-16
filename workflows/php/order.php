<?php
    include('databaseConnection.php');
    $uname = $_SESSION['username'];
    $totalPriceOrder = 0;

    $p = mysqli_query($conn, "SELECT uID FROM users WHERE uUserName=$uname");
    if($row = mysqli_fetch_array($p)){
      $uID = $row['uID'];
    }

    $sql = "INSERT INTO orderTable (ouID, oStatus, oPrice)
            VALUES ($uID, 'Order Processing', 0)";
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                echo $last_id;
                echo "<h1 style='color:white'>Account created successfully!</h1>";

                $cart = mysqli_query($conn, "SELECT * FROM cartItem WHERE ciID=$uID");
                while ($row1 = mysqli_fetch_array($cart)) {
                    $oipID = $row1['cipID'];
                    $oiQuantity = $row1['ciQuantity'];

                    $productInfo = mysqli_query($conn, "SELECT * FROM products WHERE pID=$oipID");
                    if ($row2 = mysqli_fetch_array($productInfo)) {
                        $oiPrice = $row2['pPrice'] * $oiQuantity;
                        $totalPriceOrder += $oiPrice;
                    }

                    $sql = "INSERT INTO orderItem (oiID, oipID, oiPrice, oiQuantity)
                            VALUES($last_id, $oipID, $oiPrice, $oiQuantity)";

                            if ($conn->query($sql) === TRUE) {
                                echo "hej";
                        }
                }
                $sql = "UPDATE orderTable SET oPrice = $totalPriceOrder WHERE oID = $last_id";
                        if ($conn->query($sql) === TRUE) {
                            echo "inserted totprice";
                        }
            } 
            else {
                echo "<script>alert('Failed to create order table')</script>";
            }
?>
