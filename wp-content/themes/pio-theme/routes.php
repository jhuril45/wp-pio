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

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/delete-flip-card', array(
    'methods' => 'POST',
    'callback' => 'deleteFlipCard',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-quick-links', array(
    'methods' => 'GET',
    'callback' => 'fetchQuickLinks',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-quick-link', array(
    'methods' => 'POST',
    'callback' => 'submitQuickLink',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/delete-quick-link', array(
    'methods' => 'POST',
    'callback' => 'deleteQuickLink',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-partner-lists', array(
    'methods' => 'GET',
    'callback' => 'fetchPartnerLists',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-partner-list', array(
    'methods' => 'POST',
    'callback' => 'submitPartnerList',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/delete-partner-list', array(
    'methods' => 'POST',
    'callback' => 'deletePartnerList',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-office-list', array(
    'methods' => 'GET',
    'callback' => function () {
      return fetchOffices($_GET['id'],$_GET['is_post']);
    }
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-barangay-list', array(
    'methods' => 'GET',
    'callback' => function () {
      return fetchBarangays($_GET['id'],$_GET['is_edit'],$_GET['is_post']);
    }
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-bids-report-list', array(
    'methods' => 'GET',
    'callback' => 'fetchBids',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-report', array(
    'methods' => 'GET',
    'callback' => function () {
      return getReport($_GET['id'],$_GET['is_bid']);
    }
  ) );
} );

add_action('rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-tourism-list', array(
    'methods' => 'GET',
    'callback' => function () {
      return fetchTourism($_GET['is_place'],$_GET['id'],$_GET['is_all']);
      return getReport($_GET['id'],$_GET['is_bid']);
    }
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-procurement-monitoring', array(
    'methods' => 'POST',
    'callback' => 'submitProcurementMonitoring',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-procurement-monitoring-list', array(
    'methods' => 'GET',
    'callback' => function () {
      return fetchProcurementMonitoring($_GET['id'],$_GET['is_post']);
    }
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-procurement-monitoring-attachment', array(
    'methods' => 'POST',
    'callback' => 'removeProcurementMonitoringAttachment',
    'permission_callback' => function($request){
      return checkUser('pio');
    },
  ) );
} );