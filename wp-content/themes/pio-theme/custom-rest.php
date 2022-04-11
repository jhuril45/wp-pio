<?php
function my_awesome_func( $data ) {
  $posts = get_posts( array(
    'author' => $data['id'],
  ) );
 
  if ( empty( $posts ) ) {
    return null;
  }
  $user = wp_get_current_user();
 
  return $user->exists();
  return $posts[0]->post_title;
}

function submitCarouselImage( $data ) {
  try{
    $user = wp_get_current_user();
    $temp= explode('.',basename($_FILES["file"]["name"]));
    $extension = end($temp);
    $file_name = time().'.'.$extension;
    $file = wp_upload_bits( $file_name, null, @file_get_contents( $_FILES['file']['tmp_name'] ) );

    global $wpdb;
    $image = $wpdb->insert(
      'wp_carousel_images',
      array(
        'path' => $file['url'],
        'is_display' => true,
      ),
    );

    return $image;
  }catch(Exception $error){
    return $error;
  }
}

function updateCarouselImage() {
  try{
    
    $is_display = $_POST['is_display'];
    if(boolval($is_display)){
      return 23;
    }
    return boolval($is_display);
  }catch(Exception $error){
    return $error;
  }
}

function getCarouselImage( $data ) {
  try{
    $user = wp_get_current_user();
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wp_carousel_images");
    return $results;
  }catch(Exception $error){
    return $error;
  }
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/update-carousel-display', array(
    'methods' => 'POST',
    'callback' => 'updateCarouselImage',
  ));
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-carousel', array(
    'methods' => 'GET',
    'callback' => 'getCarouselImage',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-carousel', array(
    'methods' => 'POST',
    'callback' => 'submitCarouselImage',
  ) );
} );