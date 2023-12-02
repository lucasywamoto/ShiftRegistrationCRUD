<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Work Shifts Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="images/logo@256x.png">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <?php
    include_once 'includes/header.php'
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
  </header>
  <main>
    <div class="shift-registration-main">
      <?php
      $uploadSuccess = null;
      $valid_file = true;

      if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
        session_unset();  
        session_destroy();
        echo '<p class="hello">Hello, guest!</p>';
      } else {
        require 'database.php'; 

        $user_id = $_SESSION['user_id'];

        try {
          $sql = "SELECT user_id, name FROM phpadmins WHERE user_id = :user_id";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':user_id', $user_id);
          $stmt->execute();

          $userData = $stmt->fetch(PDO::FETCH_ASSOC);

          $nameFromDB = isset($userData['name']) ? $userData['name'] : '';
          echo '<p class="hello">Hello, ' . $nameFromDB . '!</p>';
        } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      }
      ?>

      <div class="form-container">
        <form action="add.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
          </div>
          <div class="input-container">
            <div class="mb-3">
              <label for="employee-id" class="form-label">Employee ID</label>
              <input type="text" class="form-control" name="employee-id" id="employee-id" aria-describedby="helpId" placeholder="0">
            </div>
            <div class="mb-3">
              <label for="avatar" class="form-label">Avatar</label>
              <input type="file" class="form-control" id="avatar" name="avatar">
              <small id="avatarHelp" class="form-text text-muted">Upload your avatar image.</small>
            </div>
          </div>
          <div class="input-container">
            <div class="mb-3">
              <label for="branch" class="form-label">Branch</label>
              <select class="form-select form-select-lg" name="branch" id="branch" required>
                <option selected>Select one</option>
                <option value="Toronto">Toronto</option>
                <option value="Ottawa">Ottawa</option>
                <option value="Montreal">Montreal</option>
                <option value="Calgary">Calgary</option>
                <option value="Vancouver">Vancouver</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Date</label>
              <input type="date" class="form-control" id="date" name="date" required />
            </div>
            <div class="mb-3">
              <label for="time-in" class="form-label">Time in</label>
              <input type="time" class="form-control" id="time-in" name="time-in" required />
            </div>
            <div class="mb-3">
              <label for="time-out" class="form-label">Time out</label>
              <input type="time" class="form-control" id="time-out" name="time-out" required />
            </div>
          </div>
          <div class="input-container form-buttons">
            <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
            <button type="reset" class="btn btn-primary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <footer>
    <?php
    include_once 'includes/footer.php';
    ?>
  </footer>
</body>

</html>