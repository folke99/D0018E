<!DOCTYPE html>
<html>

<head>
    <meta name="shoppingCart" content="e-commerce" />
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/shoppingCart.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="icon" href="../images/fruitIcon.png">

    <style type="text/css">

        /* Taken from w3schools */
        /* https://www.w3schools.com/css/tryit.asp?filename=trycss_buttons_shadow */
        button{
          background-color: rgba(69, 162, 158, 1); /* Green */
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
        }
        button:hover {
          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
    </style>
    
</head>

<body>

    <?php
    session_start();
    include('databaseConnection.php');
    $uname = $_SESSION['username'];

    //Get user ID
    $uID_res = mysqli_query($conn, "SELECT * FROM users WHERE uUserName = '$uname'");
    while ($row0 = mysqli_fetch_array($uID_res)) {
        $uID = $row0['uID'];
        $uBalance = $row0['uBalance'];
    }
    echo $uBalance;
    echo $uID;

    include('adminAndBalanceCheck.php');
    ?>

    <header>

        <h1> Shopping Cart </h1>

    </header>

    <div id="menu">
        <ul>
          <li><a href="store.php">Home</a></li>
          <li><a href="../html/login.html" class="menuright">Logout</a></li>
          <?php 
          if ($adminCheck == 1) {
            echo "<li><a href='../php/admin.php' class='menuright'>ADMIN</a></li>";
          }
          ?> 
          <li><a href="shoppingCart.php" class="img"><img src="../images/cart.png"></a></li>
          <li> Items in cart: <?php include('itemsInCart.php'); ?> </li>
          <li> <span></span> Balance: $<?php echo $balanceCheck; ?> </li>
          <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li>
       </ul>
        <p></p> 
  </div>

    <div id="content">

        <?php
        error_reporting(error_reporting() & ~E_NOTICE);

        $nrOfItems =  mysqli_query($conn, "SELECT COUNT(*) FROM cartItem WHERE ciID=$uID");
        while ($row = mysqli_fetch_array($nrOfItems)) {
            $max = $row['COUNT(*)'];
        }

        $cart = mysqli_query($conn, "SELECT * FROM cartItem WHERE ciID=$uID");
        while ($row1 = mysqli_fetch_array($cart)) {
            //Product ID i
            $ciID = $row1['ciID'];
            $cipID = $row1['cipID'];
            $quantity = $row1['ciQuantity']; 

            $productInfo = mysqli_query($conn, "SELECT * FROM products WHERE pID=$cipID");

            while ($row2 = mysqli_fetch_array($productInfo)) {
                $pName = $row2['pName'];
                $pPrice = $row2['pPrice'] * $quantity;
                $totalPrice += $pPrice;
                $pImg = $row2['pImg'];
                $pDescription = $row2['pDescription'];
                $pButton = $pName . "Button";

echo <<<HTML
        <div class="gridContainer">  
            <div class="items">
                <div class="card">
                <img src="$pImg" alt="$pName" style="width: 150px; border-radius: 20px;">
                  <h1 style="color: black; font-weight: bolder;"> $pName </h1>
                  <p class="price" style="color: black; font-weight: bold;">      Price: $$pPrice</p>
                  <p class="description" style="color: black;">Quantity: $quantity</p>
                  <form method="POST">
                    <label for="amount"><h3>Remove Amount: </h3></label>
                    <input type="number" name="amount" min="0" value="0" style="width: 15%; required">
                    <p><button type="submit" name="$pButton" value="submit">Remove</button></p>
                  </form>
                </div>
            </div>

        </div>
HTML;
            }
        }

        include('removeFromCart.php');


        //Check if cart is empty

        $nrOfItems =  mysqli_query($conn, "SELECT COUNT(*) FROM cartItem WHERE ciID=$uID");
        while ($row = mysqli_fetch_array($nrOfItems)) {
            $max = $row['COUNT(*)'];
        }

        if ($max > 0) {
echo <<<HTML
        <form method="POST">
            <div class="checkout">
                <h1> Purchase </h1>
                <p> Total Price: $$totalPrice </p>
                <button type="submit" name="submit" value="submit"> Purchase </button>
            </div>
        </form>
HTML;
            include('purchase.php');
        }
        else
        {
echo <<<HTML
        <div class="checkout">
            <h1> Your cart is empty </h1>
        </div>
HTML;
        }


        ?>
    </div>
</body>

</html>