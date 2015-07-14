<h4><?php _e( 'Update Headshot', 'buddypress' ); ?></h4>

<?php do_action( 'bp_before_profile_avatar_upload_content' ); ?>

<?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

	<p><img src="<?php echo get_template_directory(); ?>/buddypress/members/single/profile/instructions.gif"></p>

	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">

		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
			<p>Headshots can be in <b>JPG, GIF or PNG</b> formats.</p>

			<p id="avatar-upload">
				<input type="file" name="file" id="file" />
				<input type="submit" name="upload" id="upload" value="<?php _e( 'Upload Image', 'buddypress' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

			<?php if ( bp_get_user_has_avatar() ) : ?>
				<br />
				<img src="<?php echo get_template_directory(); ?>/buddypress/members/single/profile/deleteheadshot.gif">
				<p>WARNING: This cannot be undone!</p>
				<p><a class="button edit" href="<?php bp_avatar_delete_link(); ?>" title="<?php _e( 'Delete Avatar', 'buddypress' ); ?>">Delete Current Headshot</a></p>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

			<h5><?php _e( 'Crop Your New Avatar', 'buddypress' ); ?></h5>

			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'buddypress' ); ?>" />
			
			<div id="avatar-crop-pane">
				
				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" style="border:1px #4f5557;" alt="<?php _e( 'Avatar preview', 'buddypress' ); ?>" />
			</div>
			<h6>Headshot Preview</h6>
			<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'buddypress' ); ?>" />

			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

		<?php endif; ?>

	</form>

<?php else : ?>

	<p><?php _e( 'Your avatar will be used on your profile and throughout the site. To change your avatar, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'buddypress' ); ?></p>

<?php endif; ?>

<?php do_action( 'bp_after_profile_avatar_upload_content' ); ?>
