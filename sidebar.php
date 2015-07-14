<?php do_action( 'bp_before_sidebar' ); ?>
<?php $url = home_url(); ?>
<div id="sidebar" role="complementary">
	<div class="padder">

	<?php do_action( 'bp_inside_before_sidebar' ); ?>
	<div id="sidebar-logo">
	<a href="http://cronkite.asu.edu" target="_blank"><img style="margin-left:-5px;" src="<?php echo esc_url( $url ); ?>/wp-content/uploads/2012/10/WCSJ_B.png" /></a>
	</div>
	<?php if ( is_user_logged_in() ) : ?>
		<h3 class="widgettitle">Welcome <?php echo bp_loggedin_user_fullname() ?></h3>
		<?php do_action( 'bp_before_sidebar_me' ); ?>

		<div id="sidebar-me">
			<a href="<?php echo bp_loggedin_user_domain(); ?>">
				<?php bp_loggedin_user_avatar( 'type=thumb&width=60&height=60' ); ?>
			</a>

			<h4><a href="<?php echo bp_loggedin_user_domain() ?>profile/">Your Profile</a></h4>
			<a class="button logout" href="<?php echo wp_logout_url( wp_guess_url() ); ?>">Logout</a>

			<?php do_action( 'bp_sidebar_me' ); ?>
		</div>

		<?php do_action( 'bp_after_sidebar_me' ); ?>

		<?php if ( bp_is_active( 'messages' ) ) : ?>
			<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
		<?php endif; ?>

	<?php else : ?>
	<h3 class="widgettitle">Alumni Login</h3>
		<?php do_action( 'bp_before_sidebar_login_form' ); ?>

		<?php if ( bp_get_signup_allowed() ) : ?>
		
			<p id="login-text">

				<?php printf( __( 'Are you an alum looking to get listed? <a href="%s" title="Create an account">Create an account</a> to get started.', 'cronkitenation' ), bp_get_signup_page() ); ?>

			</p>

		<?php endif; ?>
		
	<div class="loginmain">
		<div class="loginbox">
			<form name="login-form" class="loginform" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
				<fieldset>
					<div class="row">
						<i class="fa fa-user fa-2x fa-fw"></i><input type="text" name="log" class="login" name="login" placeholder="Email Address" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97"/>
						<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
						<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
					</div>
					<div class="row">
						<i class="fa fa-key fa-2x fa-fw"></i><input name="pwd" type="password" class="password" name="password" class="input" value="" tabindex="98" placeholder="Password"/>
					</div>	
					<div class="row">
						<input type="checkbox" class="remember" name="rememberme" value="forever" id="remember"  />
						<label for="remember">Keep me signed in</label><br />
						<a style="font-size:11px;padding-top:-3px;" href="<?php echo site_url( add_query_arg( array( 'action' => 'lostpassword' ), 'wp-login.php' ), 'login' ); ?>">Reset Password</a>
						<?php do_action( 'bp_sidebar_login_form' ); ?>
						<input type="submit" name="wp-submit" value="<?php _e( 'Log In', 'cronkitenation' ); ?>" tabindex="100"/>
						<input type="hidden" name="testcookie" value="1" />
					</div>
				</fieldset>
			</form>		
		</div>
	</div>

		<?php do_action( 'bp_after_sidebar_login_form' ); ?>

	<?php endif; ?>

	<?php /* Show forum tags on the forums directory */
	if ( bp_is_active( 'forums' ) && bp_is_forums_component() && bp_is_directory() ) : ?>
		<div id="forum-directory-tags" class="widget tags">
			<h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'cronkitenation' ); ?></h3>
			<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
		</div>
	<?php endif; ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php do_action( 'bp_inside_after_sidebar' ); ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ); ?>
