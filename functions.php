<?php
/**
 * calder.io theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/** 
 * Remove WP-Emoji
 */
require_once __DIR__ . '/site/remove-wp-emoji.php';

/** 
 * Disable Comments
 * Make sure to set allow_comments to true when setting context below
 */
require_once __DIR__ . '/site/disable-comments.php';


/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

class StarterSite extends Timber\Site {
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	public function register_post_types() {

	}
	public function register_taxonomies() {

	}
	public function add_to_context( $context ) {
		$context['allow_comments'] = false;  //set to true to allow comment form to appear on site.
		$context['menu'] = new Timber\Menu();
		$context['site'] = $this;
		return $context;
	}

	public function theme_supports() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);
		add_theme_support( 'menus' );
	}


}

new StarterSite();
