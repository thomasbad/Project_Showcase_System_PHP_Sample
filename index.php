<?php

@include 'lib/connect.php';

session_start();

//check username and password

if (isset($_POST['submit'])) {

   $username = $_POST['username'];
   $pass = $_POST['password'];

   $select = " SELECT * FROM user_account WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);


   if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_array($result);

      // admin or student page

      if ($row['user_type'] == 'admin') {
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['user_name'] = $row['username'];
         header('location:admin_page.php');

      } elseif ($row['user_type'] == 'student') {
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['user_name'] = $row['username'];
         header('location:user_page.php');

      } elseif ($row['user_type'] == 'guest') {
         $_SESSION['user_type'] = $row['user_type'];
         $_SESSION['user_name'] = $row['username'];
         header('location:guest_page.php');

      }
   } else {
      $error[] = 'incorrect username or password!';
   }

}
;
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HKIT Project Showcase System - Login</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">

</head>

<header>
   &emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>
</header>

<body>

   <div class="form-container">

      <form action="" method="post">
         <h3 style='text-align:center'>login now</h3>
         <?php
         if (isset($error)) {
            foreach ($error as $error) {
               echo '<span class="error-msg">' . $error . '</span>';
            }
            ;
         }
         ;
         ?>
         <input type="username" name="username" required placeholder="Enter your username">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn"><br>
         <button class="button is-primary is-hlafwidth" onclick="popup()"><a style="color: white;"
               href="editproject.php">View Demo Account for this Demo</button>
      </form>
   </div>

</body>

<script>

   function popup() {
      window.open('demoaccount.php', 'popUpWindow', 'height = 300, width = 500, left = 100, top = 100, scrollbars = yes, resizable = yes, menubar = no, toolbar = yes, location = no, directories = no, status = yes')
   }

</script>

</html>