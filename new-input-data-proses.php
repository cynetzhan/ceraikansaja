<?php 

session_start();

if (!isset($_SESSION["nama"])) {
    header("location:login.php");
}
elseif ($_SESSION['type'] !=0) {
    header("location:login.php");
}   


include 'conf/koneksi.php'; 
 
 foreach(range(0,count($_POST['np'])-1) as $idx){
  $np				= $_POST['np'][$idx];
  $kec			= $_POST['kec'][$idx];
  $kel			= $_POST['kel'][$idx];
  $alamat			= $_POST['alamat'][$idx];
  $lat			= $_POST['lat'][$idx];
  $lng			= $_POST['lng'][$idx];
  $simpan = mysql_query("INSERT INTO data_cerai VALUES ('','$np','$kec','$kel','$alamat','$lat','$lng')");
 }
if($simpan){
  	echo "<script>alert('Data berhasil di tambah.'); window.location = 'list-data.php';</script>";

} else {
	echo "<script>alert('Kesalahan saat menambah. Error: ".mysql_error()." '); window.location = 'new-input-data.php';</script>";
	
	} 
?>