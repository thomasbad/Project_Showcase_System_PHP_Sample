<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';

if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['user_name'])) {
   header('location:index.php');
}

if ($_SESSION['user_type'] != 'student') {
   header('location:index.php');
}

?>

<?php
@include 'header.php';
@include 'banner_user.php';
?>

<body>
   <div class="container">
      <div class="content">
         <h1>Hi, <span>
               <?php echo $_SESSION['first_name'], ' ', $_SESSION['last_name'] ?>
            </span> !</h1>
         <p><font color="black">Welcome Back to the HKIT Project Showcase System.</font></p><br>
         <a href="editprofile.php" class="btn">
            <img src='img/profile.png' width="128" height="128">
            <br>
            Edit Profile
         </a>
         <a href="showcase.php" class="btn">
            <img src='img/showcase.svg'>
            <br>
            Project Showcase</a>
         <a href="changepwd.php" class="btn">
            <img src='img/changepwd.svg'>
            <br>
            Change Password</a>
         <a href="logout.php" class="btn">
            <img src='img/logout.svg'>
            <br>
            logout</a>
      </div>
   </div>
</body>

</html>