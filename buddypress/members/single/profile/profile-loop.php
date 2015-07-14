<?php do_action( 'bp_before_profile_loop_content' ); ?>
<?php $url = home_url(); ?>

<?php if ( bp_has_profile() ) : ?>

	<?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

		<?php if ( bp_profile_group_has_fields() ) : ?>

			<?php do_action( 'bp_before_profile_field_content' ); ?>
<style type="text/css">
a.tooltip {outline:none;text-decoration:none;border-bottom:dotted 1px #ffb310;}
    a.tooltip strong {line-height:17px;}
    a.tooltip > span 
    {
	    width:235px;
	    padding: 10px 20px;
	    margin-top: 20px;
	    margin-left: -85px;
	    opacity: 0;
	    visibility: hidden;
	    z-index: 10;	   
	    position: absolute;
	    font-family: Arial;
	    font-size: 16px;
	    font-weight:bold;
	    -webkit-border-radius: 3px;
	    -moz-border-radius: 3px;
	    -o-border-radius: 3px;
	    border-radius: 3px;
        -webkit-box-shadow: 2px 2px 2px #999;
	    -moz-box-shadow: 2px 2px 2px #999;		
	    box-shadow: 2px 2px 2px #999;	    
	    -webkit-transition-property:opacity, margin-top, visibility, margin-left;
	    -webkit-transition-duration:0.2s, 0.1s, 0.2s, 0.1s;  
	    -webkit-transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
	
	    -moz-transition-property:opacity, margin-top, visibility, margin-left;
	    -moz-transition-duration:0.2s, 0.1s, 0.2s, 0.1s;  
	    -moz-transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
	
	    -o-transition-property:opacity, margin-top, visibility, margin-left;
	    -o-transition-duration:0.2s, 0.1s, 0.2s, 0.1s;  
	    -o-transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
	
	    transition-property:opacity, margin-top, visibility, margin-left;
	    transition-duration:0.2s, 0.1s, 0.2s, 0.1s;  
	    transition-timing-function: ease-in-out, ease-in-out, ease-in-out, ease-in-out;
    }
    /*a.tooltip > span:hover,*/
	a.tooltip:hover > span
	{
		opacity: 1;
		text-decoration:none;
		visibility: visible;
		overflow: visible;
		margin-top:20px;
		display: inline;
		margin-left: -75px;		
	}

	a.tooltip span b {
		margin-left: 20px;
		margin-top: -19px;
		display: block;
		position: absolute;

		-webkit-transform: rotate(-45deg);
		-moz-transform: rotate(-45deg);
		-o-transform: rotate(-45deg);
		transform: rotate(-45deg);
			
		-webkit-box-shadow: inset -1px 1px 0 #fff;
		-moz-box-shadow: inset 0 1px 0 #fff;
		-o-box-shadow: inset 0 1px 0 #fff;
		box-shadow: inset 0 1px 0 #fff;
			
		display: none;
	}
    
a.tooltip > span {
	color: #000000; 

	background: #fed88b;
	background: -moz-linear-gradient(top, #fff6e5 0%, #fed88b 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fff6e5), color-stop(100%,#fed88b));
	    
	border: 1px solid #CFB57C;	     
}    
	  
a.tooltip span b {
	background: #fed88b;
	border-top: 1px solid #CFB57C;
	border-right: 1px solid #CFB57C;
}    
			</style>
			

		<div class="bp-widget alumni-profile">
			<div style="float:right;"><?php global $bp ?>
			<?php $editurl = $bp->displayed_user->domain; if ( is_user_logged_in() && is_super_admin() ) { ?><a class="button" href="<?php echo esc_url( $editurl ); ?>profile/edit/">Admin Edit Profile</a> <a class="button" href="<?php echo esc_url( $editurl ); ?>profile/change-avatar/">Admin Upload Headshot</a><?php } ?>
			</div>
		<table class="profile-fields">
			<tr class="field_1 field_first-name">
				<td class="label">Full Name:</td>
				<td class="data"><p style="font-weight:bold;"><?php bp_profile_field_data( 'field=First Name' );?> <?php bp_profile_field_data( 'field=Middle Name' );?> <?php bp_profile_field_data( 'field=Last Name' );?> <?php if ( $maiden = bp_get_profile_field_data( 'field=Maiden Name' ) ) : ?><span style="font-weight:normal;">(<?php echo $maiden ?>)</span><?php endif ?></p></td>		
			</tr>
			<tr class="field_2042 field_job-title">
				<td class="label">Employment:<span style="color:#990033;font-weight:bold;font-size:14px;">*</span></td>
				<td class="data">
				<p>
				<?php $pri = bp_get_profile_field_data( 'field=Position at Primary Employer' ) ?>
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_2042=') . urlencode( $pri ); ?>" class="tooltip" rel="nofollow">
				<?php echo $pri ;?>
				<span>Search directory for:<br /><?php echo $pri; ?></span></a> at
				<?php $priemp = bp_get_profile_field_data( 'field=Primary Employer' ) ?>
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_2043=') . urlencode( $priemp ); ?>" rel="nofollow" class="tooltip">
				<?php bp_profile_field_data( 'field=Primary Employer' );?><span><strong>Other alumni employed at:</strong><br />
				<?php echo $priemp; ?></span></a></p></td>
			</tr>
			<?php if ( $sec = bp_get_profile_field_data( 'field=Position at Secondary Employer' ) ) : ?>
			<tr class="field_2044 field_job-title-2">
				<td class="label"></td>
				<td class="data"><p>
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_2168=') . urlencode( $sec ); ?>" class="tooltip" rel="nofollow"><?php echo $sec ?>
				<span>Search directory for:<br /><?php echo $sec ?></span></a> at 
				<?php $secemp = bp_get_profile_field_data( 'field=Secondary Employer' ) ?>
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_2169=') . urlencode( $secemp ); ?>" class="tooltip" rel="nofollow"><?php bp_profile_field_data( 'field=Secondary Employer' );?>
				<span>Other alumni employed at:<br /><?php echo $secemp;?></span></a></p></td>
			</tr>
			<?php endif ?>
			<tr class="field_1524 field_city">	
					<td class="label">Location:<span style="color:#990033;font-weight:bold;font-size:14px;">*</span></td>	
					<td class="data">
							<?php $city = bp_get_profile_field_data( 'field=City' ) ?>
							<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1524=') . urlencode( $city ); ?>" class="tooltip" rel="nofollow"><?php echo $city; ?>
							<span>Other alumni employed in:<br /><?php echo $city; ?></span></a>
							<?php $state = bp_get_member_profile_data( "field=U.S. State / Territory" ); if ( $state == "Washington D.C." ) {} elseif ($state =="Outside U.S.") {} else { ?>, 
							<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1525=') . urlencode( $state ); ?>" class="tooltip" rel="nofollow"><?php echo $state ?>
							<span>Other alumni living in:<br /><?php echo $state ?></span></a><?php } ?>,
							<?php $country = bp_get_profile_field_data( 'field=Country' ) ?>
							<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1644=') . urlencode( $country ) ; ?>" class="tooltip" rel="nofollow">
							<span>Other alumni living in:<br /><?php echo $country; ?></span><?php echo $country; ?></a></p></td>
			</tr>
			<tr class="field_173 field_years-of-graduation">
				<td class="label">Graduating Class:</td>
				<?php $gyear = bp_get_profile_field_data( 'field=Graduating Class' ); ?>
				<td class="data"><p><a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_173=') . urlencode( $gyear[0] ); ?>" rel="nofollow" class="tooltip">
				<?php echo $gyear[0];?><span><strong>Search alumni directory for:</strong><br />Class of <?php echo $gyear[0];?></span></a>
				<?php if ($gyear[1] != '') { ?>,
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_173=') . urlencode( $gyear[1] ); ?>" rel="nofollow" class="tooltip">
				<?php echo $gyear[1];?><span><strong>Search alumni directory for:</strong><br />Class of <?php echo $gyear[1];?></span></a>
				<?php } ?>
				</p></td>
			</tr>
			<?php if ( $degreedisplay = bp_get_member_profile_data( 'field=Degree' ) ) : ?>
			<tr class="field_304 field_degree">	
				<td class="label">Degree:</td>
				<?php $degree = bp_get_profile_field_data('field=Degree'); ?>
				<td class="data">
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_304=') . urlencode( $degree[0] ); ?>" rel="nofollow" class="tooltip">
				<?php echo $degree[0];?><span><strong>Search directory for:</strong><br /><?php echo $degree[0];?></span></a><?php if ($degree[1] != '') { ?>,
				<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_304=') . urlencode( $degree[1] ); ?>" rel="nofollow" class="tooltip">
				<?php echo $degree[1];?><span><strong>Search directory for:</strong><br /><?php echo $degree[1];?></span></a> <?php } ?>
				</td>
			</tr>
			<?php endif ?>
			<?php if ( $inddisp = bp_get_profile_field_data( 'field=Industry (Comma-Separated)' ) ) : ?>
			<tr class="field field_industry">
				<td class="label">Industry:</td>
				<td class="data"><?php function industry_array($industries) { $industry = xprofile_get_field_data( 'Industry (Comma-Separated)' );
    						$industries = explode(',', $industry);
    						$industryarray = array();
   							foreach ($industries as $industry) {
        						if (empty($industry)) continue;
       							$industryarray[] = '<a href="' . esc_url( home_url() . '/alumni/?bp_profile_search&field_2594=' ) . urlencode( trim($industry) ) . '" class="tooltip">' . $industry . '<span>Search directory for:<br />' . $industry . '</span></a>';
    							}
    						return implode(', ', $industryarray);
							} echo industry_array($industries) ?></td>
			</tr>
			<?php endif ?>

			<?php if ( $beatdisp = bp_get_profile_field_data( 'field=Beats (Comma-Separated)' ) ) : ?>
			<tr class="field field_beat">	
				<td class="label">Beats:</td>
				<td class="data"><?php function beat_array($beats) { $beat = xprofile_get_field_data( 'Beats (Comma-Separated)' );
    						$beats = explode(',', $beat);
    						$beatarray = array();
   							foreach ($beats as $beat) {
        						if (empty($beat)) continue;
       							$beatarray[] = '<a href="' . esc_url( home_url() . '/alumni/?bp_profile_search&field_2593=' ) . urlencode( trim($beat) ) . '" class="tooltip">' . $beat . '<span>Search directory for:<br />' . $beat . '</span></a>';
    							}
    						return implode(', ', $beatarray);
							} echo beat_array($beats) ?></td>
			</tr>
			<?php endif ?>
			
			<?php if ( $skilldisp = bp_get_profile_field_data( 'field=Skills (Comma-Separated)' ) ) : ?>
			<tr class="field field_skill">	
				<td class="label">Skills:</td>
				<td class="data"><?php function skill_array($skills) { $skill = xprofile_get_field_data( 'Skills (Comma-Separated)' );
    						$skills = explode(',', $skill);
    						$skillarray = array();
   							foreach ($skills as $skill) {
        						if (empty($skill)) continue;
       							$skillarray[] = '<a href="' . esc_url( home_url() . '/alumni/?bp_profile_search&field_2595=' ) . urlencode( trim($skill) ) . '" class="tooltip">' . $skill . '<span>Search directory for:<br />' . $skill . '</span></a>';
    							}
    						return implode(', ', $skillarray);
							} echo skill_array($skills) ?></td>
			</tr>
			<?php endif ?>
			
			
			
			<?php if ( $twitter = bp_get_profile_field_data( 'field=Twitter Username' ) ) : ?>
			<tr class="field_2044 field_twitter">	
				<td class="label">Twitter:</td>
				<td class="data">
				<a href="https://twitter.com/<?php echo esc_html( $twitter ); ?>" class="twitter-follow-button" data-show-count="true" data-size="large" target="_blank">Loading Twitter...</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</td>
			</tr>
			<?php endif ?>
			
			<?php if ( $linkedin = bp_get_profile_field_data( 'field=LinkedIn URL' ) ) : ?>
			<tr class="field_2045 field_linkedin-url">	
				<td class="label">LinkedIn:</td>
				<td class="data"><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><img src="http://www.linkedin.com/img/webpromo/btn_viewmy_160x33.png" width="160" height="33" border="0" alt="View <?php bp_profile_field_data( 'field=First Name' );?> <?php bp_profile_field_data( 'field=Last Name' );?>'s profile on LinkedIn"></a></td>
			</tr>
			<?php endif ?>
			
			<?php if ( $persurl = bp_get_profile_field_data( 'field=Personal Website URL' ) ) : ?>
			<tr class="field_2046 field_personal-website-url">	
				<td class="label">Personal Website:</td>
				<td class="data"><a href="<?php echo esc_url( $persurl ); ?>" target="_blank"><?php echo esc_url( $persurl ); ?></a></td>
			</tr>
			<?php endif ?>
			
			<?php if ( $portfoliourl = bp_get_profile_field_data( 'field=Web Portfolio URL' ) ) : ?>
			<tr class="field_2046 field_personal-website-url">	
				<td class="label">Web Portfolio:</td>
				<td class="data"><a href="<?php echo esc_url( $portfoliourl ); ?>" target="_blank"><?php echo esc_url( $portfoliourl ); ?></a></td>
			</tr>
			<?php endif ?>
			
			<?php if ( $empurl = bp_get_profile_field_data( 'field=Employer Website URL' ) ) : ?>
			<tr class="field_2046 field_personal-website-url">	
				<td class="label">Employer's Website:</td>
				<td class="data"><a href="<?php echo esc_url( $empurl ); ?>" target="_blank"><?php echo esc_url( $empurl ); ?></a></td>
			</tr>
			<?php endif ?>
	</table>

</div>
<?php if ( $RSSfeed = bp_get_profile_field_data( 'field=RSS Feed' ) ) : ?>	
<h2 style="float:left;display:inline;padding-top:10px;"><?php bp_profile_field_data( 'field=First Name' );?>'s Latest Stories</h2><a href="<?php echo esc_url( $RSSfeed ); ?>"><i class="fa fa-rss-square fa-2x fa-fw"></i></a><hr>
<?php include_once(ABSPATH.WPINC.'/rss.php'); // path to include built-in WordPress RSS script
$RSSurl = $RSSfeed;
$feed = fetch_rss($RSSurl); // specify feed url
$items = array_slice($feed->items, 0, 5); // specify first and last item
?>

<?php if (!empty($items)) : ?>

<?php foreach ($items as $item) : ?>
<h4><a href="<?php echo esc_url( wp_filter_kses($item['link']) ); ?>" target="_blank"><?php echo wp_specialchars($item['title']); ?></a></h4>
<?php if (isset($item['description'])) : ?>
<p>Published on <?php $pubdate = substr($item['pubdate'], 0, 16); echo $pubdate; ?> <br /><?php echo $item['description']; ?></p>
<?php endif; ?>
<p></p>
<?php endforeach; ?>

<?php endif; ?>
<?php endif; ?>
<p style="font-size:10px;text-align:left;"><span style="color:#990033;font-size:14px;">*</span> Based on last reported employment information.</p>
			

			<?php do_action( 'bp_after_profile_field_content' ); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php do_action( 'bp_profile_field_buttons' ); ?>

<?php endif; ?>

<?php do_action( 'bp_after_profile_loop_content' ); ?>
