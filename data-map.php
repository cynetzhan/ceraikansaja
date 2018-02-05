<?php
include_once('conf/koneksi.php');
$vws->set_inline("<link rel='stylesheet' href='assets/css/MarkerCluster.css'/>");
$vws->set_inline("<link rel='stylesheet' href='assets/css/MarkerCluster.Default.css'/>");
include('header.php');
?>
<link rel="stylesheet" href="assets/css/leaflet.css">
<style>
.icoleg{
 margin:5px auto;
 padding:5px;
 text-align:center;
 color:#fff;
}
</style>
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
                                    <a href="#">Data</a>
                                </li>
                                <li>
                                    <a href="list-data.php">Data Titik Perceraian</a>
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
                                    <h1 class="custom-font"><strong>Data Titik Perceraian </strong></h1>
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
<script src="assets/js/leaflet.markercluster.js"></script>
        <!--/ custom javascripts -->
<script>
<?php
$kecamatan = ["Bukit Raya"=>0,"Lima Puluh"=>0,"Marpoyan Damai"=>0,"Payung Sekaki"=>0,"Pekanbaru Kota"=>0,"Rumbai"=>0,"Rumbai Pesisir"=>0,"Sail"=>0,"Senapelan"=>0,"Sukajadi"=>0,"Tampan"=>0,"Tenayan Raya"=>0];
$query = mysql_query("SELECT kec,count(*) as jumlah_cerai FROM `data_cerai` group by kec");
while($row=mysql_fetch_assoc($query)){
 $kecamatan[$row['kec']] = $row['jumlah_cerai'];
}
echo "jmcerai_kecamatan = ".json_encode($kecamatan)."\n";
?>
 function warnaChloro(nilai){
  warna = "rgba(241,227,58,1)";
  if(nilai > 150){
   warna = "rgba(241,58,58,1)"
  } else if(nilai > 50) {
   warna = "rgba(241,142,58,1)"
  }
  return warna
 }
 $("#geocodeit").click(function () {
  //geocoder = new google.maps.Geocoder();
  //geocodeAddress(geocoder, map);
  L.marker([0.54, 101.5], {
   title: "Pusat Kota Pekanbaru",
   riseOnHover: true
  }).addTo(map);
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
   fillOpacity: 0.5,
   fillColor: warnaChloro(jmcerai_kecamatan[feature.properties['Kecamatan']])
  };
 }

 var pekanbaru = L.geoJson(null, {
   style: style_kelurahan,
   onEachFeature: function (feature, layer) {
    layer.bindPopup("<strong>"+feature.properties['Kecamatan']+"</strong><br>Jumlah Perceraian: <strong>"+jmcerai_kecamatan[feature.properties['Kecamatan']]+"</strong>");
  }
  });
 $.getJSON("geodata-kelurahan.php", function (data) {
  pekanbaru.addData(data);
 });
 var markerClusters = new L.MarkerClusterGroup({
  spiderfyOnMaxZoom: true,
  showCoverageOnHover: false,
  zoomToBoundsOnClick: true,
  disableClusteringAtZoom: 16
 });
 var markerCeraiLayer = L.geoJson(null);
 var markerCerai = L.geoJson(null, {
  pointToLayer: function (feature, latlng) {
   return L.marker(latlng, {
    icon: L.icon({
     iconUrl: "assets/images/heartbreak.png",
     iconSize: [30,28],
     iconAnchor: [15, 28],
     popupAnchor: [0, -25]
    }),
    title: feature.properties.no_putusan,
    riseOnHover: true
   });
  },
  onEachFeature: function (feature, layer) {
   layer.bindPopup("<strong>"+feature.properties.no_putusan+"</strong><br>Alamat:"+feature.properties.alamat+", "+feature.properties.kel+", "+feature.properties.kec+"<br><a href='http://putusan.mahkamahagung.go.id/pengadilan/pa-pekanbaru/'>Cari Nomor Putusan</a>");
  }
 });
 $.getJSON("geodata-cerai.php", function (data) {
  markerCerai.addData(data);
  map.addLayer(markerCeraiLayer);
 });
 
 var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
     maxZoom: 20,
     subdomains:['mt0','mt1','mt2','mt3']
 });

 var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
     maxZoom: 20,
     subdomains:['mt0','mt1','mt2','mt3']
 });

 var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
     maxZoom: 20,
     subdomains:['mt0','mt1','mt2','mt3']
 });


 var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
     maxZoom: 20,
     subdomains:['mt0','mt1','mt2','mt3']
 });

 var osm = L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
   maxZoom: 20,
   subdomains: ['a' , 'b' , 'c'],
   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
   });

 var cartoLight = L.tileLayer("https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png", {
   maxZoom: 19,
   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://cartodb.com/attributions">CartoDB</a>'
  });
  
 var usgsImagery = L.layerGroup([L.tileLayer("http://basemap.nationalmap.gov/arcgis/rest/services/USGSImageryOnly/MapServer/tile/{z}/{y}/{x}", {
     maxZoom: 15,
    }), L.tileLayer.wms("http://raster.nationalmap.gov/arcgis/services/Orthoimagery/USGS_EROS_Ortho_SCALE/ImageServer/WMSServer?", {
     minZoom: 16,
     maxZoom: 19,
     layers: "0",
     format: 'image/jpeg',
     transparent: true,
     attribution: "Aerial Imagery courtesy USGS"
    })]);
 var map = L.map("map", {
   zoom: 10,
   center: [0.54, 101.5],
   layers: [osm, pekanbaru, markerClusters],
   zoomControl: true,
   attributionControl: true
  });
  
  map.on("overlayadd", function (e) {
    markerClusters.addLayer(markerCerai);
  });

  map.on("overlayremove", function (e) {
    markerClusters.removeLayer(markerCerai);
  });
  
  L.Control.Legend = L.Control.extend({
   onAdd: function(map){
    var divlegend = L.DomUtil.create('div','legenda');
    divlegend.style = "min-width:200px;min-height:150px;background-color:#fff;padding:20px;border-radius:5px";
    divlegend.innerHTML = "<strong>Jumlah Perceraian Per Kecamatan</strong><div class='icoleg' style='background-color:rgba(241,58,58,1)'>>150</div><div class='icoleg' style='background-color:rgba(241,142,58,1)'>50-150</div><div class='icoleg' style='color:#aa2a22;background-color:rgba(241,227,58,1)'>0-50</div>";
    return divlegend;
   }
  });
  
  L.control.legend = function(opts){
   return new L.Control.Legend(opts);
  }
  
  L.control.legend({position: 'bottomleft'}).addTo(map);
  var baseLayers = {
   "Open Street Map": osm,
   "Google Hybrid": googleHybrid,
   "Google Satellite": googleSat,
   "Google Streets": googleStreets,
   "CartoDB Light": cartoLight,
   "Arial Imagery": usgsImagery,
  };
  var overLayers = {
    "<img src='assets/images/heartbreak.png' width=20 height=18 /> Titik Cerai": markerCeraiLayer
  }
  if (document.body.clientWidth <= 767) {
   var isCollapsed = true;
  } else {
   var isCollapsed = false;
  }
  var layerControl = L.control.layers(baseLayers,overLayers, {
    collapsed: isCollapsed
   }).addTo(map);
</script>
<?php
$vws->set_inline(ob_get_clean());
include('footer.php');