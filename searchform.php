<?php do_action( 'bp_before_blog_search_form' ); ?>

<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/alumni">
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'buddypress' ); ?>" />

	<?php do_action( 'bp_blog_search_form' ); ?>
</form>

<?php do_action( 'bp_after_blog_search_form' ); ?>
