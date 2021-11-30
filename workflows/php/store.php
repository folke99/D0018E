<!DOCTYPE html>
<html>

<head>
  <meta name="Store" content="e-commerce" />
  <meta charset="utf-8">
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
    echo $_SESSION['username'];
    $admin = mysqli_query($conn, "SELECT uIsAdmin FROM users WHERE uUserName=$uname");
    while($adminRow = mysqli_fetch_array($admin))
    {
      $adminCheck = $adminRow['uIsAdmin'];
    }
  ?>

  <header>
    
    <h1> Lorem Ipsum </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
      <li><a href="shoppingCart.php" class="img"><img src="../images/cart.png"></a></li>
      <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li>
      <?php 
      if ($adminCheck == 1) {
        echo "<li><a href='../html/admin.html' class='menuright'>ADMIN</a></li>";
      }
      ?> 
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

      $i = 1;   //loop variable





      //Get products and rating from db (multiple of 3)

      while ($i < $max) {

        //products
        $p1 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i");
        $p2 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i+1");
        $p3 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i+2");


        //rating
        $r1 = mysqli_query($conn, "SELECT rRating FROM reviews WHERE rpID=$i");
        $r2 = mysqli_query($conn, "SELECT rRating FROM reviews WHERE rpID=$i+1");
        $r3 = mysqli_query($conn, "SELECT rRating FROM reviews WHERE rpID=$i+2");

        $c1 = mysqli_query($conn, "SELECT COUNT(*) FROM reviews WHERE rpID=$i");
        $c2 = mysqli_query($conn, "SELECT COUNT(*) FROM reviews WHERE rpID=$i+1");
        $c3 = mysqli_query($conn, "SELECT COUNT(*) FROM reviews WHERE rpID=$i+2");








        /** Check Rating **/

        $totRating1 = 0;
        $totRating2 = 0;
        $totRating3 = 0;
        $count1 = 0;
        $count2 = 0;
        $count3 = 0;

        while($rowR1 = mysqli_fetch_array($r1)){ 

          if ($rowC1 = mysqli_fetch_array($c1)) {
            $totRating1 += $rowR1['rRating'];
            $count1 = $rowC1['COUNT(*)'];
          }
          
        }

        while($rowR2 = mysqli_fetch_array($r2)) {
          
          if ($rowC2 = mysqli_fetch_array($c2)) {
            $totRating2 += $rowR2['rRating'];
            $count2 = $rowC2['COUNT(*)'];
          }
        }

        while ($rowR3 = mysqli_fetch_array($r3)) {
          
          if ($rowC3 = mysqli_fetch_array($c3)) {
            $totRating3 += $rowR3['rRating'];
          $count3 = $rowC3['COUNT(*)'];
          }
        }

        if($count1 != 0)
          $average1 = $totRating1/$count1;
        else
          $average1 = 0;

        if($count2 != 0)
          $average2 = $totRating2/$count2;
        else
          $average2 = 0;

        if($count3 != 0)
          $average3 = $totRating3/$count3;
        else
          $average3 = 0;








        /** Get products from database **/

       while($row1 = mysqli_fetch_array($p1) and
            $row2 = mysqli_fetch_array($p2) and
            $row3 = mysqli_fetch_array($p3) 
            ){


          //Product ID i
          $p1_ID = $row1['pID'];
          $p1_name = $row1['pName'];
          $p1_price = $row1['pPrice'];
          $p1_description = $row1['pDescription'];
          $p1_img = $row1['pImg'];
          $p1_button = $p1_name . "Button";

          //Product ID i+1
          $p2_ID = $row2['pID'];
          $p2_name = $row2['pName'];
          $p2_price = $row2['pPrice'];
          $p2_description = $row2['pDescription'];
          $p2_img = $row2['pImg'];
          $p2_button = $p2_name . "Button";

          //Product ID i+2
          $p3_ID = $row3['pID'];
          $p3_name = $row3['pName'];
          $p3_price = $row3['pPrice'];
          $p3_description = $row3['pDescription'];
          $p3_img = $row3['pImg'];
          $p3_button = $p3_name . "Button";

        }





        /** Generate webpage **/
       
echo <<<HTML
        
        <div class="gridContainer">
      
          <div class="left">
            <div class="card">
              <a href="product.php?pID=$p1_ID" class="reviewPage"><img src="$p1_img" alt="$p1_name"></a>
              <h1> $p1_name </h1>
              <p class="price">$ $p1_price</p>
              <p class="description"> $p1_description </p>
              <p class="rating"> Rating: $average1 </p>
              <p class="rating"> Reviews: $count1 </p>
              <form method="POST">
                <p><button type="submit" name="$p1_button" value="submit">Add to Cart</button></p>
              </form>
            </div>
          </div>

          <div class="middle">
            <div class="card">
              <a href="product.php?pID=$p2_ID" class="reviewPage"><img src="$p2_img" alt="$p2_name"></a>
              <h1> $p2_name </h1>
              <p class="price">$ $p2_price</p>
              <p class="description"> $p2_description </p>
              <p class="rating"> Rating: $average2 </p>
              <p class="rating"> Reviews: $count2 </p>
              <form method="POST">
                <p><button type="submit" name="$p2_button" value="submit">Add to Cart</button></p>
              </form>
              
            </div>
          </div>

          <div class="right">
            <div class="card">
              <a href="product.php?pID=$p3_ID" class="reviewPage"><img src="$p3_img" alt="$p3_name"></a>
              <h1> $p3_name </h1>
              <p class="price">$ $p3_price</p>
              <p class="description"> $p3_description </p>
              <p class="rating"> Rating: $average3 </p>
              <p class="rating"> Reviews: $count3 </p>
              <form method="POST">
                <p><button type="submit" name="$p3_button" value="submit">Add to Cart</button></p>
              </form>
            </div>
          </div>

        </div>


HTML;
        
        $i = $i +3;
      }

      include('addToCart.php');

       

      $conn->close();

    ?>

  </div> <!-- Content -->


  <footer>
    

  </footer>

</body>
</html>