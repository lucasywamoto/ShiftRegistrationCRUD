<?php
  session_start();
  include_once 'database.php';
?>
<!doctype html>
<html lang="en">

<head>
  <title>Work Shifts Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="images/logo@256x.png">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <?php
      include_once 'includes/header.php';
    ?>
  </header>
  <main>
    <div class="shift-registration-main" style="padding-top: 32px;">
      <div class="form-container" style="width: 80%;">
        <h1 style="margin-bottom: 32px">Timesheet</h1>
        <table style="width:100%">
          <?php
            $sql = 'SELECT * FROM timesheet';
            $result = $conn->query($sql);
          ?>
          <tr style="height: 40px">
            <th></th>
            <th>Employee</th>
            <th>ID</th>
            <th>Branch</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Duration</th>
            <?php
              if (isset($_SESSION['user_id'])) {
                echo '<th>Edit</th>';
                echo '<th>Delete</th>';
              }
            ?>
          </tr>
          <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            foreach($result as $key => $res){
              echo '<tr style="border-top: 1px solid #0d6efd; height: 40px">';
              if ($res['avatar']) {
                echo "<td><img src='./avatar/".$res['avatar']."'height='32' width='32' style='border-radius: 50%; object-fit: cover;'></td>";
              } else {
                echo "<td><img src='./images/6676023.png'height='32' width='32' style='border-radius: 50%; object-fit: cover;'></td>";

              }
              echo "<td>".$res['employee_name']."</td>";
              echo "<td>".$res['employee_id']."</td>";
              echo "<td>".$res['branch']."</td>";
              echo "<td>".$res['shift_date']."</td>";
              echo "<td>".$res['time_in']."</td>";
              echo "<td>".$res['time_out']."</td>";
              echo "<td>".$res['duration']."</td>";
              if (isset($_SESSION['user_id'])) {
                echo "<td><a href='edit.php?id=".$res['workshift_id']."' class='btn btn-primary'>Edit</a></td>";
                echo "<td><a href='delete.php?id=".$res['workshift_id']."' class='btn btn-danger'>Delete</a></td>";
              }
                echo "</tr>";
            }
          ?>
            </table>
      </div>
    </div>
  </main>
  <footer>
    <?php
      include_once 'includes/footer.php';
    ?>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>