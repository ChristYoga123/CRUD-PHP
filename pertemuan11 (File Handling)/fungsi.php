<?php 
function query($query) {
    // koneksi php ke sql
    $connection = mysqli_connect("localhost", "root", "", "shoes");
    // ambil data sql dan disimpan ke variable
    $result = mysqli_query($connection, $query);
    // masukkan data sql ke var rows dengan perulangan
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        // data perulangan di dalam $row diappend ke $rows
        $rows[] = $row;
    }
    return $rows;
}

function tambah($method) {
    // koneksi php ke mysql
    $connection = mysqli_connect("localhost", "root", "", "shoes");

    // data inputan dimasukkan ke variable
    $nama = htmlspecialchars($method["nama_produk"]);
    $deskripsi = htmlspecialchars($method["deskripsi"]);
    $harga = htmlspecialchars($method["harga"]);
    $warna = htmlspecialchars($method["warna"]);
    $ukuran = htmlspecialchars($method["ukuran"]);

    // upload gambar menggunakan func upload
    $gambar = upload();
    if(!$gambar) {
        return false;
    }

    // data dimasukkan ke database dengan query
    $query = "INSERT INTO mahasiswa VALUES('', '$nama', '$deskripsi', '$harga', '$warna', '$ukuran', '$gambar')";
    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function hapus($id) {
    $connection = mysqli_connect("localhost", "root", "", "sqldasar");
    $query = "DELETE FROM mahasiswa WHERE id_produk = $id";
    $result = mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function ubah($method) {
    $connection = mysqli_connect("localhost", "root", "", "shoes");

    // data inputan dimasukkan ke variable
    $id = $method["id_produk"];
    $nama = htmlspecialchars($method["nama_produk"]);
    $deskripsi = htmlspecialchars($method["deskripsi"]);
    $harga = htmlspecialchars($method["harga"]);
    $warna = htmlspecialchars($method["warna"]);
    $ukuran = htmlspecialchars($method["ukuran"]);

    $gambar = upload();
    // query update
    $query = "UPDATE produk SET 
              nama_produk = '$nama',
              deskripsi = '$deskripsi',
              harga = '$harga',
              warna = '$warna',
              ukuran = '$ukuran',
              Gambar = '$gambar'
              WHERE id_produk = $id";
    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function cari($keyword) {
    $connection = mysqli_connect("localhost", "root", "", "sqldasar");
    $query = "SELECT * FROM mahasiswa WHERE Nama LIKE '%$keyword%' OR NIM LIKE '%$keyword%' OR Jurusan LIKE '%$keyword%'";
    $result = mysqli_query($connection, $query);
    return $result;
}

function upload() {
    // mengambil isi data dari file
    $namaFile = $_FILES["Gambar"]["name"];
    $ukuranFile = $_FILES["Gambar"]["size"];
    $error = $_FILES["Gambar"]["error"];
    $tmpName = $_FILES["Gambar"]["tmp_name"];

    // pengecekan 1: Ada gambar yang diupload atau tidak. Value 4 menunjukkan jika tidak ada gambar yang diupload
    if($error === 4) {
        echo "
            <script>
                alert('Pilih gambar terlebih dahulu');
            </script>
        ";
        return false;
    }

    // pengecekan 2: Apakah yang diupload file gambar atau bukan
    $ekstensiValid = ["jpg", "jpeg", "png"]; #kalo misal ada ekstensi lain bisa ditambahkan
    $ekstensi = explode(".", $namaFile); #parameternya adalah delimiter dan string.
    $ekstensi = strtolower(end($ekstensi)); #func end untuk mengambil array terakhir
    if(!in_array($ekstensi, $ekstensiValid)) {
        echo "
        <script>
            alert('Yang diupload bukan gambar');
        </script>
        ";
    return false;
    }

    // pengecekan 3: Jika lolos, gambar diupload
    // generate nama gambar baru agar jika ada user yang up file dengan nama sama, tidak menimpa nilai di variabel sebelumnya

    $namaFilebaru = uniqid();
    $namaFilebaru .= ".";
    $namaFilebaru .= $ekstensi;

    move_uploaded_file($tmpName, "img/" . $namaFilebaru);

    // return namafile sehingga jika kita kembali ke func tambah atau update, namafilenya masuk ke variabel gambar sebelumnya
    return $namaFilebaru;
}
?>