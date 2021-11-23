<!DOCTYPE html>
<html>

<head>
  <meta name="Store" content="e-commerce" />
  <meta charset="utf-8">
  <title>Store</title>
  <link rel="stylesheet" href="../css/product.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/menu.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">

</head>

<body>

  <?php
    session_start();

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

    $pID = $_GET["pID"];

    $array = array();

    $reviews = mysqli_query($conn, "SELECT ruID, rRating, rComment FROM reviews WHERE rpID=$pID");

    while($row = mysqli_fetch_array($reviews)){
        
      $ruID = $row['ruID'];
      $rRating = $row['rRating'];
      $review = $row['rComment'];

      $users = mysqli_query($conn, "SELECT uUserName FROM users WHERE uID='$ruID'");
      if($row1 = mysqli_fetch_array($users)){
        $uUserName = $row1['uUserName'];
      }

      $temp = 'User: '. $uUserName. '&emsp;'. 'Review: '. $review. '&emsp;'. 'Rating: '. $rRating. '<br>'. '<br>';
      array_push($array, $temp);
    }

    //Get all information about the product from database

    $get_info = mysqli_query($conn, "SELECT * FROM products WHERE pID=$pID");

    while($row = mysqli_fetch_array($get_info)){
      $pName = $row['pName'];
      $pPrice = $row['pPrice'];
      $pDescription = $row['pDescription'];
      $pImg = $row['pImg'];
    }

    

    $conn->close();
  ?>

  <header>
    
    <h1> Title </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="store.php">Home</a></li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
      <li><a href="#" class="img"><img src="../images/cart.png"></a></li>
      <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li> 
   </ul>
   	<br>
  </div>

  <div id="content">
    <div class="gridContainer">
      
      <div class="image">
        <img class ="productImage" src="<?php echo $pImg; ?>">
      </div>

      <div class="info">
        <div class="ProductInfo">
            <h1><?php echo $pName; ?></h1>
            <p><?php echo $pDescription; ?></p>
            <br>
            <p>$ <?php echo $pPrice; ?></p>
        </div>

        <div>
        <button> Add to cart </button>
        </div>
      </div>

      <form action="../php/sendReview.php" method="GET">

        <div class="rComment">
          <label for="rComment"><h2>Review</h2></label>
          <textarea type="text" placeholder="Enter Review" name="rComment" required></textarea>
        </div>

        <div class="rRating">
          <label for="rRating"><h2>Rate</h2></label>
          <input type="text" placeholder="Enter Rate" name="rRating" required>
        </div>

        <input type="hidden" name="pID" value=" <?php echo $pID; ?> ">

        <div class="sendButton">
          <label for="Send"><h2>Send</h2></label>
          <button> Send </button>
        </div>
        
      </form>

      <div class="reviews">
          <h1>Reviews</h1>
          <p>
            <?php
              foreach( $array as $userReview ) {
                echo $userReview;
              }
            ?>
          </p>
      </div>

    </div> <!-- gridContainer -->
  </div> <!-- Content -->
</body>
</html>