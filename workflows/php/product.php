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


		$conn->close();
	?>

  <header>
    
    <h1> Title </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="../html/index.html">Home</a></li>
      <li><a href="../html/product.html" class="img"><img src="../images/cart.png"></a></li>
      <li id="user"> <?php echo $_SESSION['username'] ?> </li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
   </ul>
   	<br>
  </div>

  <div id="content">
    <div class="gridContainer">
      
      <div class="image">
        <img class ="productImage" src="../images/products/apple.png">
      </div>

      <div class="info">
        <div class="ProductInfo">
            <h1>Product Information</h1>
            <p>Detta är en product</p>
            <br>
            <p>100 kr</p>
        </div>
        <div>
        <button> Add to cart </button>
        </div>
      </div>
      <form action="../php/sendReview.php">
        <div class="rComment">
          <label for="rComment"><h2>Review</h2></label>
          <textarea type="text" placeholder="Enter Review" required></textarea>
        </div>

        <div class="rRating">
          <label for="rRating"><h2>Rate</h2></label>
          <input type="text" placeholder="Enter Rate" required>
        </div>

        <div class="sendButton">
          <label for="Send"><h2>Send</h2></label>
          <button> Send </button>
        </div>
      </form>

      <div class="reviews">
          <h1>Reviews</h1>
          <p>Detta är en product</p>
      </div>

    </div> <!-- gridContainer -->
  </div> <!-- Content -->
</body>
</html>