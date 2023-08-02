<?php
//Load user_type detail
$selecttype = "SELECT * FROM user_type";
$typeresult = mysqli_query($conn, $selecttype);
if(mysqli_num_rows($typeresult) > 0){
   $row = mysqli_fetch_array($typeresult);
   $_SESSION['user_type'] = $row['type'];
}else{
   $error[] = 'Cannot load user type';
};
?>