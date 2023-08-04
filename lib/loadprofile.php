<?php
if (!isset($_SESSION)) {
   session_start();
}
//Load user_profile detail
$username = $_SESSION['user_name'];
$selectprofile = "SELECT * FROM user_profile WHERE username = '$username'";
$profileresult = mysqli_query($conn, $selectprofile);
if (mysqli_num_rows($profileresult) > 0) {
   $row = mysqli_fetch_array($profileresult);
   $_SESSION['first_name'] = $row['firstname'];
   $_SESSION['mid_name'] = $row['midname'];
   $_SESSION['last_name'] = $row['lastname'];
   $_SESSION['department_name'] = $row['department_name'];
   $_SESSION['course_name'] = $row['course_name'];
   $_SESSION['grad_year'] = $row['grad_year'];
   $_SESSION['self_intro'] = $row['self_intro'];
   $_SESSION['show_profile'] = $row['show_profile'];
} else {
   $error[] = 'Cannot load user profile';
}
;
?>