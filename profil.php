<?php
include('conf/koneksi.php');
include('front_header.php'); 
$query = mysql_query("select * from profil where id_artikel='".$_GET['id']."'");
$artikel = mysql_fetch_assoc($query);
?>
    <div class="container" style="margin-top:70px;min-height:70vh">
     <div class="row">
      <div class="col-md-8">
       <h2><?= $artikel['judul_artikel'] ?></h2>
       <p><small>Terakhir diperbarui pada <?= tanggal($artikel['tgl_terbit_artikel'],true) ?></small></p>
           <?= html_entity_decode($artikel['isi_artikel']) ?>
      </div>
     </div>
    </div>
    
    <hr />
<?php 
include('front_footer.php');
?>