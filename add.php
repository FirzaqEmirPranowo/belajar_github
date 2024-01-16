<html>

<head>
    <title>Add Users</title>
</head>

<body>
    <a href="tabel.php">Go to Home</a>
    <br /><br />

    <form action="add.php" method="post" name="form1" enctype="multipart/form-data">
        <table width="25%" border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><input type="text" name="mobile"></td>

            </tr>
            <tr>
                <td>Gambar</td>
                <td><input type="file" name="gambar"></td>

            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php
    // cek apakah tombol submit sudah bernilai true
    if (isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $gambar = $_FILES['gambar']['name'];

        // koneksi dengan database
        include_once("config.php");

        //cek dulu jika ada gambar produk jalankan coding ini
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
                $query = "INSERT INTO tb_siswa(name,email,mobile,gambar) VALUES('$name','$email','$mobile', '$nama_gambar_baru')";
                $result = mysqli_query($mysqli, $query);
                // periska query apakah ada error
                if (!$result) {
                    die("Query gagal dijalankan: " . mysqli_errno($mysqli) .
                        " - " . mysqli_error($mysqli));
                } else {
                    //tampil alert dan akan redirect ke halaman tabel.php
                    // menampilkan pesan success
                    echo "User added successfully. <a href='tabel.php'>Lihat user</a>";
                }
            } else {
                //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tabel.php';</script>";
            }
        } else {
            $query = "INSERT INTO tb_siswa(name,email,mobile,gambar) VALUES('$name','$email','$mobile', null)";
            $result = mysqli_query($mysqli, $query);
            // periska query apakah ada error
            if (!$result) {
                die("Query gagal dijalankan: " . mysqli_errno($mysqli) .
                    " - " . mysqli_error($mysqli));
            } else {
                //tampil alert dan akan redirect ke halaman tabel.php
                // menampilkan pesan success
                echo "User added successfully. <a href='tabel.php'>Lihat user</a>";
            }
        }
    }
    ?>
</body>

</html>