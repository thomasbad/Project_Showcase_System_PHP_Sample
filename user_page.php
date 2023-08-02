<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

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
   <title>HKIT Project Showcase System</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">
</head>

<header>

&emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>

</header>

<body>   
<div class="container">
   <div class="content">
      <h1>Hi, <span><?php echo $_SESSION['first_name'], ' ', $_SESSION['last_name'] ?></span> !</h1>
      <p>Welcome Back to the HKIT Project Showcase System.</p><br>
      <a href="editprofile.php" class="btn">
      <img src='img/editprofile.svg'>
      <br> 
      Edit Profile
      </a>
      <a href="showcase.php" class="btn">
      <img src='img/showcase.svg'>
      <br>
      Project Showcase</a>
      <a href="logout.php" class="btn">
      <img src='img/logout.svg'>
      <br>
      logout</a>
   </div>
</div>
</body>

</html>