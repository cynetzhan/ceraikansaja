<?php 


include 'conf/koneksi.php';

$id = $_POST['id'];

$Query = mysql_query("SELECT * FROM user WHERE np=$id ");
$details = mysql_fetch_assoc($Query);
?>

<table class="table">
	<tr>
		<td class="success">No Keputusan</td>
		<td>:</td>
		<td><?php echo $details['np']; ?></td>
	</tr>
	<tr>
		<td class="success">Kota</td>
		<td>:</td>
		<td><?php echo $details['kota']; ?></td>
	</tr>
	<tr>
		<td class="success">Kecamatan</td>
		<td>:</td>
		<td><?php echo $details['kec']; ?></td>
	</tr>
	<tr>
		<td class="success">Kelurahan</td>
		<td>:</td>
		<td><?php echo $details['kel']; ?></td>
	</tr>
	<tr>
		<td class="success">Alamat</td>
		<td>:</td>
		<td><?php echo $details['alamat']; ?></td>
	</tr>
	<tr>
		<td class="success">Latitude</td>
		<td>:</td>
		<td><?php echo $details['lat']; ?></td>
	</tr>
	<tr>
		<td class="success">Longitude</td>
		<td>:</td>
		<td><?php echo $details['lng']; ?></td>
	</tr>
	<tr>
		<td class="success">Zoom</td>
		<td>:</td>
		<td><?php echo $details['zoom']; ?></td>
	</tr>
</table>