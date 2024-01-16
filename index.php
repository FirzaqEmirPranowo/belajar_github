<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']); // Hash the input confirm password using SHA-256

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($mysqli, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (name ,username, email, password)
                    VALUES ('$name' ,'$username', '$email', '$password')";
            $result = mysqli_query($mysqli, $sql);
            if ($result) {
                header("Location: login.php");
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $name = "";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 20%;
            padding: 5px;
        }

        .btn {
            display: block;
            width: 20%;
        }
    </style>
</head>

<body>
    <p>Registrasi akun user</p>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input class="form-control" type="text" name="name" placeholder="Nama kamu" required />
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Username" required />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Alamat Email" required />
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password" required />
        </div>

        <div class="form-group">
            <label for="cpassword">Password</label>
            <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password" required />
        </div>

        <input type="submit" class="btn btn-success btn-block" name="register" value="Daftar" />
    </form>

</body>

</html>