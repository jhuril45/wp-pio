<?php 
function add_script()
{
  global $pagename;

  // wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
  wp_register_script('vue-script', get_template_directory_uri() . '/assets/js/vue.min.js',array ( 'jquery' ), 1.1, true);
  wp_register_script('quasar-script', get_template_directory_uri() . '/assets/js/quasar.min.js',array ( 'jquery' ), 1.1, true);
  // wp_register_script('quasar-fontawesome', get_template_directory_uri() . '/assets/js/quasar-fontawesome5.min.js',array ( 'jquery' ), 1.1, true);
  
  wp_register_script('axios', get_template_directory_uri() . '/assets/js/axios.min.js');
  wp_enqueue_script( 'vue-script');
  wp_enqueue_script( 'quasar-script');
  wp_enqueue_script( 'axios');

  wp_register_script('clockComponent', get_template_directory_uri() . '/assets/js/clockComponent.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'clockComponent');

  wp_register_script('organization-chart', get_template_directory_uri() . '/assets/js/organization-chart.min.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'organization-chart');

  wp_register_script('vue-pdf-embed', get_template_directory_uri() . '/assets/js/vue-pdf-embed.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'vue-pdf-embed');
  
  if($pagename == 'dashboard'){
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/dashboard_main.js',array ( 'jquery' ), 1.1, true);
    $page_data = [
      'home_url' => get_home_url(),
      'nonce' => wp_create_nonce('wp_rest'),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'reports' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'reports' ? fetchReports() : [],
      'bids' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'bid-reports' ? fetchBids() : [],
      'bid' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-bid-report' ? getReport(get_query_var( 'id' ),true) : '',
      'report' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-report' ? getReport(get_query_var( 'id' )) : '',
      'offices' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'offices' ? fetchOffices() : [],
      'office' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-office' ? fetchOffices(get_query_var( 'id' )) : '',
      'city_barangays' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'barangays' ? fetchBarangays() : [],
      'barangay' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-barangay' ? fetchBarangays(get_query_var( 'id' ),true) : '',
      'posts' => get_query_var( 'tab' ) == null || get_query_var( 'tab' ) == 'posts' ? getRecentPosts() : [],
      
      'places_to_stay' => fetchTourism(),
      'places_to_go' => fetchTourism(false),
      'city_tourism' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'tourism' ? fetchTourism(false,0,true) : [],
      'tourism' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-tourism' ? fetchTourism(true,get_query_var( 'id' )) : '',
      'dashboard_drawer_menu' => getDashboardDrawerMenu(),
      'carousel_images' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'carousel' ? fetchCarouselImages() : [],
      'edit_post' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'add-post' && get_query_var( 'id' ) ? fetchPost(get_query_var( 'id' )) : null, 
      'flip_cards' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'flip-cards' ? fetchFlipCards() : [],
    ];
  }else{
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/landing_main.js',array ( 'jquery' ), 1.1, true);
    $office = get_query_var( 'office' ) ? fetchOffices(get_query_var( 'office' ),get_query_var( 'searched' )) : null;
    $barangay = get_query_var( 'barangay' ) ? fetchBarangays(get_query_var( 'barangay' ),false,get_query_var( 'searched' )) : null;
    

    $page_data = [
      'home_url' => get_home_url(),
      'nonce' => wp_create_nonce('wp_rest'),
      'carousel_images' => fetchCarouselImages(),
      'flip_cards' => getFlipCards(),
      // 'recent_posts' => is_front_page() ? getRecentPosts() : [],
      'recent_posts' => getRecentPosts(),
      'header_menus' => getHeaderMenus(),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'offices' => $pagename == 'offices' ? fetchOffices() : [],
      'reports' => $pagename == 'transparency' ? fetchReports() : [],
      'bids' => $pagename == 'bids' ? fetchBids() : [],
      'office' => $office,
      'barangay' => $barangay,
      'city_officials' => $pagename == 'city-officials' ? fetchCityOfficials() : '',
      'city_barangays' => $pagename == 'barangays' ? fetchBarangays() : '',
      'places_to_stay' => fetchTourism(),
      'places_to_go' => fetchTourism(false),
      'header_logo' => get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png',
      'searched_contents' => $pagename == 'contents' ? searchContents(get_query_var( 'search' )) : [],
    ];
  }
  wp_enqueue_script( 'vue-main');

  wp_localize_script('vue-main', 'Main', $page_data);
}

add_action('wp_enqueue_scripts', 'add_script');