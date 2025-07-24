<?php 

@include 'config.php';

if(isset($_POST['update_update_btn'])){
	$update_value = $_POST['update_quantity'];
	$update_id = $_POST['update_quantity_id'];
	$update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
	
	if($update_quantity_query){
		header('location:userCart.php');
	};
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:userCart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:userCart.php');
}

?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to MARVELPedia Cart</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	
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
			<section class="MTV-cart">
				
				<h1 class="heading">MARVELPedia Movies & TV Series Cart</h1>
				
				<table>
					<thead>
						<th>Image</th>
						<th>Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Action</th>
					</thead>
					
					<tbody>
						
		<?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>Rs:<?php echo number_format($fetch_cart['price']); ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>Rs:<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
            <td><a href="userCart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
				
           $grand_total += $sub_total;  
            };
         };
						
						?>
						<tr class="" >
							
							<td><a href="userMTVs.php" class="option-btn" style="margin-top: 0;">Countinue Buying</a></td>
							<td colspan="3">Total Price</td>
                            <td>Rs:<?php echo $grand_total; ?>/-</td>
                            <td><a href="userCart.php?delete_all" onclick="return confirm('Are you sure you want to Delete All?');" class="delete-btn"> <i class="fas fa-trash"></i> Delete All </a></td>
						
						</tr>
					
					</tbody>
				</table>
				
				<div class="checkout-btn">
                      <a href="checkoutUser.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
                </div>
			
			</section>
	
	
	
	<script src="adminjs.js"></script>
</body>
</html>