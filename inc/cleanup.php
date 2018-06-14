<?php
/**
 * Clean up WordPress defaults
 */

if ( ! function_exists( 'base_start_cleanup' ) ) :
function base_start_cleanup() {
	// Launching operation cleanup.
	add_action( 'init', 'base_cleanup_head' );
	// Better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
	// Remove WP version from RSS.
	add_filter( 'the_generator', 'base_remove_rss_version' );
	// Remove pesky injected css for recent comments widget.
	add_filter( 'wp_head', 'base_remove_wp_widget_recent_comments_style', 1 );
	// Clean up comment styles in the head.
	add_action( 'wp_head', 'base_remove_recent_comments_style', 1 );
	// Clean up gallery output in wp.
	add_filter( 'base_gallery_style', 'base_gallery_style' );
  // Change JPEG Compression
  add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );
}
add_action( 'after_setup_theme','base_start_cleanup' );
endif;

/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'base_cleanup_head' ) ) :
function base_cleanup_head() {
	// EditURI link.
	remove_action( 'wp_head', 'rsd_link' );
	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );
	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );
	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// Canonical.
	remove_action( 'wp_head', 'rel_canonical', 10, 0 );
	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version.
	remove_action( 'wp_head', 'wp_generator' );
	// Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	// Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
endif;

// A better title
// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} // end better title

// Remove WP version from RSS.
if ( ! function_exists( 'base_remove_rss_version' ) ) :
function base_remove_rss_version() { return ''; }
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'base_remove_wp_widget_recent_comments_style' ) ) :
function base_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'base_remove_recent_comments_style' ) ) :
function base_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;

// Remove injected CSS from gallery.
if ( ! function_exists( 'base_gallery_style' ) ) :
function base_gallery_style( $css ) {
	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}
endif;

// remove WP version from scripts
if ( ! function_exists( 'base_remove_wp_ver_css_js' ) ) :
function base_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}
endif;

// Removes the Update Notification Bar
function wphidenag() {
  remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wphidenag');

?>