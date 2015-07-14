		</div> <!-- #container -->

		<?php do_action( 'bp_after_container' ); ?>
		<?php do_action( 'bp_before_footer'   ); ?>

		<div id="footer">
			<?php if ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' ) || is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
				<div id="footer-widgets">
					<?php get_sidebar( 'footer' ); ?>
				</div>
			<?php endif; ?>

			<div id="site-generator" role="contentinfo">
				<?php do_action( 'bp_dtheme_credits' ); ?>
				<p style="font-size:11px;">A product of the <a href="http://nmil.asu.edu/">New Media Innovation Lab</a> at the <a href="http://cronkite.asu.edu">Walter Cronkite School of Journalism and Mass Communication</a>.</p>
				<p style="font-size:10px;">Developed with <a href="http://d3js.org/">d3js</a>, <a href="http://wordpress.org">WordPress</a> and <a href="http://buddypress.org">BuddyPress</a>.</p>
			</div>

			<?php do_action( 'bp_footer' ); ?>

		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ); ?>

		<?php wp_footer(); ?>
		
		</div>

	</body>

</html>