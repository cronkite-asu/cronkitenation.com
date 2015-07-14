<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
	<?php
if ( function_exists( 'yoast_analytics' ) ) { 
  yoast_analytics(); 
}
?>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if (bp_is_front_page()) { ?><meta name="viewport" content="width:768px" /><?php } elseif (current_theme_supports( 'bp-default-responsive' )) { ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php } ?>
		<title><?php if(bp_is_user_profile()) {?><?php bp_member_profile_data( 'field=First Name' ); ?> <?php bp_member_profile_data( 'field=Last Name' ); ?> | Cronkite Nation <?php } elseif(bp_is_directory()) { ?>Alumni Directory | Cronkite Nation<?php } elseif(bp_is_front_page()) { ?>Alumni Map - The Cronkite School | Cronkite Nation <?php } else { ?>Cronkite Nation <?php } ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<?php do_action( 'bp_head' ); ?>
		<?php wp_head(); ?>
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

<?php
	
	if (strpos($ua['userAgent'], 'iP')){ ?> <div style="height:28px;"></div><?php }
else {
?>
<!-- START /asuthemes/4.0/heads/default_white.shtml -->

<link type="text/css" rel="stylesheet" media="all" href="//www.asu.edu/asuthemes/4.0/css/asu_header.css" />
<link rel="shortcut icon" href="/wp-content/plugins/buddypress/bp-themes/bp-default/favicon.ico" />
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
	<img src="//www.asu.edu/asuthemes/4.0/images/logos/asu_logo_white.png" height="32" width="203" id="asu_print_logo" />
	<div id="asu_nav_wrapper">
	  <h2 class="hidden">Sign In / Sign Out</h2>
        <h2 class="hidden">Navigation: ASU Universal</h2>
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
		<?php } ?>

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
