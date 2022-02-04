<?php 
require "fungsi.php";
// Order by ASC => index kecil ke besar
// Order by DESC => index besar ke kecil
$mahasiswa = query("SELECT * FROM produk");

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
            <td><?= $mhs["Gambar"]; ?></td>
        </tr>
        <?php 
        $i++;
        endforeach;
        ?>
    </table>

    
</body>
</html>
