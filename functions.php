<?php

/**
 * Genesis Starter Theme.
 *
 * @package      Freelance Writer
 * @link         https://seothemes.com/themes/freelance-writer
 * @author       Aman Thakur
 * @copyright    Copyright © 2018
 * @license      GPL-2.0+
 */

 // If this file is called directly, abort.
if (!defined('WPINC')) {

	die;

}

// Child theme (do not remove).
include_once(get_template_directory() . '/lib/init.php');

// Define theme constants.
define('CHILD_THEME_NAME', 'Freelance Writer');
define('CHILD_THEME_URL', 'https://amanthakur.me');
define('CHILD_THEME_VERSION', '1.0.0');

// Set Localization (do not remove).
load_child_theme_textdomain('freelance-writer', apply_filters('child_theme_textdomain', get_stylesheet_directory() . '/languages', 'freelance-writer'));

// Remove unused site layouts.
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');

// Enable support for page excerpts.
// add_post_type_support( 'page', 'excerpt' );

// Enable shortcodes in text widgets.
// add_filter( 'widget_text', 'do_shortcode' );

// Enable support for WooCommerce and WooCommerce features.
// add_theme_support( 'woocommerce' );
// add_theme_support( 'wc-product-gallery-zoom' );
// add_theme_support( 'wc-product-gallery-lightbox' );
// add_theme_support( 'wc-product-gallery-slider' );

// Enable support for structural wraps.
add_theme_support('genesis-structural-wraps', array(
	'header',
	'menu-primary',
	'menu-secondary',
	'footer-widgets',
	'footer',
));

// Enable support for Accessibility enhancements.
add_theme_support('genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
));

// Enable support for custom navigation menus.
add_theme_support('genesis-menus', array(
	'primary' => __('Header Menu', 'freelance-writer'),
	'social' => __('Footer Social Menu', 'freelance-writer'),
	'secondary' => __('Footer Menu', 'freelance-writer'),
));

// Enable support for viewport meta tag for mobile browsers.
add_theme_support('genesis-responsive-viewport');

// Enable support for Genesis footer widgets.
add_theme_support('genesis-footer-widgets', 1);

// Register call-to-action widget area.
genesis_register_sidebar(array(
	'id' => 'call-to-action',
	'name' => __('Call to Action', 'freelance-writer'),
	'description' => __('Add your call to action here', 'freelance-writer'),
));

//* Add the call-to-action widget area
add_action('genesis_before_footer', 'freelance_writer_before_footer', 5);
function freelance_writer_before_footer()
{
	if (is_active_sidebar('call-to-action')) {
		genesis_widget_area('call-to-action', array(
			'before' => '<div id="call-to-action" class="call-to-action"><div class="wrap" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000" data-aos-easing="ease-out-quad" data-aos-offset="50">',
			'after' => '</div></div>',
		));
	}
}



//* Remove the entry header markup (requires HTML5 theme support)
remove_action('genesis_entry_header', 'genesis_entry_header_markup_open', 5);
add_action('genesis_entry_header', 'freelance_writer_entry_header_markup_open', 5);

function freelance_writer_entry_header_markup_open()
{
	printf('<header %s data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-out-quad">', genesis_attr('entry-header'));
}

add_action('the_content', 'ravs_content_div');
function ravs_content_div($content)
{
	return '<main class="entry-content" data-aos="fade-up" data-aos-duration="500" data-aos-easing="ease-out-quad">' . $content . '</main>';
}



// Enable support for Gutenberge wide images.
add_theme_support('gutenberg', array(
	'wide-images' => true,
));

// Enable support for default posts and comments RSS feed links.
add_theme_support('automatic-feed-links');

// Enable support for HTML5 markup structure.
add_theme_support('html5', array(
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
));

// Enable support for post thumbnails.
add_theme_support('post-thumbnails');

// Enable support for selective refresh and Customizer edit icons.
add_theme_support('customize-selective-refresh-widgets');

// Enable support for custom background image.
add_theme_support('custom-background', array(
	'default-color' => 'ffffff',
));

// Enable support for logo option in Customizer > Site Identity.
add_theme_support('custom-logo', array(
	'height' => 60,
	'width' => 240,
	'flex-height' => true,
	'flex-width' => true,
	'header-text' => array('.site-title', '.site-description'),
));

// Display custom logo in site title area.
add_action('genesis_site_title', 'the_custom_logo', 0);

// // Reposition primary navigation menu.
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_after_title_area', 'genesis_do_nav');

// Reposition footer widgets inside site footer.
remove_action('genesis_before_footer', 'genesis_footer_widget_areas');
add_action('genesis_before_footer_wrap', 'genesis_footer_widget_areas', 5);

// Modify the Genesis content limit read more link
add_filter('get_the_content_more_link', 'freelance_writer_read_more_link');
function freelance_writer_read_more_link()
{
	return '<a class="more-link" href="' . get_permalink() . '">Continue Reading</a>';
}

// Remove entry meta in entry header
remove_action('genesis_entry_header', 'genesis_post_info', 12);

// Customize the entry meta in the entry footer 
add_filter('genesis_post_meta', 'freelance_writer_post_meta');
function freelance_writer_post_meta($post_meta)
{
	$post_meta = '[post_categories before=""] [post_tags before=""]';
	return $post_meta;
}


add_action('wp_enqueue_scripts', 'freelance_writer_scripts_styles', 99);

/**
 * Enqueue theme scripts and styles.
 *
 * @return void
 */
function freelance_writer_scripts_styles()
{

	// Remove Simple Social Icons CSS (included with theme).
	// wp_dequeue_style('simple-social-icons-font');

	$folder = 'min';
	$suffix = 'min';

	// Google fonts.
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Muli:300,400,400i,700,800|Nunito+Sans:400,700,800', array(), CHILD_THEME_VERSION);

	// AOS Styles
	wp_enqueue_style('aos-styles', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css', [], CHILD_THEME_VERSION);

	// AOS Scripts

	wp_enqueue_script('aos-script', 'https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js', array(), CHILD_THEME_VERSION, true);

	// Ion Icons
	wp_enqueue_style('ion-icons', 'https://unpkg.com/ionicons@4.0.0/dist/css/ionicons.min.css', array(), CHILD_THEME_VERSION);

	// Enqueue responsive menu script.
	// wp_enqueue_script('freelance-writer-menu', get_stylesheet_directory_uri() . '/assets/scripts/' . $folder . '/scripts.' . $suffix . '.js', array('jquery'), CHILD_THEME_VERSION, true);

	// Custom script
	wp_enqueue_script('freelance-writer-js', get_stylesheet_directory_uri() . '/assets/scripts/app.js', array(), CHILD_THEME_VERSION, true);


	// wp_localize_script(
	// 	'freelance-writer-menu',
	// 	'genesis_responsive_menu',
	// 	freelance_writer_menu_settings()
	// );
}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
// function freelance_writer_menu_settings()
// {
// 	$settings = array(
// 		'mainMenu' => __('Menu', 'freelance-writer'),
// 		'menuIconClass' => 'icon ion-ios-menu',
// 		'subMenu' => __('Submenu', 'freelance-writer'),
// 		'subMenuIconClass' => 'icon ion-ios-arrow-dropdown-circle',
// 		'menuClasses' => array(
// 			'combine' => array(
// 				'.nav-primary',
// 			),
// 			'others' => array(),
// 		),
// 	);
// 	return $settings;
// }

// Load footer widgets

if (is_active_sidebar('footer-1')) {
	echo '<p>This is active</p>';
};

// Load helper functions.
include_once(get_stylesheet_directory() . '/includes/helpers.php');

// Load miscellaneous functions.
include_once(get_stylesheet_directory() . '/includes/extras.php');

// Load widget areas.
include_once(get_stylesheet_directory() . '/includes/widgets.php');

// Load page header.
include_once(get_stylesheet_directory() . '/includes/header.php');

// Load Customizer settings.
include_once(get_stylesheet_directory() . '/includes/customize.php');

// Load default settings.
include_once(get_stylesheet_directory() . '/includes/defaults.php');

// Load recommended plugins.
include_once(get_stylesheet_directory() . '/includes/plugins.php');

//* Testimonials
include_once(get_stylesheet_directory() . '/includes/testimonials.php');
include_once(get_stylesheet_directory() . '/includes/testimonials-widget.php');

include_once(get_stylesheet_directory() . '/includes/widget_recent-posts.php');

