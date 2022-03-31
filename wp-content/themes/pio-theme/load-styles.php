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