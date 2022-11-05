<?php
/*
Plugin Name: ChildIt Core
Plugin URI: https://smartdata.tonytemplates.com/childit/
Description: ChildIt Core theme functions and library files.
Version: 2.0
Author: SmartDataSoft
Author URI: http://smartdatasoft.com/
License: GPLv2 or later
Text Domain: childit-core
Domain Path: /languages/
 */

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function childit_core_load_textdomain() {
	load_plugin_textdomain( 'childit-core', false, dirname( __FILE__ ) . '/languages' );
}
add_action( 'plugins_loaded', 'childit_core_load_textdomain' );

function childit_core_admin_enqueue( $hook ) {
	if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'widgets.php' ) {
		return;
	}
	wp_enqueue_script( 'custom-js', plugin_dir_url( __FILE__ ) . '/js/admin.js' );
	if ( $hook == 'widgets.php' ) {
		wp_enqueue_media();
		wp_enqueue_script( 'childit-media-widget-js', plugin_dir_url( __FILE__ ) . '/widgets/js/media-gallery.js', array( 'jquery' ), '1.0', 1 );
	}
}

add_action( 'admin_enqueue_scripts', 'childit_core_admin_enqueue' );

function childit_en_scripts() {
	wp_enqueue_script( 'childit-fancybox', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.js', array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'childit_en_scripts' );

define( 'PLUGIN_DIR', dirname( __FILE__ ) . '/' );

if ( ! defined( 'CHILDIT_CORE_PLUGIN_URI' ) ) {
	define( 'CHILDIT_CORE_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
}

require_once plugin_dir_path( __FILE__ ) . 'childit-addons/childit-addons.php';
/*
 * Meta Box Configuration Post Meta Option
 */
require_once plugin_dir_path( __FILE__ ) . '/meta-box/post-meta.php';
require_once plugin_dir_path( __FILE__ ) . '/meta-box/page-meta.php';

register_activation_hook( __FILE__, 'childit_activation_func' );

require_once plugin_dir_path( __FILE__ ) . '/widgets/childit-sidebar-recent-post-widget.php';
require_once plugin_dir_path( __FILE__ ) . '/widgets/childit-footer-contact-widget.php';
require_once plugin_dir_path( __FILE__ ) . '/post-type/programs.php';
require_once plugin_dir_path( __FILE__ ) . '/post-type/testimonials.php';
require_once plugin_dir_path( __FILE__ ) . '/post-type/gallery.php';
require_once plugin_dir_path( __FILE__ ) . '/post-type/staffs.php';

use ChildIt\CPT\Gallery;
use ChildIt\CPT\Programs;
use ChildIt\CPT\Staffs;
use ChildIt\CPT\Testimonials;

Programs::register();
Testimonials::register();
Gallery::register();
Staffs::register();

function childit_activation_func() {
	file_put_contents( __DIR__ . '/my-loggg.txt', ob_get_contents() );
}

function childit_add_excerpt_support_for_cpt() {
	add_post_type_support( 'childit_services', 'excerpt' );
}

add_action( 'init', 'childit_add_excerpt_support_for_cpt' );

function childit_add_excerpt_support_for_projects_cpt() {
	add_post_type_support( 'childit_projects', 'excerpt' );
}
add_action( 'init', 'childit_add_excerpt_support_for_projects_cpt' );

if ( ! function_exists( 'childit_post_share' ) ) {
	function childit_post_share() {
		global $post;
		$post_slug = $post->post_name;
		?>
		<div class="float-right">
		<ul class="social-icon-colored">
			<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><span
				class="fab fa-facebook-f"></span></a></li>
			<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo $post_slug; ?>"><span
				class="fab fa-twitter"></span></a></li>
			<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><span
				class="fab fa-google-plus-g"></span></a></li>
		</ul>
		</div>
		<?php
	}
}
/**
 * Register the action with WordPress.
 */
add_action( 'childit_post_share', 'childit_post_share' );

add_action(
	'elementor/frontend/after_enqueue_scripts',
	function () {
		wp_dequeue_script( 'lightbox' );
	}
);
