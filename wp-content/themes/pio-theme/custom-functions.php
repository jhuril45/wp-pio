<?php
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
add_action('rest_api_init', 'register_rest_images' );

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

function custom_get_post_data(){
  $post_id = url_to_postid(get_permalink());
  // $data = get_post($post_id);
  return $post_id;
}
add_action('init', 'myInit');

function myInit() {
  global $globalUrl;
  $globalUrl = url_to_postid(get_permalink());
}

function get_posted_date() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf(
    $time_string,
    esc_attr( get_the_date( DATE_W3C ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( DATE_W3C ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    /* translators: %s: post date. */
    esc_html_x( '%s', 'post date', 'pio' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

add_action('wp', 'redirect_private_page_to_login');

function redirect_private_page_to_login(){

    global $wp_query;

    $queried_object = get_queried_object();

    if ($queried_object->post_status == "private" && !is_user_logged_in()) {

        wp_redirect(home_url('/login'));

    } 
}