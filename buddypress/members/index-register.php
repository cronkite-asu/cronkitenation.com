<?php get_header(); ?>
<?php $url = home_url(); ?>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("form#signup_form").submit(function(e){
			var full_name = jQuery('input#field_1').val().toLowerCase() + jQuery('input#field_1201').val().toLowerCase();
			full_name = full_name.replace(/[^a-zA-Z 0-9]+/g,'');
			jQuery('input#signup_username').val(full_name);
			return true;
		});
	});
</script>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_register_page' ); ?>

		<div class="page" id="register-page">
			
			<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">

			<?php if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>
				<?php do_action( 'template_notices' ); ?>
				<?php do_action( 'bp_before_registration_disabled' ); ?>

					<p>User registration for Cronkite Nation is currently disabled. Please check back later or contact Elizabeth Smith at elizabeth.grace.smith@asu.edu.</p>

				<?php do_action( 'bp_after_registration_disabled' ); ?>
			<?php endif; // registration-disabled signup setp ?>

			<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>

				<h2>Create a Cronkite Nation Alumni Account </h2>
				
				<h4>But wait, are you <a href="<?php echo esc_url( $url ); ?>/alumni">already registered</a>? If so, <a href="<?php echo esc_url( $url ); ?>/claim">claim</a> your existing account.</h4>
			
				
				<h5 style="float:right;"><span style="color:#990033;font-weight:bold;font-size:14px;">*</span> These fields are required.</h5><br />


				<?php do_action( 'template_notices' ); ?>

				<?php do_action( 'bp_before_account_details_fields' ); ?>

				<div class="register-section" id="basic-details-section">

					<?php /***** Basic Account Details ******/ ?>

					<h4><?php _e( 'Account Details', 'buddypress' ); ?></h4>

					<?php do_action( 'bp_signup_username_errors' ); ?>
					<input type="hidden" name="signup_username" id="signup_username" value="" />

					<label for="signup_email"><?php _e( 'Email Address', 'buddypress' ); ?> <span style="color:#990033;font-weight:bold;font-size:14px;">*</span></label>
					<?php do_action( 'bp_signup_email_errors' ); ?>
					<input type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" />

					<label for="signup_password"><?php _e( 'Choose a Password', 'buddypress' ); ?> <span style="color:#990033;font-weight:bold;font-size:14px;">*</span></label>
					<?php do_action( 'bp_signup_password_errors' ); ?>
					<input type="password" name="signup_password" id="signup_password" value="" />

					<label for="signup_password_confirm"><?php _e( 'Confirm Password', 'buddypress' ); ?> <span style="color:#990033;font-weight:bold;font-size:14px;">*</span></label>
					<?php do_action( 'bp_signup_password_confirm_errors' ); ?>
					<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" />

				</div><!-- #basic-details-section -->

				<?php do_action( 'bp_after_account_details_fields' ); ?>

				<?php /***** Extra Profile Details ******/ ?>

				<?php if ( bp_is_active( 'xprofile' ) ) : ?>

					<?php do_action( 'bp_before_signup_profile_fields' ); ?>

					<div class="register-section" id="profile-details-section">


						<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
						<?php if ( bp_is_active( 'xprofile' ) ) : if ( bp_has_profile( 'profile_group_id=1' ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

								<?php if ( 'First Name' == bp_get_the_profile_field_name() ){ ?>
				<h3>Name</h3>
				<table style="width:100%;border:0px;">
				<tr>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text"  name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
				</div></td>	
				<?php } ?>
				
				<?php if ( 'Middle Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr><tr>
				<?php } ?>
				
				<?php if ( 'Last Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'Maiden Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>		</tr>
							</table>
				<?php } ?>
				
				<?php if ( 'Position at Primary Employer' == bp_get_the_profile_field_name() ){ ?>
				<h3>Employment</h3>
							<h5>Tell us where you're working</h5>
							<ul style="list-style-type: square;">
							<li>Your Primary Employment information is displayed on the Alumni Map and in the Alumni Directory.</li>
							<li>Secondary Employment information will only show on your profile.</li>
							<li>When listing your employer, please use the name they use in the public domain (i.e. FOX Sports Arizona instead of FoxSportsArizona).</li>
							</ul>

						<table style="width:100%;border:0px;">
						<tr style="width:100%;">
						<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td><td>
						<p style="padding-top:15px;">at</p>
						</td>
				<?php } ?>
				<?php if ( 'Primary Employer' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr>
				<?php } ?>
				<?php if ( 'Position at Secondary Employer' == bp_get_the_profile_field_name() ){ ?>
				<tr><td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
						<td>
						<p style="padding-top:15px;">at</p>
						</td>
				<?php } ?>
				
				<?php if ( 'Secondary Employer' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr></table>
				<?php } ?>
				
				<?php if ( 'Employer ZIP Code' == bp_get_the_profile_field_name() ){ ?>
				<h3>Location</h3>
						<h5>Let us put you on the map</h5>
							<ul style="list-style-type: square;">
							<li style="font-weight:bold;">Your Employer ZIP Code will NEVER be public.</li>
							<li>If you are <span style="font-weight:bold;">outside the United States</span> please select Outside U.S. in the State drop-down.</li>
							</ul>
						
						<table style="width:100%;border:0px;">
						<tr>
						<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'City' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'U.S. State / Territory' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
						<?php bp_the_profile_field_options(); ?>
					</select>
			</div></td>
				<?php } ?>
				
				<?php if ( 'Country' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					
					<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
						<?php bp_the_profile_field_options(); ?>
					</select>
			</div><?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?></td></tr></table>
				<?php } ?>
				
				<?php if ( 'Graduating Class' == bp_get_the_profile_field_name() ){ ?>
				<h3>Cronkite Degree Information</h3>
						<ul style="list-style-type: square;">
							<li>If you have received multiple degrees from The Walter Cronkite School of Journalism and Mass Communication, select multiple years of graduation (CTRL+Click on Windows, command+Click on Mac).</li>
							</ul>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					
					<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" style="width:35%;height:85px;font-size:1.5em;text-align:center;padding:4px;" multiple="multiple" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>

						<?php bp_the_profile_field_options(); ?>

					</select>

					<?php if ( !bp_get_the_profile_field_is_required() ) { ?>

						<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name(); ?>' );"><?php _e( 'Clear', 'buddypress' ); ?></a>

					<?php } ?>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
			</div>
				<?php } ?>
				
				<?php if ( 'Degree' == bp_get_the_profile_field_name() ){ ?>
				<div class="editfield">
					<div class="checkbox">
						<span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></span>
<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
						<?php bp_the_profile_field_options(); ?>
					</div>
					
			</div>
				<?php } ?>
				
				<?php if (  'Industry (Comma-Separated)' == bp_get_the_profile_field_name()) { ?>
				<br />
						<h3>Your Work</h3>
						<table style="width:100%;border:0px;">
						<tr>
							<td>
				<div class="editfield">					
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
				
					<p class="description">Ex. Government, Nonprofit, Public Relations, Real Estate, etc.</p>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" onKeyDown="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown1,40);" onKeyUp="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown1,40);" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
					<p class="description">You have <input readonly type="text" name="countdown1" value="40"  style="color:#ffb310;background:#4f5557;width:20px;height:18px;line-height:18px;"> characters left. (Maximum characters: 40)</p>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>			</div></td>
						</tr>
				<?php } ?>
				
				<script type="text/javascript">
				function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
				</script>

				<?php if ( 'Beats (Comma-Separated)' == bp_get_the_profile_field_name()) { ?>
				<td style="width:50%;">
				<div class="editfield">
				<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<p class="description">Ex. Healthcare, Politics, Sports, Technology, etc.</p>
					<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" onKeyDown="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown2,60);" onKeyUp="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown2,60);" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
					<p class="description">You have <input readonly type="text" name="countdown2" value="60"  style="color:#ffb310;background:#4f5557;width:20px;height:18px;line-height:18px;"> characters left. (Maximum characters: 60)</p>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>		</div></td>
				<?php } ?>
				
				<?php if ( 'Skills (Comma-Separated)' == bp_get_the_profile_field_name() ) { ?>
				<td style="width:50%;">
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<p class="description">Ex. Copy Editing, Graphic Design, Photography, Programming, Reporting, Video Editing, etc.</p>
					<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" onKeyDown="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown3,140);" onKeyUp="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown3,140);" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
					<p class="description">You have <input readonly type="text" name="countdown3" value="140"  style="color:#ffb310;background:#4f5557;width:28px;height:18px;line-height:18px;"> characters left. (Maximum characters: 140)</p>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>		</div>	</td></tr></table>
				<?php } ?>
				
				
					<?php if ( 'Twitter Username' == bp_get_the_profile_field_name() ){ ?>
					<h3>Social Media & Web Presence</h3>
						<ul style="list-style-type: square;">
							<li>If you provide your Twitter Username, a follow button and the number of users following you will be displayed.</li>
							<li>If you provide an RSS Feed of your content, we will display the 5 latest headlines from your feed on your profile. Please provide feeds containing your own, original work.</li></ul>
					<table style="width:100%;border:0px;">
						<tr>
						<td style="width:32%;">
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<span style="display:inline;color:#990033;font-weight:800;">@ </span><input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
					<?php if ( 'LinkedIn URL' == bp_get_the_profile_field_name() ){ ?>
					<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
						</tr>
				<?php } ?>
				
					<?php if ( 'Personal Website URL' == bp_get_the_profile_field_name() ){ ?>
					<tr>
						<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
					<?php if ( 'Web Portfolio URL' == bp_get_the_profile_field_name() ){ ?>
					<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr>
				<?php } ?>
				
					<?php if ( 'Employer Website URL' == bp_get_the_profile_field_name() ){ ?>
					<tr><td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'RSS Feed' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ); ?>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr></table>
				<?php } ?>
						<?php endwhile; ?>

						<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

						<?php endwhile; endif; endif; ?>

					</div><!-- #profile-details-section -->

					<?php do_action( 'bp_after_signup_profile_fields' ); ?>

				<?php endif; ?>

				

				<?php do_action( 'bp_before_registration_submit_buttons' ); ?>

				<div class="submit">
					<input type="submit" name="signup_submit" id="signup_submit" value="Complete Registration" />
				</div>

				<?php do_action( 'bp_after_registration_submit_buttons' ); ?>

				<?php wp_nonce_field( 'bp_new_signup' ); ?>

			<?php endif; // request-details signup step ?>

			<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

				<h2><?php _e( 'Sign Up Complete!', 'buddypress' ); ?></h2>

				<?php do_action( 'template_notices' ); ?>
				<?php do_action( 'bp_before_registration_confirmed' ); ?>

					<h3>Welcome!</h3>
					<p>We've created your account. You can now login using the email and password you signed-up with.<br /> NOTE: it may take up to 20 minutes for you to display on the Alumni Map.</p>
					
					<h6>Be sure to <a href="<?php echo esc_url( $url ); ?>/faqs/how-can-i-upload-a-headshot">upload your headshot</a> after you login</h6>

				<?php do_action( 'bp_after_registration_confirmed' ); ?>

			<?php endif; // completed-confirmation signup step ?>

			<?php do_action( 'bp_custom_signup_steps' ); ?>

			</form>

		</div>

		<?php do_action( 'bp_after_register_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar(); ?>

	<script type="text/javascript">
		jQuery(document).ready( function() {
			if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
				jQuery('div#blog-details').toggle();

			jQuery( 'input#signup_with_blog' ).click( function() {
				jQuery('div#blog-details').fadeOut().toggle();
			});
		});
	</script>

<?php get_footer(); ?>