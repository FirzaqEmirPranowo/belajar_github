<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    header("Location: tabel.php");
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($mysqli, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: tabel.php");
        exit();
    } else {
        echo "<script>alert('username atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <p>Belum punya akun? <a href="index.php">Daftar di sini</a></p>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Username" />
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password" />
        </div>
        <input type="submit" class="btn btn-success btn-block" name="submit" value="Masuk" />
    </form>
</body>

</html>