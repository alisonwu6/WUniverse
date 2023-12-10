<?php 

/* 
  Plugin Name: Our Test Plugin
  Description: A truely amazing plugins.
  Version: 1.0
  Author: Alison
  Author URI: https://WWW.google.com
*/

class WordCountAndTimePlugin {
  function __construct() {
    add_action('admin_menu', array($this, 'adminPage'));
  }

  function adminPage() {
    add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
  }
  
  function ourHTML() { ?>
    <div class="wrap">
      <h1>Word Count Settings</h1>
    </div>
  <?php }
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();