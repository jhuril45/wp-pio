<?php 
function add_script()
{
  global $pagename;

  // wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
  wp_register_script('vue-script', get_template_directory_uri() . '/assets/js/vue.min.js',[], 1.2, false);
  wp_register_script('quasar-script', get_template_directory_uri() . '/assets/js/quasar.min.js',[], 1.2, true);
  // wp_register_script('quasar-fontawesome', get_template_directory_uri() . '/assets/js/quasar-fontawesome5.min.js',array ( 'jquery' ), 1.1, true);
  
  wp_register_script('axios', get_template_directory_uri() . '/assets/js/axios.min.js');
  wp_enqueue_script( 'vue-script');
  wp_enqueue_script( 'quasar-script');
  wp_enqueue_script( 'axios');

  

  wp_register_script('organization-chart', get_template_directory_uri() . '/assets/js/organization-chart.min.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'organization-chart');

  wp_register_script('vue-pdf-embed', get_template_directory_uri() . '/assets/js/vue-pdf-embed.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'vue-pdf-embed');
  $tab = get_query_var( 'tab' );
  $id = get_query_var( 'id' );
  if($pagename == 'dashboard'){
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/dashboard_main.js',array ( 'jquery' ), 1.1, true);
    
    $page_data = [
      'user' => wp_get_current_user(),
      'home_url' => get_home_url(),
      'nonce' => wp_create_nonce('wp_rest'),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'query_tab' => $tab,
      'query_id' => $id ? $id : null,
      'user' => wp_get_current_user(),
      'reports' => fetchReports(),
      // 'reports' => $tab && $tab == 'reports' ? fetchReports() : [],
      // 'report' => $tab && $id && $tab == 'add-report' ? getReport($id) : '',
      
      // 'bids' => $tab && $tab == 'bid-reports' ? fetchBids() : [],
      // 'bid' => $tab && $id && $tab == 'add-bid-report' ? getReport($id,true) : '',
      
      // 'offices' => $tab && $tab == 'offices' ? fetchOffices() : [],
      // 'office' => $tab && $id && $tab == 'add-office' ? fetchOffices($id) : '',
      
      // 'city_barangays' => $tab && $tab == 'barangays' ? fetchBarangays() : [],
      // 'barangay' => $tab && $id && $tab == 'add-barangay' ? fetchBarangays($id,true) : '',
      
      // 'city_tourism' => $tab && $tab == 'tourism' || checkUser('tourism') && $tab == 'tourism' ? fetchTourism(false,0,true) : [],
      'city_tourism' => fetchTourism(false,0,true),
      // 'tourism' => $tab && $id && $tab == 'add-tourism' ? fetchTourism(true,$id) : '',
      'procurement_monitorings' => fetchProcurementMonitoring(),
      // 'posts' => $tab == null || $tab == 'posts' ? getRecentPosts(-1) : [],
      
      'dashboard_drawer_menu' => getDashboardDrawerMenu(),
      'carousel_images' => $tab && $tab == 'carousel' ? fetchCarouselImages() : [],
      'edit_post' => $tab && $tab == 'add-post' && $id ? fetchPost($id) : null, 
      'flip_cards' => $tab && $tab == 'flip-cards' ? fetchFlipCards() : [],
      'quick_links' => $tab && $tab == 'quick-links' ? fetchQuickLinks() : [],
      'partners_list' => $tab && $tab == 'partners-list' ? fetchPartnerLists() : [],
    ];
  }else{
    wp_register_script('clockComponent', get_template_directory_uri() . '/assets/js/clockComponent.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'clockComponent');
    
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/landing_main.js',array ( 'jquery' ), 1.1, true);
    
    global $post;
    $page_data = [
      'landing_details' => getLandingDetails(),
      'home_url' => get_home_url(),
      'nonce' => wp_create_nonce('wp_rest'),
      'carousel_images' => is_front_page() == 1 ? fetchCarouselImages() : [],
      'flip_cards' => is_front_page() == 1 ? fetchFlipCards() : [],
      'quick_links' => is_front_page() == 1 ? fetchQuickLinks() : [],
      'partners_list' => is_front_page() == 1 ? fetchPartnerLists() : [],
      // 'recent_posts' => is_front_page() ? getRecentPosts() : [],
      'procurement_monitorings' => fetchProcurementMonitoring(),
      'recent_posts' => getRecentPosts(4),
      'header_menus' => getHeaderMenus(),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'offices' => $pagename == 'offices' ? fetchOffices() : [],
      'reports' => $pagename == 'transparency' ? fetchReports() : [],
      'bids' => $pagename == 'bids' ? fetchBids() : [],
      'bid' => get_query_var( 'bid' ) && $pagename == 'bids' ? getReport(get_query_var( 'bid' ),true) : null,
      'monitoring_report' => get_query_var( 'monitoring_report' ) && $pagename == 'procurement-monitoring-reports' ? fetchProcurementMonitoring(get_query_var( 'monitoring_report' ),false) : null,
      'report' => get_query_var( 'report' ) ? getReport(get_query_var( 'report' )) : null,
      'office' => get_query_var( 'office' ) ? fetchOffices(get_query_var( 'office' ),get_query_var( 'searched' )) : null,
      'barangay' => get_query_var( 'barangay' ) ? fetchBarangays(get_query_var( 'barangay' ),false,get_query_var( 'searched' )) : null,
      'city_officials' => $pagename == 'city-officials' ? fetchCityOfficials() : '',
      'city_barangays' => $pagename == 'barangays' ? fetchBarangays() : '',
      'places_to_stay' => $pagename == 'tourism' ? fetchTourism() : [],
      'places_to_go' => $pagename == 'tourism' ? fetchTourism(false) : [],
      'header_logo' => get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png',
      'searched_contents' => $pagename == 'contents' ? searchContents(get_query_var( 'search' )) : [],
      'post' => is_front_page() ? null : $post,
      'post_categories' => $post ? wp_get_post_categories($post->ID,array('fields' => 'names')) : null,
      'front_page' => is_front_page(),
    ];
  }
  wp_enqueue_script( 'vue-main');

  wp_localize_script('vue-main', 'Main', $page_data);
}

add_action('wp_enqueue_scripts', 'add_script');