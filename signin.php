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
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include_once 'includes/header.php';
    ?>
  </header>
  <main>
    <div class="two-column">
      <div class="left-column">
        <img src="images/clocking-system-banner.jpg" alt="Clocking System" width="450" class="home-image">
      </div>
      <div class="right-column">
        <h2 style="color: white; text-align: center;">Looks like you're not<br>signed in!</h2>
        <hr class="solid-divider">
        <div class="input-container">
          <form action="validate.php" method="post">
            <h2 style="text-align: center; color: white;">Sign in</h2>
            <div class="form-fields">
              <div class="mb-3">
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required>
              </div>
            </div>
            <div class="input-container form-buttons">
              <input class="btn btn-primary" style="background-color: white; color: #0d6efd;" type="submit" value="Login">
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <footer>
    <?php
    include_once 'includes/footer.php';
    ?>
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>