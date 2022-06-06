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
        'placement_number' => 0,
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
    $table_name = $wpdb->prefix . "carousel_images";
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    return $results;
  }catch(Exception $error){
    return $error;
  }
}

function fetchPosts() {
  try{
    $user = wp_get_current_user();
    $args = array( 
      'author' => $user->ID,
      'numberposts'	=> 3,
    );

    return array(
      'posts' => get_posts($args),
    );

  }catch(Exception $error){
    return $error;
  }
}

function fetchReports() {
  try{
    $user = wp_get_current_user();
    global $wpdb;
    $table_name = $wpdb->prefix . "reports";
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    return $results;

  }catch(Exception $error){
    return $error;
  }
}

function fetchBids() {
  try{
    $user = wp_get_current_user();
    global $wpdb;
    $table_name = $wpdb->prefix . "bid_reports";
    $results = $wpdb->get_results("SELECT * FROM $table_name");
    return $results;

  }catch(Exception $error){
    return $error;
  }
}

function fetchPost() {
  try{
    $id = $_GET['id'];
    $post = get_post($id);

    $featured_image = get_the_post_thumbnail_url($post->ID);
    if(!empty($featured_image)){
      $post->featured_image = $featured_image;
    }
    
    $attachments = get_posts( array( 
      'post_type' => 'attachment',
      'post_mime_type'=>'image',
      'posts_per_page' => -1,
      'post_status' => 'published',
      'post_parent' => $id)
      );

    foreach ( $attachments as $attachment ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
      $mime = wp_get_attachment_metadata($attachment->ID);
      $type = wp_check_filetype($mime['file']);
      $attachment->mime_type = $type['type'];
      $attachment->src = $src;
    }

    
    return array(
      'post' => $post,
      'attachments' => $attachments,
    );
  }catch(Exception $error){
    return $error;
  }
}

function removePostAttachment() {
  try{
    $user = wp_get_current_user();
    $attachment = null;
    if (isset($_POST['id'])) {
      $attachment = wp_delete_attachment($_POST['id']);
    }
    return $attachment;
  }catch(Exception $error){
    return $error;
  }
}

function submitPost() {
  try{
    $user = wp_get_current_user();
    $term = get_term_by('name', 'News', 'category');
    // return $term;
    $post = wp_insert_post(
      array(
        'ID' => $_POST['id'] ? $_POST['id'] : 0,
        'post_title' => $_POST['title'],
        'post_content' => $_POST['content'],
        'post_status' => 'publish',
        'post_category' => array($term->term_id),
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

function submitReport() {
  try{
    $user = wp_get_current_user();
    $attachment = basename($_FILES["attachment"]["name"]);

    if($attachment){
      $temp = explode('.',basename($_FILES["attachment"]["name"]));
      $extension = end($temp);
      $file_name = time().'.'.$extension;
      $file = wp_upload_bits( $file_name, null, @file_get_contents( $_FILES['attachment']['tmp_name'] ) );

      global $wpdb;
      $report = $wpdb->insert(
        $wpdb->prefix.'reports',
        array(
          'title' => $_POST['title'],
          'year' => $_POST['year'],
          'path' => $file['url'],
          'type' => $_POST['type'],
          'quarter' => $_POST['quarter'] ? $_POST['quarter'] : null,
        ),
      );
      return $report;
    }
  }catch(Exception $error){
    return $error;
  }
}

function submitOffice() {
  try{
    // return 1;
    $user = wp_get_current_user();
    $logo_file = basename($_FILES["logo"]["name"]);
    $org_file = basename($_FILES["org_structure"]["name"]);
    $logo = null;
    $org_structure = null;
    
    if($logo_file){
      $logo = uploadFileSubmitted('logo',false);
    }

    if($org_file){
      $org_structure = uploadFileSubmitted('org_structure',false);
    }

    global $wpdb;
    $table_name = $wpdb->prefix.'offices';
    $data = array(
      'title' => $_POST['title'],
      'head' => $_POST['head'],
      'assistant' => $_POST['assistant'] ? $_POST['assistant'] : '',
      'description' => $_POST['description'] ? $_POST['description'] : '',
      'mandate' => $_POST['mandate'] ? $_POST['mandate'] : '',
      'facebook' => $_POST['facebook'] ? $_POST['facebook'] : '',
      'instagram' => $_POST['instagram'] ? $_POST['instagram'] : '',
      'twitter' => $_POST['twitter'] ? $_POST['twitter'] : '',
      'youtube' => $_POST['youtube'] ? $_POST['youtube'] : '',
      'email' => $_POST['email'] ? $_POST['email'] : '',
    );
    if($_POST['id']){
      if($logo){
        $data['logo'] = $logo['url'];
      }
      if($org_structure){
        $data['org_structure'] = $org_structure['url'];
      }
      // return $table_name;
      $data_where = array('id' => $_POST['id']);
      $wpdb->update($table_name , $data, $data_where);
    }else{
      $data['logo'] = $logo ? $logo['url'] : null;
      $data['org_structure'] = $org_structure ? $org_structure['url'] : null;

      $office = $wpdb->insert(
        $table_name,
        $data,
      );
    }
    
    

    $office_id = $wpdb->insert_id;

    if($_POST['services_length'] > 0){
      for ($i=1; $i <= intval($_POST['services_length']); $i++) {
        $service_image = 'service_data-image'.$i;
        $service = uploadFileSubmitted($service_image,false);
        
        global $wpdb;
        $wpdb->insert(
          $wpdb->prefix.'office_services',
          array(
            'title' => $_POST['service_data-name'.$i],
            'office_id' => $office_id,
            'path' => $service['url'],
          ),
        );
      }
    }

    if($_POST['forms_length'] > 0){
      for ($i=1; $i <= intval($_POST['forms_length']); $i++) {
        $form_file_name = 'form_data-file'.$i;
        $form = uploadFileSubmitted($form_file_name,false);

        global $wpdb;
        $wpdb->insert(
          $wpdb->prefix.'office_forms',
          array(
            'title' => $_POST['service_data-name'.$i],
            'office_id' => $office_id,
            'path' => $form['url'],
          ),
        );
      }
    }
    return $office;
  }catch(Exception $error){
    return $error;
  }
}

function submitBarangay() {
  try{
    $user = wp_get_current_user();

    $landmark_file = basename($_FILES["landmark_image"]["name"]);
    $landmark_image = null;

    if($landmark_file){
      $landmark_image = uploadFileSubmitted('landmark_image',false,'barangay/');
    }

    global $wpdb;
    $table_name = $wpdb->prefix.'barangays';
    $data = array(
      'title' => $_POST['title'],
      'address' => $_POST['address'],
      'contact_no' => $_POST['contact_no'],
      'population' => $_POST['population'],
      'land_area' => $_POST['land_area'],
      'description' => $_POST['description'],
    );
    if($_POST['id']){
      if($landmark_image){
        $data['landmark_img'] = $landmark_image['url'];
        $data['landmark_name'] = $_POST['landmark_name'];
      }
      $data_where = array('id' => $_POST['id']);
      $wpdb->update($table_name, $data, $data_where);
    }else{
      $data['landmark_name'] = $_POST['landmark_name'] ? $_POST['landmark_name'] : null;
      $data['landmark_img'] = $landmark_image ? $landmark_image['url'] : null;
      $wpdb->insert($table_name, $data);
    }

    $barangay_id = $wpdb->insert_id;

    if($_POST['officials_length'] > 0){
      for ($i=1; $i <= intval($_POST['officials_length']); $i++) {
        $official_file_name = 'barangay-official-image'.$i;
        $official_image = uploadFileSubmitted($official_file_name,false,'barangay-official');

        global $wpdb;
        $wpdb->insert(
          $wpdb->prefix.'barangay_officials',
          array(
            'name' => $_POST['barangay-official-name'.$i],
            'position' => $_POST['barangay-official-position'.$i],
            'barangay_id' => $barangay_id,
            'path' => $official_image['url'],
          ),
        );
      }
    }

    if($_POST['services_length'] > 0){
      for ($i=1; $i <= intval($_POST['services_length']); $i++) {
        $service_file_name = 'barangay-service-image'.$i;
        $service_image = uploadFileSubmitted($service_file_name,false,'barangay-service');

        global $wpdb;
        $wpdb->insert(
          $wpdb->prefix.'barangay_services',
          array(
            'title' => $_POST['barangay-service-title'.$i],
            'barangay_id' => $barangay_id,
            'path' => $service_image['url'],
          ),
        );
      }
    }
    
    return true;
  }catch(Exception $error){
    return $error;
  }
}

function submitBidReport() {
  try{
    $user = wp_get_current_user();
    $attachment = basename($_FILES["attachment"]["name"]);

    if($attachment){
      $temp = explode('.',basename($_FILES["attachment"]["name"]));
      $extension = end($temp);
      $file_name = time().'.'.$extension;
      $file = wp_upload_bits( $file_name, null, @file_get_contents( $_FILES['attachment']['tmp_name'] ) );

      global $wpdb;
      $report = $wpdb->insert(
        $wpdb->prefix.'bid_reports',
        array(
          'title' => $_POST['title'],
          'year' => $_POST['year'],
          'path' => $file['url'],
          'type' => $_POST['type'],
          'month' => $_POST['month'] ? $_POST['month'] : null,
        ),
      );
      return $file;
    }
  }catch(Exception $error){
    return $error;
  }
}

function uploadFileSubmitted($file_name,$is_post=true,$prefix=''){
  $upload_dir = wp_upload_dir();
  $temp = explode('.',basename($_FILES[$file_name]['name']));
  $extension = end($temp);
  $image_data = file_get_contents($_FILES[$file_name]['tmp_name'] );
      
  $name = $prefix.time().'.'.$extension;
  $file = null;
  if($is_post){
    $file = wp_mkdir_p($upload_dir['path']) ? $upload_dir['path'] . '/' . $name : $upload_dir['basedir'] . '/' . $name;
  }else{
    $file = wp_upload_bits( $name, null, @file_get_contents( $_FILES[$file_name]['tmp_name'] ) );
  }

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

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-report', array(
    'methods' => 'POST',
    'callback' => 'submitReport',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-posts', array(
    'methods' => 'GET',
    'callback' => 'fetchPosts',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-post', array(
    'methods' => 'GET',
    'callback' => 'fetchPost',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-reports', array(
    'methods' => 'GET',
    'callback' => 'fetchReports',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/get-bids', array(
    'methods' => 'GET',
    'callback' => 'fetchBids',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/remove-post-attachment', array(
    'methods' => 'POST',
    'callback' => 'removePostAttachment',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-bid-report', array(
    'methods' => 'POST',
    'callback' => 'submitBidReport',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-office', array(
    'methods' => 'POST',
    'callback' => 'submitOffice',
  ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/add-barangay', array(
    'methods' => 'POST',
    'callback' => 'submitBarangay',
  ) );
} );

