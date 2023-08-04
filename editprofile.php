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

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Profile</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">

</head>

<header>

   &emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>

</header>

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
         <input type="submit" name="editprofile" value="Update My Profile" class="form-btn">
         <input type="button" value="Cancel" onclick="history.back()" class="cancel-btn">
      </form>

   </div>

</body>

</html>