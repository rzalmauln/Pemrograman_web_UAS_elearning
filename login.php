<?php
session_start();
include("../tugas_4/config.php");
$validation = '';

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $cookie_username = $_COOKIE['username'];
    $cookie_password = $_COOKIE['password'];
    $query = mysqli_query($mysqli, "SELECT * from users where username = '$cookie_username'");
    $row = mysqli_fetch_array($query);

    if ($row['password'] == $_COOKIE['password']) {
        $_SESSION['username'] == $cookie_username;
        $_SESSION['password'] == $cookie_password;
    }
}

if (isset($_SESSION['username'])) {
    if ($row['role'] == 'admin') {
        header("Location: ./admin/index.php");
    } else if ($row['role'] == 'mahasiswa') {
        header("Location: ./mahasiswa/index.php");
    } else if ($row['role'] == 'dosen') {
        header("Location: ./dosen/index.php");
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $user = mysqli_query($mysqli, $sql);

    // jika user terdaftar
    if ($user->num_rows > 0) {
        $row = mysqli_fetch_assoc($user);
        // verifikasi password
        if ($password === $row['password']) {

            // buat Session & cookies
            $_SESSION["username"] = $row['username'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["status"] = 'login';

            if (isset($_POST['remember'])) {
                setcookie('username', $row['username'], time() + 60, "/");
                setcookie('password', $row['password'], time() + 60, "/");
            }
            if ($row['role'] == 'admin') {
                header("Location: ./admin/index.php");
            } else if ($row['role'] == 'mahasiswa') {
                header("Location: ./mahasiswa/index.php");
            } else if ($row['role'] == 'dosen') {
                header("Location: ./dosen/index.php");
            }
        } else {
            $validation .= '<div class="alert alert-danger" role="alert">username dan password salah</div>';
        }
    } else {
        $validation .= '<div class="alert alert-danger" role="alert">username dan password salah</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5" style="margin-right:70px">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 me-5">
                    <?php
                    if ($validation != ' ') {
                        echo $validation;
                    }
                    ?>
                    <form method="POST" action="">
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fs-2 fw-bold mx-3 mb-0">Log In</p>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control <?php echo ($validation == '') ? '' : ' is-invalid' ?>" id="floatingInput" placeholder="Username" required>
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?php echo ($validation == '') ? '' : ' is-invalid' ?>" id=" floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" name="remember" checked type="checkbox" role="switch" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Ingat saya.</label>
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" name="login" class="d-block btn btn-primary btn-lg mx-auto" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <script src="./bootstrap.bundle.min.js"></script>
</body>

</html>