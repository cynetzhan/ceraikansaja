<?php
include('header.php')
?>
<link rel="stylesheet" href="assets/css/leaflet.css">
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">

                <div class="page page-tables-datatables">

                    <div class="pageheader">

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html"><i class="fa fa-home"></i> Beranda</a>
                                </li>
                                <li>
                                    <a href="#">Input</a>
                                </li>
                                <li>
                                    <a href="list-data.php">Input Data Perceraian</a>
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
                                    <h1 class="custom-font"><strong>Data</strong> Lokasi Perceraian</h1>
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


       <form method="POST" class="form-horizontal" name="form1" role="form" id="form1" action="new-input-data-proses.php"
       data-parsley-validate>
       <button type="button" class="btn btn-primary" id="btn_addform"><span class="fa fa-add"></span> Tambah Data</button>
       <button id="geocodeit" type="button" class="btn btn-primary"><span class="fa fa-map"></span> Cari Koordinat</button>
       <table class="table table-striped">
        <thead>
         <tr>
          <td></td>
          <th>No Putusan</th>
          <th>Kecamatan</th>
          <th>Kelurahan</th>
          <th>Alamat</th>
          <th>Latitude</th>
          <th>Longitude</th>
         </tr>
         </thead>
         <tbody id="isiform">
          <tr class="isi" id="row0">
           <td><button type="button" class="btn btn-primary" onclick="hapusRow(0)"><span class="fa fa-close"></span></button></td>
           <td><input type="text" name="np[]" class="form-control np" placeholder="No Putusan" required></td>
           <td><input type="text" name="kec[]" class="form-control addr_kec" placeholder="Kecamatan" required></td>
           <td><input type="text" name="kel[]" class="form-control addr_kel" placeholder="Kelurahan" required></td>
           <td><textarea name="alamat[]" class="form-control alamat" placeholder="Alamat" required></textarea></td>
           <td><input value= "" type="text" name="lat[]" class="form-control lat" placeholder="Latitude"></td>
           <td><input value="" type="text" name="lng[]" class="form-control lng" placeholder="Longtitude"></td>
          </tr>
         </tbody>
       </table>

       <!--hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">No Putusan</label>
               <div class="col-sm-10">
                   <input type="textbook" name="np" class="form-control" placeholder="No Putusan"
                          required>
               </div>
           </div>
           <hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">Kota</label>
               <div class="col-sm-10">
                   <input type="textbook" id="addr_kota" name="kota" class="form-control" placeholder="Kota"
                          required>
               </div>
           </div>
           <hr class="line-dashed line-full" />
           <div class="form-group">
               <label class="col-sm-2 control-label">Kecamatan</label>
               <div class="col-sm-10">
                   <input type="text" id="addr_kec" name="kec" class="form-control" placeholder="Kecamatan"
                          required>
               </div>
           </div>
           <hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">Kelurahan</label>
               <div class="col-sm-10">
                   <input type="text" id="addr_kel" name="kel" class="form-control" placeholder="Kelurahan"
                          required>
               </div>
           </div>
           <hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">Alamat Geocode</label>
               <div class="col-sm-10">
                   <input id="address" type="texbox" name="alamat" class="form-control" placeholder="Alamat"
                          required>
                     <button id="geocodeit" type="button" class="btn btn-primary"><span class="fa fa-map"></span> Cari Koordinat</button>
               </div>
           </div>

           <hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">Latitude</label>
               <div class="col-sm-10">
                   <input id="lat" value= "" type="textbook" name="lat" class="form-control" placeholder="Latitude">
               </div>
           </div>

           <hr class="line-dashed line-full"/>

           <div class="form-group">
               <label class="col-sm-2 control-label">Longtitude</label>
               <div class="col-sm-10">
                   <input id="lng" value="" type="textbook" name="lng" class="form-control" placeholder="Longtitude"       >
               </div>
           </div>

           <hr class="line-dashed line-full" />

           <div class="form-group">
               <label class="col-sm-2 control-label">Zoom</label>
               <div class="col-sm-10">
                   <input type="number" name="zoom" class="form-control" placeholder="Zoom">
               </div>
           </div>
          
           <hr class="line-dashed line-full" />
            </div> 

    <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
       <!-- SUBMIT BUTTON -->
       <button type="submit" class="btn btn-success" id="form1Submit" >Submit</button>
       <button type="reset" class="btn btn-danger"> Reset</button>
   </div>
                                    <!-- END SUBMIT BUTTON -->


<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 500px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 500px;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
          display:none;
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
    <div id="map"></div>
                            </section>
                            <!-- /tile -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Informasi Data Keseluruhan</h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        
                    </div>
                </div>
            </div>
        </div>

                        </div>
                        <!-- /col -->
                        
                    </div>
                    <!-- /row -->
<div class="tile-widget bg-greensea">
                                "Copyright © 2017"
                                <a href="www.github.com/renomuliasari">Reno Mulia Sari</a>
                                 All rights reserved.
                                </div>  
                </div>
                
            </section>
            <!--/ CONTENT -->

        </div>
        <!--/ Application Content -->

<?php ob_start() ?>
        <script src="assets/js/leaflet.js"></script>
        <script>
        var map;
        var geocoder;
        function hapusRow(row){
          $("tr#row"+row).remove()
         }
        $(document).ready(function () {
         var rowcount = 1;
         /*var standardClipboardEvent = function (clipboardEvent, event) {
         	var clipboardData = event.clipboardData;
         	if (clipboardEvent == 'paste') {
         		pasted = clipboardData.getData('text/plain');
           pasted.split('\n').forEach(function(data) {
            row = addForm();
            row_content = data.split('\t');
            $("tr#row"+(row-1)+" input#np").val(row_content[0]);
            $("tr#row"+(row-1)+" input#addr_kota").val(row_content[1]);
            $("tr#row"+(row-1)+" input#addr_kec").val(row_content[2]);
            $("tr#row"+(row-1)+" input#addr_kel").val(row_content[3]);
            $("tr#row"+(row-1)+" textarea#alamat").val(row_content[4]);
            $("tr#row"+(row-1)+" input#lat").val(row_content[5]);
            $("tr#row"+(row-1)+" input#lng").val(row_content[6]);
            $("tr#row"+(row-1)+" input#zoom").val("13");
           });
           //console.log('Clipboard Plain Text: ' + clipboardData.getData('text/plain'));
         	}
         };
         	document.addEventListener('paste', function (e) {
         		console.log('paste');
         			standardClipboardEvent('paste', e);
         			e.preventDefault();
         	});*/
         function addForm(){
          var isiform =  '<tr class="isi" id="row'+rowcount+'"><td><button type="button" class="btn btn-primary" onclick="hapusRow('+rowcount+')"><span class="fa fa-close"></span></button></td><td><input type="text" name="np[]" class="form-control np" placeholder="No Putusan" required></td><td><input type="text" name="kec[]" class="form-control addr_kec" placeholder="Kecamatan" required></td><td><input type="text" name="kel[]" class="form-control addr_kel" placeholder="Kelurahan" required></td><td><textarea name="alamat[]" class="form-control alamat" placeholder="Alamat" required></textarea></td><td><input value= "" type="text" name="lat[]" class="form-control lat" placeholder="Latitude"></td><td><input value="" type="text" name="lng[]" class="form-control lng" placeholder="Longtitude"></td></tr>';
          $("#isiform").append(isiform);
          return rowcount++;
         }
         
        	$("#geocodeit").click(function () {
        		//geocoder = new google.maps.Geocoder();
        		$("tr.isi").each(function (elem) {
           $this = $(this);
           this_sel = $(this)[0].id;
           console.log(this_sel);
        			address = $(this).find(".alamat").val() + ", " + $(this).find(".addr_kec").val() + ", Pekanbaru";
        			console.log(address);
           //console.log($(this).find("#lat").val());
        			if ($(this).find(".lat").val() === '' || $(this).find(".lng").val() === '') {
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
               L.marker([hasil['lat'], hasil['lng']], {
                title: address,
                riseOnHover: true
               }).addTo(map);
               //console.log($(this_sel+">td>#lat").find("#lat"));
               console.log(Date() + " : AJAX diinput ke "+this_sel);
               $("#"+this_sel+">td>.lat").val(hasil['lat']);
               $("#"+this_sel+">td>.lng").val(hasil['lng']);
              } else {
               alert('Geocode was not successful for the following reason: ' + res.status);
              }
             }
            });
        			} else {
            console.log($this.find(".alamat").val()+" sudah ditemukan");
           }
        		});
        		//geocodeAddress(geocoder, map);
        	});
        	var kecamatanColors = {
        		"Bukit Raya": "rgba(210,199,72,1.0)",
        		"Lima Puluh": "rgba(130,233,209,1.0)",
        		"Marpoyan Damai": "rgba(46,187,230,1.0)",
        		"Payung Sekaki": "rgba(132,116,220,1.0)",
        		"Pekanbaru": "rgba(218,63,63,1.0)",
        		"Rumbai": "rgba(107,214,139,1.0)",
        		"Rumbai Pesisir": "rgba(162,218,72,1.0)",
        		"Sail": "rgba(221,112,212,1.0)",
        		"Senapelan": "rgba(121,151,219,1.0)",
        		"Sukajadi": "rgba(204,156,117,1.0)",
        		"Tampan": "rgba(89,222,62,1.0)",
        		"Tenayan Raya": "rgba(159,78,209,1.0)"
        	};

        	/** fungsi untuk style kelurahan dikategorikan ke kecamatan
        	 */
        	function style_kelurahan(feature) {
        		return {
        			opacity: 1,
        			color: 'rgba(0,0,0,0.1)',
        			dashArray: '',
        			lineCap: 'butt',
        			lineJoin: 'miter',
        			weight: 1.0,
        			fillOpacity: 0.2,
        			fillColor: kecamatanColors[feature.properties['Kecamatan']]
        		};
        	}

        	var pekanbaru = L.geoJson(null, {
        			style: style_kelurahan,
        			onEachFeature: function (feature, layer) {
        				//to-do: put a real to-do here
        			}
        		});
        	$.getJSON("geodata-kelurahan.php", function (data) {
        		pekanbaru.addData(data);
        	});
         var osm = L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
          maxZoom: 20,
          subdomains: ['a' , 'b' , 'c'],
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
         });
        	var map = L.map("map", {
        			zoom: 10,
        			center: [0.54, 101.5],
        			layers: [osm, pekanbaru],
        			zoomControl: true,
        			attributionControl: true
        		});
          $("#btn_addform").click(function() {
           addForm();
          });
        });
        </script>
<?php
$vws->set_inline(ob_get_clean());
include('footer.php');