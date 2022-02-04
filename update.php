<?php 
// HALAMAN UPDATE DATA

// koneksi ke function
require "fungsi.php";

// koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "sqldasar");

// ambil data database dari id yang sudah di GET.
$id = $_GET["id"];
// diberi [0] karena sebenarnya fungsi query ini mengembalikan array numerik baru di dalamnya ada array associative jadi harus dibuka dulu.
$mhs = query("SELECT * FROM mahasiswa WHERE No = $id")[0];

//cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["submit"])) {
    //cek data apakah berhasil diubah atau tidak dikarenakan php tidak memberikan pesan kesalahan di web. Menggunakan mysqli_affected_rows({koneksi}).
    if(ubah($_POST) > 0) {
        echo "
        <script>
            alert('data berhasil diubah');
            document.location.href='index.php';
        </script>";
    } else {
        echo "Gagal <br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah</title>
</head>
<body>
    <!-- judul halaman tambah data -->
    <h1>Ubah Data</h1>

    <!-- membuat form. Enctype untuk mengurus data file. Untuk cek file, menggunakan superglobal var $_FILES -->
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <!-- membuat input hidden lalu dipost agar array dari id ini masuk ke function -->
            <input type="hidden" name="id" value="<?=$mhs['No']?>">
            <li>
                <label for="Nama">Nama: </label>
                <input type="text" name="Nama" id="Nama" required value="<?=$mhs['Nama']?>">
            </li>
            <li>
                <label for="NIM">NIM: </label>
                <input type="text" name="NIM" id="NIM" required value="<?=$mhs['NIM']?>">
            </li>
            <li>
                <label for="Jurusan">Jurusan: </label>
                <input type="text" name="Jurusan" id="Jurusan" required value="<?=$mhs['Jurusan']?>">
            </li>
            <li>
                <label for="Gambar">Gambar: </label>
                <input type="file" name="Gambar" id="Gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Kirim</button>
            </li>
        </ul>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>
