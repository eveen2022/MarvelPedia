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
	  header('Location: admin.php');

   }
};


?>