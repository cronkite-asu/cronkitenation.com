<?php /* Template name: Cronkite Nation Map */ ?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$url = home_url();

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

<?php get_header(); ?>

<?php

if (!array_key_exists("3d", $_GET)){

	if (($ua['name'] == "Internet Explorer") && (floatval($ua['version']) < 9.0)){
		?>
		<script type="text/javascript">
			window.location = "<?php echo esc_url( $url ); ?>/2d";
		</script>
		<?php
	}
	
	if (strpos($ua['userAgent'], 'iP')){
		?>
		<script type="text/javascript">
			window.location = "<?php echo esc_url( $url ); ?>/2d";
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
		?><h2 style="line-height:1.2em;">The 3-D Alumni Map is not compatible with older versions of Internet Explorer. <br />Please use the <a href="<?php echo esc_url( $url ); ?>/2d">2-D Map</a> or <a href="http://windows.microsoft.com/en-US/internet-explorer/downloads/ie">upgrade your browser</a>.</h2><?php } ?>
      
    </div>

 <?php
	$map_params = array();
	$map_params['site_url']= $url;
	$map_params['stylesheet_directory']= get_stylesheet_directory_uri();
	if (array_key_exists("map_search", $_GET)) {
		$map_params['map_search']=$_GET["map_search"];
	}
	wp_localize_script( 'cn_map', 'map_params', $map_params );
?>
    
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

						<?php edit_post_link( __( 'Edit this page.', 'cronkitenation' ), '<p class="edit-link">', '</p>'); ?>

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
	<a href="<?php echo esc_url( $url ); ?>/alumni">or search alumni directory <i class="fa fa-angle-double-right"></i></a>
	</form>
	<div class="padder" style="padding-top: 0; margin-top: 10px; border-left: 1px solid #000;">
	<?php do_action( 'bp_inside_before_sidebar' ); ?>
	<div style="margin:5px -20px 0px -19px;background:#4f5557;text-align:center;"><a href="<?php echo esc_url( $url ); ?>/2d" style="font-weight:800;color:#ffb310;margin-top:-5px;font-size:13px;">2-D Map <i class="fa fa-angle-double-right"></i></a></div>
	<div id="idbg">
		<div id="load_message"></div>
		<div id="sidebar-mapload"><i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>
		<div id="sidebar-mapsingle" style="display: none;">
			<i class="fa fa-user fa-5x"></i>
			<h4><span id="firstname">Oops</span> <span id="lastname">!</span></h4>
			<h5><span id="jobtitle">We're having some technical difficulties</span> at <span id="employer">the moment</span></h4>
			<h5><span id="city">Please refresh the page</span></h5>
			<span class="calltoaction"><a id="profile_url" href="<?php echo esc_url( $url ); ?>" >See full profile <i class="fa fa-angle-double-right"></i></a></span>
		</div><br /><br />
		<div id="sidebar-mapgroup" style="display: none;">
			<h5 style="font-size:28px;">Displaying</h5>
			<h4>145</h4>
			<h5 style="font-size:22px;padding-bottom:10px;">Cronkite alumni in:</h5>
			<span style="text-align:left;margin-left:30px;color:#ffb310;font-size:14px;font-weight:700;width:85%;"><span id="groupcity"><ul style="list-style-type:square;text-align:left;">GroupCity</span><br /></span>
			<!--<span class="calltoaction"><a id="group_in_dir" href="<?php echo esc_url( $url ); ?>" >See in directory <i class="fa fa-angle-double-right"></i></a></span>-->
			<form role="search" method="get" id="searchgroup" action="/alumni/">
				<input type="hidden" value="" name="s" id="s" >
				</form>
			<h5></h5>
		</div>
	</div>
	
	<div id="controls">
	
		<div id="ctrlwrap">
				
				<div id="sidebar-pp" class="sidebar-control"><i class="fa fa-youtube-play fa-5x fa-fw"></i></div>
		</div>
		<div class="tweakControls">
			<div id="sidebar-back" class="sidebar-control"><i class="fa fa-step-backward fa-3x fa-fw"></i></div>
			<div id="sidebar-zout" class="sidebar-control"><i class="fa fa-search-minus fa-3x fa-fw"></i></div>
			<div id="sidebar-zin" class="sidebar-control"><i class="fa fa-search-plus fa-3x fa-fw"></i></div>
			<div id="sidebar-forward" class="sidebar-control"><i class="fa fa-step-forward fa-3x fa-fw"></i></div>
			<br />

			<div id="sidebar-up" class="sidebar-control"><i class="fa fa-chevron-circle-up fa-3x fa-fw"></i></div>

			<div id="sidebar-left" class="sidebar-control"><i class="fa fa-chevron-circle-left fa-3x fa-fw"></i></div>
			<div id="sidebar-right" class="sidebar-control"><i class="fa fa-chevron-circle-right fa-3x fa-fw"></i></div>

			<div id="sidebar-down" class="sidebar-control"><i class="fa fa-chevron-circle-down fa-3x fa-fw"></i></div>
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
 				
				<?php printf( __( 'Are you an alum looking to get listed? <a href="%s" title="Create an account">Create an account</a> to get started.', 'cronkitenation' ), bp_get_signup_page() ); ?>
			</p>

		<?php endif; ?>
		
	<div class="loginmain">
		<div class="loginbox">
			<form name="login-form" class="loginform" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
				<fieldset>
					<div class="row">
						<i class="fa fa-user fa-2x fa-fw"></i><input type="text" name="log" class="login" name="login" placeholder="Email Address" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97"/>
						<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
						<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
					</div>
					<div class="row">
						<i class="fa fa-key fa-2x fa-fw"></i><input name="pwd" type="password" class="password" name="password" class="input" value="" tabindex="98" placeholder="Password"/>
					</div>	
					<div class="row">
						<input type="checkbox" class="remember" name="rememberme" value="forever" id="remember"  />
						<label for="remember">Keep me signed in</label><br />
						<a style="font-size:11px;padding-top:-3px;" href="<?php echo site_url( add_query_arg( array( 'action' => 'lostpassword' ), 'wp-login.php' ), 'login' ); ?>">Reset Password</a>
						<?php do_action( 'bp_sidebar_login_form' ); ?>
						<input type="submit" name="wp-submit" value="<?php _e( 'Log In', 'cronkitenation' ); ?>" tabindex="100"/>
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
	<a href="http://cronkite.asu.edu" target="_blank"><img style="margin-left:-9px;" src="<?php echo esc_url( $url ); ?>/wp-content/uploads/2012/10/WCSJ_B.png" /></a>
	</div>

	

	<?php do_action( 'bp_inside_after_sidebar' ); ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ); ?>


<?php get_footer(); ?>
