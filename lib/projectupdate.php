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

// Get POST message
 if(isset($_POST['editproject']))
 {
    $username=$_SESSION['user_name'];
    $projtitle=$_POST['projtitle'];
    $projlink=$_POST['projlink'];
    $select= "select * from document_upload where username='$username'";
    $sql = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($sql);
    $res= $row['username'];

    // Check if account exist
    try {
        $stmt = $conn->prepare($select);
        //for you no need to pass parameter inside execute statement
        $result = $stmt->execute();
        //After executing the query store the result like below
        $stmt->store_result();
    } catch(PDOException $ex) {
        echo $ex->getMessage();
    }

    //Now Check for the row count
       //you have to check numrows >0 like this
       if($stmt->num_rows==0) {
        $addnewproj = "INSERT INTO document_upload(username,file_id,project_showcase) VALUES ('$username','$projlink','$projtitle')";
        $updatetable1 = "SELECT * FROM user_profile RIGHT JOIN document_upload ON user_profile.username = document_upload.username;";
        die;
    } else {
        
    if($res === $username)
    {
   
       $update = "update document_upload set file_id='$projlink',project_showcase='$projtitle' where username='$username'";
       $sql2=mysqli_query($conn,$update);
        if($sql2)
        { 
           /*Successful*/
           ?>
                <script>
				alert('Profile Updated !');
				window.location.href='showcase.php';
				</script>
                <?php 
        }
        else
        {
           /*sorry your profile is not update*/
           ?>
                <script>
				alert('Error Ecountered, Profile would not update.');
				window.location.href='showcase.php';
				</script>
                <?php 
        }
    }
 }   
}


?>