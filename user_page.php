<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>student page</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="container">

   <div class="content">
      <h1>Hi, <span><?php echo $_SESSION['first_name'] ?></span> !</h1><br>
      <p>Welcome Back to the HKIT Project Showcase System.</p>
      <a href="index.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>

</body>
</html>