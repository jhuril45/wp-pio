<?php 
add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/delete-carousel-display', array(
    'methods' => 'POST',
    'callback' => 'deleteCarouselImage',
  ));
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/update-carousel-display', array(
    'methods' => 'POST',
    'callback' => 'updateCarouselImage',
  ));
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-carousel', array(
    'methods' => 'GET',
    'callback' => 'fetchCarouselImages',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-carousel', array(
    'methods' => 'POST',
    'callback' => 'submitCarouselImage',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-post', array(
    'methods' => 'POST',
    'callback' => 'submitPost',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-report', array(
    'methods' => 'POST',
    'callback' => 'submitReport',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-report', array(
    'methods' => 'POST',
    'callback' => 'deleteReport',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-bid-report', array(
    'methods' => 'POST',
    'callback' => 'deleteBidReport',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-posts', array(
    'methods' => 'GET',
    'callback' => 'fetchPosts',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-post', array(
    'methods' => 'GET',
    'callback' => 'fetchPost',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-reports', array(
    'methods' => 'GET',
    'callback' => 'fetchReports',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-bids', array(
    'methods' => 'GET',
    'callback' => 'fetchBids',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-post-attachment', array(
    'methods' => 'POST',
    'callback' => 'removePostAttachment',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-bid-report', array(
    'methods' => 'POST',
    'callback' => 'submitBidReport',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-office', array(
    'methods' => 'POST',
    'callback' => 'submitOffice',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-barangay', array(
    'methods' => 'POST',
    'callback' => 'submitBarangay',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-tourism', array(
    'methods' => 'POST',
    'callback' => 'submitTourism',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-tourism', array(
    'methods' => 'POST',
    'callback' => 'removeTourism',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-office-attachment', array(
    'methods' => 'POST',
    'callback' => 'removeOfficeAttachment',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-barangay-attachment', array(
    'methods' => 'POST',
    'callback' => 'removeBarangayAttachment',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-barangay', array(
    'methods' => 'POST',
    'callback' => 'removeBarangay',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-office', array(
    'methods' => 'POST',
    'callback' => 'removeOffice',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/search-page', array(
    'methods' => 'POST',
    'callback' => 'searchContents',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-flip-card', array(
    'methods' => 'POST',
    'callback' => 'submitFlipCard',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-flip-cards', array(
    'methods' => 'GET',
    'callback' => 'fetchFlipCards',
  ) );
} );