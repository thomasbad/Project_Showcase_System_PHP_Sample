<?php

@include 'lib/connect.php';

session_start();

//check username and password

if(isset($_POST['submit'])){

   $username =  $_POST['username'];
   $pass = $_POST['password'];

   $select = " SELECT * FROM user_account WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);


   if(mysqli_num_rows($result) > 0){
    
      $row = mysqli_fetch_array($result);

      // admin or student page
      
      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['username'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'student'){

         $_SESSION['user_name'] = $row['username'];
         header('location:user_page.php');

      }elseif($row['user_type'] == 'guest'){

         $_SESSION['user_name'] = $row['username'];
         header('location:guest_page.php');

      }
   }else{
      $error[] = 'incorrect username or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="username" name="username" required placeholder="Enter your username">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn"><br>
      
   </form>

</div>

</body>
</html>
