<!DOCTYPE html>
<html>

<head>
    <meta name="order" content="e-commerce" />
    <meta charset="utf-8">
    <title>Order</title>
    <link rel="stylesheet" href="../css/shoppingCart.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card.css">
    <link rel="icon" href="../images/fruitIcon.png">

    <style type="text/css">
        /* Taken from w3schools */
        /* https://www.w3schools.com/css/tryit.asp?filename=trycss_buttons_shadow */
        button {
            background-color: rgba(69, 162, 158, 1);
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
        }

        button:hover {
            box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .gridContainerOrder {
            display: grid;
            grid-template-areas:
                'order';
            grid-column-gap: 20px;
            margin-bottom: 50px;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
            padding-top: 15px;
        }

        /* The grid container */
        .gridContainer {
            display: grid;
            grid-template-areas:
                'left left middle middle right right';
            grid-column-gap: 20px;
            margin-bottom: 50px;
            margin-left: 20px;
            margin-right: 20px;
            text-align: center;
            padding-top: 15px;
        }

        .left,
        .middle,
        .right {
            padding: 10px;
            background-color: rgba(69, 162, 158, 0);
            border-radius: 15px;
            text-align: center;
        }

        /* Style the left column */
        .left {
            grid-area: left;
        }

        /* Style the middle column */
        .middle {
            grid-area: middle;
        }

        /* Style the right column */
        .right {
            grid-area: right;
        }

        .left img {
            width: 200px;
            border-radius: 10px;
        }

        .right button {
            background-color: black;
        }

        .items2 {
            display: block;
            width: 90%;
            background-color: rgba(69, 162, 158, 0.7);
        }

        .order {
            display: block;
            width: 100%;
            background-color: red;
        }
    </style>

</head>

<body>

    <?php
    session_start();
    include('databaseConnection.php');
    $uname = $_SESSION['username'];
    $productArray = array();

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

        <h1> Orders </h1>

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
            <li><a href="viewOrder.php">Orders</a></li>
        </ul>
        <p></p>
    </div>

    <div id="content">


        <?php
        error_reporting(error_reporting() & ~E_NOTICE);

        //Get order
        $order = mysqli_query($conn, "SELECT * FROM orderTable WHERE ouID = $uID");
        while ($row1 = mysqli_fetch_array($order)) {
            $oID = $row1['oID'];
            $ouID = $row1['ouID'];
            $oStatus = $row1['oStatus'];
            $oPrice = $row1['oPrice'];

            echo <<<HTML


    <div class="gridContainerOrder">
        <div class="order">
        

HTML;

            //Get orderItem
            $orderItem = mysqli_query($conn, "SELECT * FROM orderItem WHERE oiID = $oID");
            while ($row2 = mysqli_fetch_array($orderItem)) {
                $oipID = $row2['oipID'];
                $oiPrice = $row2['oiPrice'];
                $oiQuantity = $row2['oiQuantity'];

                /*
                array_push($productArray, $oipID);
                array_push($productArray, $oiPrice);
                array_push($productArray, $oiQuantity);

                for ($i = 0; $i < sizeof($productArray); $i += 3) {
                    $oipIDFromArray      = $productArray[$i];
                    $oiPriceFromArray    = $productArray[$i + 1];
                    $oiQuantityFromArray = $productArray[$i + 2];
                */

                echo <<<HTML
<center>
            <div class="items2">
                <div class="gridContainer">
                    <div class="left">
                        <p>Total price: $oPrice</p>
                    </div>

                    <div class="middle">
                        <p>ProductID: $oipID</p>
                        <p>Quantity: $oiQuantity</p>
                        <p>Price: $oiPrice</p>
                    </div>

                    <div class="right">
                        <p>Status: $oStatus</p>
                    </div>
                </div>
            </div>
</center>
        </div>
        </div>
HTML;
                //}
            }
        }


        //Check if order is empty

        $nrOfItems =  mysqli_query($conn, "SELECT COUNT(*) FROM orderTable WHERE ouID = $uID");
        while ($row = mysqli_fetch_array($nrOfItems)) {
            $max = $row['COUNT(*)'];
        }

        if ($max == 0) {
            echo <<<HTML
            <div class="checkout">
                <h1> You haven't ordered anything yet </h1>
            </div>
HTML;
        }
        ?>
    </div>
</body>

</html>