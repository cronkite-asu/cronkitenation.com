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

    $result = $geo->geocode( $alum[1] );
    $lat = $result["Latitude"];
    $long = $result["Longitude"];
    $feature = array(
        "type" => "Feature",
        "geometry" => array(
            "type" => "Point",
            "coordinates" => array($long, $long),
            "properties" => array(
                "name" => $alum[0]
            )
        )
    );
    $geojson_out["features"][] = $feature;


?>
<!DOCTYPE html>
<meta charset="utf-8">
<?php
 	wp_enqueue_script('d3_script');
	wp_enqueue_script('d3_geo_script');
?>
<style>

.background {
  fill: none;
  pointer-events: all;
}

#states {
  fill: #aaa;
  stroke: #fff;
  stroke-width: 1.5px;
}

#states .active {
  fill: steelblue;
}

circle {
    fill: steelblue !important;
}

</style>
<body>
    <?php print_r( $result ); ?>
<script>

var width = 960,
    height = 500,
    centered;


var projection = d3.geo.equirectangular()
    .scale(width)

    .translate([0, 0]);

/*
var projection = d3.geo.azimuthal()
    .scale(380)
    .mode("orthographic")
    .translate([0, 0]);
*/
//path is a function thats used with assignign the "d" attribute on the svg paths
var path = d3.geo.path()
    .projection(projection);

var svg = d3.select("body").append("svg")
    .attr("width", width)
    .attr("height", height);

svg.append("rect")
    .attr("class", "background")
    .attr("width", width)
    .attr("height", height)
    .on("click", click);

var g = svg.append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")")
  .append("g")
    .attr("id", "states");

var g_points = svg.append('g').attr("id", "circles").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
/*
var gw = svg.append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")")
  .append("g")
    .attr("id", "world");
*/

d3.json("world-countries.json", function(json) {
  g.selectAll("path")
      .data(json.features)
    .enter().append("path")
      .attr("d", path)

      .on("click", click);
    /*
    setInterval(function(){
        var paths = g.selectAll("path");
        centered = json.features[Math.floor(Math.random() * json.features.length)];

        g.selectAll("path")
              .classed("active", centered && function(d) { return d === centered; });

        var centroid = path.centroid(centered);
        x = -centroid[0];
        y = -centroid[1];
        k = 4;

        g.transition()
              .duration(1000)
              .attr("transform", "scale(" + k + ")translate(" + x + "," + y + ")")
              .style("stroke-width", 1.5 / k + "px");
        }, 3000);
    */
 
});

d3.json("alums_geojson.php", function(json) {
    var positions = [];
    for (i in json["features"]){
        var feature = json["features"][i];
        var location = [+feature.geometry.coordinates[0], +feature.geometry.coordinates[1]];
        positions.push(projection(location));
    }
    
    
    g.selectAll("circle").data(json.features).enter().append("circle")
        .attr("cx", function(d, i) {
            return positions[i][0];
            })
        .attr("cy", function(d, i) {
            return positions[i][1];
            })
        .attr("r", 10);
    
    
    setInterval(function(){
        
        centered = json.features[Math.floor(Math.random() * json.features.length)];
        var location = [+centered.geometry.coordinates[0], +centered.geometry.coordinates[1]];
        prj = projection(location)
        x = -prj[0];
        y = -prj[1];
        k = 4;
        
        g.transition()/*
              .duration(500)
              .attr("transform", "scale(1)translate(" + x + "," + y + ")")
              .transition()*/
              .duration(1000)
              .delay(500)
              .attr("transform", "scale(" + k + ")translate(" + x + "," + y + ")")
              .style("stroke-width", 1.5 / k + "px");
        }, 3000);
    
});



function click(d) {
  var x = 0,
      y = 0,
      k = 1;

  if (d && centered !== d) {
    var centroid = path.centroid(d);
    x = -centroid[0];
    y = -centroid[1];
    k = 4;
    centered = d;
  } else {
    centered = null;
  }

  g.selectAll("path")
      .classed("active", centered && function(d) { return d === centered; });

  g.transition()
      .duration(1000)
      .attr("transform", "scale(" + k + ")translate(" + x + "," + y + ")")
      .style("stroke-width", 1.5 / k + "px");
}



</script>