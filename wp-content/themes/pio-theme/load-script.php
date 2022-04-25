<?php 
function add_script()
{
  wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
  wp_register_script('quasar-script', get_template_directory_uri() . '/assets/js/quasar.min.js',array ( 'jquery' ), 1.1, true);
  // wp_register_script('quasar-fontawesome', get_template_directory_uri() . '/assets/js/quasar-fontawesome5.min.js',array ( 'jquery' ), 1.1, true);
  
  wp_register_script('axios', get_template_directory_uri() . '/assets/js/axios.min.js');
  wp_enqueue_script( 'vue-script');
  wp_enqueue_script( 'quasar-script');
  wp_enqueue_script( 'axios');

  wp_register_script('clockComponent', get_template_directory_uri() . '/assets/js/clockComponent.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'clockComponent');

  if($wp_query->queried_object->post_name == 'dashboard'){
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/add_post.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'vue-main');
  }else{
    wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/main.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'vue-main');
  }

  wp_localize_script('vue-main', 'Rest', [
    'nonce' => wp_create_nonce('wp_rest'),
  ]);
  
}
add_action('wp_enqueue_scripts', 'add_script');