<?php
include('conf/koneksi.php');
$vws->set_inline("<link rel='stylesheet' href='assets/css/leaflet.css'/>");
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
     <div class="row">
      <div class="col-sm-12">
       <span style="text-align:center;margin-bottom:50px"><h3>Sistem Informasi Titik Perceraian Kota Pekanbaru</h3></span>
       <div id="map" style="height:70vh"></div>
      </div>
     </div>
    </div>
    
    <hr />
<?php 
ob_start();
?>
<script src="assets/js/leaflet.js"></script>
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
           layer.bindPopup("<strong>"+feature.properties.no_putusan+"</strong><br>Alamat:"+feature.properties.alamat+", "+feature.properties.kel+", "+feature.properties.kec+"<br><a href='http://mahkamahagung.go.id'>Cari Nomor Putusan</a>");
          }
         });
         $.getJSON("geodata-cerai.php", function (data) {
          markerCerai.addData(data);
         });
         
         var osm = L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
          maxZoom: 20,
          subdomains: ['a' , 'b' , 'c'],
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>" '
         });
        	var map = L.map("map", {
        			zoom: 10,
        			center: [0.54, 101.5],
        			layers: [osm, pekanbaru, markerCerai],
        			zoomControl: true,
        			attributionControl: true
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
          
          L.control.legend({position: 'topright'}).addTo(map);
        </script>
<?php
$vws->set_inline(ob_get_clean());
include('front_footer.php');
?>