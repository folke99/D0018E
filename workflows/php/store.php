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
    
    .gridContainer .card a{
      width: 100%;
      padding: 0;
      margin: 0;
    }

    .gridContainer .card a img{
      margin: 0 auto;
    }

  </style>

</head>

<body>
  
  <?php
    session_start();
  ?>

  <header>
    
    <h1> Lorem Ipsum </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
      <li><a href="#" class="img"><img src="../images/cart.png"></a></li>
      <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li> 
   </ul>
    <p></p> 
  </div>
    

  <div id="content">
    
    <h1 class="space"></h1>

    <?php

      $servername = "utbweb.its.ltu.se";
      $username = "19980724";
      $password = "19980724";
      $dbName = "db19980724";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbName);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      //Check how many products are in the database
      $result =  mysqli_query($conn,"SELECT COUNT(*) FROM products");

      while($row = mysqli_fetch_array($result)){
        $max = $row['COUNT(*)'];
      }

      $i = 1;

      //Generate products to display (multiple of 3)

      while ($i < $max) {

        $p1 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i");
        $p2 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i+1");
        $p3 = mysqli_query($conn, "SELECT * FROM products WHERE pID=$i+2");

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

          //Product ID i+1
          $p2_ID = $row2['pID'];
          $p2_name = $row2['pName'];
          $p2_price = $row2['pPrice'];
          $p2_description = $row2['pDescription'];
          $p2_img = $row2['pImg'];

          //Product ID i+2
          $p3_ID = $row3['pID'];
          $p3_name = $row3['pName'];
          $p3_price = $row3['pPrice'];
          $p3_description = $row3['pDescription'];
          $p3_img = $row3['pImg'];

        }
       
      echo <<<HTML
        
        <div class="gridContainer">
      
          <div class="left">
            <div class="card">
              <a href="product.php?pID=$p1_ID" class="reviewPage"><img src="$p1_img" alt="$p1_name"></a>
              <h1> $p1_name </h1>
              <p class="price">$ $p1_price</p>
              <p class="description"> $p1_description </p>
              <p><button>Add to Cart</button></p>
            </div>
          </div>

          <div class="middle">
            <div class="card">
              <a href="product.php?pID=$p2_ID" class="reviewPage"><img src="$p2_img" alt="$p2_name"></a>
              <h1> $p2_name </h1>
              <p class="price">$ $p2_price</p>
              <p class="description"> $p2_description </p>
              <p><button>Add to Cart</button></p>
            </div>
          </div>

          <div class="right">
            <div class="card">
              <a href="product.php?pID=$p3_ID" class="reviewPage"><img src="$p3_img" alt="$p3_name"></a>
              <h1> $p3_name </h1>
              <p class="price">$ $p3_price</p>
              <p class="description"> $p3_description </p>
              <p><button>Add to Cart</button></p>
            </div>
          </div>

        </div>


      HTML; 
        
        $i = $i +3;
      }

      $conn->close();

    ?>

  </div> <!-- Content -->


  <footer>
    

  </footer>

</body>
</html>