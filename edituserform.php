<?php

$dbservername="localhost";
$dbuser="admin";
$dbpass="adminpassword";
$dbname="showcasedb";
global $conn;
$conn = mysqli_connect($dbservername,$dbuser,$dbpass,$dbname);

if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}

if($_SESSION['user_type'] != 'admin'){
    header('location:index.php');
 } 

 if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
 {
    $username = $_GET['edit_id'];
 }
 else
 {
    header("Location: admin_page.php");
 }

$selectprofile = "SELECT * FROM user_profile WHERE username = '$username'";
$profileresult = mysqli_query($conn, $selectprofile);
if(mysqli_num_rows($profileresult) > 0){
   $row = mysqli_fetch_array($profileresult);
   $ffname = $row['firstname'];
   $mmname = $row['midname'];
   $llname = $row['lastname'];
   $ddname = $row['department_name'];
   $ccname = $row['course_name'];
   $ggradyr = $row['grad_year'];
}else{
   $error[] = 'Cannot load user profile';
};

$selectacc = "SELECT * FROM user_account WHERE username = '$username'";
$accresult = mysqli_query($conn, $selectacc);
if(mysqli_num_rows($accresult) > 0){
   $row = mysqli_fetch_array($accresult);
   $ppass = $row['password'];
}else{
   $error[] = 'Cannot load user account';
};

if(isset($_POST['submit'])){

   $pass = $_POST['password'];
   $cpass = $_POST['cpassword'];
   $fname = $_POST['fname'];
   $mname = $_POST['mname'];
   $lname = $_POST['lname'];
   $dname = $_POST['dname'];
   $cname = $_POST['cname'];
   $gradyr = $_POST['gradyr'];
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_profile WHERE username = '$username' && firstname = '$fname' && lastname = '$lname' ";

   $result = mysqli_query($conn, $select);

   if($dname = ''){
      $dname = NULL;
   }

   if($cname = ''){
      $cname = NULL;
   }

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "UPDATE user_profile SET firstname = '$fname', midname = '$mname', lastname = '$lname', department_name = '$dname', course_name = '$cname', grad_year = '$gradyr' WHERE username = '$username'";
         $insert2 = "UPDATE user_account SET password = '$cpass', user_type = '$user_type' WHERE username = '$username'";
         mysqli_query($conn, $insert);
         mysqli_query($conn, $insert2);
         ?>
                <script>
				alert('User Profile Update Successfully !');
				window.location.href='edituser.php';
				</script>
                <?php 
      }
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register New User</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
   <link rel="stylesheet" href="style.css">

</head>

<header>

&emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>

</header>

<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Edit User Profile</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="fname" required placeholder="Enter user's First Name" value="<?php echo $ffname ?>">
      <input type="text" name="mname" placeholder="Enter user's Middle Name" value="<?php echo $mmname ?>">
      <input type="text" name="lname" required placeholder="Enter user's Last Name" value="<?php echo $llname ?>">
      <select id = "departmentlist" name="dname" required>
         <option selected disabled>-----Choose User's department-----</option>
         <option value="Art and Design">Art and Design</option>
         <option value="Creative Media Technology">Creative Media Technology</option>
         <option value="Built Environment">Built Environment</option>
         <option value="Engineering">Engineering</option>
         <option value="Humanities">Humanities</option>
         <option value="Performing Arts">Performing Arts</option>
         <option value="Research">Research</option>
         <option value="Science">Science</option>
         <option value="">NONE</option>
      </select>

      <!----------------course selector------------------------------>

      <select id="c0" name="cname" style='display:'>
         <option selected disabled>-----Choose User's Course-----</option>
      </select>

      <select id="c1" name="cname" style='display:none'>
         <option value="High Diploma of Art & Design">High Diploma of Art & Design</option>
      </select>

      <select id = "c2" name="cname" style='display:none'>
         <option value="Bachelor of Creative Media">Bachelor of Creative Media</option>
      </select>

      <select id = "c3" name="cname" style='display:none'>
         <option value="Bachelor of Environmental Science">Bachelor of Environmental Science</option>
      </select>

      <select id = "c4" name="cname" style='display:none'>
         <option value="Advanced Diploma of Engineering">Advanced Diploma of Engineering</option>
      </select>

      <select id = "c5" name="cname" style='display:none'>
         <option value="High Diploma of Human Resource Management">High Diploma of Human Resource Management</option>
      </select>

      <select id = "c6" name="cname" style='display:none'>
         <option value="High Diploma of Performing Arts">High Diploma of Performing Arts</option>
      </select>

      <select id = "c7" name="cname" style='display:none'>
         <option value="Research PhD students">Research PhD students</option>
      </select>

      <select id = "c8" name="cname" style='display:none'>
         <option value="High Diploma of Science">High Diploma of Science</option>
      </select>

      <select id = "c9" name="cname" style='display:none'>
         <option value="">NONE</option>
      </select>

      <!----------------end of course selector--------------------------->
      <select class="form-select" id="year" name="gradyr" required>
    <option value="" selected disabled>-----Choose Graduated Year-----</option>
    <option value="9999">None</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
    <option value="2031">2031</option>
    <option value="2032">2032</option>
    <option value="2033">2033</option>
    <option value="2034">2034</option>
    <option value="2035">2035</option>
    <option value="2036">2036</option>
    <option value="2037">2037</option>
    <option value="2038">2038</option>
    <option value="2039">2039</option>
    <option value="2040">2040</option>
    <option value="2041">2041</option>
    <option value="2042">2042</option>
    <option value="2043">2043</option>
    <option value="2044">2044</option>
    <option value="2045">2045</option>
    <option value="2046">2046</option>
    <option value="2047">2047</option>
    <option value="2048">2048</option>
    <option value="2049">2049</option>
    <option value="2050">2050</option>
</select>
   <input type="text" name="username" disabled placeholder="Enter User's Login ID" value="<?php echo $username ?>">
      <input type="password" name="password" required placeholder="Change User's password" >
      <input type="password" name="cpassword" required placeholder="Confirm password again" >
      
      <select name="user_type" required>
      <option selected disabled>-----Choose Account Permission-----</option>
      <option value="guest">Guest</option>
         <option value="student">Student</option>
         <option value="admin">Administrator</option>
      </select>
      <input type="submit" name="submit" value="Update User Profile" class="form-btn">
      <button class="button" style="width: 450px"><a style="color: black;" href="edituser.php">Back to Edit User Page</button>
   </form>

</div>

</body>

<script>

document.getElementById('departmentlist').onchange = function () {
  var selectedValue = this.options[this.selectedIndex].value; // get the selected value

  // Depending on the value selected you can show or hide other elements:

  if (selectedValue == "") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = '';
  }else if (selectedValue == "Art and Design") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = '';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Creative Media Technology") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = '';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Built Environment") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = '';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Engineering") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = '';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if(selectedValue == "Humanities") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = '';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Performing Arts") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = '';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Research") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = '';
    document.getElementById('c8').style.display = 'none';
    document.getElementById('c9').style.display = 'none';
  }else if (selectedValue == "Science") { 
   document.getElementById('c0').style.display = 'none';
    document.getElementById('c1').style.display = 'none';
    document.getElementById('c2').style.display = 'none';
    document.getElementById('c3').style.display = 'none';
    document.getElementById('c4').style.display = 'none';
    document.getElementById('c5').style.display = 'none';
    document.getElementById('c6').style.display = 'none';
    document.getElementById('c7').style.display = 'none';
    document.getElementById('c8').style.display = '';
    document.getElementById('c9').style.display = 'none';
  }
};

</script>

</html>