<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $total_price = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($item = mysqli_fetch_assoc($cart_query)){
         $item_name[] = $item['name'] .' ('. $item['quantity'] .') ';
         $item_price = number_format($item['price'] * $item['quantity']);
         $total_price += $item_price;
      };
   };

   $total_items = implode(',',$item_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `userorder`(name, number, email, method, flat, street, city, state, country, pin_code, total_items, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_items','$total_price')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_items."</span>
            <span class='total'> total : $".$total_price."/-  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p>(*pay when items or item arrives*)</p>
         </div>
            <a href='user.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="adminCss.css">

</head>
<body>

		<header class="header">
	
    <div class="flex">
	
		<a href="#" class=logo><img src="User Logo MarvelPedia.png" width=350px</a>
		
		<nav class="navbar">
		   <a href="user.php">Movies & TV Shows</a>
		   <a href="userCart.php">My Cart</a>
		   <a href="orderPage.php">Orders</a>
		</nav>
			
			<div>
				<a href="../logout.php" class="logout">Log Out</a>
			</div>
			<div id="menu-btn" class="fas fa-bars"></div>
	</div>
	
</header>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : Rs:<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>Your Name</span>
            <input type="text" placeholder="Enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>Your Number</span>
            <input type="number" placeholder="Enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>Your E - mail</span>
            <input type="email" placeholder="Enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>Payment Method</span>
            <select name="method">
				<option value="" selected> ---- </option>
               <option value="cash on delivery">Cash on Devlivery</option>
               <option value="credit cart">Credit or Debit Card</option>
               <option value="paypal">Paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>Address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>City</span>
            <input type="text" placeholder="e.g. Kollupitiya" name="city" required>
         </div>
         <div class="inputBox">
            <span>State</span>
            <input type="text" placeholder="e.g. Colombo" name="state" required>
         </div>
         <div class="inputBox">
            <span>Country</span>
            <input type="text" placeholder="e.g. Sri Lanka" name="country" required>
         </div>
         <div class="inputBox">
            <span>Pin Code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="Order Now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="adminjs.js"></script>
   
</body>
</html>