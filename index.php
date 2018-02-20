<?php
include('conf/koneksi.php');
$vws->set_inline("<link rel='stylesheet' href='assets/css/leaflet.css'/>");
$vws->set_inline("<link rel='stylesheet' href='assets/css/MarkerCluster.css'/>");
$vws->set_inline("<link rel='stylesheet' href='assets/css/MarkerCluster.Default.css'/>");
include('front_header.php');
$vws->reset_inline();
?>
<style>
.icoleg{
 margin:5px auto;
 padding:5px;
 text-align:center;
 color:#fff;
}
</style>
    <div class="container" style="margin-top:70px;min-height:70vh">
    <span style="text-align:center;margin-bottom:50px"><h3>Sistem Informasi Titik Perceraian Kota Pekanbaru</h3></span>
     <div class="row">
      <div class="col-sm-3">
       <div class="panel panel-primary" id="features">
         <div class="panel-heading">
           <h3 class="panel-title">Titik Perceraian</h3>
         </div>
         <div class="panel-body">
           <div class="row">
             <div class="col-xs-8 col-md-8">
               <input type="text" class="form-control search" placeholder="Filter" />
             </div>
             <div class="col-xs-4 col-md-4">
               <button type="button" class="btn btn-primary pull-right sort" data-sort="feature-name" id="sort-btn"><i class="fa fa-sort"></i>&nbsp;&nbsp;Urutkan</button>
             </div>
           </div>
         </div>
         <div class="sidebar-table">
           <table class="table table-hover" id="feature-list">
             <thead class="hidden">
               <tr>
                 <th>Icon</th>
               <tr>
               <tr>
                 <th>Name</th>
               <tr>
               <tr>
                 <th>Chevron</th>
               <tr>
             </thead>
             <tbody class="list"></tbody>
           </table>
         </div>
       </div>
      </div>
      <div class="col-sm-9">
       <div id="map" style="height:70vh"></div>
      </div>
     </div>
    </div>
    <hr />
<?php 
ob_start();
?>
<script src="assets/js/leaflet.js"></script>
<script src="assets/js/leaflet.markercluster.js"></script>
<script src="assets/js/list.min.js"></script>
<script src="assets/js/typeahead.bundle.min.js"></script>
<script src="assets/js/handlebars.min.js"></script>
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
 var featureList;
 var listCerai = [];
 $(document).on("click", ".feature-row", function (e) {
  $(document).off("mouseout", ".feature-row", clearHighlight);
  sidebarClick(parseInt($(this).attr("id"), 10));
 });
 function warnaChloro(nilai){
  warna = "rgba(241,227,58,1)";
  if(nilai > 150){
   warna = "rgba(241,58,58,1)"
  } else if(nilai > 50) {
   warna = "rgba(241,142,58,1)"
  }
  return warna
 }
 
 function clearHighlight() {
  highlight.clearLayers();
 }
  
 function sidebarClick(id) {
  var layer = markerClusters.getLayer(id);
  map.setView([layer.getLatLng().lat, layer.getLatLng().lng], 17);
  layer.fire("click");
  /* Hide sidebar and go to the map on small screens */
  if (document.body.clientWidth <= 767) {
   $("#sidebar").hide();
   map.invalidateSize();
  }
 }

 function syncSidebar(){
  featureList = new List("features", {
			valueNames: ["feature-name"]
		});
  featureList.sort("feature-name", {
   order: "asc"
  });
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
    title: feature.properties.no_putusan,
    riseOnHover: true
   });
  },
  onEachFeature: function (feature, layer) {
   layer.bindPopup("<strong>"+feature.properties.no_putusan+"</strong><br>Alamat:"+feature.properties.alamat+", "+feature.properties.kel+", "+feature.properties.kec+"<br><a href='http://putusan.mahkamahagung.go.id/pengadilan/pa-pekanbaru/'>Cari Nomor Putusan</a>");
   $("#feature-list tbody").append('<tr class="feature-row" id="' + L.stamp(layer) + '" lat="' + layer.getLatLng().lat + '" lng="' + layer.getLatLng().lng + '"><td style="vertical-align: middle;"><img width="15" height="22" src="assets/css/images/marker-icon.png"></td><td class="feature-name">' + layer.feature.properties.no_putusan + '</td><td style="vertical-align: middle;"><i class="fa fa-chevron-right pull-right"></i></td></tr>');
   listCerai.push({
     name: feature.properties.no_putusan,
					address: feature.properties.alamat,
					source: "Cerai",
					id: L.stamp(layer),
					lat: feature.geometry.coordinates[1],
					lng: feature.geometry.coordinates[0]
   });
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
   zoomControl: false,
   attributionControl: true
  });
  
  map.on("overlayadd", function (e) {
    markerClusters.addLayer(markerCerai);
    syncSidebar();
  });

  map.on("overlayremove", function (e) {
    markerClusters.removeLayer(markerCerai);
    syncSidebar();
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
  
  /*L.Control.Cari = L.Control.extend({
   onAdd: function(map){
    var divlegend = L.DomUtil.create('div','kotakcari');
    divlegend.style = "min-width:200px;min-height:150px;background-color:#fff;padding:20px;border-radius:5px";
    divlegend.innerHTML = "<strong>Cari Keputusan Perceraian</strong><input type='text' id='cari' placeholder='Nomor Keputusan' class='form-control'/>";
    return divlegend;
   }
  });
  
  L.control.cari = function(opts){
   return new L.Control.Cari(opts);
  }
  
  L.control.cari({position: 'topleft'}).addTo(map);*/
  var zoomControl = L.control.zoom({
		position: "bottomright"
	}).addTo(map);
  var baseLayers = {
   "Open Street Map": osm,
   "Google Hybrid": googleHybrid,
   "Google Satellite": googleSat,
   "Google Streets": googleStreets,
   "CartoDB Light": cartoLight,
   "Arial Imagery": usgsImagery,
  };
  var overLayers = {
    "<img src='assets/css/images/marker-icon.png' width=15 height=22 /> Titik Cerai": markerCeraiLayer
  }
  if (document.body.clientWidth <= 767) {
   var isCollapsed = true;
  } else {
   var isCollapsed = false;
  }
  var layerControl = L.control.layers(baseLayers,overLayers, {
    collapsed: isCollapsed
  }).addTo(map);
   
  $(document).one("ajaxStop", function () {
    featureList = new List("features", {
      valueNames: ["feature-name"]
     });
    featureList.sort("feature-name", {
     order: "asc"
    });
    var CeraiBD = new Bloodhound({
     name: "Cerai",
     datumTokenizer: function (d) {
      return Bloodhound.tokenizers.whitespace(d.name);
     },
     queryTokenizer: Bloodhound.tokenizers.whitespace,
     local: listCerai,
     limit: 10
    });
    CeraiBD.initialize();
    
    $("#cari").typeahead({
      minLength: 3,
      highlight: true,
      hint: false
     }, {
      name: "Cerai",
      displayKey: "name",
      source: CeraiBD.ttAdapter(),
      templates: {
       header: "<h4 class='typeahead-header'><img src='assets/css/images/marker-icon.png' width='24' height='28'>&nbsp;Cerai</h4>",
       suggestion: Handlebars.compile(["{{name}}<br>&nbsp;<small>{{address}}</small>"].join(""))
      }
     }).on("typeahead:selected", function (obj, datum) {
      if (datum.source === "Cerai") {
       if (!map.hasLayer(markerCeraiLayer)) {
        map.addLayer(markerCeraiLayer);
       }
       map.setView([datum.lat, datum.lng], 17);
       if (map._layers[datum.id]) {
        map._layers[datum.id].fire("click");
       }
      }
      if ($(".navbar-collapse").height() > 50) {
        $(".navbar-collapse").collapse("hide");
      }
     });
     $(".twitter-typeahead").css("position", "static");
     $(".twitter-typeahead").css("display", "block");
  });
</script>
<?php
$vws->set_inline(ob_get_clean());
include('front_footer.php');
?>