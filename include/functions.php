<?php

$num_posts_updated = 0;
// Credit: https://wordpress.org/plugins/remove-orphan-shortcodes/
if ( ! function_exists( 'clean_shortcodes' ) ) {


	/* Main function which finds and hides unused shortcodes */
	function clean_shortcodes( $content ) {

		if ( false === strpos( $content, '[' ) ) {
			return $content;
		}

		global $num_posts_updated;
		global $shortcode_tags;

		//Check for active shortcodes
		$active_shortcodes = ( is_array( $shortcode_tags ) && ! empty( $shortcode_tags ) ) ? array_keys( $shortcode_tags ) : array();

		//Avoid "/" chars in content breaks preg_replace
		$hack1 = md5( microtime() );
		$content = str_replace( '[/', $hack1, $content );
		$hack2 = md5( microtime() + 1 );
		$content = str_replace( '/', $hack2, $content );
		$content = str_replace( $hack1, '[/', $content );

		if ( ! empty( $active_shortcodes ) ) {
			//Be sure to keep active shortcodes
			$keep_active = implode( '|', $active_shortcodes );
			$content = preg_replace( "~(?:\[/?)(?!(?:$keep_active))[^/\]]+/?\]~s", '', $content );
		} else {
			//Strip all shortcodes
			$content = preg_replace( '~(?:\[/?)[^/\]]+/?\]~s', '', $content );
		}

		//Set "/" back to its place
		$content = str_replace( $hack2,'/',$content );

		$num_posts_updated++;

		return $content;
	}
}

if ( ! function_exists( 'cleanup_shortcodes_page' ) ) {
	function cleanup_shortcodes_page() {
		include( CLEAN_SHORTCODE_DIR . 'pages/cleanuppage.php' );
	}
}

if ( ! function_exists( 'clean_all_shortcodes' ) ) {
	function clean_all_shortcodes() {
		$the_query = new WP_Query( array( 'post_type' => 'any' ) );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$id = get_the_ID();
				$post = get_post( $id );
				$post->post_content = clean_shortcodes( $post->post_content );
				$post->post_excerpt = clean_shortcodes( $post->post_excerpt );
				$post_id = wp_update_post( $post, true );
				if ( is_wp_error( $post_id ) ) {
					$errors = $post_id->get_error_messages();
					foreach ( $errors as $error ) {
						echo $error . '<br/>';
					}
				}
			}
		}
	}
}
