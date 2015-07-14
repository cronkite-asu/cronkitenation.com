<?php /* Template name: Recently Updated Alumni */ ?>  

<?php if ( is_user_logged_in() && is_super_admin() ) { ?>
<?php get_header(); ?>
<div id="content">
		<div class="padder">
		
		<h2>Recently Added Alumni</h2>
		<div style="float:right;"><?php do_action( 'bp_before_directory_members' ); ?>
					<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/alumni">
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Search Alumni Directory" />
				<?php do_action( 'bp_blog_search_form' ); ?><br />
			</form></div>

		<form action="" method="post" id="members-directory-form" class="dir-form">

			<?php do_action( 'bp_before_directory_members_content' ); ?>


			<br />

			<div id="members-dir-list" class="members dir-list">

				<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="member-dir-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list" role="main">

	<?php while ( bp_members() ) : bp_the_member(); ?>

		<li>
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
			</div>

			<div class="item">
				<div class="item-title">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_profile_data( 'field=First Name' );?> <?php bp_member_profile_data( 'field=Last Name' );?> <?php if ( $maiden = bp_get_member_profile_data( 'field=Maiden Name' ) ) : ?> <span style="display:inline-block;font-weight:normal;font-size:18px;">(<?php echo $maiden; ?>)</span><?php endif ?></a>
						
				</div>
				<div class="item-desc">
					<?php bp_member_profile_data( 'field=Position at Primary Employer' );?> at <?php bp_member_profile_data( 'field=Primary Employer' );?> <br />Class of <?php bp_member_profile_data( 'field=Graduating Class' );?>
				</div>
				
				<?php if ( bp_get_member_latest_update() ) : ?>

						<span class="update"> <?php bp_member_latest_update(); ?></span>

					<?php endif; ?>

				<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>

				<?php do_action( 'bp_directory_members_item' ); ?>

				<?php
				 /***
				  * If you want to show specific profile fields here you can,
				  * but it'll add an extra query for each member in the loop
				  * (only one regardless of the number of fields you show):
				  *
				  * bp_member_profile_data( 'field=the field name' );
				  */
				?>
			</div>

			<div class="action">

				<?php do_action( 'bp_directory_members_actions' ); ?>

			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

			</div><!-- #members-dir-list -->

			<?php do_action( 'bp_directory_members_content' ); ?>

			<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

			<?php do_action( 'bp_after_directory_members_content' ); ?>

		</form><!-- #members-directory-form -->

		<?php do_action( 'bp_after_directory_members' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_members_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
<?php } else {?>
<p>erm?</p>
<?php } ?>
