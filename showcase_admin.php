<?php

@include 'lib/connect.php';
@include 'lib/loadprofile.php';
@include 'lib/projectlink.php';

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';
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

<?php
@include 'header.php';
@include 'banner_admin.php';
?>

<style>
  .fix-bg {
    min-height: 100vh;
    display: flex;
    padding: 0px;
    padding-bottom: 0px;
  }
</style>

<body>
  <div class="fix-bg">
    <div style="width:100%; padding: 80px 50px 20px;">
      <input type="text" id="myInput" onkeyup="tableFilter()" placeholder="Search by names...">

      <div style="height:350px; overflow:auto;">
        <table id="myTable" class="data-table" style="color: black;">
          <tr class="header">

            <th>
              <font color="white">Student Name</font>
            </th>
            <th>
              <font color="white">Department</font>
            </th>
            <th>
              <font color="white">Course</font>
            </th>
            <th>
              <font color="white">Introduction</font>
            </th>
            <th>
              <font color="white">Project Name</font>
            </th>
            <th>
              <font color="white">Document Link</font>
            </th>
            <th>
              <font color="white">Remove Project</font>
            </th>
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
                echo "<td>" . $row['self_intro'] . "</td>";
                echo "<td>" . $row['project_showcase'] . "</td>";
                echo htmlspecialchars_decode("<td><a style=&quot;color: white;&quot; href=&quot;" . $row['file_id'] . "&quot; target=&quot;_blank&quot; rel=&quot;noopener noreferrer&quot;><button class=&quot;button is-link&quot;>Download</button></a></td>");
                ?>
                <td><button class="button is-danger"><a style="color: white"
                      href="?delete_proj=<?php echo $row['username']; ?>" title="click for delete"
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
      <!--  <br><a style="color: white;" href="editproject.php"><button class="button is-warning is-fullwidth">Edit My Project
          Information</button></a>-->

        <a style="color: black;" href="admin_page.php"><button class="button is-warning is-fullwidth">Back to Previous
             Page</button></a>
    </div>
  </div>
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