<?php
/*
Plugin Name: Automatic Google Maps Widget
Plugin URI: http://smartfan.pl/
Description: Widget that shows Google Maps markers.
Author: Piotr Pesta
Version: 0.5
Author URI: http://smartfan.pl/
License: GPL12
*/

include 'functions.php';

$options = get_option('automatic_google_maps');

add_shortcode("automatic-google-maps", "automatic_gogle_maps_shortcode_handler"); // shortcode hook

class automatic_google_maps extends WP_Widget {

// widget constructor
function automatic_google_maps() {
	
	$widget_ops = array('description' => __('Widget that shows Google Maps markers.'));
	$this->WP_Widget(false, $name = __('Automatic Google Maps Widget', 'wp_widget_plugin'), $widget_ops);

}

// widget back end (UI)
function form($instance) {

// nadawanie i ³¹czenie defaultowych wartoœci
	$defaults = array('title' => 'Automatic Google Maps');
	$instance = wp_parse_args( (array) $instance, $defaults );
?>

<p>
	<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
	<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>

<?php

}

function update($new_instance, $old_instance) {
$instance = $old_instance;

// available fields
$instance['title'] = strip_tags($new_instance['title']);
return $instance;
}

// widget front end
function widget($args, $instance) {
extract($args);

$title = apply_filters('widget_title', $instance['title']);
echo $before_widget;

// title check
if ($title) {
	echo $before_title . $title . $after_title;
}

pp_show_google_map();

echo $after_widget;
}
}

// shortcode function
function automatic_gogle_maps_shortcode_handler() {
	$widgetOptions = get_option('automatic_google_maps');

	ob_start();

	$ret = ob_get_contents();	
	ob_end_clean();
	return $ret;
}

// widget registration
add_action('widgets_init', create_function('', 'return register_widget("automatic_google_maps");'));
add_action('wp_enqueue_scripts', 'automatic_google_maps_stylesheet');
    function automatic_google_maps_stylesheet() {
        wp_enqueue_style( 'prefix-style', plugins_url('/style.css', __FILE__) );
    }

?>