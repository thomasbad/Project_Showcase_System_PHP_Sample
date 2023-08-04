<?php

$dbservername = "localhost";
$dbuser = "admin";
$dbpass = "adminpassword";
$dbname = "showcasedb";
$conn = mysqli_connect($dbservername, $dbuser, $dbpass, $dbname);

if (!isset($_SESSION)) {
    session_start();
}

// Get POST message
if (isset($_POST['editproject'])) {
    $username = $_SESSION['user_name'];
    $projtitle = $_POST['projtitle'];
    $projlink = $_POST['projlink'];
    $select = "select * from document_upload where username='$username'";
    $sql = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($sql);
    $res = $row['username'];

    $updateproj = "SELECT * FROM document_upload WHERE username = '$username'";
    $updateprojresult = mysqli_query($conn, $updateproj);
    if (mysqli_num_rows($updateprojresult) == 0) {
        $addnewproj = "INSERT INTO document_upload(username,file_id,project_showcase) VALUES ('$username','$projlink','$projtitle')";
        $sql3 = mysqli_query($conn, $addnewproj);
        if ($sql3) {
            /*Successful*/
            ?>
            <script>
                alert('Profile Updated !');
                window.location.href = '../showcase.php';
            </script>
        <?php
        } else {
            /*sorry your profile is not update*/
            ?>
            <script>
                alert('Error Ecountered, Profile would not update.');
                window.location.href = '../showcase.php';
            </script>
        <?php
        }

    } else if (mysqli_num_rows($updateprojresult) > 0) {

        $update = "UPDATE document_upload SET file_id='$projlink',project_showcase='$projtitle' WHERE username='$username'";
        $sql2 = mysqli_query($conn, $update);
        if ($sql2) {
            /*Successful*/
            ?>
                <script>
                    alert('Profile Updated !');
                    window.location.href = '../showcase.php';
                </script>
        <?php
        } else {
            /*sorry your profile is not update*/
            ?>
                <script>
                    alert('Error Ecountered, Profile would not update.');
                    window.location.href = '../showcase.php';
                </script>
        <?php

        }
    } else {
        $error[] = 'Cannot load user profile';
    }
}
?>