<?php
function submitCarouselImage() {
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

function deleteCarouselImage() {
  try{
    global $wpdb;
    $table='wp_carousel_images';
    $id = $_POST['id'];
    $wpdb->delete( $table, array( 'id' => intval($id) ) );
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function fetchCarouselImages() {
  try{
    $user = wp_get_current_user();
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wp_carousel_images");
    return $results;
  }catch(Exception $error){
    return $error;
  }
}

function submitPost() {
  try{
    $user = wp_get_current_user();

    $post = wp_insert_post(
      array(
        'post_title' => $_POST['title'],
        'post_content' => $_POST['content'],
        'post_status' => 'publish',
      )
    );

    $featured_image = basename($_FILES["featured_image"]["name"]);

    if($featured_image){
      $featured_image = uploadFileSubmitted('featured_image');
      $attachment_image = insertAttachment($featured_image,$post,true);
    }
    if($_POST['attachment_length'] > 0){
      for ($i=1; $i <= intval($_POST['attachment_length']); $i++) { 
        $attachment_file = uploadFileSubmitted('attachment-'.$i);
        $attachment = insertAttachment($attachment_file,$post,true);
      }
    }
    
    return $post;
  }catch(Exception $error){
    return $error;
  }
}

function uploadFileSubmitted($file_name){
  $upload_dir = wp_upload_dir();
  $temp = explode('.',basename($_FILES[$file_name]['name']));
  $extension = end($temp);
  $image_data = file_get_contents($_FILES[$file_name]['tmp_name'] );
      
  $filename = 'jhuril'.time().'.'.$extension;
  
  $file = wp_mkdir_p($upload_dir['path']) ? $upload_dir['path'] . '/' . $filename : $upload_dir['basedir'] . '/' . $filename;

  file_put_contents($file, $image_data);
  return $file;
}

function insertAttachment($file,$post_id,$is_featured=false){
  $filename = basename($file);
  $attachment = array(
    'post_mime_type' => wp_check_filetype($filename, null )['type'],
    'post_title' => sanitize_file_name($filename),
    'post_content' => '',
    'post_status' => 'inherit'
  );
  
  $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

  require_once(ABSPATH . 'wp-admin/includes/image.php'); 

  $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
  $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
  $res2= $is_featured ? set_post_thumbnail( $post_id, $attach_id ) : null;
  
  return $res2;
}

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/delete-carousel-display', array(
    'methods' => 'POST',
    'callback' => 'deleteCarouselImage',
  ));
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/update-carousel-display', array(
    'methods' => 'POST',
    'callback' => 'updateCarouselImage',
  ));
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-carousel', array(
    'methods' => 'GET',
    'callback' => 'fetchCarouselImages',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-carousel', array(
    'methods' => 'POST',
    'callback' => 'submitCarouselImage',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-post', array(
    'methods' => 'POST',
    'callback' => 'submitPost',
  ) );
} );