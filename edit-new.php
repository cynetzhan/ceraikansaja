<?php
include('header.php');
$query = "SELECT * FROM data_cerai WHERE id = '$_GET[id]'";
$result = mysql_query($query);
$data = mysql_fetch_assoc($result);

?>
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-forms-common">

                    <div class="pageheader">

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
                                </li>
                                <li>
                                    <a href="#">Data</a>
                                </li>
                                <li>
                                    <a href="#">Ubah Data Putusan Cerai</a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>Ubah Data</strong> Putusan Cerai</h1>
                                    <ul class="controls">
                                        <li class="dropdown">

                                            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                                <i class="fa fa-cog"></i>
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </a>

                                            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-toggle">
                                                        <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                        <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-refresh">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a role="button" tabindex="0" class="tile-fullscreen">
                                                        <i class="fa fa-expand"></i> Fullscreen
                                                    </a>
                                                </li>
                                            </ul>

                                        </li>
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
     <div class="tile-body">
     <form method="POST" class="form-horizontal" name="form1" role="form" id="form1" action="edit-new-proses.php">
     <input type="hidden" name="id" class="form-control" value="<?= $_GET['id'] ?>">
      <div class="form-group">
       <label class="col-sm-2 control-label">Nomor Putusan</label>
       <div class="col-sm-10">
           <input type="text" name="np" class="form-control" placeholder="No Putusan" value="<?= $data['np'] ?>"required>
       </div>
      </div>
      <hr class="line-dashed line-full" />
      
      <div class="form-group">
          <label class="col-sm-2 control-label">Kecamatan</label>
          <div class="col-sm-10">
              <input type="text" id="addr_kec" name="kec" class="form-control" placeholder="Kecamatan" value="<?= $data['kec'] ?>"required>
          </div>
      </div>
      <hr class="line-dashed line-full" />

      <div class="form-group">
          <label class="col-sm-2 control-label">Kelurahan</label>
          <div class="col-sm-10">
              <input type="text" id="addr_kel" name="kel" class="form-control" placeholder="Kelurahan" value="<?= $data['kel'] ?>"required>
          </div>
      </div>
      <hr class="line-dashed line-full" />

      <div class="form-group">
          <label class="col-sm-2 control-label">Alamat</label>
          <div class="col-sm-10">
              <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required><?= $data['alamat'] ?></textarea>
                <button id="geocodeit" type="button" class="btn btn-primary"><span class="fa fa-map"></span> Cari Koordinat</button>
          </div>
      </div>
      <hr class="line-dashed line-full" />

      <div class="form-group">
          <label class="col-sm-2 control-label">Latitude</label>
          <div class="col-sm-10">
              <input id="lat" value="<?= $data['lat'] ?>" type="text" name="lat" class="form-control" placeholder="Latitude">
          </div>
      </div>
      <hr class="line-dashed line-full"/>

      <div class="form-group">
          <label class="col-sm-2 control-label">Longtitude</label>
          <div class="col-sm-10">
              <input id="lng" value="<?= $data['lng'] ?>" type="text" name="lng" class="form-control" placeholder="Longtitude">
          </div>
      </div>

      <hr class="line-dashed line-full" />
         <!-- SUBMIT BUTTON -->
         <button type="submit" class="btn btn-success" id="form1Submit" >Submit</button>
         <button type="reset" class="btn btn-danger"> Reset</button>
     </div>
         </form>

     </div>
     <!-- /tile body -->
 </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->




                </div>
                
            </section>
            <!--/ CONTENT -->






        </div>
        <!--/ Application Content -->
<?php ob_start() ?>
        <script src="assets/js/leaflet.js"></script>
        <script>

        $(document).ready(function () {
        	$("#geocodeit").click(function () {
        			address = $("textarea#alamat").val() + ", " + $("#addr_kec").val() + ", Pekanbaru";
        			console.log(address);
           $.ajax({
            dataType: "json",
            async: false,
            url:'https://maps.googleapis.com/maps/api/geocode/json',
            data:{
             'address': address,
             'key': 'AIzaSyCfswesJkjAcixCfuhU42Ss6dHlFCG5JAk'
            }, 
            success:function (res, status) {
             console.log(res);
             if (res.status === 'OK') {
              _results = res;
              hasil = {
               'lat': res.results[0].geometry.location.lat,
               'lng': res.results[0].geometry.location.lng
              };
              console.log(Date() + " : AJAX diinputkan");
              $("#lat").val(hasil['lat']);
              $("#lng").val(hasil['lng']);
             } else {
              alert('Pencarian tidak mendapatkan hasil. Kode Error: ' + res.status);
             }
            }
           });
        	});
        });
        </script>
<?php
$vws->set_inline(ob_get_clean());
include('footer.php');
