<?php 

@include 'config.php';


if(isset($_POST['add_marvel'])){
   $m_name = $_POST['m_name'];
   $m_price = $_POST['m_price'];
   $m_image = $_FILES['m_image']['name'];
   $m_image_tmp_name = $_FILES['m_image']['tmp_name'];
   $m_image_folder = 'uploaded_img/'.$m_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `item_db`(name, price, image) VALUES('$m_name', '$m_price', '$m_image')") or die('Query Failed');

   if($insert_query){
      move_uploaded_file($m_image_tmp_name, $m_image_folder);
      $message[] = 'Item added Succesfully';
      header('Location: admin.php');
   }else{
      $message[] = 'Could not Add the Item';
	  //header('Location: admin.php');

   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `item_db` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      //header('location:admin.php');
      $message[] = 'Item has been Deleted Successfully';
   }else{
      //header('location:admin.php');
      $message[] = 'Item could not be Deleted Please Try Again !';
   };
};

if(isset($_POST['update_item'])){
   $update_m_id = $_POST['update_m_id'];
   $update_m_name = $_POST['update_m_name'];
   $update_m_price = $_POST['update_m_price'];
   $update_m_image = $_FILES['update_m_image']['name'];
   $update_m_image_tmp_name = $_FILES['update_m_image']['tmp_name'];
   $update_m_image_folder = 'uploaded_img/'.$update_m_image;

   $update_query = mysqli_query($conn, "UPDATE `item_db` SET name = '$update_m_name', price = '$update_m_price', image = '$update_m_image' WHERE id = '$update_m_id'");

   if($update_query){
      move_uploaded_file($update_m_image_tmp_name, $update_m_image_folder);
      $message[] = 'Item Updated Succesfully';
      //header('location:admin.php');
   }else{
      $message[] = 'Item Could not be Updated, Please Try Again.';
      //header('location:admin.php');
   }

}

?>




<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="TE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome Admin</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	
	<link rel="stylesheet" href="adminCss.css">
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
	
		<a href="#" class=logo><img src="MarvelPedia admin logo.png" width=350px</a>
		
		<nav class="navbar">
			<ul>
				<a href="admin.php">Add M&TVs</a>
				<a href="MTVs.php">View M&TVs</a>
			    <a href="orderPage.php">Orders</a>
			</ul>
		</nav>
			<div>
				<a href="../logout.php" class="logout">Log Out</a>
			</div>
			<div id="menu-btn" class="fas fa-bars"></div>
		   
	</div>
		
	
</header>
	
	<div class="container">
<section>
   <form action="" method="post" class="add-marvel" enctype="multipart/form-data">
	   <h3>Add a New Marvel Movie or TV Series</h3>
	   <input type="text" name="m_name" placeholder="Enter the Name and Year" class="box" required>
	   <input type="number" name="m_price" min="0" placeholder="Enter the Price" class="box" required>
	   
	   <input type="file" name="m_image" accept="image/jpeg, image/png, image/jpg" class="box" required>
	   
	   <input type="submit" value="Submit The Form" name="add_marvel" class="btn">
   </form>
</section>
		
		
        <section class="display-item-table">
		
			<table>
				<thead>
					<th>Item Image</th>
					<th>Item Name</th>
					<th>Item Price</th>
					<th>Actions</th>
				</thead>
				
				<tbody>
					
					<?php
					$select_items = mysqli_query($conn, "SELECT * FROM `item_db` ");
					if(mysqli_num_rows($select_items) > 0){
						while($row = mysqli_fetch_assoc($select_items)){
					?>
					
					<tr>
						
						<td><img src="uploaded_img/<?php echo $row['image']; ?>" height="150" alt=""></td>
						<td><?php echo $row['name'] ?></td>
						<td>Rs:<?php echo $row['price'] ?></td>
					    <td>
							
							<a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this item ?')"><i class="fas fa-trash"> Delete </i></a>
							
							<a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"><i class="fas fa-edit"> Update </i></a>
						 
						</td>
					</tr>
					
					<?php 
						};
					}else{
						echo "<div class='empty'> No Item Added </div>";
					}
					?>
				
				</tbody>
			</table>
			
		</section>
		
		<section class="edit-form-container">
			
			<?php
			
			if(isset($_GET['edit'])){
			   $edit_id = $_GET['edit'];
		       $edit_query = mysqli_query($conn, "SELECT * FROM `item_db` WHERE id = $edit_id ");
			   
			   if(mysqli_num_rows($edit_query) > 0){
				   while($fetch_edit = mysqli_fetch_assoc($edit_query)){
			
		    ?>
			
   <form action="#" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_m_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_m_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_m_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_m_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="Update the Item" name="update_item" class="btn">
      <input type="reset" value="Cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>
		
		</section>
</div>
	
	
	
	
	
	

	
     <script src="adminjs.js"></script>
</body>
</html>