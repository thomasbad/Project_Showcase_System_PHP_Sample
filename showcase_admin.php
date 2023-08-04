<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';
@include 'lib/projectlink.php';

$DB_HOST = 'localhost';
$DB_USER = 'admin';
$DB_PASS = 'adminpassword';
$DB_NAME = 'showcasedb';

try {
  $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}", $DB_USER, $DB_PASS);
  $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['user_name'])) {
  header('location:index.php');
}

if ($_SESSION['user_type'] != 'admin') {
  header('location:index.php');
}

if (isset($_GET['delete_proj'])) {
  $stmt_select = $DB_con->prepare('SELECT username FROM document_upload WHERE username =:uid');
  $stmt_select->execute(array(':uid' => $_GET['delete_proj']));
  $imgRow = $stmt_select->fetch(PDO::FETCH_ASSOC);
  $stmt_delete = $DB_con->prepare('DELETE FROM document_upload WHERE username =:uid');
  $stmt_delete->bindParam(':uid', $_GET['delete_proj']);
  $stmt_delete->execute();
  header("location:showcase_admin.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Showcase</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<header>
  &emsp;&emsp;<a href="user_page.php"><img src="img/logo.svg" width="250" height="180"></a>
</header>

<body>
  <div style="margin: auto; width:100%; padding: 20px 50px 20px;">
    <input type="text" id="myInput" onkeyup="tableFilter()" placeholder="Search by names...">

    <div style="height:320px; overflow:auto;">
      <table id="myTable" class="data-table">
        <tr class="header">

          <th>Student Name</th>
          <th>Department</th>
          <th>Course</th>
          <th>Graduated Year</th>
          <th>Introduction</th>
          <th>Project Name</th>
          <th>Document Link</th>
          <th>Remove Project</th>
        </tr>
        <?php
        $sql = "SELECT * FROM user_profile RIGHT JOIN document_upload ON user_profile.username = document_upload.username;";
        $result = $conn->query($sql);
        if ($res = mysqli_query($conn, $sql)) {
          if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_array($res)) {
              echo "<tr>";
              echo "<td>" . $row['firstname'] . " " . $row['midname'] . " " . $row['lastname'] . "</td>";
              echo "<td>" . $row['department_name'] . "</td>";
              echo "<td>" . $row['course_name'] . "</td>";
              echo "<td>" . $row['grad_year'] . "</td>";
              echo "<td>" . $row['self_intro'] . "</td>";
              echo "<td>" . $row['project_showcase'] . "</td>";
              echo htmlspecialchars_decode("<td><a style=&quot;color: white;&quot; href=&quot;" . $row['file_id'] . "&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;><button class=&quot;button is-link&quot;>Download</button></a></td>");
              ?>
              <td><button class="button is-danger"><a style="color: white" href="?delete_proj=<?php echo $row['username']; ?>"
                    title="click for delete"
                    onclick="return confirm('Are You Sure You Want To Remove The Project Information of This User From The System?')"><span
                      class="glyphicon glyphicon-trash"></span>Delete</a></button></td>
              <?php
              echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($res);
          } else {
            echo "No matching records are found.";
          }
        } else {
          echo "ERROR: Could not able to execute $sql. "
            . mysqli_error($conn);
        }
        ?>
      </table>
    </div>
    <button class="button is-primary is-fullwidth"><a style="color: white;" href="editproject.php">Edit My Project
        Information</button>
    <a style="color: black;" href="admin_page.php"><button class="button is-fullwidth">Back to Previous
        Page</button></a>
  </div>
</body>

<script>
  function tableFilter() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

</html>