<?php 
require "fungsi.php"; 
// data yang ditangkap di URL dimasukkan ke dalam variabel
$id = $_GET["id"];
if(hapus($id) > 0) {
    echo "
        <script>
            alert('Data berhasil dihapus');
            document.location.href='index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data gagal dihapus);
            document.location.href='index.php';
        </script>
    ";
}
?>