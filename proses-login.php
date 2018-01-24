<?php 
session_start();

if (!isset($_SESSION["nama"])) {
    header("location:login.php");
}
elseif ($_SESSION['type'] !=0) {
    header("location:login.php");
}   

session_start();

require("conf/koneksi.php");

$encrypt_pass = $_POST['pass'];

$cek = "SELECT * from login where nama='$_POST[nama]' and pass='".md5($encrypt_pass)."'";

$query = mysql_query($cek);
$hasil_cek = mysql_num_rows($query);

if ($hasil_cek==0){
echo "<script>alert('Anda Gagal Login')
location.replace('login.php')</script>";

}else{
$hasil = mysql_fetch_assoc($query);
header("location:menus-admin.php");
$_SESSION['nama']=$hasil['nama'];
$_SESSION['type']=$hasil['type'];
}
?>