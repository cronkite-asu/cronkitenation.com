<?php /* Template name: Cronkite Nation Map */ ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}
$ua=getBrowser();?>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if (bp_is_front_page() && strpos($ua['userAgent'], 'iP')) { ?><meta name="viewport" content="width:768px" /><?php } elseif (current_theme_supports( 'bp-default-responsive' )) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php } ?>
		<title><?php if(bp_is_user_profile()) {?><?php bp_member_profile_data( 'field=First Name' ); ?> <?php bp_member_profile_data( 'field=Last Name' ); ?> | Cronkite Nation <?php } elseif(bp_is_directory()) { ?>Alumni Directory | Cronkite Nation<?php } elseif(bp_is_front_page()) { ?>Alumni Map - The Cronkite School | Cronkite Nation <?php } else { ?>Cronkite Nation <?php } ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php do_action( 'bp_head' ); ?>
		<?php wp_head(); ?>
		
<!-- START /asuthemes/4.0/heads/default_white.shtml -->

<link type="text/css" rel="stylesheet" media="all" href="//www.asu.edu/asuthemes/4.0/css/asu_header.css" />

<!--[if lte IE 8]>
<style type="text/css">
  #asu_search_module input.asu_search_box { line-height: 19px; }
  #asu_universal_nav ul li:hover > ul {top: 25px;}
</style>
<![endif]-->
<!--[if lte IE 7]>
<style type="text/css">
  #asu_search_module {height:17px;float:none; text-align:right; top:3px;}
  .asu_search_selection {position:relative; top:-2px;}
  #asu_universal_nav ul li.parent ul {display: none;}
  #asu_universal_nav > ul > li.parent > a {background-image: none; padding-right: 8px;}
  #asu_universal_nav > ul > li.parent:hover > a {background-image: none; background-color: transparent; color: #903; filter: none;}
</style>
<![endif]-->
<!--[if lte IE 6]>
<style type="text/css">
  #asu_hdr.asu_hdr_maroon {background: #903;}
</style>
<![endif]-->

<!--[if IE 9]>
<style type="text/css">
  #asu_universal_nav ul ul {filter: none; box-shadow: 0px 6px 6px 0px #999;}
  #asu_universal_nav > ul > li.parent:hover > a {filter: none; box-shadow: 6px 0px 6px -6px #999, -6px 0px 6px -6px #999;}
</style>
<![endif]-->

<script type="text/javascript" src="//www.asu.edu/asuthemes/4.0/js/asu_header.min.js"></script>

<!-- END /asuthemes/4.0/heads/default_white.shtml -->

	</head>

	<body <?php body_class(); ?> id="bp-default">
	
	
<!-- *****************************************
**********************************************
************ BEGIN ASU HEADER **************** 
***********************************************
*********************************************** -->
<div id="asu_hdr" class=" asu_hdr_white">
	<div id="asu_logo">
    	<a target="_blank" href="http://www.asu.edu/" title="Arizona State University">
    		<img src="//www.asu.edu/asuthemes/4.0/images/logos/asu_logo_white.png" alt="Arizona State University" height="32" width="203" style="margin-top:14px" />
    	</a>
	</div>

	<div id="asu_nav_wrapper">
      <div id="asu_universal_nav">
        <ul>
      	  <li><a target="_blank" href="http://www.asu.edu/">ASU Home</a></li>
      	  <li><a target="_blank" href="https://my.asu.edu/">My ASU</a></li>
      	  <li class="parent"><a target="_blank" href="http://www.asu.edu/colleges/">Colleges &amp; Schools</a>
	  		<ul>
				<li><a target="_blank" class="first" href="http://artsandsciences.asu.edu/" title="Arts and Sciences website">Arts and Sciences</a></li>     
				<li><a target="_blank" href="http://wpcarey.asu.edu/" title="W. P. Carey School of Business Web  and Morrison School of Agribusiness website">Business</a></li>          
				<li><a target="_blank" href="http://herbergerinstitute.asu.edu" title="Herberger Institute for Design and the Arts website">Design and the Arts</a></li>
				<li><a target="_blank" href="http://education.asu.edu/" title="Mary Lou Fulton Teachers College website">Education </a></li>
				<li><a target="_blank" href="http://engineer.asu.edu/" title="Engineering website">Engineering</a></li>
				<li><a target="_blank" href="http://graduate.asu.edu" title="Graduate College website">Graduate</a></li>
				<li><a target="_blank" href="https://healthsolutions.asu.edu/" title="Health Solutions website">Health Solutions</a></li>
				<li><a target="_blank" href="http://honors.asu.edu/" title="Barrett, The Honors College website">Honors</a></li>
				<li><a target="_blank" href="http://cronkite.asu.edu" title="Walter Cronkite School of Journalism and Mass Communication website">Journalism</a></li>
				<li><a target="_blank" href="http://www.law.asu.edu/" title="Sandra Day O' Connor College of Law website">Law</a></li>
				<li><a target="_blank" href="http://nursingandhealth.asu.edu/" title="College of Nursing and Health Innovation website">Nursing and Health</a></li>
					<li><a href="http://nursingandhealth.asu.edu/nutrition" title="School of Nutrition and Health Promotion website">Nutrition and Health Promotion</a></li>
				<li><a target="_blank" href="http://copp.asu.edu" title="College of Public Programs website">Public Programs</a></li>
				<li><a target="_blank" href="http://schoolofsustainability.asu.edu" title="School of Sustainability website">Sustainability</a></li>
				<li><a target="_blank" href="http://technology.poly.asu.edu/" title="College of Technology and Innovation website">Technology and Innovation</a></li>
				<li><a target="_blank" href="http://uc.asu.edu/" title="University College website">University (Exploratory)</a></li>
			</ul>
      	  </li>
      	  <li class="parent"><a target="_blank" href="http://www.asu.edu/map/">Map & Locations</a>
      		<ul>
				<li><a target="_blank" class="border first" href="http://www.asu.edu/map/">Map</a></li>
				<li><a target="_blank" href="http://campus.asu.edu/tempe/" title="Tempe campus">Tempe</a></li>
				<li><a target="_blank" href="http://campus.asu.edu/west/" title="West campus">West</a></li>
				<li><a target="_blank" href="http://campus.asu.edu/polytechnic/" title="Polytechnic campus">Polytechnic</a></li>
				<li><a target="_blank" href="http://campus.asu.edu/downtown/" title="Downtown Phoenix campus">Downtown Phoenix</a></li>
				<li><a target="_blank" href="http://asuonline.asu.edu/" title="Online and Extended campus">Online and Extended</a></li>
				<li><a target="_blank" class="border" href="http://havasu.asu.edu/">Lake Havasu</a></li>
				<li><a target="_blank" href="http://skysong.asu.edu/">Skysong</a></li>
				<li><a target="_blank" href="http://asuresearchpark.com/">Research Park</a></li>
				<li><a target="_blank" href="http://washingtoncenter.asu.edu/">Washington D.C.</a></li>
				<li><a target="_blank" href="http://wpcarey.asu.edu/mba/china-program/english/">China</a></li>
			</ul>
	  	  </li>      
      	  <li><a target="_blank" href="http://www.asu.edu/contactasu/" title="Directory, Index and other info">Contact ASU</a></li>
	    </ul>
	    <img class="asu_touch" src="//www.asu.edu/asuthemes/4.0/images/ipad_close.gif" alt="" />
      </div>
          
    </div>
        
</div><!-- /#asu_hdr -->
<script type="text/javascript">
<!--//--><![CDATA[//><!--
ASUHeader.default_search_text = "Search ASU";
ASUHeader.default_search_alttext = "Search ASU";
//--><!]]>
</script>
<div style="clear:both;"></div>
<!-- *****************************************
**********************************************
************ END ASU HEADER **************** 
***********************************************
*********************************************** -->
		

		<!--[if lt IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
		<div id="hbg">
		<div id="header">
					<div class="title"><h1><a href="<?php echo home_url(); ?>" title="cronkite nation">cronkite nation</a></h1></div>
			
		</div><!-- #header -->
		</div>
		<?php uberMenu_easyIntegrate(); ?>

		<?php do_action( 'bp_after_header'     ); ?>
		<?php do_action( 'bp_before_container' ); ?>

		<div id="container">

<?php
//$yourbrowser= "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];
//print_r($yourbrowser);

if (!array_key_exists("3d", $_GET)){

	if (($ua['name'] == "Internet Explorer") && (floatval($ua['version']) < 9.0)){
		?>
		<script type="text/javascript">
			window.location = "http://cronkitenation.com/2d";
		</script>
		<?php
	}
	
	if (strpos($ua['userAgent'], 'iP')){
		?>
		<script type="text/javascript">
			window.location = "http://cronkitenation.com/2d";
		</script>
		<?php
	}
}
?>
	<div id="content" >
	<div class="padder">
		<?php do_action( 'bp_before_blog_page' ); ?>
		<div class="page" id="blog-page" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry">
		<div id="body" >
		
		<?php if (($ua['name'] == "Internet Explorer") && (floatval($ua['version']) < 9.0)){
		?><h2 style="line-height:1.2em;">The 3-D Alumni Map is not compatible with older versions of Internet Explorer. <br />Please use the <a href="http://cronkitenation.com/2d">2-D Map</a> or <a href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie">upgrade your browser</a>.</h2><?php } ?>
		<!--<div id="map_messages" style="min-height: 20px;color: red;">Click Map to Pause.</div>-->
      
    </div>
	<script type="text/javascript" src="<?php echo get_template_directory_uri() ; ?>/blogs/d3.v2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri() ; ?>/blogs/world_files/d3.geo.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    
    <style type="text/css">

svg {
margin-top:5px;
margin-left:auto;
margin-right:auto;
width:100%;
  width: 720px;
  height: 720px;
  pointer-events: all;
}

circle {
  
  opacity: 0.5;
}

path {
  stroke: #fff;
}

path.points{
	stroke: #fff;
	stroke-width: 25;
	/*opacity: 0.8;*/
}

path.points:hover{
	stroke-width: 75;
}
div#body{
	text-align: center;
}
    </style>
    <script type="text/javascript">

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
	$('#sidebar-mapload').hide('fast');
	$('#load_message').hide('fast');
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
	$('div#sidebar-mapsingle').hide("fast");
	$('div#sidebar-mapgroup').hide("fast");
	
	$('span#firstname').html(alumn_fields[0]);
	$('span#lastname').html(alumn_fields[1]);
	$('span#employer').html(alumn_fields[2]);

	if (alumn_fields[5] == "United States"){
		$('span#city').html(alumn_fields[3] + ", " + alumn_fields[4] );
	} else {
		$('span#city').html(alumn_fields[3] + ", " + alumn_fields[5] );
	}

	$('span#jobtitle').html(alumn_fields[6]);
	
	$("img#profile_avatar").attr("src", alumn_fields[7]);
	$("a#profile_url").attr("href", alumn_fields[8]);
	
	$('div#sidebar-mapsingle').show("fast");
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
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[5] + '&quot;">' + dname[3] + ", " + dname[5] + ' &raquo;</a>';
		} else  if (dname[4] == "Washington D.C."){
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + ' &raquo;</a>';
		} else {
			ht_val = '<li><a style="color:#fff;border-bottom:1px dotted #ffb310;" href="/alumni/?s=&quot;' + dname[3] + ", " + dname[4] + '&quot;">' + dname[3] + ", " + dname[4] + ' &raquo;</a>';
		}
		
		if (cities.indexOf(ht_val) < 0){
			cities.push(ht_val);
		}
		
	}
	
	$('span#groupcity').html(cities.join("</li>"));
	/*
	if (centered.geometry.properties["names"][0][4] == "Outside U.S."){
		$('span#groupcity').html(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5] );
	} else {
		$('span#groupcity').html(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][4] );
	}
	*/
	
	$('div#sidebar-mapsingle').hide("fast");
	$('div#sidebar-mapgroup').hide("fast");
	
	
	$('div#sidebar-mapgroup h4').html(num_alumns.toString());
	$('a#group_in_dir').click(function(e){
		e.preventDefault();
		if (centered.geometry.properties["names"][0][4] == "Outside U.S."){
			$("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5]);
		} else if (centered.geometry.properties["names"][0][4] == "Washington D.C."){
			$("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][5]);
		} else{
			$("input#s").val(centered.geometry.properties["names"][0][3] + ", " + centered.geometry.properties["names"][0][4]);
		}
		$("form#searchgroup").submit();
	});
	
	$('div#sidebar-mapgroup').show("fast");
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
	if ($('div#sidebar-pp').hasClass('play')){
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
	var posX = $('svg').offset().left,posY = $('svg').offset().top;
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
	$('#sidebar-mapload').hide("fast");
	$('#load_message').html("Click on an alumni.");
	
	stop=true;
	$('div#sidebar-pp').addClass('play');
	svg.on("mousedown", mousedown);
	$('svg').dblclick(pan_and_zoom);
	points.on("click", click);
	$('div.tweakControls').show('fast');
	$('div#sidebar-back').click(function(e){
		prev_alumn();
	});
	
	$('div#sidebar-forward').click(function(e){
		next_alumn();
	});
	
	$('#sidebar-zin').click(function(e){
		$('#sidebar-zin').addClass("active");
		$('#sidebar-zout').removeClass("active");
		e.preventDefault();
		water.transition().duration(2000).attr("r", 3000);
		projection.scale(3000);
		refresh(2000);
	});
	
	$('#sidebar-zout').click(function(e){
		$('#sidebar-zout').addClass("active");
		$('#sidebar-zin').removeClass("active");
		e.preventDefault();
		projection.scale(360);
		water.transition().duration(2000).attr("r", 360);        
		refresh(2000);
	});
	
	
	$('#sidebar-left').click(function(e){
		
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0] - get_step(), orig_lat_long[1]];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	$('#sidebar-right').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0] + get_step(), orig_lat_long[1]];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	$('#sidebar-up').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0], orig_lat_long[1] + get_step()];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
	
	
	
	$('#sidebar-down').click(function(e){
		e.preventDefault();
		var orig_lat_long = projection.origin();
		var location = [orig_lat_long[0], orig_lat_long[1] - get_step()];
		projection.origin(location);
		circle.origin(location);
		refresh();
	});
}

function message_tip(msg){
	$('div#map_messages').html(msg);
	$('div#map_messages').show("fast");
	//alert("message");
}

function stop_message(msg){
	$('div#map_messages').hide("fast");
	//$('svg').hover(message_tip(msg), stop_message(msg));
	//alert("hide");
}

function start_animation(){
	stop=false;
	do_next_alumn();
	$('svg').unbind();
	//feature.on("mouseover", message_tip('Click to stop animation'));
	//feature.on("mouseout", stop_message);
	$('div#sidebar-pp').removeClass('play');
	svg.on("mousedown", toggle_animation);
	points.on("click", null);
	$('div#sidebar-back').unbind();
	$('div#sidebar-forward').unbind();
	$('.tweakControlSizeDown').unbind();
	$('.tweakControlSizeUp').unbind();
	$('.tweakControlMoveLeft').unbind();
	$('.tweakControlMoveRight').unbind();
	$('.tweakControlMoveUp').unbind();
	$('.tweakControlMoveDown').unbind();
	$('div.tweakControls').hide('fast');
	
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
		$('div#load_message').html('No results, <a href="/" style="color: #fff;">reset map.</a>').show('fast');
		$('div#sidebar-mapload').hide('fast');
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
	
	$('div#sidebar-pp').click(function(e){
		toggle_animation();
	});
}

$(document).ready(function(){
	d3.json("<?php echo get_template_directory_uri() ; ?>/blogs/world-countries.json", function(collection) {
		feature = svg.selectAll("path")
			.data(collection.features)
		  .enter().append("svg:path")
			.attr("d", clip)
			.attr("fill", "#4F5557");
	  
		feature.append("svg:title")
			.text(function(d) { return d.properties.name; });
		<?php if (array_key_exists("map_search", $_GET)){ ?>
			d3.json("/filter_geojson.php<?php if (array_key_exists("map_search", $_GET)){echo "?search=".$_GET["map_search"];}?>", process_alumns);
		<?php } else { ?>
			d3.json("/alumns.json", process_alumns);
		<?php } ?>
	  });
	/*
	<?php if (array_key_exists("map_search", $_GET)){ ?>
		d3.json("/filter_geojson.php<?php if (array_key_exists("map_search", $_GET)){echo "?search=".$_GET["map_search"];}?>", process_alumns);
	<?php } else { ?>
		d3.json("/alumns.json", process_alumns);
	<?php } ?>
	*/
	/*
	$('form#mapsearchform').submit(function(e){
		stop = true;
		e.preventDefault();
		val = $('form#mapsearchform input#s').val();
		points.remove();
		d3.json("/~cronkitenation/filter_geojson.php?search=" + val, process_alumns);
		('form#mapsearchform').submit();
	});
	*/

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

    </script>
						<?php edit_post_link( __( 'Edit this page.', 'buddypress' ), '<p class="edit-link">', '</p>'); ?>

					</div>

				</div>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->
	
<!-- BEGIN SIDEBAR -->

<?php do_action( 'bp_before_sidebar' ); ?>


<div id="sidebar" role="complementary">
    
	<form role="search" method="get" id="mapsearchform" action=""><input type="text" value="<?php echo stripslashes(htmlspecialchars($_GET["map_search"])) ?>" name="map_search" id="s" style="width: 125px;" />
	<input type="submit" id="searchsubmit" value="Search Map"/>
	<?php do_action( 'bp_blog_search_form' ); ?><br />
	<a href="/alumni">or search alumni directory &raquo;</a>
	</form>
	<div class="padder" style="padding-top: 0; margin-top: 10px; border-left: 1px solid #000;">
	<?php do_action( 'bp_inside_before_sidebar' ); ?>
	<div style="margin:5px -20px 0px -19px;background:#4f5557;text-align:center;"><a href="http://cronkitenation.com/2d" style="font-weight:800;color:#ffb310;margin-top:-5px;font-size:13px;">2-D Map &raquo;</a></div>
	<div id="idbg">
		<div id="load_message"></div>
		<div id="sidebar-mapload"></div>
		<div id="sidebar-mapsingle" style="display: none;">
			<img id="profile_avatar" src="wp-content/uploads/avatars/1/f582828b5064197a26b89b6c6e43b3cc-bpfull.jpg">
			<h4><span id="firstname">Oops</span> <span id="lastname">!</span></h4>
			<h5><span id="jobtitle">We're having some technical difficulties</span> at <span id="employer">the moment</span></h4>
			<h5><span id="city">Please refresh the page</span></h5>
			<span class="calltoaction"><a id="profile_url" href="http://cronkitenation.com" >See full profile &raquo;</a></span>
		</div><br /><br />
		<div id="sidebar-mapgroup" style="display: none;">
			<h5 style="font-size:28px;">Displaying</h5>
			<h4>145</h4>
			<h5 style="font-size:22px;padding-bottom:10px;">Cronkite alumni in:</h5>
			<span style="text-align:left;margin-left:30px;color:#ffb310;font-size:14px;font-weight:700;width:85%;"><span id="groupcity"><ul style="list-style-type:square;text-align:left;">GroupCity</span><br /></span>
			<!--<span class="calltoaction"><a id="group_in_dir" href="http://cronkitenation.com" >See in directory &raquo;</a></span>-->
			<form role="search" method="get" id="searchgroup" action="/alumni/">
				<input type="hidden" value="" name="s" id="s" >
				</form>
			<h5></h5>
		</div>
	</div>
	
	<div id="controls">
	
		<div id="ctrlwrap">
				
				<div id="sidebar-pp"></div>
				
		</div>
		<div class="tweakControls" style="width: 100%;padding-bottom:10px; text-align: center; background-color: black;">
				<div id="sidebar-back"></div>
				<div id="sidebar-zout"></div>
				<div id="sidebar-zin"></div>
				<div id="sidebar-forward"></div>
				
				<div id="sidebar-up"></div><br />
				
				<div id="sidebar-left"></div>
				<div id="sidebar-right"></div>
				
				<div id="sidebar-down"></div>
		</div>
	</div>

	<!-- BEGIN CUSTOM EVENTS -->
	<!-- 	<h3 class="widgettitle">Cronkite Alumni Event</h3> -->
	<?php         
	   /* $argsevent = array( 
		'timespan'    => 60,
		'date_format_1'   => 'm/d/Y',
		'date_format_2'   => 'm/d',
		'html_list_v1'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE%, %TIME%',
		'html_list_v2'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE%',
		'html_list_v3'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE% to <b>%ENDDATE%',
		'html_list_v4'    => '<a class="list1" href="%LOCATION%">%TITLE</a> on %DATE% (multiday)',
		'max_events'  => 4,
		);
	
	    rs_event_list($argsevent); 
          */
	?>
    
	<!-- END CUSTOM EVENTS-->



	
	<?php if ( is_user_logged_in() ) : ?>
		<h3 class="widgettitle">Welcome <?php echo bp_loggedin_user_fullname() ?></h3>
		<?php do_action( 'bp_before_sidebar_me' ); ?>

		<div id="sidebar-me">
			<a href="<?php echo bp_loggedin_user_domain(); ?>">
				<?php bp_loggedin_user_avatar( 'type=thumb&width=60&height=60' ); ?>
			</a>

			<h4><a href="<?php echo bp_loggedin_user_domain() ?>profile/">Your Profile</a></h4>
			<a class="button logout" href="<?php echo wp_logout_url( wp_guess_url() ); ?>">Logout</a>

			<?php do_action( 'bp_sidebar_me' ); ?>
		</div>

		<?php do_action( 'bp_after_sidebar_me' ); ?>

		<?php if ( bp_is_active( 'messages' ) ) : ?>
			<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
		<?php endif; ?>

	<?php else : ?>
	<h3 class="widgettitle">Alumni Login</h3>
		<?php do_action( 'bp_before_sidebar_login_form' ); ?>

		<?php if ( bp_get_signup_allowed() ) : ?>
		
			<p id="login-text">

				<?php// printf( __( 'Are you an alum looking to get listed? <a href="%s" title="Create an account">Create an account</a> to get started.', 'buddypress' ), bp_get_signup_page() ); ?>
 				
			Are you an alum looking to get listed?	<a href="<?php echo bp_get_signup_page(); ?>"><input type="submit" name="wp-submit" title="Create an account" value="Create an account" tabindex="100"/></a> to get started.
			</p>

		<?php endif; ?>
		
		<style type="text/css">
		.loginmain { width:230px; height:200px; margin-left:-19px;margin-top:-20px;}
.loginbox { width:200px; overflow:hidden; padding:15px; background:#fff; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;}
.loginbox h2 { color:#292929; font-size:25px; margin:0; padding:0 0 10px 0; font-weight:bold; outline:none;}
.loginbox h3 { color:#7f7f7f; font-size:17px; line-height:20px; margin:0; padding:0; font-weight:normal; outline:none;}

.loginform { margin:0; padding:0;}
.loginform fieldset { border:none; padding: 10px 0 0; margin:0;}
.loginform .row { margin-bottom:6px; position:relative; line-height:33px;}

.loginform .row input[type="text"], .loginform .row input[type="password"] { height:33px; line-height:33px; border:1px solid #c5c5c5; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset; -moz-box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset; -webkit-box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset;}
.loginform .row input[type="text"]:focus, .loginform .row input[type="text"]:hover, .form .row input[type="password"]:focus, .form .row input[type="password"]:hover { border:1px solid #c5c5c5; box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset; -moz-box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset; -webkit-box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset;}
.loginform .row input.login { background:url(http://cronkitenation.com/wp-content/plugins/buddypress/bp-themes/bp-default/_inc/login/input_login.png) left center no-repeat #f5f5f5; width:152px; padding: 1px 5px 1px 45px;}
.loginform .row input.password { background:url(http://cronkitenation.com/wp-content/plugins/buddypress/bp-themes/bp-default/_inc/login/input_password.png) left center no-repeat #f5f5f5; width:152px; padding: 1px 5px 1px 45px; }
.loginform .row input.error { border:1px solid #eb9393; box-shadow: 0 0 5px #f7c4c4; -moz-box-shadow: 0 0 5px #f7c4c4; -webkit-box-shadow: 0 0 5px #f7c4c4; background-color:#fce4e4; }

.loginform .row a.forgot { position:absolute; top:2px; right:10px; color:#909090; font-size:12px; text-shadow:1px 1px 1px #fff;}
.loginform .row a.forgot:hover { color:#6e6e6e;}
.loginform .row input[type="checkbox"] { display:block; float:left; margin: 9px 6px 9px 2px; }
.loginform .row label { color:#7f7f7f; font-size:14px; display:block; float:left; }
.loginform .row input[type="submit"] { cursor:pointer; color:#fff; border:1px solid #bd2525; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; background:#990033; font-size:16px; padding:5px 20px; font-weight:bold; float:right;}
.loginform .row input[type="submit"]:hover { background:#ffb310; color:#990033; font-size:16px; padding:5px 20px; font-weight:bold; float:right;}
		</style>
		
		<div class="loginmain">
		<div class="loginbox">
			<form name="login-form" class="loginform" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
				<fieldset>
					<div class="row">
						<input type="text" name="log" class="login" name="login" placeholder="Email Address" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97"/>
						<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
						<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
					</div>
					<div class="row">
						<input name="pwd" type="password" class="password" name="password" class="input" value="" tabindex="98" placeholder="Password"/>
					
					</div>	
					<div class="row">
						<input type="checkbox" class="remember" name="rememberme" value="forever" id="remember"  />
						<label for="remember">Keep me signed in</label><br />
						<a style="font-size:11px;padding-top:-3px;" href="<?php echo site_url( add_query_arg( array( 'action' => 'lostpassword' ), 'wp-login.php' ), 'login' ); ?>">Reset Password</a>
						<?php do_action( 'bp_sidebar_login_form' ); ?>
						<input type="submit" name="wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100"/>
						<input type="hidden" name="testcookie" value="1" />
					</div>
				</fieldset>
			</form>		
		</div>
		
	</div>

		<?php do_action( 'bp_after_sidebar_login_form' ); ?>

	<?php endif; ?>


        <h3 class="widgettitle">Cronkite Nation on Twitter</h3>
         <a class="twitter-timeline" href="https://twitter.com/search?q=%23cronkitenation" data-widget-id="448521295630594048">Tweets about "#cronkitenation"</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

        <!-- BEGIN CUSTOM EVENTS -->
        <h3 class="widgettitle">Cronkite Alumni Event</h3>
        <?php
            $argsevent = array(
                'timespan'    => 60,
                'date_format_1'   => 'm/d/Y',
                'date_format_2'   => 'm/d',
                'html_list_v1'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE%, %TIME%',
                'html_list_v2'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE%',
                'html_list_v3'    => '<a class="list1" href="%LOCATION%">%TITLE%</a> on %DATE% to <b>%ENDDATE%',
                'html_list_v4'    => '<a class="list1" href="%LOCATION%">%TITLE</a> on %DATE% (multiday)',
                'max_events'  => 4,
                );

            rs_event_list($argsevent);
        ?>

        <!-- END CUSTOM EVENTS-->

	<div id="sidebar-logo">
	<a href="http://cronkite.asu.edu" target="_blank"><img style="margin-left:-9px;" src="/wp-content/uploads/2012/10/WCSJ_B.png" /></a>
	</div>

	

	<?php do_action( 'bp_inside_after_sidebar' ); ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ); ?>


<?php get_footer(); ?>
