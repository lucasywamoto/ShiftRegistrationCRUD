<?php
    session_start();

    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require 'database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = hash('sha512', $_POST['password']);

        $sql = "SELECT user_id, name, username FROM phpadmins 
        WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($sql);

        $count = $result->rowCount();

        if ($count == 1) {
            $row = $result->fetch();

            $_SESSION['timeout'] = time() + 300; //seconds

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            $name = $row['name'];
            $username = $row['username'];

            // Set cookie
            setcookie('name', $name, time() + 150, '/');
            setcookie('username', $username, time() + 150, '/');

            // redirect the user
            header('Location: ./clock-in.php');
            exit(); // Ensure script stops after redirection
        } else {
            echo 'Invalid Login';
        }
    }

    $conn = null;
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
        include_once 'includes/header.php';
        ?>
    </header>
    <main>
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