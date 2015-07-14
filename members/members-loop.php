<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php /* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter() */ ?>

<?php do_action( 'bp_before_members_loop' ) ?>
<?php if ( bp_has_members(bp_ajax_querystring( 'members').'&type=alphabetical') ) : ?>


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
	
<?php $search_query = get_search_query(); if ($search_query != ("")) { ?><h5><span style="color:#990033;font-weight:bold;">Displaying results for: <span style="color:#ffb310;"><?php echo $search_query; ?></span></span> <?php } ?> 
	<?php while ( bp_members() ) : bp_the_member(); ?>

		<li>
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar('type=full&width=70&height=70'); ?></a>
			</div>

			<div class="item">
				<div class="item-title">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_profile_data( 'field=First Name' );?> <?php bp_member_profile_data( 'field=Last Name' );?> <?php if ( $maiden = bp_get_member_profile_data( 'field=Maiden Name' ) ) : ?> <span style="display:inline-block;font-weight:normal;font-size:18px;">(<?php echo $maiden; ?>)</span><?php endif ?></a>
						
				</div>
				<div class="item-desc">
					<?php bp_member_profile_data( 'field=Position at Primary Employer' );?> at <?php bp_member_profile_data( 'field=Primary Employer' );?> <br /><?php bp_member_profile_data( 'field=City' );?><?php $state = bp_get_member_profile_data( "field=U.S. State / Territory" ); if ( $state == "Washington D.C." ) {} elseif ($state =="Outside U.S.") {} else { ?>, <?php echo $state ?><?php } ?><?php $country = bp_get_member_profile_data( "field=Country" ); if ($country == "United States") { } else { ?>, <?php echo $country; ?> <?php } ?> | Class of <?php bp_member_profile_data( 'field=Graduating Class' );?>
				</div>
				
				<?php do_action( 'bp_directory_members_item' ); ?>
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
		<p><?php _e( "Sorry, no alumni were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>
