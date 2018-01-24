<?php 
session_start();

if (!isset($_SESSION["nama"])) {
    header("location:login.php");
}
elseif ($_SESSION['type'] !=0) {
    header("location:login.php");
}   

include 'conf/koneksi.php';

$id = $_GET['id'];
$hps = mysql_query("DELETE FROM data_cerai WHERE id=$id");
if ($hps) {

    echo "<script>alert('Data Berhasil dihapus'); window.location = 'list-data.php';</script>";
} else {
    echo "<script>alert('Terjadi Kesalahan saat menghapus data. Kode Error: '".mysql_error()."); window.location = 'list-data.php';</script>";
}
?>