<?php

/*
  Plugin Name: Featured Professor Block Type
  Version: 1.0
  Author: Your Name Here
  Author URI: https://www.udemy.com/user/bradschiff/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once plugin_dir_path(__FILE__) . 'inc/generateProfessorHTML.php';

class FeaturedProfessor {
  function __construct() {
    add_action('init', [$this, 'onInit']);
    add_action('rest_api_init', [$this, 'profHTML']);
  }

  function profHTML() {
    register_rest_route('featuredProfessor/v1', 'getHTML', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => [$this, 'getProfHTML']
    ));
  }

  function getProfHTML($data) {
    // return '<h4>Hello from our endpoint</h4>';
    return generateProfessorHTML($data['profId']);
  }

  function onInit() {
    wp_register_script('featuredProfessorScript', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-i18n', 'wp-editor'));
    wp_register_style('featuredProfessorStyle', plugin_dir_url(__FILE__) . 'build/index.css');

    register_block_type('ourplugin/featured-professor', array(
      'render_callback' => [$this, 'renderCallback'],
      'editor_script' => 'featuredProfessorScript',
      'editor_style' => 'featuredProfessorStyle'
    ));
  }

  function renderCallback($attributes) {
    if ($attributes) {
      wp_enqueue_style('featuredProfessorStyle');
      return generateProfessorHTML($attributes['profId']);
    } else {
      return NULL;
    }
  }

}

$featuredProfessor = new FeaturedProfessor();