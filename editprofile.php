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

?>

<?php
@include 'header.php';
@include 'banner_user.php';
?>

<body>

   <div class="form-container">

      <form action="lib/profileupdate.php" method="post">
         <h3 style='text-align:center'>Edit Profile</h3>
         <label class="label" style="text-align:left">First Name: </label>
         <input class="input is-primary" type="text" name="fname" required placeholder="Enter your first name"
            value="<?php echo $_SESSION['first_name'] ?>">
         <label class="label" style="text-align:left">Middle Name: </label>
         <input class="input is-primary" type="text" name="mname" placeholder="Enter your middle name"
            value="<?php echo $_SESSION['mid_name'] ?>">
         <label class="label" style="text-align:left">Last Name: </label>
         <input class="input is-primary" type="text" name="lname" required placeholder="Enter your last name"
            value="<?php echo $_SESSION['last_name'] ?>">
         <label class="label" style="text-align:left">Department: </label>
         <input class="input is-info" type="text" disabled value="<?php echo $_SESSION['department_name'] ?>">
         <label class="label" style="text-align:left">Course: </label>
         <input class="input is-info" type="text" disabled value="<?php echo $_SESSION['course_name'] ?>">
         <label class="label" style="text-align:left">Introduction: </label>
         <input class="input is-primary" type="text" name="self_intro" required
            placeholder="Enter the introduction for yourself" value="<?php echo $_SESSION['self_intro'] ?>">
         <input type="submit" name="editprofile" value="Update Your Profile" class="form-btn">
         <input type="button" value="Cancel" onclick="history.back()" class="cancel-btn">
      </form>

   </div>

</body>

</html>