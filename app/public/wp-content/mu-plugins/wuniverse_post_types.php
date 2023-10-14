<?php 

function wuniverse_post_types() {
  register_post_type('event', array(
    'supports' => array('title', 'editor', 'excerpt'), // 'editor' - modern screen
    'rewrite' => array('slug' => 'events'),   // changing slug into plural
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,                   // using the modern block editor
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'edit_item' => "Edit Event",
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));
}

add_action('init', 'wuniverse_post_types');
