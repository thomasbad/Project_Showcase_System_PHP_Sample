<?php

@include 'lib/connect.php';

if (!isset($_SESSION)) {
   session_start();
}

$username = $_SESSION['user_name'];
$selectproj = "SELECT * FROM document_upload WHERE username = '$username'";
$projresult = mysqli_query($conn, $selectproj);
if (mysqli_num_rows($projresult) > 0) {
   $row = mysqli_fetch_array($projresult);
   $projlink = $row['file_id'];
   $projtitle = $row['project_showcase'];
} else if (mysqli_num_rows($projresult) == 0) {
   $projlink = "";
   $projtitle = "";
} else {
   $error[] = 'Cannot load user profile';
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

      <form action="lib/projectupdate.php" method="post">
         <h3 style='text-align:center'>Add / Edit Project Information</h3><br>
         <label class="label" style="text-align:left">Project Title: </label>
         <input class="input is-primary" type="text" name="projtitle" required placeholder="Enter your Project Title"
            value="<?php echo $projtitle ?>"><br>
         <label class="label" style="text-align:left">Project document link: </label>
         <input class="input is-primary" type="text" name="projlink"
            placeholder="Enter the link of your Project Documents for download" value="<?php echo $projlink ?>"><br><br>
         <input type="submit" name="editproject" value="Add / Update Project Information" class="form-btn">
         <input type="button" value="Cancel" onclick="history.back()" class="cancel-btn">
      </form>

   </div>

</body>

</html>