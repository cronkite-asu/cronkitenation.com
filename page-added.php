<?php /* Template name: Recently Added Alumni */ ?>  

<?php if ( is_user_logged_in() && is_super_admin() ) { ?>
<?php get_header(); ?>
<div id="content">
		<div class="padder">
		
		<h2>Recently Added Alumni</h2>
		<?php // prepare arguments
$args  = array(

// order results by registration date
'orderby' => 'user_registered',
'order ' => 'desc',

);
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// Get the results
$authors = $wp_user_query->get_results();
// Check for results
if (!empty($authors))
{
    echo '<ul>';
    // loop trough each author
    foreach ($authors as $author)
    {
        // get all the user's data
        $author_info = get_userdata($author->ID);
        $username = $author_info->user_login;
        $bpfirstname = xprofile_get_field_data( "First name" ,$author->ID);
        $bplastname = xprofile_get_field_data( "Last name" ,$author->ID);
        $baseurl = get_site_url();
        $time = $author_info->user_registered;

        echo '<li>'.$bpfirstname.' '.$bplastname.' <a href="'.$baseurl.'/alumni/'.$username.'">'.$username.'</a>- '.$time.'</li>';

    }
    echo '</ul>';
} else {
    echo 'No alumni found.';
} ?>
		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_members_page' ); ?>

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
<?php } else {?>
<p>erm?</p>
<?php } ?>
