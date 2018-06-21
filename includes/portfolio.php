<?php

/**
 * portfolios Custom Post Type
 *
 * @package freelance_writer Pro
 * @author  JT Grauke
 * @link    http://my.studiopress.com/themes/freelance_writer/
 * @license GPL2-0+
 */

/**
 * Register a portfolios post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
add_action('init', 'freelance_writer_portfolios_init');
function freelance_writer_portfolios_init()
{

    //* Create the labels (output) for the portfolios
  $labels = array(
    'name' => _x('portfolios', 'post type general name', 'freelance_writer'),
    'singular_name' => _x('portfolio', 'post type singular name', 'freelance_writer'),
    'menu_name' => _x('portfolios', 'admin menu', 'freelance_writer'),
    'name_admin_bar' => _x('portfolio', 'add new on admin bar', 'freelance_writer'),
    'add_new' => _x('Add New', 'portfolio', 'freelance_writer'),
    'add_new_item' => __('Add New portfolio', 'freelance_writer'),
    'new_item' => __('New portfolio', 'freelance_writer'),
    'edit_item' => __('Edit portfolio', 'freelance_writer'),
    'view_item' => __('View portfolio', 'freelance_writer'),
    'all_items' => __('All portfolios', 'freelance_writer'),
    'search_items' => __('Search portfolios', 'freelance_writer'),
    'parent_item_colon' => __(' ', 'freelance_writer'),
    'not_found' => __('No portfolios found.', 'freelance_writer'),
    'not_found_in_trash' => __('No portfolios found in Trash.', 'freelance_writer')
  );

  $args = array(
    'labels' => $labels,
    'description' => __('portfolios', 'freelance_writer'),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'portfolios'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'menu_icon' => 'dashicons-portfolio',
    'taxonomies' => array('category'),
    'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'genesis-cpt-archives-settings')
  );

    //* Register the post type
  register_post_type('portfolios', $args);
}



/**
 * portfolio update messages
 *
 * See /wp-admin/edit-form-advanced.php
 *
 * @param array $messages Existing post update messages.
 *
 * @return array Amended post update messages with new CPT update messages.
 */
add_filter('post_updated_messages', 'freelance_writer_portfolio_updated_messages');
function freelance_writer_portfolio_updated_messages($messages)
{

  $post = get_post();
  $post_type = get_post_type($post);
  $post_type_object = get_post_type_object($post_type);

  $messages['portfolios'] = array(
    0 => '', // Unused. Messages start at index 1
    1 => __('portfolio updated.', 'freelance_writer'),
    2 => __('Custom field updated.', 'freelance_writer'),
    3 => __('Custom field deleted.', 'freelance_writer'),
    4 => __('portfolio updated.', 'freelance_writer'),
        /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf(__('portfolio restored to revision from %s', 'freelance_writer'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
    6 => __('portfolio published.', 'freelance_writer'),
    7 => __('portfolio saved.', 'freelance_writer'),
    8 => __('portfolio submitted.', 'freelance_writer'),
    9 => sprintf(
      __('portfolio scheduled for: <strong>%1$s</strong>.', 'freelance_writer'),
            // translators: Publish box date format, see http://php.net/date
      date_i18n(__('M j, Y @ G:i', 'freelance_writer'), strtotime($post->post_date))
    ),
    10 => __('portfolio draft updated.', 'freelance_writer')

  );

  if ($post_type_object->publicly_queryable) {
    $permalink = get_permalink($post->ID);

    $view_link = sprintf(' <a href="%s">%s</a>', esc_url($permalink), __('View portfolio', 'freelance_writer'));

    $messages[$post_type][1] .= $view_link;
    $messages[$post_type][6] .= $view_link;
    $messages[$post_type][9] .= $view_link;

    $preview_permalink = add_query_arg('preview', 'true', $permalink);
    $preview_link = sprintf(' <a target="_blank" href="%s">%s</a>', esc_url($preview_permalink), __('Preview portfolio', 'freelance_writer'));
    $messages[$post_type][8] .= $preview_link;
    $messages[$post_type][10] .= $preview_link;
  }

  return $messages;
}