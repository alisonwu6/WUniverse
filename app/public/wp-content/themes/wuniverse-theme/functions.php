<?php
// This is where we can have a conversation with the WordPress system itself

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
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);   // wide, tall, crop?
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'wuniverse_features');

function wuniverse_adjust_queries($query) {
  if (!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

  // $query->set('posts_per_page', '1');   // this line of code is going to manipulate every single query on our website; admin, too.
  if (!is_admin() AND is_post_type_archive('event') AND is_main_query()) { // is_main_query(): will only evaluate to true if the query in question is the default URL based query.
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