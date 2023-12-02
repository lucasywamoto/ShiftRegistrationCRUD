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
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        require 'database.php';
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirmPassword'];
        $ok = true;
        if (empty($name)) {
            echo '<p>Name required</p>';
            $ok = false;
        }
        if (empty($username)) {
            echo '<p>Username required</p>';
            $ok = false;
        }
        if ((empty($password)) || ($password != $confirm)) {
            echo "<p>Passwords don't match</p>";
            $ok = false;
        }

        if ($ok) {
            $stmt = $conn->prepare("SELECT * FROM phpadmins WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $existingUser = $stmt->fetch();
    
            if ($existingUser) {
                echo "<p>Username already exists. Please choose a different username.</p>";
                $ok = false;
            }
        }
        
        if ($ok) {
            $password = hash('sha512', $password);
            $sql = "INSERT INTO phpadmins (name, username, password) 
		VALUES ('$name', '$username', '$password');";
            $conn->exec($sql);
            echo '<section class="success-row">';
            echo '<div>';
            echo '<h3>Admin Saved</h3>';
            echo '</div>';
            echo '</section>';
            echo '<script>window.location.href = "signin.php";</script>';
            exit();
        }
        ?>
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