<?php
include 'conf/koneksi.php'; 
$pass=md5($_POST['pass']);
$query=mysql_query("INSERT INTO login(nama,pass) values ('$_POST[nama]','$pass')");
if($query){
 echo "<script>alert('Pengguna berhasil ditambah'); window.location = 'user-add.php';</script>";
} else {
 echo "<script>alert('Pengguna gagal ditambah. Kode error: ".mysql_error() ."'); window.location = 'user_add.php';</script>";
}
 
?>