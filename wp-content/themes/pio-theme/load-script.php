<?php 
function add_script()
{
  global $pagename;

  wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
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
      'offices' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'offices' ? getOfficeList() : [],
      'office' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-office' ? getOffice(get_query_var( 'id' )) : '',
      'city_barangays' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'barangays' ? getCityBarangay() : [],
      'barangay' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-barangay' ? getCityBarangay(get_query_var( 'id' )) : '',
      'places_to_stay' => getTourismPlaces(),
      'places_to_go' => getTourismPlaces(false),
      'city_tourism' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'tourism' ? getTourismPlaces(false,0,true) : [],
      'tourism' => get_query_var( 'tab' ) && get_query_var( 'id' ) && get_query_var( 'tab' ) == 'add-tourism' ? getTourismPlaces(true,get_query_var( 'id' )) : '',
      // 'edit_post' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'add-post' && get_query_var( 'id' ) ? fetchPost(get_query_var( 'id' )) : null, 
    ];
  }else{
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/landing_main.js',array ( 'jquery' ), 1.1, true);
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
      'offices' => $pagename == 'offices' ? getOfficeList() : [],
      'office' => get_query_var( 'office' ) ? getOffice(get_query_var( 'office' )) : '',
      'barangay' => get_query_var( 'barangay' ) ? getCityBarangay(get_query_var( 'barangay' )) : '',
      'city_officials' => $pagename == 'city-officials' ? getCityOfficials() : '',
      'city_barangays' => $pagename == 'barangays' ? getCityBarangay() : '',
      'places_to_stay' => getTourismPlaces(),
      'places_to_go' => getTourismPlaces(false),
      'header_logo' => get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png',
    ];
  }
  wp_enqueue_script( 'vue-main');

  wp_localize_script('vue-main', 'Main', $page_data);
}

add_action('wp_enqueue_scripts', 'add_script');