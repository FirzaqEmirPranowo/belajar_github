<!-- fungsi update -->
<?php
// tambahkan koneksi database
include_once("config.php");
// cek apakah user sudah mengupdate data dengan menekan tombol update
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $email = $_POST['email'];
    $gambar = $_FILES['gambar']['name'];

    if ($gambar != "") {
        $ekstensi_diperbolehkan = array('png', 'jpg'); //ekstensi file gambar yang bisa diupload 
        $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $angka_acak     = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $gambar; //menggabungkan angka acak dengan nama file sebenarnya
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
            // jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
            $query = "UPDATE tb_siswa SET name='$name',email='$email',mobile='$mobile', gambar='$nama_gambar_baru' WHERE id=$id";
            $result = mysqli_query($mysqli, $query);
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($mysqli) .
                    " - " . mysqli_error($mysqli));
            } else {
                // Redirect to homepage to display updated user in list
                header("Location: tabel.php");
            }
        } else {
            //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
            echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tabel.php';</script>";
        }
    } else {
        $result = mysqli_query($mysqli, "UPDATE tb_siswa SET name='$name',email='$email',mobile='$mobile' WHERE id=$id");
        header("Location: tabel.php");
    }
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
    $email = $user_data['email'];
    $mobile = $user_data['mobile'];
    $gambar = $user_data['gambar'];
}
?>
<html>

<head>
    <title>Edit Data User</title>
</head>

<body>
    <a href="tabel.php">Home</a>
    <br /><br />

    <form name="update_user" method="post" action="edit.php" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value=<?php echo $name; ?>></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value=<?php echo $email; ?>></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><input type="text" name="mobile" value=<?php echo $mobile; ?>></td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td> <img src="gambar/<?php echo $gambar; ?>" style="width: 120px;float: left;margin-bottom: 5px;"></td>
                <td><input type="file" name="gambar" />
                    <br>
                    <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar</i>
                </td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>