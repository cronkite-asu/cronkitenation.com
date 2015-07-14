<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">
		<?php bp_displayed_user_avatar( 'type=full' ); ?>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h2>
		<a href="<?php bp_displayed_user_link(); ?>"><?php bp_profile_field_data( 'field=First Name' );?> <?php bp_profile_field_data( 'field=Last Name' );?> <?php if ( $maiden = bp_get_profile_field_data( 'field=Maiden Name' ) ) : ?><span style="font-weight:normal;!important">(<?php echo $maiden ?>)</span><?php endif ?></a>
	</h2>
	<h3><span style="color:#4F5557;"><?php bp_member_profile_data( 'field=Position at Primary Employer' ); ?> at <?php bp_member_profile_data( 'field=Primary Employer' ); ?> </span></h3>

	<?php do_action( 'bp_before_member_header_meta' ); ?>

	<div id="item-meta">

		<div id="item-buttons">
<?php global $bp; 
			$user = $bp->displayed_user->id;
			$usernfo = get_userdata($user);
			$email = $usernfo->user_email;
			if ($email !='cronkitenation@gmail.com') { do_action( 'bp_member_header_actions' ); } ?>

		</div><!-- #item-buttons -->
		<?php
		/***
		 * If you'd like to show specific profile fields here use:
		 * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
		 */
		 do_action( 'bp_profile_header_meta' );

		 ?>
	
	</div><!-- #item-meta -->

</div><!-- #item-header-content -->


<?php do_action( 'bp_after_member_header' ); ?> 

<?php do_action( 'template_notices' ); ?>
