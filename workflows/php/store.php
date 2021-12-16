<!DOCTYPE html>
<html>

<head>
  <meta name="Store" content="e-commerce" />
  <meta charset="utf-8">
  <link rel="icon" href="../images/fruitIcon.png">
  <title>Store</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/menu.css">
  <link rel="stylesheet" href="../css/grid.css">
  <link rel="stylesheet" href="../css/card.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">

  <style type="text/css">

    .gridContainer .card{
      border-radius: 10px;
    }
    
    .gridContainer .card a{
      width: 100%;
      padding: 5px;
      margin-bottom: 3px;
      border-radius: 10px;
      transition: 0.3s;
    }

    .gridContainer .card a img{
      margin: 0 auto;
      border-radius: 10px;
    }

    .gridContainer .card a:hover{
      transform: scale(1.05);
    }

  </style>

</head>

<body>
  
  <?php
    include('databaseConnection.php');
    session_start();
    $uname = $_SESSION['username'];

    include('adminAndBalanceCheck.php');

  ?>

  <header>
    
    <h1> Store </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="#">Home</a></li>
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
    
    <h1 class="space"></h1>

    <?php

      //Check how many products are in the database
      $result =  mysqli_query($conn,"SELECT COUNT(*) FROM products");

      while($row = mysqli_fetch_array($result)){
        $max = $row['COUNT(*)'];
      }

      $i = 1;         //loop variable
      $counter = 1;   //reset after 3 to create a new gridContainer


      //Add all pID to a array

      $productList = array();

      $p = mysqli_query($conn, "SELECT pID FROM products");
      while($row = mysqli_fetch_array($p)) {
        $productList[] = $row[0];
      }




      //Get products and rating from db

      while ($i <= $max) {

        $currentProductID = $productList[$i-1];

        include('getProducts.php');
        include('checkRating.php');
        

        //Check grid position

        if ($counter == 1) {
          $location = "left";
          $counter += 1;
        }
        else if ($counter == 2) {
          $location = "middle";
          $counter += 1;
        }
        else if ($counter == 3) {
          $location = "right";
          $counter = 1;
        }



        //Stock check
        $get = mysqli_query($conn,"SELECT pStock FROM products WHERE pID='$p_ID'");

        if ($row = mysqli_fetch_array($get)) {
          $p_stock = $row['pStock'];
        }

        if ($p_stock == 0) {
          $p_price = "Out of Stock";
        }




        /** Generate webpage **/

        if ($location == "left") {
          echo '<div class="gridContainer">';
        }

echo <<<HTML
        
      
          <div class="$location">
            <div class="card">
              <a href="product.php?pID=$p_ID" class="reviewPage"><img src="$p_img" alt="$p_name"></a>
              <h1> $p_name </h1>
              <p class="price">$ $p_price</p>
              <p class="description"> $p_description </p>
              <p class="rating"> Rating: $averageRating </p>
              <p class="rating"> Reviews: $countReviews </p>
              <form method="POST">
                <label for="amount"><h3>Select Amount</h3></label>
                <input type="number" name="amount" min="1" value="1" style="width: 15%; required">
                <p><button type="submit" name="$p_button" value="submit" >Add to Cart</button></p>
              </form>
            </div>
          </div>
          
HTML;
      
      if ($location == "right") {
        echo '</div>';
      }

        $i = $i +1;
      }

      include('addToCart.php');

       

      $conn->close();

    ?>

  </div> <!-- Content -->


  <footer>
    

  </footer>

</body>
</html>