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

        /* The grid container */
        .gridContainer {
            display: grid;
            grid-template-areas:
                'left left middle middle right right';
            grid-column-gap: 20px;
            margin-bottom: 10px;
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

        .order{
            border: 2px white solid;
            border-radius: 10px;
            margin-bottom: 20px;
            padding-top: 10px;
        }

        .order h1, h2, h3{
            text-align: center;
            color: white;
        }

        .order p{
            text-align: center;
        }

        .changeStatus{
            width: 50%;
            text-align: center;
            margin: auto;
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

    include('adminAndBalanceCheck.php');
    ?>

    <header>

        <h1> Orders </h1>

    </header>

    <div id="menu">
        <ul>
            <li><a href="store.php">Home</a></li>
            <li><a href="viewOrder.php">Orders</a></li>
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

        //Get order
        $order = mysqli_query($conn, "SELECT * FROM orderTable");
        while ($row1 = mysqli_fetch_array($order)) {
            $oID = $row1['oID'];
            $ouID = $row1['ouID'];
            $oStatus = $row1['oStatus'];
            $oPrice = $row1['oPrice'];

            //Get username
            $user = mysqli_query($conn, "SELECT uUserName FROM users WHERE uID=$ouID");
            if ($rowName = mysqli_fetch_array($user)) {
                $uName = $rowName['uUserName'];
            }


echo <<<HTML

    <div class="order">
    <h1> OrderID: $oID </h1>
    <h2> Username: $uName </h2>

HTML;

            //Get orderItem
            $orderItem = mysqli_query($conn, "SELECT * FROM orderItem WHERE oiID = $oID");
            while ($row2 = mysqli_fetch_array($orderItem)) {
                $oipID = $row2['oipID'];
                $oiPrice = $row2['oiPrice'];
                $oiQuantity = $row2['oiQuantity'];
                $oipName = $row2['oipName'];



echo <<<HTML
<center>
            <div class="items2">
                <div class="gridContainer">

                    <div class="middle">
                        <p>Product: $oipName</p>
                        <p>Quantity: $oiQuantity</p>
                        <p>Price: $oiPrice</p>
                    </div>

                </div>
            </div>
</center>

HTML;
            }

echo <<<HTML
    
    <p>Total price: $oPrice</p>
    <p>Current Status: $oStatus</p>
    <br>


    <h3> Change Status: </h3>

    <div class="changeStatus">
        <form action="?">
            <input type="hidden" name="oID" value="$oID">
            <select name="status">
                <option value="Order Processing"> Order Processing </option>
                <option value="Shipped"> Shipped </option>
            </select>

            <button> Submit </button>

        </form>
    </div>

    </div>

HTML;
                

        }


        echo $oID;

        if (isset($_GET['status'])) {
            $updateStatus = $_GET['status'];
            $ID = $_GET['oID'];

            $sql = mysqli_query($conn, "UPDATE orderTable SET oStatus = '$updateStatus' WHERE oID = $ID");
            if ($conn->query($sql) === TRUE) {
            }
            else{
                echo '<script>';
                echo 'window.location = "manageOrders.php"';
                echo '</script>';
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