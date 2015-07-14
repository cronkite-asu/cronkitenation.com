<?php /* Template name: Alumni Directory */ ?>  
<?php
$url = home_url();

/**
 * BuddyPress - Members Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */
?>

<?php get_header(); ?>

<?php do_action( 'bp_before_directory_members_page' ); ?>

<div id="content">
	<div class="padder">
	
	<h2>Alumni Directory</h2>
	<div style="float:right;"><?php do_action( 'bp_before_directory_members' ); ?>
				<form role="search" method="get" id="searchform" action="<?php echo esc_url( $url ); ?>/alumni">
			<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="Search Alumni Directory" />
			<?php do_action( 'bp_blog_search_form' ); ?><br />
		</form></div>

	<form action="" method="post" id="members-directory-form" class="dir-form">

		<h6>
			<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1524=') . urlencode( 'Phoenix' ); ?>" >Alumni in Phoenix</a>
			|
			<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1525=') . urlencode( 'Arizona' ); ?>" >Alumni in Arizona</a>
			|
			<a href="<?php echo esc_url( $url . '/alumni/?bp_profile_search&field_1525=') . urlencode( 'Outside U.S.' ) ; ?>" >Alumni Outside U.S.</a>
		</h6>
		<br />
		<?php do_action( 'bp_before_directory_members_content' ); ?>

		<br />

		<div id="members-dir-list" class="members dir-list">

			<?php locate_template( array( '/buddypress/members/members-loop.php' ), true ); ?>

		</div><!-- #members-dir-list -->

		<?php do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->

	<?php do_action( 'bp_after_directory_members' ); ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php do_action( 'bp_after_directory_members_page' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
