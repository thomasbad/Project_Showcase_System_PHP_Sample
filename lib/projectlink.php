<?php
@include 'lib/connect.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
//Load document_upload detail
$username = $_SESSION['user_name'];
$selectdoc = "SELECT * FROM document_upload WHERE username = '$username'";
$docresult = mysqli_query($conn, $selectdoc);
if(mysqli_num_rows($docresult) > 0){
   $row = mysqli_fetch_array($docresult);
   $_SESSION['doc_username'] = $row['username'];
   $_SESSION['doc_link'] = $row['fileid'];
   $_SESSION['proj_name'] = $row['project_showcase'];
}else{
   $error[] = 'Cannot load showcase information';
};
?>