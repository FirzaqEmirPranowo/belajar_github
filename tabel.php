<?php
// koneksi dengan database
include_once("config.php");

// Ambil data dari database menggunakan Query SQL
$result = mysqli_query($mysqli, "SELECT * FROM tb_siswa ORDER BY id DESC");
// var_dump(mysqli_fetch_array($result));
?>


<html>

<head>
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1>DATA USER</h1>
    <a href="add.php">Tambah data</a><br /><br />
    <a href="logout.php">Logout</a><br /><br />

    <table width='80%' border=1>

        <tr>
            <th>Name</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Gambar</th>
            <th>Update</th>
        </tr>
        <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $user_data['name'] . "</td>";
            echo "<td>" . $user_data['mobile'] . "</td>";
            echo "<td>" . $user_data['email'] . "</td>";
            echo "<td style='text-align: center;'><img src='gambar/{$user_data['gambar']}' style='width: 120px;'></td>";
            echo "<td><a href='edit.php?id=$user_data[id]'>Edit</a> | <a href='delete.php?id=$user_data[id]'>Delete</a></td></tr>";
        }
        ?>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>