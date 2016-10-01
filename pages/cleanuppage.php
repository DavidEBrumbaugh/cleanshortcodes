<h2>Shortcode Cleanup Page</h2>
<p>This plugin was written because removing visual composer leaves a lot of "orphaned" shortcodes in your content.</p>
<p>The purpose of this plugin is to go through all the posts in your WordPress Site and remove the unused shortcodes.</p>
<p>This is based on the (MUCH!!!) safer plugin: <em>Remove Orphan Shortcodes </em>
	<a href=" https://wordpress.org/plugins/remove-orphan-shortcodes/">https://wordpress.org/plugins/remove-orphan-shortcodes/</a></p>

<h3>Active Shortcodes</h3>
<pre>
	<?php
	global $shortcode_tags;
	global $num_posts_updated;

	//Check for active shortcodes
	$active_shortcodes = ( is_array( $shortcode_tags ) && ! empty( $shortcode_tags ) ) ? array_keys( $shortcode_tags ) : array();
	var_export( $active_shortcodes );

	?>

</pre>
<?php
$show_form = true;
if ( isset( $_POST['submit'] ) ) {
	if ( ! isset( $_POST['cleaup_short_codes_nonce'] )
	|| ! wp_verify_nonce( $_POST['cleaup_short_codes_nonce'], 'cleaup_short_codes' ) ) {

		print 'Sorry, your nonce did not verify.';
		exit;
	} else {
		if ( $_POST['backup'] != 'Yes' ) {
			echo "<h1>I'm not kidding about the database backup. Back it up. Now</h1>";
		}
		else {
			clean_all_shortcodes();
			echo "<h1> $num_posts_updated Posts Updated With Removed ShortCodes</h1>";
			echo '<p>Make sure everything still works</p>';
			echo "If it doesn't - well good thing you backed up your database.";
			$show_form = false;
		}
	}
}
if ( $show_form ) {
	?>
	<p>Push Button below to remove all shortcodes except the ones above.</p>
	<h1>BACK UP YOUR DATABASE FIRST - I'M SERIOUS</h1>
	<form method="post">
		<div style="padding: 5px;">
			<input type="checkbox" name="backup" value="Yes" /> I promise.	I backed up my databse. Cross My Heart.
		</div>
		<input type="submit" name="submit" value="Clean All Shortcodes" />
		<?php wp_nonce_field( 'cleaup_short_codes', 'cleaup_short_codes_nonce' ); ?>
	</form>
	<?php } ?>
