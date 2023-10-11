<!-- This is where we can have a conversation with the WordPress system itself -->

<?php

// loading js and css files
function wuniverse_files() {
  wp_enqueue_script('main-wus-blog-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"');
  wp_enqueue_style('wuniverse_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('wuniverse_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'wuniverse_files');

// setup title-tag on browser
function wuniverse_features() {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'wuniverse_features');