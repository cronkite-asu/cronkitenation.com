var feature;
var centered;
var points;
var positions;
var MARKER_SIZE = 10;
var MARKER_SELECT = 20;
var max_in_group = 0;
var TRANS_TIME = 5000; // Time to trasition between points in milliseconds
var water = null;
var stop = false;
var points_json;
var next_timeout;

var alumn_history = [];
var next_queue = [];

var projection = d3.geo.azimuthal()
    .scale(360)
    .origin([-71.03,42.37])
    .mode("orthographic")
    .translate([360, 360]);

var circle = d3.geo.greatCircle()
    .origin(projection.origin());

// TODO fix d3.geo.azimuthal to be consistent with scale
var scale = {
  orthographic: 360,
  stereographic: 360,
  gnomonic: 360,
  equidistant: 360 / Math.PI * 2,
  equalarea: 360 / Math.SQRT2
};

var path = d3.geo.path()
    .projection(projection);

var svg = d3.select("#body").append("svg:svg")
    .attr("width", 720)
    .attr("height", 720);
    
	
water = svg.append("circle").attr("cx", 360).attr("cy", 360).attr("r", 360).attr("fill", "#f2f2f2");
var point_g;



d3.select(window)
    .on("mousemove", mousemove)
    .on("mouseup", mouseup);

d3.select("select").on("change", function() {
  projection.mode(this.value).scale(scale[this.value]);
  refresh(750);
});

function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}


/*
var water_path = {type: "Feature", properties: {"name": "water"}, geometry:{type:"MultiPolygon",coordinates: [[[-180.0,-90.0],[180.0, -90.0],[180.0, 90.0],[-180.0, 90.0],[-180.0, -90.0]]]},id:"AFG"};
var water = svg.append("path").attr("d", clip(water_path)).attr("fill", "blue");
*/

function click(d){
	/*
	var location = [+d.geometry.coordinates[0], +d.geometry.coordinates[1]];
	
	prj = projection(location)
        x = -prj[0];
        y = -prj[1];
	*/
	
	path_transition_end(d, 0);
			
	//UPDATE SIDEBAR INFO
	update_sidebar_info_group(d);

}

function marker_transform(d){
    var scale = 0.04 * (d.geometry.properties["names"].length / 100.0) + 0.015;
    if (scale > 0.05){scale = 0.05;}
    var mul = 1.0 / scale;
    
    return "scale(" + scale.toString() + ")translate(" + (clip_cx(d) * mul - 319) + "," + (clip_cy(d) * mul - 302) + ")";
}

function plot_with_circles(json){
	points = svg.selectAll("circle").data(json.features).enter().append("circle")
		.attr("cx", clip_cx).attr("cy", clip_cy)
		.attr("stroke", "steelblue")
		.attr("r", function(d){
				return ((d.geometry.properties["names"].length / max_in_group) * MARKER_SIZE) + 5;
			})
		.attr("fill", "#990033");
}

function circle_transition_end(centered){
	points.transition().delay(2000).duration(300).attr("r", function(d){
		start_size = ((d.geometry.properties["names"].length / max_in_group) * MARKER_SIZE) + 5;
		if (d === centered){
			 return start_size + MARKER_SELECT;
		} else {
			 return start_size;
		}
	}).attr("fill", function(d){
		if (d === centered){
			 return "#FFB310";
		} else {
			 return "#990033";
		}
	});
}

function plot_with_paths(json){
	//DRAW THE GEOJSON POINTS WITH PATHS
	point_g = svg.append("g");
	points = point_g.selectAll("path").data(json.features).enter().append("path")
	  .attr("d", function(d){
		if (d.geometry.properties["names"].length <= 1){
		    return "M0,594.742c0-57.158-1.935-124.356,33.188-173.004c36.127-50.038,99.26-43.039,152.157-59.76 c76.866-24.297,55.263-95.158,33.873-154.934C194.407,137.711,203.112,54.1,273.258,13.92	c60.125-34.44,132.294-4.329,160.408,56.107c33.664,72.37-10.915,128.113-23.267,198.008 c-17.171,97.166,97.378,96.123,156.918,130.939c72.691,42.508,62.461,133.511,71.461,205.21c-116.346,0-232.7-5.777-349.034-1.698 c-68.98,2.419-255.229,51.296-290.789-31.105c0.125,7.798,0.47,15.585,1.035,23.36c0.239-7.482,0.242-14.967,0.01-22.454 c0,9.89,0,19.78,0,29.67c0-10.869,0-21.737,0-32.606C0,577.815,0,586.278,0,594.742c0-9.756,0-19.513,0-29.269 C0,575.229,0,584.986,0,594.742c0,30.002,0-36.938,0-24.973C0,578.094,0,586.418,0,594.742C0,526.927,0,594.742,0,594.742z";
		} else if (d.geometry.properties["names"].length <= 5) {
		    return "M477.102,364.325	c-61.322,0-113.601-9.89-98.439-95.692c10.908-61.721,50.275-110.945,20.547-174.851c-24.826-53.369-88.555-79.958-141.648-49.546	c-61.943,35.481-69.629,109.314-47.721,170.539c18.889,52.785,34.939,109.096-29.911,136.814	C56.779,406.871-81.221,569.871,74.398,547.416c19.708,0,67.404-8.318,76.915,17.146c12.076,32.336,3.645,93.072,49.036,100.422	c94.681,15.326,118.662,1.609,214.135,2.148c149.953,0.85,62.268-4.129,211.66,8.268c28.217,2.342,89.631,12.047,94.732-29.588	c2.311-18.844-45.936-77.264-31.523-91.178c41.082-39.667,294.15,46.402,190.865-72.961c-44.26-51.149-97.219-61.979-156.727-89.604	c-106.52-49.447-43.84-93.681-18.553-173.678c71.537-226.33-295.789-246.315-211.23-18.006	c17.311,46.731,50.984,100.189,32.984,144.45c-5.9,10.637-19.299,19.019-49.592,19.492";		    
		} else if (d.geometry.properties["names"].length <= 200){
		    return "M-270.413,396.344c-69.035,25.258-155.288,153.851-33.054,153.851c19.708,0,67.404-8.318,76.915,17.147 c12.076,32.335-11.631,78.262,33.761,85.61c94.681,15.327,205.669-6.144,301.142-5.604c149.952,0.848,303.894-4.344,453.286,8.052 c28.215,2.341,89.631,12.047,94.733-29.587c2.311-18.845-30.66-62.454-16.249-76.369c41.082-39.667,294.15,46.404,190.865-72.962 c-44.258-51.149-97.218-61.979-156.725-89.604c-106.52-49.447-43.84-93.681-18.554-173.678 c71.538-226.33-295.787-246.315-211.229-18.006c17.309,46.731,72.397,73.491,77.561,125.963 c4.619,46.944-56.472,48.402-88.028,44.1c-21.179-2.888-73.843,1.339-73.753-31.315c0.175-63.583,44.01-125.329,49.405-190.081 c8.825-105.897-54.177-179.706-159.05-191.938C124.851-62.747,97.079,56.135,120.243,155.605 c18.964,81.431,116.499,198.197-30.544,203.531c-140.26,5.088,5.203-184.83-10.313-249.926 C52.57-3.291-145.594-28.47-178.342,91.921c-15.828,58.189-6.695,124.043,13.577,179.605 C-128.851,369.964-197.55,370.721-270.413,396.344C-309.615,410.687-270.413,396.344-270.413,396.344z";
		} else{
		    return "M-352.016,553.007	c52.61-19.159,102.213-19.725,76.282-93.339c-14.637-41.55-21.232-90.796-9.803-134.311c23.645-90.029,166.727-71.2,186.09,12.929	c11.203,48.68-93.826,190.703,7.447,186.897c70.05-8.001,83.505-7.759,47.592-106.196c-20.272-55.562-29.405-121.417-13.577-179.605	c32.748-120.391,230.912-95.212,257.728,17.289c15.516,65.096-129.947,255.014,10.313,249.926	c147.043-5.334,49.508-122.1,30.544-203.531c-23.164-99.47,4.608-218.352,130.369-203.682	c104.873,12.232,167.876,86.041,159.051,191.938c-5.395,64.752-49.229,126.499-49.405,190.082	c-0.09,32.653,52.575,28.427,73.753,31.314c31.556,4.302,92.647,2.845,88.029-44.1c-5.164-52.472-60.252-79.232-77.562-125.963	c-84.558-228.309,282.767-208.324,211.23,18.006c-25.287,79.997-75.568,119.238,30.951,168.685	c22.861,8.373,65.528,25.631,59.263-19.859c-3.947-40.092-46.035-60.536-59.263-96.242	c-64.604-174.438,216.049-159.169,161.39,13.758c-19.32,61.121-59.24,98.516,22.146,136.296	c10.081,4.681,19.524,8.553,28.485,12.171c31.456,12.701,56.972,22.279,83.291,52.692c3.566,4.121,6.577,7.924,9.072,11.428	c52.693,74.025-139.743,16.685-169.713,45.623h-0.002c-14.411,13.914-5.146,45.468-19.812,82.135	c-9.334,38.595-211.666,37.857-239.881,35.516c-154.821-12.848-305.987,1.752-453.979,0.913	c-54.095-0.306-188.147,8.543-304.967,3.407c-89.356-3.928-165.833-8.337-206.585-23.335	c-31.839-14.167-22.097-60.975-31.839-87.992c-7.673-21.274-46.149-14.323-62.048-14.323c-98.606,0-29.026-107.441,26.665-128.544";
		}
	  })	  
      .attr("transform", marker_transform)
	  //.attr("transform", "scale(0.1)")
	  .attr("fill", "#990033")
	  .attr("class", "points");
}

function path_transition_end(centered, delay){
	jQuery('#sidebar-mapload').hide('fast');
	jQuery('#load_message').hide('fast');
	points.transition().delay(delay).duration(300).attr("transform", function(d){
		if (d === centered){
			return "scale(0.05)translate(" + (clip_cx(d) * 20 - 319) + "," + (clip_cy(d) * 20 - 302) + ")";
		} else {
			return marker_transform(d);
		}
	}).attr("fill", function(d){
		if (d === centered){
			 return "#FFB310";
		} else {
			 return "#990033";
		}
	});
}

function update_sidebar_info_single(centered){
	var alumn_fields;
	if(centered.geometry.properties["names"].length > 1){
		alumn_fields = centered.geometry.properties["names"][Math.floor(Math.random() * centered.geometry.properties["names"].length)];
	} else {
		alumn_fields = centered.geometry.properties["names"][0];
	}
	jQuery('div#sidebar-mapsingle').hide("fast");
	jQuery('div#sidebar-mapgroup').hide("fast");
	
	jQuery('span#firstname').html(alumn_fields[0]);
	jQuery('span#lastname').html(alumn_fields[1]);
	jQuery('span#employer').html(alumn_fields[2]);

	if (alumn_fields[5] == "United States"){
		jQuery('span#city').html(alumn_fields[3] + ", " + alumn_fields[4] );
	} else {
		jQuery('span#city').html(alumn_fields[3] + ", " + alumn_fields[5] );
	}

	jQuery('span#jobtitle').html(alumn_fields[6]);
	
	jQuery("img#profile_avatar").attr("src", alumn_fields[7]);
	jQuery("a#profile_url").attr("href", alumn_fields[8]);
	
	jQuery('div#sidebar-mapsingle').show("fast");
}



function update_sidebar_info_group(centered){
	var alumn_fields;
	num_alumns = centered.geometry.properties["names"].length;
	if(num_alumns <= 1){
		//update the single instead
		return update_sidebar_info_single(centered);
		
	}
	
	var cities = [];
	for (i in centered.geometry.properties["names"]){
		var dname = centered.geometry.properties["names"][i];
		var ht_val;
		if (dname[4] == "Outside U.S."){
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[5] + '&quot;">' + dname[3] + ", " + dname[5] + ' <i class="fa fa-angle-double-right"></i>' + '</a>';
		} else  if (dname[4] == "Washington D.C."){
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + ' <i class="fa fa-angle-double-right"></i> ' + '</a>';
		} else {
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + ", " + dname[4] + ' <i class="fa fa-angle-double-right"></i>' + '</a>';
		}
		
		if (cities.indexOf(ht_val) < 0){
			cities.push(ht_val);
		}
		
	}
	
	jQuery('span#groupcity').html(cities.join("</li>"));
	/*
	if (centered.geometry.properties["names"][0][4] == "Outside U.S."){
		jQuery('span#groupcity').html(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5] );
	} else {
		jQuery('span#groupcity').html(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][4] );
	}
	*/
	
	jQuery('div#sidebar-mapsingle').hide("fast");
	jQuery('div#sidebar-mapgroup').hide("fast");
	
	
	jQuery('div#sidebar-mapgroup h4').html(num_alumns.toString());
	jQuery('a#group_in_dir').click(function(e){
		e.preventDefault();
		if (centered.geometry.properties["names"][0][4] == "Outside U.S."){
			jQuery("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5]);
		} else if (centered.geometry.properties["names"][0][4] == "Washington D.C."){
			jQuery("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5]);
		} else{
			jQuery("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][4]);
		}
		jQuery("form#searchgroup").submit();
	});
	
	jQuery('div#sidebar-mapgroup').show("fast");
}

function do_next_alumn(next, no_transition){
	/*
	FUNCTION THAT STARTS THE ANIMATION TO THE NEXT POINT
   */
	//there is a previous alumn, and i'm going forwards
	if (centered && !next){
		alumn_history.push(centered);
	}
	
	json = points_json;
	
	if (!no_transition){
		projection.scale(360);
		water.transition().duration(2000).attr("r", 360);        
		refresh(2000);
	}
	orig_lat_long = projection.origin();
	
	if (!next){
		centered = json.features[Math.floor(Math.random() * json.features.length)];
	} else {
		centered = next;
	}
	
	var location = [+centered.geometry.coordinates[0], +centered.geometry.coordinates[1]];
	
	//calculate steps
	lat_diff = Math.sqrt(Math.pow(orig_lat_long[1] - location[1], 2));
	long_diff = Math.sqrt(Math.pow(orig_lat_long[0] - location[0], 2));
	tot_diff = lat_diff + long_diff;
	var steps = Math.round(tot_diff / 0.4);
	
	lat_step = (location[1] - orig_lat_long[1] ) / steps;
	lon_step = (location[0] - orig_lat_long[0]) / steps;
	
	last_step_lat  = orig_lat_long[1];
	last_step_lon = orig_lat_long[0];
	
	var start_time = new Date();
	var at_end = false;
	
	function do_step(){
		if (at_end){
			//WE ARRIVED AT THE NEXT ALUMN, WORK SOME MAGIC
			
			//zoom the water at the points, etc
			if (projection.scale() != 3000){
				water.transition().duration(2000).attr("r", 3000);
				projection.scale(3000);
				refresh(2000);
				path_transition_end(centered, 2000);
			} else {
				path_transition_end(centered, 1);
			}
			
			//FOR CIRCLES
			//circle_transition_end(centered)
			
			//FOR PATHS
			
			
			//UPDATE SIDEBAR INFO
			update_sidebar_info_single(centered);
			
			if (!stop){
				next_timeout = setTimeout(do_next_alumn, 10000);
			}
		} else {
			now = new Date();
			diff = now - start_time - 2000;
			perc = diff / TRANS_TIME;
			if (perc > 1){ perc = 1.0; at_end = true;}
			lat_addr = (location[1] - orig_lat_long[1]) * perc;
			lon_addr = (location[0] - orig_lat_long[0]) * perc;
			
			new_location = [orig_lat_long[0] + lon_addr, orig_lat_long[1] + lat_addr];
			
			projection.origin(new_location);
			circle.origin(new_location);
			refresh();
			
			if (!stop){
				next_timeout = setTimeout(do_step, 0);
			}
		}
		
	}
	
	if (no_transition){
		projection.origin(location);
		circle.origin(location);
		refresh();
		at_end = true;
		do_step();
	} else {
		//start the transition steps
		if (!stop){
			next_timeout = setTimeout(do_step, 2000);
		}
	}
}

function toggle_animation(){
	if (jQuery('div#sidebar-pp').hasClass('play')){
		return start_animation();
	} else {
		return stop_animation();
	}
}

function get_step(){
	if (projection.scale() == 360){
		return 10;
	} else {
		return 1;
	}
}

function pan_and_zoom(e){
	e.preventDefault();
	var posX = jQuery('svg').offset().left,posY = jQuery('svg').offset().top;
	var x_y_location = [(e.pageX - posX), (e.pageY - posY)]
    var location = projection.invert(x_y_location);
	projection.origin(location);
	circle.origin(location);
	refresh();
	if (projection.scale() != 3000){
		water.transition().duration(2000).attr("r", 3000);
		projection.scale(3000);
		refresh(2000);
	} 
}

function stop_animation(){
	clearTimeout(next_timeout);
	jQuery('#sidebar-mapload').hide("fast");
	jQuery('#load_message').html("Click on an alumni.");
	
	stop=true;
	jQuery('div#sidebar-pp').addClass('play');
	svg.on("mousedown", mousedown);
	jQuery('svg').dblclick(pan_and_zoom);
	points.on("click", click);
	jQuery('div.tweakControls').show('fast');
	jQuery('div#sidebar-back').click(function(e){
		prev_alumn();
	});
	
	jQuery('div#sidebar-forward').click(function(e){
		next_alumn();
	});
	
	jQuery('#sidebar-zin').click(function(e){
		jQuery('#sidebar-zin').addClass("active");
		jQuery('#sidebar-zout').removeClass("active");
		e.preventDefault();
		water.transition().duration(2000).attr("r", 3000);
		projection.scale(3000);
		refresh(2000);
	});
	
	jQuery('#sidebar-zout').click(function(e){
		jQuery('#sidebar-zout').addClass("active");
		jQuery('#sidebar-zin').removeClass("active");
		e.preventDefault();
		projection.scale(360);
		water.transition().duration(2000).attr("r", 360);        
		refresh(2000);
	});
	
	
	jQuery('#sidebar-left').click(function(e){
		
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0] - get_step(), orig_lat_long[1]];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	jQuery('#sidebar-right').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0] + get_step(), orig_lat_long[1]];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	jQuery('#sidebar-up').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0], orig_lat_long[1] + get_step()];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	
	
	jQuery('#sidebar-down').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0], orig_lat_long[1] - get_step()];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
}

function message_tip(msg){
	jQuery('div#map_messages').html(msg);
	jQuery('div#map_messages').show("fast");
	//alert("message");
}

function stop_message(msg){
	jQuery('div#map_messages').hide("fast");
	//jQuery('svg').hover(message_tip(msg), stop_message(msg));
	//alert("hide");
}

function start_animation(){
	stop=false;
	do_next_alumn();
	jQuery('svg').unbind();
	//feature.on("mouseover", message_tip('Click to stop animation'));
	//feature.on("mouseout", stop_message);
	jQuery('div#sidebar-pp').removeClass('play');
	svg.on("mousedown", toggle_animation);
	points.on("click", null);
	jQuery('div#sidebar-back').unbind();
	jQuery('div#sidebar-forward').unbind();
	jQuery('.tweakControlSizeDown').unbind();
	jQuery('.tweakControlSizeUp').unbind();
	jQuery('.tweakControlMoveLeft').unbind();
	jQuery('.tweakControlMoveRight').unbind();
	jQuery('.tweakControlMoveUp').unbind();
	jQuery('.tweakControlMoveDown').unbind();
	jQuery('div.tweakControls').hide('fast');
	
}

function next_alumn(){
	if (next_queue.length > 0){
		var next = next_queue.pop();
		//add the current alumn to the history queue
		alumn_history.push(centered);
		return do_next_alumn(next, 1);
	} else {
		return do_next_alumn(null, 1);
	}
}

function prev_alumn(){
	if (alumn_history.length > 0){
		var next = alumn_history.pop();
		//all the current alumn to the next queue
		next_queue.push(centered);
		return do_next_alumn(next, 1);		
	}
}

function process_alumns(json) {
	if (json["features"].length <= 0){
		jQuery('div#load_message').html('No results, <a href="/" style="color: #fff;">reset map.</a>').show('fast');
		jQuery('div#sidebar-mapload').hide('fast');
		return;
	} 
	//CALCULATE THE POINT WITH THE MOST PEOPLE
	for (i in json["features"]){
		var feature = json["features"][i];
		if (feature.geometry.properties["names"].length > max_in_group){
			max_in_group = feature.geometry.properties["names"].length
		}
	}
	
	//set the global points json so do_next_alumn can get the data
	points_json = json;
	
	//DRAW THE POINTS WITH PATHS
	plot_with_paths(json);
	
	//start the process if going between alumns
	stop = false;
	start_animation();
	
	/*
	d3.select(window)
	.on("mouseover", stop_animation)
    .on("mouseout", start_animation);
	*/
	
	jQuery('div#sidebar-pp').click(function(e){
		toggle_animation();
	});
}

jQuery(document).ready(function(){
	d3.json( map_params.stylesheet_directory + "/js/world-countries.json", function(collection) {
		feature = svg.selectAll("path")
			.data(collection.features)
		  .enter().append("svg:path")
			.attr("d", clip)
			.attr("fill", "#4F5557");
	  
		feature.append("svg:title")
			.text(function(d) { return d.properties.name; });
		if (typeof map_params.map_search !== 'undefined') {
			d3.json("/filter_geojson.php?search=" + map_params.map_search, process_alumns);
		} else {
			d3.json(map_params.site_url + "/alumns.json", process_alumns);
		}
	  });
});

var m0,
    o0;

function mousedown() {
  m0 = [d3.event.pageX, d3.event.pageY];
  o0 = projection.origin();
  d3.event.preventDefault();
}
//different drag implementation: http://philau.willbowman.com/2012/digitalInnovation/DevelopmentReferences/LIBS/d3JS/examples/drag/drag.html
function mousemove() {
	var divider;
	if (projection.scale() == 360){
		divider = 8;
	} else {
		divider = 32;
	}
  if (m0) {
    var m1 = [d3.event.pageX, d3.event.pageY],
        o1 = [o0[0] + (m0[0] - m1[0]) / divider , o0[1] + (m1[1] - m0[1]) / divider ];
    projection.origin(o1);
    circle.origin(o1);
    refresh();
  }
}

function mouseup() {
  if (m0) {
    mousemove();
    m0 = null;
  }
}

function refresh(duration) {
	//if (!feature){return;}
  (duration ? feature.transition().duration(duration) : feature).attr("d", clip);
  //(duration ? points.transition().duration(duration) : points).attr("cx", clip_cx).attr("cy", clip_cy);
  (duration ? points.transition().duration(duration) : points).attr("transform", marker_transform);
  
              
}

function clip_cx(d) {
    var d = circle.clip(d);
    if (d){
        //var location = [+d.geometry.coordinates[0], +d.geometry.coordinates[1]];
        return projection(d.geometry.coordinates)[0];
    } else {
        return -999;
    }
}

function clip_cy(d) {
    var d = circle.clip(d);
    if (d){
        //var location = [+d.geometry.coordinates[0], +d.geometry.coordinates[1]];
        return projection(d.geometry.coordinates)[1];
    } else{
        return -999;
    }
}

function clip(d) {
    var x = circle.clip(d);
    return path(circle.clip(d));
}