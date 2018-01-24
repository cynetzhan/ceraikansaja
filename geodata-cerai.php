<?php
header('Content-type: text/json');
include 'conf/koneksi.php';
$query = mysql_query("select * from data_cerai");
$geojson = [
 "type" => "FeatureCollection",
 "crs"  => [
  "type"=> "name",
  "properties" => ["name"=>"urn:ogc:def:crs:OGC:1.3:CRS84" ]
 ], 
 "features" => []
];
while($row=mysql_fetch_assoc($query)){
 $features=[
  "type" => "Feature",
  "properties" => [
   "no_putusan"=> $row['np'],
   "kel" => $row['kel'],
   "kec" => $row['kec'],
   "alamat" => $row['alamat']
  ],
  "geometry" => [
   "type" => "Point",
   "coordinates" => [$row['lng'],$row['lat']]
  ]
 ];
 $geojson['features'][] = $features;
}
echo json_encode($geojson);
?>

