<?php 

add_action('rest_api_init', 'wuniverseLikeRoutes');

function wuniverseLikeRoutes() {
  register_rest_route('wuniverse/v1', 'manageLike', array(
    'methods' => 'POST',
    'callback' => 'createLike'
  ));

  register_rest_route('wuniverse/v1', 'manageLike', array(
    'methods' => "DELETE",
    'callback' => 'deleteLike'
  ));
}

function createLike() {
  return 'Thanks fro trying to create a like';
}

function deleteLike() {
  return 'Thanks for trying to delete a like';
}