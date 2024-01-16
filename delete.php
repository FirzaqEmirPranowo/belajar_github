<!-- fungsi mengambil data terpilih berdasarkan id -->
<?php
// koneksi database
include_once("config.php");
if (isset($_POST['delete'])) {

    // ambil data dari url
    $id = $_POST['id'];
    // fungsi untuk menghapus data
    $result = mysqli_query($mysqli, "DELETE FROM tb_siswa WHERE id=$id");

    // Redirect to homepage to display updated user in list
    header("Location: tabel.php");
}
?>

<!-- fungsi mengambil data terpilih berdasarkan id -->
<?php
// ambil data dari url
$id = $_GET['id'];

// ambil data sesuai id
$result = mysqli_query($mysqli, "SELECT * FROM tb_siswa WHERE id=$id");

while ($user_data = mysqli_fetch_array($result)) {
    $name = $user_data['name'];
}
?>

<html>

<head>
    <title>Hapus Data User</title>
</head>

<body>
    <a href="tabel.php">Kembali</a>
    <br /><br />

    <form name="delete_user" method="post" action="delete.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <h3>Apakah Anda yakin menghapus data <?php echo $name; ?> ?</h3>
        <input type="submit" name="delete" value="Hapus">
        <input type="button" value="Batal" onclick="window.location.href='tabel.php'">
    </form>
</body>

</html>