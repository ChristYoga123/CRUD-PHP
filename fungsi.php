<?php
function ubah($method) {
    $connection = mysqli_connect("localhost", "root", "", "sqldasar");

    // data inputan dimasukkan ke variable
    $id = $method["id"];
    $nama = htmlspecialchars($method["Nama"]);
    $nim = htmlspecialchars($method["NIM"]);
    $jurusan = htmlspecialchars($method["Jurusan"]);
    $gambar = upload();
    // query update
    $query = "UPDATE mahasiswa SET 
              Nama = '$nama',
              NIM = '$nim',
              Jurusan = '$jurusan',
              Gambar = '$gambar'
              WHERE No = $id";
    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}

function ubah($method) {
    $connection = mysqli_connect("localhost", "root", "", "sqldasar");

    // data inputan dimasukkan ke variable
    $id = $method["id"];
    $nama = htmlspecialchars($method["Nama"]);
    $nim = htmlspecialchars($method["NIM"]);
    $jurusan = htmlspecialchars($method["Jurusan"]);
    $gambar = upload();
    // query update
    $query = "UPDATE mahasiswa SET 
              Nama = '$nama',
              NIM = '$nim',
              Jurusan = '$jurusan',
              Gambar = '$gambar'
              WHERE No = $id";
    mysqli_query($connection, $query);
    return mysqli_affected_rows($connection);
}
?>
