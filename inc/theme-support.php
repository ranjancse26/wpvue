<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats, etc.
 */

if ( ! function_exists( 'base_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function base_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Add menu support
	add_theme_support( 'menus' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	// add_theme_support( 'html5', array(
	// 	'search-form',
	// 	'comment-form',
	// 	'comment-list',
	// 	'gallery',
	// 	'caption',
	// ) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	// add_theme_support( 'post-formats', array(
	// 	'aside',
	// 	'gallery',
	// 	'link',
	// 	'image',
	// 	'quote',
	// 	'status',
	// 	'video',
	// 	'audio',
	// 	'chat'
	// ) );

	// Set up the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( 'base_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '', // https://source.unsplash.com/category/nature/1600x900
	// ) ) );

}
endif;
add_action( 'after_setup_theme', 'base_setup' );

?>
