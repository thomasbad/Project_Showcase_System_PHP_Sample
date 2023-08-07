<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';

if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['user_name'])) {
   header('location:index.php');
}

if ($_SESSION['user_type'] != 'admin') {
   header('location:index.php');
}

?>

<?php
@include 'header.php';
@include 'banner_admin.php';
?>

<body>
   <div class="container">
      <div class="content">
         <h1>Hi, <span>
               <?php echo $_SESSION['first_name'], ' ', $_SESSION['last_name'] ?>
            </span> !</h1>
         <p><font color="black">Welcome Back to the HKIT Project Showcase System.</font></p><br>
         <a href="adduser.php" class="btn">
            <img src='img/adduser.png' width="128" height="128">
            <br>
            Add User
         </a>
         <a href="edituser.php" class="btn">
            <img src='img/edituser.svg'>
            <br>
            Edit User
         </a>
         <a href="showcase_admin.php" class="btn">
            <img src='img/projmanager.svg'>
            <br>
            Project Manager</a>
         <a href="changepwd_admin.php" class="btn">
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