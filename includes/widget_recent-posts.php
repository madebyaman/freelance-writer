<?php

/**
 * Popular Posts Widget
 *
 * @package Showcase Pro
 * @author JT Grauke
 * @since 1.0.0
 * @link http://my.studiopress.com/themes/showcase/
 * @license GPL2-0+
 */

// Register and load the widget
function freelance_popular_posts_widget()
{
  register_widget('freelance_writer_posts_widget');
}
add_action('widgets_init', 'freelance_popular_posts_widget');

class freelance_writer_posts_widget extends WP_Widget
{
  function __construct()
  {

    // Widget Slug
    $widget_slug = 'showcase-team-widget';

    $widget_ops = array(
      'classname' => $widget_slug,
      'description' => 'Displays Most Recent in sidebar'
    );
    $control_ops = array(
      'id_base' => $widget_slug
    );
    parent::__construct($widget_slug, 'Most Popular Posts', $widget_ops, $control_ops);
  }

  // Creating widget front-end

  public function widget($args, $instance)
  {
    $title = $instance['title'];
    $tag = $instance['tag'];
    $url = $instance['url'];
    $image_url = $instance['image_url'];

    if ($title && $tag && $url && $image_url) {
      echo '<a class="card" href="' . $url . '" target="_blank"><img src="' . $image_url . '" /><div class="card-content"><h3 class="post-title">' . $title . '</h3><p class="tag">' . $tag . '</p></div></a>';
    }
  }
         
  // Widget Backend 
  public function form($instance)
  {
    // Merge with defaults
    if (isset($instance['title']) || isset($instance['url']) || isset($instance['image_url']) || isset($instance['tag'])) {
      $title = $instance['title'];
      $tag = $instance['tag'];
      $url = $instance['url'];
      $image_url = $instance['image_url'];
    }
    ?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image Source URL:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo esc_attr($image_url); ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('tag'); ?>"><?php _e('Tag:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" type="text" value="<?php echo esc_attr($tag); ?>" />
</p>
  <?php 
}
     
  // Updating widget replacing old instances with new
public function update($new_instance, $old_instance)
{
  $instance = $old_instance;
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['url'] = $new_instance['url'];
  $instance['image_url'] = $new_instance['image_url'];
  $instance['tag'] = $new_instance['tag'];

  return $instance;
}
}

?>