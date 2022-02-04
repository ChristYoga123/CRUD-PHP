<?php 
// HALAMAN UPDATE DATA

// koneksi ke function
require "fungsi.php";

// koneksi ke database
$connection = mysqli_connect("localhost", "root", "", "sqldasar");

// ambil data database dari id yang sudah di GET.
$id = $_GET["id"];
// diberi [0] karena sebenarnya fungsi query ini mengembalikan array numerik baru di dalamnya ada array associative jadi harus dibuka dulu.
$mhs = query("SELECT * FROM produk WHERE id_produk = $id")[0];

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
            <input type="hidden" name="id_produk" value="<?=$mhs['id_produk']?>">
            <li>
                <label for="Nama">Nama: </label>
                <input type="text" name="nama_produk" id="Nama" required value="<?=$mhs['nama_produk']?>">
            </li>
            <li>
                <label for="NIM">Desk: </label>
                <input type="text" name="deskripsi" id="NIM" required value="<?=$mhs['deskripsi']?>">
            </li>
            <li>
                <label for="Jurusan">Harga: </label>
                <input type="text" name="harga" id="Jurusan" required value="<?=$mhs['harga']?>">
            </li>
            <li>
                <label for="Jurusan">Warna: </label>
                <input type="text" name="warna" id="Jurusan" required value="<?=$mhs['warna']?>">
            </li>
            <li>
                <label for="Jurusan">Ukuran: </label>
                <input type="text" name="ukuran" id="Jurusan" required value="<?=$mhs['ukuran']?>">
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
