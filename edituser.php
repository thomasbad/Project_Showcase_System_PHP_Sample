<?php
		$DB_HOST = 'localhost';
		$DB_USER = 'admin';
		$DB_PASS = 'adminpassword';
		$DB_NAME = 'showcasedb';
		
		try{
			$DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
			$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

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
	
	if(isset($_GET['delete_id']))
	{
		$stmt_select = $DB_con->prepare('SELECT username FROM user_profile WHERE username =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		$stmt_delete = $DB_con->prepare('DELETE FROM user_profile WHERE username =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
        $urpf_delete = $DB_con->prepare('DELETE FROM user_account WHERE username =:uid');	
        $urpf_delete->bindParam(':uid',$_GET['delete_id']);
		$urpf_delete->execute();
		header("Location: edituser.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit User Profile</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>
<style>
    header {
   background-color: #004d99;
   width: 100%;
}
</style>
</head>

<header>
&emsp;&emsp;<a href="admin_page.php"><img src="img/logo.svg" width="250" height="180"></a>
</header>

<body>
<div class="container">
<h1 align="center">Edit / Remove User Profile</h1>
	<div class="page-header">
    	<h1 class="h2">&nbsp; List of Members<a class="btn btn-success" href="adduser.php" style="margin-left: 770px;"><span class="glyphicon glyphicon-user"></span>&nbsp; Add User</a></h1><hr>
    </div>
<div class="row">
<?php
	$stmt = $DB_con->prepare('SELECT PID, username, firstname, lastname, course_name FROM user_profile ORDER BY PID DESC');
	$stmt->execute();
if($stmt->rowCount() > 0)
{
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		extract($row);
		?>
		<div class="col-xs-3" style="height: 500px">
			<div style="height: 100px"><h4 class="page-header" style="background-color:cadetblue" align="center"><?php echo $firstname." ".$lastname."<br>".$username."<br>".$course_name; ?></h3></div>
			<img src="img/profile_pic.png" class="img-responsive" /><hr>
			<p class="page-header" align="center">
			<span>
			<a class="btn btn-primary" href="edituserform.php?edit_id=<?php echo $row['username']; ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a> 
			<a class="btn btn-warning" href="?delete_id=<?php echo $row['username']; ?>" title="click for delete" onclick="return confirm('Are You Sure You Want To Delete This User?')"><span class="glyphicon glyphicon-trash"></span> Delete</a>
			</span>
			</p>
		</div>       
		<?php
	}
}
else
{
	?>
	<div class="col-xs-12">
		<div class="alert alert-warning">
			<span class="glyphicon glyphicon-info-sign"></span>&nbsp; No Data Found.
		</div>
	</div>
	<?php
}
?>
</div>
</div>
</body>
</html>