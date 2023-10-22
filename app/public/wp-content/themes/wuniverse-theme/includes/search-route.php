<?php

add_action('rest_api_init', 'wuniverseRegisterSearch');

function wuniverseRegisterSearch() {
  // 3 argus are -> namespace | route | what should happen when someone visits this URL.
  register_rest_route('wuniverse/v1', 'search', array(
    'methods' => WP_REST_Server::READABLE, // equals to 'GET'
    'callback' => 'wuniverseSearchResults'
  ));
}

function wuniverseSearchResults($data) {
  $professions = new WP_Query(array(
    'post_type' => 'professor',
    's' => sanitize_text_field($data['term']),
  ));

  $professorResults = array();

  while($professions->have_posts()) {
    $professions->the_post();
    array_push($professorResults, array(
      'title' => get_the_title(),
      'permalink' => get_the_permalink(),
    ));
  }

  return $professorResults;
}
