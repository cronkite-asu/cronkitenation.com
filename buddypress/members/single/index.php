<?php get_header(); ?>

<div id="content">
	<div class="padder">

	<?php do_action( 'bp_before_blog_page' ); ?>

	<div class="page" id="blog-page" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry">

					<?php the_content(); ?>

				</div>
			</div>

		<?php endwhile; endif; ?>

	</div><!-- .page -->

	<?php do_action( 'bp_after_blog_page' ); ?>

	</div><!-- .padder -->
</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
