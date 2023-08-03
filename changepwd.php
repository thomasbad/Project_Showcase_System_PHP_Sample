<?php

@include 'lib/connect.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}

if($_SESSION['user_type'] != 'student'){
    header('location:index.php');
 } 

if(isset($_POST['changepass'])){
   $username = $_SESSION['user_name'];
   $oldpass = $_POST['oldpass'];
   $newpass = $_POST['newpass'];
   $cnewpass = $_POST['cnewpass'];

   $select = " SELECT * FROM user_account WHERE username = '$username'";

   $result = mysqli_query($conn, $select);

   $row = mysqli_fetch_array($result);

   if($row['password'] != $oldpass){
      $error[] = 'Old Password Wrong !';
   }else{
      if($newpass != $cnewpass){
         $error[] = 'New Password Not Matched!';
      }else{
         $update = "UPDATE user_account SET password = '$newpass' WHERE username = '$username'";
         mysqli_query($conn, $update);
         header('location:user_page.php');   
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Change Password</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">

</head>

<header>

&emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>

</header>

<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3 style='text-align:center'>Change Password</h3>
      <label class="label" style="text-align:left">Old Password: </label>
      <input class="input is-primary" type="password" name="oldpass" required placeholder="Enter your Old Password">  
      <label class="label" style="text-align:left">New Password: </label>
      <input class="input is-info" type="password" name="newpass" placeholder="Enter your New Password">
      <label class="label" style="text-align:left">Retype New Password: </label>
      <input class="input is-info" type="password" name="cnewpass" required placeholder="Retype your New Password again">
      <br><br>
      <input type="submit" name="changepass" value="Update My Password" class="form-btn" style="color: white">
      <input type="button" value="Cancel" onclick="history.back()" class="cancel-btn">
   </form>

</div>

</body>
</html>