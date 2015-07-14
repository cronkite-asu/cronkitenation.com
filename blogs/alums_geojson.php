<?php
require('GoogleGeocode.php');

$alums = array(
               array("Sam Smith", "Seattle, WA"),
               array("Barb Coeing", "Phoenix, AZ")
               );

$apiKey = '';
$geo = new GoogleGeocode( $apiKey );
$geojson_out = array(
    "type" => "FeatureCollection",
    "features" => array()
);
foreach ($alums as $alum)
{
    $result = $geo->geocode( $alum[1] );
    $lat = $result["Placemarks"][0]["Latitude"];
    $long = $result["Placemarks"][0]["Longitude"];
    $feature = array(
        "type" => "Feature",
        "geometry" => array(
            "type" => "Point",
            "coordinates" => array($long, $lat),
            "properties" => array(
                "name" => $alum[0]
            )
        )
    );
    $geojson_out["features"][] = $feature;
}
echo json_encode($geojson_out);
?>

