<?php

@include 'lib/connect.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(!isset($_SESSION['user_name'])){
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

   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="form-container">

   <form action="lib/profileupdate.php" method="post">
      <h3 style='text-align:center'>Edit Profile</h3>
      First Name: <input type="text" name="fname" required placeholder="Enter your first name" value=<?php echo $_SESSION['first_name'] ?>>  
      Middle Name: <input type="text" name="mname" placeholder="Enter your middle name" value=<?php echo $_SESSION['mid_name'] ?>>
      Last Name: <input type="text" name="lname" required placeholder="Enter your last name" value=<?php echo $_SESSION['last_name'] ?>>
      Introduction: <input type="text" name="self_intro" required placeholder="Enter the introduction for yourself" value=<?php echo $_SESSION['self_intro'] ?>>
      <input type="submit" name="editprofile" value="Update My Profile" class="form-btn">
      <input type="button" value="Cancel" onclick="history.back()">
   </form>

</div>

</body>
</html>