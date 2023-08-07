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

      // admin, student or guest page

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
      $error[] = 'Incorrect username or password!';
   }

}
;
?>

<?php
@include 'header.php';
@include 'banner_index.php';
?>

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
         <input type="submit" name="submit" value="login" class="form-btn"><br><br>
         <button class="button is-link is-halfwidth" onclick="popup()"><a style="color: white;"
               href="editproject.php">View Account for This Demo</button>
      </form>
   </div>

</body>

<script>

   function popup() {
      window.open('demoaccount.php', 'popUpWindow', 'height = 300, width = 500, left = 100, top = 100, scrollbars = yes, resizable = yes, menubar = no, toolbar = yes, location = no, directories = no, status = yes')
   }

</script>

</html>