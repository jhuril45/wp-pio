<?php
function add_css()
{
   wp_register_style('quasar-css', get_template_directory_uri() . '/assets/css/quasar.min.css', false,'1.1','all');
   wp_enqueue_style( 'quasar-css');

   wp_register_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', false,'1.1','all');
   wp_enqueue_style( 'quasar');

   wp_register_style('material_icons', get_template_directory_uri() . '/assets/css/material_icons.css', false,'1.1','all');
   wp_enqueue_style( 'material_icons');

   wp_register_style('main-css', get_template_directory_uri() . '/assets/css/main.css', false,'1.1','all');
   wp_enqueue_style( 'main-css');

   wp_register_style('components', get_template_directory_uri() . '/assets/css/components.css', false,'1.1','all');
   wp_enqueue_style( 'components');
}
add_action('wp_enqueue_scripts', 'add_css');

function add_script()
{
  wp_register_script( 'vue-script', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',array ( 'jquery' ), 1.1, true);
  wp_register_script('quasar-script', get_template_directory_uri() . '/assets/js/quasar.min.js',array ( 'jquery' ), 1.1, true);
  
  wp_register_script('axios', get_template_directory_uri() . '/assets/js/axios.min.js');
  wp_enqueue_script( 'vue-script');
  wp_enqueue_script( 'quasar-script');
  wp_enqueue_script( 'axios');

  wp_register_script('clockComponent', get_template_directory_uri() . '/assets/js/clockComponent.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'clockComponent');

  wp_register_script('vue-main', get_template_directory_uri() . '/assets/js/main.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'vue-main');

  

}
add_action('wp_enqueue_scripts', 'add_script');

add_theme_support( 'html5', array( 'navigation-widgets' ) );
add_theme_support('custom-header');
add_theme_support('menus');
add_theme_support('widgets');

add_theme_support( 'custom-logo', array(
  'height' => 50,
  'width'  => 50,
) );