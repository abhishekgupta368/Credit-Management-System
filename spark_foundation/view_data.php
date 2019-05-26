<?php
session_start();
require 'db_info.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Credit Transfer</title>
    <link rel="stylesheet" href="view_data.css">
  </head>
  <body>
    <div class="outter_box">
      <center><h1>User Credits</h1></center>
      <table align="center">
        <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>email</th>
          <th>credit</th>
        </tr>
        <?php
        $sql_data = "SELECT * FROM credits";
        $res = mysqli_query($conn,$sql_data);
        while ($row=mysqli_fetch_array($res)) {
          echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['email'].'</td>';
            echo '<td>'.$row['credit'].'</td>';
          echo "</tr>";
        }
        ?>
      </table>
      <center>
      <div>
          <button type="button" name="button" onclick="change_win()">Transfer Money</button>
      </div>
    </center>
    </div>

  </body>
  <script type="text/javascript">
  function change_win(){
    window.location.href="index.php"
  }
  </script>
</html>
