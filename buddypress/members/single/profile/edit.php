<!-- Character Limit Script -->
						<script language="javascript" type="text/javascript">
							function limitText(limitField, limitCount, limitNum) {
								if (limitField.value.length > limitNum) {
								limitField.value = limitField.value.substring(0, limitNum);
								} else {
								limitCount.value = limitNum - limitField.value.length;
								}
							}
							
						</script>
<?php do_action( 'bp_before_profile_edit_content' );

if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
<div class="page" id="register-page">
<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug(); ?>">

	<?php do_action( 'bp_before_profile_field_content' ); ?>

		<h3>Edit Alumni Profile</h3>
		<h5 style="float:right;"><span style="color:#990033;font-weight:bold;font-size:14px;">*</span> These fields are required.</h5><br />


		<div class="clear"></div>
		
		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
			
				
				
				<?php if ( 'First Name' == bp_get_the_profile_field_name() ){ ?>
				<h3>Name</h3>
				<table style="width:100%;border:0px;">
				<tr>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
				</div></td>	
				<?php } ?>
				
				<?php if ( 'Middle Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr><tr>
				<?php } ?>
				
				<?php if ( 'Last Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'Maiden Name' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
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
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" aria-required="true"/>
			</div></td><td>
						<p style="padding-top:15px;">at</p>
						</td>
				<?php } ?>
				<?php if ( 'Primary Employer' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr>
				<?php } ?>
				<?php if ( 'Position at Secondary Employer' == bp_get_the_profile_field_name() ){ ?>
				<tr><td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
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
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'City' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'U.S. State / Territory' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
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
			</div></td></tr></table>
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
			</div>
				<?php } ?>
				
				<?php if ( 'Degree' == bp_get_the_profile_field_name() ){ ?>
				<div class="editfield">
					<div class="checkbox">
						<span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></span>

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
								</div></td>
						</tr>
				<?php } ?>

				<?php if ( 'Beats (Comma-Separated)' == bp_get_the_profile_field_name()) { ?>
				<td style="width:50%;">
				<div class="editfield">
				<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<p class="description">Ex. Healthcare, Politics, Sports, Technology, etc.</p>
					<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" onKeyDown="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown2,60);" onKeyUp="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown2,60);" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
							<p class="description">You have <input readonly type="text" name="countdown2" value="60"  style="color:#ffb310;background:#4f5557;width:20px;height:18px;line-height:18px;"> characters left. (Maximum characters: 60)</p>
				<?php } ?>
				
				<?php if ( 'Skills (Comma-Separated)' == bp_get_the_profile_field_name() ) { ?>
				<td style="width:50%;">
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					
					<p class="description">Ex. Copy Editing, Graphic Design, Photography, Programming, Reporting, Video Editing, etc.</p>
					<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" onKeyDown="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown3,140);" onKeyUp="limitText(this.form.<?php bp_the_profile_field_input_name(); ?>,this.form.countdown3,140);" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
							<p class="description">You have <input readonly type="text" name="countdown3" value="140"  style="color:#ffb310;background:#4f5557;width:28px;height:18px;line-height:18px;"> characters left. (Maximum characters: 140)</p>
							</div>	</td></tr></table>
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
					<span style="display:inline;color:#990033;font-weight:800;">@ </span><input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
					<?php if ( 'LinkedIn URL' == bp_get_the_profile_field_name() ){ ?>
					<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
						</tr>
				<?php } ?>
				
					<?php if ( 'Personal Website URL' == bp_get_the_profile_field_name() ){ ?>
					<tr>
						<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
					<?php if ( 'Web Portfolio URL' == bp_get_the_profile_field_name() ){ ?>
					<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr>
				<?php } ?>
				
					<?php if ( 'Employer Website URL' == bp_get_the_profile_field_name() ){ ?>
					<tr><td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td>
				<?php } ?>
				
				<?php if ( 'RSS Feed' == bp_get_the_profile_field_name() ){ ?>
				<td>
				<div class="editfield">
					<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><span style="color:#990033;font-weight:bold;font-size:14px;">*</span><?php endif; ?></label>
					<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
			</div></td></tr></table>
				<?php } ?>
				
				



				<?php do_action( 'bp_custom_profile_edit_fields' ); ?>


		<?php endwhile; ?>

	<?php do_action( 'bp_after_profile_field_content' ); ?>

	<div class="submit">
		<input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php _e( 'Save Changes', 'buddypress' ); ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

</form></div>

<?php endwhile; endif; ?>

<?php do_action( 'bp_after_profile_edit_content' ); ?>
