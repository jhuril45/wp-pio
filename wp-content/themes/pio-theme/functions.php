<?php
function add_css()
{
   wp_register_style('quasar-css', get_template_directory_uri() . '/assets/css/quasar.min.css', false,'1.1','all');
   wp_enqueue_style( 'quasar-css');

   wp_register_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', false,'1.1','all');
   wp_enqueue_style( 'quasar');

   wp_register_style('material_icons', get_template_directory_uri() . '/assets/css/material_icons.css', false,'1.1','all');
   wp_enqueue_style( 'material_icons');

   wp_register_style('fontawesome5', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', false,'1.1','all');
   wp_enqueue_style( 'fontawesome5');

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
  // wp_register_script('quasar-fontawesome', get_template_directory_uri() . '/assets/js/quasar-fontawesome5.min.js',array ( 'jquery' ), 1.1, true);
  
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
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-logo', array(
  'height' => 50,
  'width'  => 50,
) );

add_action('rest_api_init', 'register_rest_images' );

function register_rest_images(){
    register_rest_field( array('post'),
        'fimg_url',
        array(
          'get_callback'    => 'get_rest_featured_image',
          'update_callback' => null,
          'schema'          => null,
        )
    );
}

function get_rest_featured_image( $object, $field_name, $request ) {
    if( $object['featured_media'] ){
        $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
        return $img[0];
    }
    return false;
}

function custom_get_custom_logo(){
  $logo = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $logo , 'full' );
  return $image[0];
}