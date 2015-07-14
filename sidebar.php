<?php do_action( 'bp_before_sidebar' ); ?>

<div id="sidebar" role="complementary">
	<div class="padder">

	<?php do_action( 'bp_inside_before_sidebar' ); ?>
	<div id="sidebar-logo">
	<a href="http://cronkite.asu.edu" target="_blank"><img style="margin-left:-5px;" src="http://cronkitenation.com/wp-content/uploads/2012/10/WCSJ_B.png" /></a>
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

				<?php printf( __( 'Are you an alum looking to get listed? <a href="%s" title="Create an account">Create an account</a> to get started.', 'buddypress' ), bp_get_signup_page() ); ?>

			</p>

		<?php endif; ?>

				<style type="text/css">
		.loginmain { width:230px; height:200px; margin-left:-19px;margin-top:-20px;}
.loginbox { width:200px; overflow:hidden; padding:15px; background:#fff; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;}
.loginbox h2 { color:#292929; font-size:25px; margin:0; padding:0 0 10px 0; font-weight:bold; outline:none;}
.loginbox h3 { color:#7f7f7f; font-size:17px; line-height:20px; margin:0; padding:0; font-weight:normal; outline:none;}

.loginform { margin:0; padding:0;}
.loginform fieldset { border:none; padding: 10px 0 0; margin:0;}
.loginform .row { margin-bottom:6px; position:relative; line-height:33px;}

.loginform .row input[type="text"], .loginform .row input[type="password"] { height:33px; line-height:33px; border:1px solid #c5c5c5; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset; -moz-box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset; -webkit-box-shadow: 0 0 5px rgba(0,0,0,.1), 0 2px 2px rgba(0,0,0,.1) inset;}
.loginform .row input[type="text"]:focus, .loginform .row input[type="text"]:hover, .form .row input[type="password"]:focus, .form .row input[type="password"]:hover { border:1px solid #c5c5c5; box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset; -moz-box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset; -webkit-box-shadow: 0 0 5px rgba(0,0,0,.21), 0 2px 2px rgba(0,0,0,.1) inset;}
.loginform .row input.login { background:url(http://cronkitenation.com/wp-content/plugins/buddypress/bp-themes/bp-default/_inc/login/input_login.png) left center no-repeat #f5f5f5; width:152px; padding: 1px 5px 1px 45px;}
.loginform .row input.password { background:url(http://cronkitenation.com/wp-content/plugins/buddypress/bp-themes/bp-default/_inc/login/input_password.png) left center no-repeat #f5f5f5; width:152px; padding: 1px 5px 1px 45px; }
.loginform .row input.error { border:1px solid #eb9393; box-shadow: 0 0 5px #f7c4c4; -moz-box-shadow: 0 0 5px #f7c4c4; -webkit-box-shadow: 0 0 5px #f7c4c4; background-color:#fce4e4; }

.loginform .row a.forgot { position:absolute; top:2px; right:10px; color:#909090; font-size:12px; text-shadow:1px 1px 1px #fff;}
.loginform .row a.forgot:hover { color:#6e6e6e;}
.loginform .row input[type="checkbox"] { display:block; float:left; margin: 9px 6px 9px 2px; }
.loginform .row label { color:#7f7f7f; font-size:14px; display:block; float:left; }
.loginform .row input[type="submit"] { cursor:pointer; color:#fff; border:1px solid #bd2525; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; background:#990033; font-size:16px; padding:5px 20px; font-weight:bold; float:right;}
.loginform .row input[type="submit"]:hover { background:#ffb310; color:#990033; font-size:16px; padding:5px 20px; font-weight:bold; float:right;}
		</style>
		
		<div class="loginmain">
		<div class="loginbox">
			<form name="login-form" class="loginform" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
				<fieldset>
					<div class="row">
						<input type="text" name="log" class="login" name="login" placeholder="Email Address" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97"/>
						<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
						<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
					</div>
					<div class="row">
						<input name="pwd" type="password" class="password" name="password" class="input" value="" tabindex="98" placeholder="Password"/>
					
					</div>	
					<div class="row">
						<input type="checkbox" class="remember" name="rememberme" value="forever" id="remember"  />
						<label for="remember">Keep me signed in</label><br />
						<a style="font-size:11px;padding-top:-3px;" href="<?php echo site_url( add_query_arg( array( 'action' => 'lostpassword' ), 'wp-login.php' ), 'login' ); ?>">Reset Password</a>
						<?php do_action( 'bp_sidebar_login_form' ); ?>
						<input type="submit" name="wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100"/>
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
			<h3 class="widgettitle"><?php _e( 'Forum Topic Tags', 'buddypress' ); ?></h3>
			<div id="tag-text"><?php bp_forums_tag_heat_map(); ?></div>
		</div>
	<?php endif; ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php do_action( 'bp_inside_after_sidebar' ); ?>

	</div><!-- .padder -->
</div><!-- #sidebar -->

<?php do_action( 'bp_after_sidebar' ); ?>
