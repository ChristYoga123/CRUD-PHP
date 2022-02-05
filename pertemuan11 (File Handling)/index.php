<?php 

// File Handling (Upload File)

/*
Akan belajar tentang:
a. TAG HTML = <input type="file">... => menerima inputan bentuk file
b. ATRIBUT HTML (Form) = enctype => mengatur tipe encoding file
c. SUPERGLOBAL PHP = $_FILES => khusus untuk menangani data tipe file
d. FUNCTION PHP = move_uploaded_file => memindahkan file yang diinput dari komputer ke server.

Jika kita sudah mengganti tipe input tetapi belum merubah method dari form, maka gambar yang masuk tetap dikelola sebagai string biasa. Maka diperlukan encrypt. Jika diencrypt maka file tadi tidak akan dikelola oleh $_POST secara string tetapi dikelola oleh $_FILES. Jika di var_dump, yang tampil adalah:

1. var_dump($_POST); -> array assoc
array(5) {
  ["id"]=>
  string(1) "1"
  ["Nama"]=>
  string(25) "Christianus Yoga Wibisono"
  ["NIM"]=>
  string(12) "212410101009"
  ["Jurusan"]=>
  string(16) "Sistem Informasi"
  ["submit"]=>
  string(0) ""
}

2. var_dump($_FILES); -> array assoc multi-dimensi
array(1) {
  ["Gambar"]=>
  array(6) {
    ["name"]=>
    string(20) "Screenshot (582).png"
    ["full_path"]=>
    string(20) "Screenshot (582).png"
    ["type"]=>
    string(9) "image/png"
    ["tmp_name"]=>
    string(24) "C:\xampp\tmp\php2F31.tmp"
    ["error"]=>
    int(0)
    ["size"]=>
    int(140544)
  }
}

*/

?>

<?php 
require "fungsi.php";
// Order by ASC => index kecil ke besar
// Order by DESC => index besar ke kecil
$mahasiswa = query("SELECT * FROM produk");
var_dump($mahasiswa);

// jika tombol cari di klik, kita timpa data $mahasiswa dengan query baru sesuai dengan kebutuhan
if(isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- judul halaman daftar mahasiswa -->
    <h1>Daftar mahasiswa</h1>
    
    <!-- tambah mahasiswa -->
    <a href="insert.php">Tambah data mahasiswa</a>
    
    <br>

    <!-- menu cari -->
    <form action="" method="post">
        <input type="text" name="keyword" id="" size="40" autofocus placeholder="masukkan pencarian" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>

    <br>

    <!-- tabel mahasiswa -->
    <table border="1" cellpadding = '10' cellspacing = '0'>
        <!-- keterangan kolom -->
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Deskrips</th>
            <th>Harga</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Gambar</th>

        </tr>
        <?php 
        // inisialisasi penomoran agar jika ada data yang dihapus, nomornya tidak auto increment tetapi menyesuaikan jumlah baris
        $i = 1;
        // data yang masuk di var mahasiswa ditampilkan dengan perulangan agar yang tampil tidak hanya satu data
        foreach($mahasiswa as $mhs):
        ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="update.php?id=<?= $mhs["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin?')">ubah</a> |
                <a href="delete.php?id=<?= $mhs["id_produk"]; ?>" onclick="return confirm('Apakah anda yakin?')">hapus</a>
            </td>
            <td><?= $mhs["nama_produk"]; ?></td>
            <td><?= $mhs["deskripsi"]; ?></td>
            <td><?= $mhs["harga"]; ?></td>
            <td><?= $mhs["warna"]; ?></td>
            <td><?= $mhs["ukuran"]; ?></td>
            <td><img src="./img/<?=$mhs["Gambar"];?>" alt=""></td>
        </tr>
        <?php 
        $i++;
        endforeach;
        ?>
    </table>

    
</body>
</html>