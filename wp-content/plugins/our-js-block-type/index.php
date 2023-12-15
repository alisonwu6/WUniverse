<?php

/*
  Plugin Name: Our Js Block Type
  Description: Give your readers a multiple choice question.
  Version: 1.0
  Author: Alison
  Author URI: https://WWW.google.com
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class OurJsBlockType {
  function __construct() {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type('ourplugin/our-js-block-type', array(
      'editor_script' => 'ournewblocktype',
      'editor_style' => 'quizeditcss',
      'render_callback' => array($this, 'theHTML')
    ));
  }

  function theHTML($attributes) {
    if (!is_admin()) {
      wp_enqueue_script('blockFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'));  // wp-element -> WordPress version of React
      wp_enqueue_style('blockFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }

    ob_start(); ?>
    <div class="paying-attention-update-me"><pre style="display: none;"><?php echo wp_json_encode($attributes) ?></pre></div>
    <?php return ob_get_clean();
  }
}

$ourJsBlockType = new OurJsBlockType();