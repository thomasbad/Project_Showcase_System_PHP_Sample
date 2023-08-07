<?php

@include 'lib/connect.php';
if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['user_name'])) {
   header('location:index.php');
}

if ($_SESSION['user_type'] != 'student') {
   header('location:index.php');
}

if (isset($_POST['changepass'])) {
   $username = $_SESSION['user_name'];
   $oldpass = $_POST['oldpass'];
   $newpass = $_POST['newpass'];
   $cnewpass = $_POST['cnewpass'];

   $select = " SELECT * FROM user_account WHERE username = '$username'";

   $result = mysqli_query($conn, $select);

   $row = mysqli_fetch_array($result);

   if ($row['password'] != $oldpass) {
      ?>
      <script>
         alert('Old Password Wrong !');
      </script>
      <?php
   } else {
      if ($newpass != $cnewpass) {
         ?>
         <script>
            alert('New Password not match !');
         </script>
         <?php
      } else {
         $update = "UPDATE user_account SET password = '$newpass' WHERE username = '$username'";
         mysqli_query($conn, $update);
         ?>
         <script>
            alert('Password Change Successfully !');
            window.location.href = 'user_page.php';
         </script>
         <?php
      }
   }

}
;

?>

<?php
@include 'header.php';
@include 'banner_user.php';
?>

<body>

   <div class="form-container">

      <form action="" method="post">
         <h3 style='text-align:center'>Change Password</h3>
         <label class="label" style="text-align:left">Old Password: </label>
         <input class="input is-primary" type="password" name="oldpass" required placeholder="Enter your Old Password">
         <label class="label" style="text-align:left">New Password: </label>
         <input class="input is-info" type="password" name="newpass" placeholder="Enter your New Password">
         <label class="label" style="text-align:left">Retype New Password: </label>
         <input class="input is-info" type="password" name="cnewpass" required
            placeholder="Retype your New Password again">
         <br><br>
         <input type="submit" name="changepass" value="Update Your Password" class="form-btn" style="color: white">
         <input type="button" value="Cancel" onclick="history.back()" class="cancel-btn">
      </form>

   </div>

</body>

</html>