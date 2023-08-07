<?php

@include 'lib/connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project Showcase</title>
  <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/bulma/0.9.4/css/bulma.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    tr:nth-child(even) {
      background-color: #ddd;
    }
    tr:nth-child(odd) {
      background-color: #fff;
    }

    td {
      text-align: center;
    }
  </style>
</head>

<body>
  <table>
    <tr class="header">

      <th>Username</th>
      <th>Password</th>
      <th>Account Permission Type</th>
    </tr>
    <?php
    $sql = "SELECT * FROM user_account";
    $result = $conn->query($sql);
    if ($res = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
          echo "<tr>";
          echo "<td>" . $row['username'] . "</td>";
          echo "<td>" . $row['password'] . "</td>";
          echo "<td>" . $row['user_type'] . "</td>";
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
</body>

</html>