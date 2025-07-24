<?php 
@include 'config.php';
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="TE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome Admin</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	
	<link rel="stylesheet" href="../admin page/adminCss.css">
	
</head>

<body>
	
	<?php 
	
	if(isset($message)){
		
		foreach($message as $message){
			echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
		};
		
	};
	
	?>
	
	<header class="header">
	
    <div class="flex">
	
		<a href="#" class=logo><img src="User Logo MarvelPedia.png" width=350px</a>
		
		<nav class="navbar">
			<ul>
				<a href="user.php">Movies & TV Shows</a>
		        <a href="userCart.php">My Cart</a>
		        <a href="orderPage.php">Orders</a>
			</ul>
		</nav>
			<div>
				<a href="../logout.php" class="logout">Log Out</a>
			</div>
			<div id="menu-btn" class="fas fa-bars"></div>
		   
	</div>
	</header>
		
		<div class="item-container">
			<section class="items">
				
				<h1 class="heading"> Marvel Movies & TV Shows !</h1>
				
				<div class="box-container">
					
					<?php 
					
					$select_items = mysqli_query($conn, "SELECT * FROM `item_db`");
					if(mysqli_num_rows($select_items) > 0){
						while($fetch_items = mysqli_fetch_assoc($select_items)){

					?>
					
					<form action="" method="post">
						
						<div class="box">
							<img src="../admin page/uploaded_img/"<?php echo $fetch_items['image']; ?>"  alt="">
							<h3><?php echo $fetch_items['name']; ?></h3>
							<div class="price">Rs:<?php echo $fetch_items['price']; ?></div>
							<input type="hidden" name="item_name" value="<?php echo $fetch_items['name']; ?>">
							<input type="hidden" name="item_price" value="<?php echo $fetch_items['price']; ?>">
							<input type="hidden" name="item_image" value="<?php echo $fetch_items['image']; ?>">
							<input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
						
						</div>
					  
					</form>
					
					<?php 
						};
					};
					?>
				
				</div>
			
			</section>
		</div>
		
		
		<script src="../admin page/adminjs.js"></script>
</body>
</html>