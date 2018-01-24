<?php
 
include 'conf/koneksi.php';
	
	$id    = $_POST['id'];
 $np				= $_POST['np'];		
	$kec			= $_POST['kec'];
	$kel			= $_POST['kel'];
	$alamat= $_POST['alamat'];
	$lat			= $_POST['lat'];
	$lng			= $_POST['lng'];

$update = mysql_query("UPDATE data_cerai SET np='$np',kec='$kec',kel='$kel',alamat='$alamat',lat='$lat',lng='$lng' WHERE id='$id' ");

if ($update) {
    echo "<script>alert('Data Berhasil di Ubah'); window.location = 'list-data.php';</script>";
} else {
    echo "<script>alert('Data Gagal di ubah');</script>";
}
?>
