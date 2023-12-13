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
    add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_enqueue_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
  }
}

$ourJsBlockType = new OurJsBlockType();