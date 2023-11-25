<?php
// This is where we can have a conversation with the WordPress system itself
require get_theme_file_path("/includes/like-route.php");
require get_theme_file_path("/includes/search-route.php");

function wuniverse_custom_reset() {
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author(); }
  ));

  register_rest_field('note', 'userNoteCount', array(
    'get_callback' => function() {return count_user_posts(get_current_user_id(), 'note'); }
  ));
}

add_action('rest_api_init', 'wuniverse_custom_reset');

function pageBanner($args = NULL) {
  // php logic will live here
  if (!isset($args['title'])) {
    $args['title'] = get_the_title();
  }
  if (!isset($args['subtitle'])) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }
  if (!isset($args['photo'])) {
    if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php }

// loading js and css files
function wuniverse_files() {
  wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyC6Blnd187x-o5R_IemhFhtcD8cPw-u-ao', NULL, '1.0', true);
  wp_enqueue_script('main-wuniverse-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"');
  wp_enqueue_style('wuniverse_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('wuniverse_extra_styles', get_theme_file_uri('/build/index.css'));

  wp_localize_script('main-wuniverse-js', 'wuniverseData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest'),  // check user permission
  ));
}

add_action('wp_enqueue_scripts', 'wuniverse_files');

// setup title-tag on browser
function wuniverse_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);   // wide, tall, crop?
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'wuniverse_features');

function wuniverse_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
    $query->set('posts_per_page', -1);
  }
  
  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // $query->set('posts_per_page', '1');   // this line of code is going to manipulate every single query on our website; admin, too.
  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) { // is_main_query(): will only evaluate to true if the query in question is the default URL based query.
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }
}

add_action('pre_get_posts', 'wuniverse_adjust_queries');

function wuniverseMapKey($api) {
  $api['key'] = 'AIzaSyC6Blnd187x-o5R_IemhFhtcD8cPw-u-ao';
  return $api;
}

add_filter('acf/fields/google_map/api', 'wuniverseMapKey');

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');;

function ourHeaderUrl() {
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"');
  wp_enqueue_style('wuniverse_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('wuniverse_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  return get_bloginfo('name');
}

// force note posts to be private
// 10 -> the priority number decides which function would run first; the lower the number, the earlier it will run and the larger the number, the later it will run. 
// 2 -> 2 parameters
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);   

function makeNotePrivate($data, $postarr) {
  if ($data['post_type'] == 'note') {
    if (count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
      die('You have reached your note limit.');
    }

    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }

  if ($data['post_type'] == 'note' && $data['post_status'] != 'trash') {
    $data['post_status'] = "private";
  }
  return $data;
}
