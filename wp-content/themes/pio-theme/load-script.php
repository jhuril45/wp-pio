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
      'nonce' => wp_create_nonce('wp_rest'),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'offices' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'offices' ? getOfficeList() : [],
      // 'edit_post' => get_query_var( 'tab' ) && get_query_var( 'tab' ) == 'add-post' && get_query_var( 'id' ) ? fetchPost(get_query_var( 'id' )) : null, 
    ];
  }else{
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/landing_main.js',array ( 'jquery' ), 1.1, true);
    $page_data = [
      'nonce' => wp_create_nonce('wp_rest'),
      'carousel_images' => is_front_page() ? fetchCarouselImages() : [],
      'flip_cards' => is_front_page() ? getFlipCards() : [],
      'recent_posts' => is_front_page() ? getRecentPosts() : [],
      'header_menus' => getHeaderMenus(),
      'template_dir' => get_template_directory_uri(),
      'page_name' => $pagename,
      'offices' => $pagename == 'offices' ? getOfficeList() : [],
      'office' => get_query_var( 'office' ) ? getOffice(get_query_var( 'office' )) : '',
      'city_officials' => $pagename == 'city-officials' ? getCityOfficials() : '',
      'city_barangays' => $pagename == 'barangays' ? getCityBarangay() : '',
      'header_logo' => get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png',
    ];
  }
  wp_enqueue_script( 'vue-main');

  wp_localize_script('vue-main', 'Main', $page_data);
}

add_action('wp_enqueue_scripts', 'add_script');