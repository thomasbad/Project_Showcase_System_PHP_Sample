<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';

if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['user_name'])) {
   header('location:index.php');
}

if ($_SESSION['user_type'] != 'guest') {
   header('location:index.php');
}

?>

<?php
@include 'header.php';
@include 'banner_guest.php';
?>

<body>
   <div class="container">
      <div class="content">
         <h1>Hi, <span>
               <?php echo $_SESSION['first_name'] ?>
            </span> !</h1>
            <p><font color="black">Welcome Back to the HKIT Project Showcase System.</font></p><br>
         <a href="showcase_guest.php" class="btn">
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