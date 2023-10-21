<?php

add_action('rest_api_init', 'wuniverseRegisterSearch');

function wuniverseRegisterSearch() {
  // 3 argus are -> namespace | route | what should happen when someone visits this URL.
  register_rest_route('wuniverse/v1', 'search', array(
    'methods' => WP_REST_Server::READABLE, // equals to 'GET'
    'callback' => 'wuniverseSearchResult'
  ));
}

function wuniverseSearchResult() {
  return 'Congratulations, you created a route';
}
