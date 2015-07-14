<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
	<?php
if ( function_exists( 'yoast_analytics' ) ) { 
  yoast_analytics(); 
}
?>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php endif; ?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

		<!-- START /asuthemes/4.0/heads/default_white.shtml -->
		<?php echo file_get_contents('http://www.asu.edu/asuthemes/4.3/heads/default.shtml'); ?>
		<!-- ASU Header -->

		<?php do_action( 'bp_head' ); ?>
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> id="bp-default">

<!-- ************ BEGIN ASU HEADER ************** -->
	<?php echo file_get_contents('http://www.asu.edu/asuthemes/4.3/includes/gtm.shtml'); ?><!-- ASU Google Tag Manager -->
	<?php echo  file_get_contents('http://www.asu.edu/asuthemes/4.3/headers/default.shtml'); ?>
<!-- ************ END ASU HEADER **************** -->

		<!--[if lt IE 9]>
			<style type="text/css">
				.gradient { filter: none; }
  			</style>
		<![endif]-->
		<div id="hbg">
		<div id="header">
			<div class="title">
				<h1>
					<a href="<?php echo esc_url( home_url() ); ?>" title="cronkite nation">cronkite nation</a>
				</h1>
			</div>
		</div><!-- #header -->
		</div>
		<?php uberMenu_easyIntegrate(); ?>

		<?php do_action( 'bp_after_header'     ); ?>
		<?php do_action( 'bp_before_container' ); ?>

		<div id="container">
