<?php

/**
 * This file contains widget areas for the Genesis Starter Theme.
 *
 * @package   GenesisStarter
 * @link      https://seothemes.com/themes/freelance-writer
 * @author    SEO Themes
 * @copyright Copyright © 2017 SEO Themes
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {

	die;

}

// Register Front Page 1 widget area.
genesis_register_sidebar(array(
	'id' => 'front-page-1',
	'name' => __('Front Page 1', 'freelance-writer'),
	'description' => __('Front page 1 widget area.', 'freelance-writer'),
	'before_title' => '<h1 itemprop="headline">',
	'after_title' => '</h1>',
));

// Register Front Page 2 widget area.
genesis_register_sidebar(array(
	'id' => 'front-page-2',
	'name' => __('Front Page 2', 'freelance-writer'),
	'description' => __('Front page 2 widget area.', 'freelance-writer'),
));

// Register Front Page 3 widget area.
genesis_register_sidebar(array(
	'id' => 'front-page-3',
	'name' => __('Front Page 3', 'freelance-writer'),
	'description' => __('Front page 3 widget area.', 'freelance-writer'),
));

// Register Front Page 4 widget area.
genesis_register_sidebar(array(
	'id' => 'front-page-4',
	'name' => __('Front Page 4', 'freelance-writer'),
	'description' => __('Front page 4 widget area.', 'freelance-writer'),
));


