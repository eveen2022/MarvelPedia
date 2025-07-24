<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
   
<div class="container">

   <div class="content">
      <h3>Hi, <span><?php echo $_SESSION['user_name'] ?></span></h3>
      <h1>Welcome to MARVELPedia Movie and TV Series Request Page ! </h1>
      <p>You Can Request Movies and TV Series by Clicking the Request Button.</p>
      <a href="admin page/user.php" class="btn">To the Buying Page</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>