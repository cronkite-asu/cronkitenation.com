<?php
/*
 * Template Name: 2D Google Fallback Map
 */
$url = home_url();
get_header();

?>

	<div id="content">
		<div class="padder one-column">

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2 class="pagetitle"><?php the_title(); ?></h2>
				<h6 style="float:right;text-align:right;display:inline;margin-top:-20px;"><a href="<?php echo esc_url( $url ); ?>?3d">3-D Map &raquo;</a></h6>
<br />
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">
						<div id="map_canvas" style="width:100%; height:600px;"></div>
					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_footer(); ?>

<script type="text/javascript"> 
	google.load("jquery", "1");
	google.load("maps", "3", {other_params:"sensor=false"});
</script>
<script>
if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function(obj, start) {
		 for (var i = (start || 0), j = this.length; i < j; i++) {
			 if (this[i] === obj) { return i; }
		 }
		 return -1;
	}
}
var map, cloud;
var counter = 0;
var markers = [];
var current_info;
var infowindow;
var bounds = new google.maps.LatLngBounds ();

function process_alumns(data) {
	var items = [];
	infowindow = new google.maps.InfoWindow({maxWidth: 300});
	$.each(data["features"], function(key, val) {
	    
		makeMarker(val);
		
		  

	});
	centerMap();
  }

function init() {
  var options = {
    zoom: 2,
    center: new google.maps.LatLng(33.43, -112.02),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  }
  map = new google.maps.Map(document.getElementById('map_canvas'), options);
	
  <?php if (array_key_exists("map_search", $_GET)){ ?>
	$.getJSON("/filter_geojson.php<?php if (array_key_exists("map_search", $_GET)){echo urlencode( "?search=" . $_GET["map_search"] );}?>", process_alumns);
  <?php } else { ?>
	$.getJSON("/alumns.json", process_alumns);
  <?php } ?>  
}

function centerMap() {
  //map.setCenter(markers[markers.length-1].getPosition());
  map.fitBounds (bounds);
}

function makeMarker(alumn) {
	var location =  alumn["geometry"]["coordinates"];
	var image;
	bounds.extend(new google.maps.LatLng(location[1], location[0]));
	if (alumn.geometry.properties["names"].length <= 1){
		image = '/images/person.png';
	}else{
		image = '/images/group.png';
	}
	
	var markerOptions = {map: map, position: new google.maps.LatLng(location[1], location[0]), icon:image};
	var marker = new google.maps.Marker(markerOptions);
	markers.push(marker);

  
	num_alumns = alumn.geometry.properties["names"].length;
	if(num_alumns <= 1){
		var city_state;
		dname = alumn.geometry.properties["names"][0];
		if (dname[5] == "United States"){
			city_state = dname[3] + ", " + dname[4];
		} else {
			city_state = dname[3] + ", " + dname[5];
		}
		
		var content = '<div style="text-align: left; font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:28px;line-height:1.1em;"><b><a style="color:#000;" href="' + dname[8] + '">' + dname[0] + ' ' + dname[1] + '</a></b></div>';
		content += '<img src="' + dname[7] + '" style="width:105px;height:105px;margin-left:auto;margin-right:auto;"/><div class="linkbutton"><a style="font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:21px;line-height:1.1em;" href="/alumni/?s=&quot;' + dname[6] + '&quot;" target="_blank">' + dname[6] +'</a>';
		content += ' <span style="style="font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:20px;line-height:1.3em;">at</span> <a style="font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:21px;line-height:1.3em;" href="/alumni/?s=&quot;' + dname[2] + '&quot;">' + dname[2] + '</a></div>';
		content += '<br /><div class="linkbutton"><a style="font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:20px;line-height:1.1em;" href="/alumni/?s=&quot;' + city_state + '&quot;" target="_blank">' + city_state + '</a></div><div class="linkbutton"><a style="padding-top:10px;font:Helvetica Neue,Helvetica,Arial;letter-spacing:-1px;font-size:20px;line-height:1.1em;font-weight:bold;text-align:right;float:right;" href="' + dname[8] + '" id="zoomLink">See full profile &raquo;</a></div></div>';
	} else {
		var cities = [];
		for (i in alumn.geometry.properties["names"]){
			var dname = alumn.geometry.properties["names"][i];
			var ht_val;
			if (dname[4] == "Outside U.S."){
				ht_val = '<a href="/alumni/?s=&quot;' + dname[3] + ", " + dname[5] + '&quot;">' + dname[3] + ", " + dname[5] + '</a>';
			} else  if (dname[4] == "Washington D.C."){
				ht_val = '<a href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + '</a>';
			} else {
				ht_val = '<a href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + ", " + dname[4] + '</a>';
			}
			if (cities.indexOf(ht_val) < 0){
				cities.push(ht_val);
			}
		}
		//.html(num_alumns.toString());
		var content  = '<div style="background-color: #ffffff;"><center><span style="margin-top:10px;text-align:center;font-size:28px;color:#990033;font:helvetica nueue,helvetica,arial;letter-spacing:-1px;">Displaying</span></center><br /><center><span style="line-height:1.3em;text-align:center;font-size:50px;color:#000;font:helvetica nueue,helvetica,arial;letter-spacing:-1px;">' + num_alumns.toString() + '</span><br /><span style="margin-top:10px;text-align:center;font-size:21px;color:#990033;font:helvetica nueue,helvetica,arial;letter-spacing:-1px;">Cronkite alumni in:</center><ul style="list-style-type:square;font-weight:bold;font-size:14px;"><li>';
		content += cities.join("</li><li style='letter-spacing:-1px;'> ") + "</li></ul></div>";
	}
	google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(content);
		
          infowindow.open(map, marker);
        }
      })(marker, i));
}

jQuery(document).ready(function(){
	init();
});
</script>
