<!-- This is where we can have a conversation with the WordPress system itself -->

<?php

function wuniverse_files() {
  wp_enqueue_style('wuniverse_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'wuniverse_files');
