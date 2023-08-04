<?php

$dbservername="localhost";
$dbuser="admin";
$dbpass="adminpassword";
$dbname="showcasedb";
$conn = mysqli_connect($dbservername,$dbuser,$dbpass,$dbname);

if(!isset($_SESSION)) 
{ 
    session_start(); 
}
 if(isset($_POST['editprofile']))
 {
    $username=$_SESSION['user_name'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $lname=$_POST['lname'];
    $self_intro=$_POST['self_intro'];
    $select= "select * from user_profile where username='$username'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['username'];
    if($res === $username)
    {
   
       $update = "update user_profile set firstname='$fname',midname='$mname',lastname='$lname',self_intro='$self_intro' where username='$username'";
       $sql2=mysqli_query($conn,$update);
if($sql2)
       { 
           /*Successful*/
           ?>
                <script>
				alert('Profile Updated !');
				window.location.href='../user_page.php';
				</script>
                <?php  
       }
       else
       {
           /*sorry your profile is not update*/
           echo '<script>alert("Error Ecountered, Profile not update.")</script>';
       }
    }
 }
?>