<?php
function submitCarouselImage() {
  try{
    global $wpdb;
    $carousel_image = basename($_FILES["file"]["name"]);
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    $table_name = $wpdb->prefix . 'carousel_images';
    $data = array(
      'caption' => $_POST['caption'],
      'is_display' => true,
    );
    if($carousel_image){
      $file = uploadFileSubmitted('file',false,'carousel-image');
      $data['path'] = $file['url'];
      $data['url'] = $file['file'];
    }

    if($id){
      $data_where = array('id' => $id);
      $prev_image = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      // $data['placement_number'] = $_POST['placement_number'] ? $_POST['placement_number'] : $prev_image->placement_number;
      $image = $wpdb->update($table_name,$data,$data_where);
      if($carousel_image){
        if(isset($prev_image)){
          wp_delete_file($prev_image->url);
        }
      }
    }else{
      $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
      $data['placement_number'] = intval($count)+1;
      $image = $wpdb->insert($table_name,$data);
    }


    
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
    $table_name = $wpdb->prefix . 'carousel_images';
    $id = $_POST['id'];
    $image = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    
    // unlink($image['url']);
    $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
    if(isset($image)){
      wp_delete_file($image->url);
      return array( 'success' => true,'image' => $image->url);
    }
  }catch(Exception $error){
    return $error;
  }
}

function fetchCarouselImages() {
  try{
    $user = wp_get_current_user();
    global $wpdb;
    $table_name = $wpdb->prefix . "carousel_images";
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY placement_number ASC");
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
      if($_POST['id']){
        $featured_image_url = get_the_post_thumbnail_url($_POST['id']);
        
        $attachments = get_posts( array( 
          'post_type' => 'attachment',
          'post_mime_type'=>'image',
          'posts_per_page' => -1,
          'post_status' => 'published',
          'post_parent' => $_POST['id'])
        );
        foreach ( $attachments as $attachment ) {
          $src = wp_get_attachment_url( $attachment->ID, 'full');
          if($featured_image_url == $src){
            $attachment = wp_delete_attachment($attachment->ID);
          }
        }
      }
      $featured_image = uploadFileSubmitted('featured_image');
      $attachment_image = insertAttachment($featured_image,$post,true);
    }
    if($_POST['attachment_length'] > 0){
      for ($i=1; $i <= intval($_POST['attachment_length']); $i++) { 
        $attachment_file = uploadFileSubmitted('attachment-'.$i);
        $attachment = insertAttachment($attachment_file,$post,true);
      }
    }
    return array(
      'success' => true,
      'id' => $post,
    );
  }catch(Exception $error){
    return $error;
  }
}

function submitReport() {
  try{
    global $wpdb;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    $attachment = basename($_FILES["attachment"]["name"]);
    $table_name = $wpdb->prefix.'reports';

    $data = array(
      'title' => $_POST['title'],
      'year' => $_POST['year'],
      'type' => $_POST['type'],
      'quarter' => $_POST['quarter'] ? $_POST['quarter'] : null,
    );

    if($attachment){
      $file = uploadFileSubmitted('attachment',false,$_POST['title']);
      $data['path'] = $file['url'];
    }
    // $post = wp_insert_post(
    //   array(
    //     'ID' => $_POST['id'] ? $_POST['id'] : 0,
    //     'post_title' => $_POST['title'],
    //     'post_content' => '',
    //     'post_status' => 'publish',
    //     // 'post_category' => array($term->term_id),
    //     'post_type' => 'bids',
    //   )
    // );
    if($id){
      $data_where = array('id' => $_POST['id']);
      $report = $wpdb->update($table_name,$data,$data_where);
    }else{
      $report = $wpdb->insert($table_name,$data);
    }

    return $report;
  }catch(Exception $error){
    return $error;
  }
}

function deleteReport() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'reports';
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    if($id){
      $wpdb->delete( $table_name, array( 'id' => $id ) );
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function deleteBidReport() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'bid_reports';
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    if($id){
      $wpdb->delete( $table_name, array( 'id' => $id ) );
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function submitBidReport() {
  try{
    global $wpdb;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    $attachment = basename($_FILES["attachment"]["name"]);
    $table_name = $wpdb->prefix.'bid_reports';
    $data = array(
      'title' => $_POST['title'],
      'year' => $_POST['year'],
      'type' => $_POST['type'],
      'month' => $_POST['month'] ? $_POST['month'] : null,
    );
    if($attachment){
      $file = uploadFileSubmitted('attachment',false,$_POST['title']);
      $data['path'] = $file['url'];
    }
    if($id){
      $data_where = array('id' => $_POST['id']);
      $report = $wpdb->update($table_name,$data,$data_where);
    }else{
      $report = $wpdb->insert($table_name,$data);
    }
    return $report;
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
      $logo = uploadFileSubmitted('logo',false,'office');
    }

    if($org_file){
      $org_structure = uploadFileSubmitted('org_structure',false,'office');
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
    
    

    $office_id = $_POST['id'] ? intval($_POST['id']) : $wpdb->insert_id;

    if($_POST['services_length'] > 0){
      for ($i=1; $i <= intval($_POST['services_length']); $i++) {
        $service_image = 'service_data-image'.$i;
        if(strlen(basename($_FILES[$service_image]['name'])) > 0){
          $service = uploadFileSubmitted($service_image,false,$_POST['service_data-name'.$i]);
          if(!$service['error']){
            global $wpdb;
            $wpdb->insert(
              $wpdb->prefix.'office_services',
              array(
                'title' => $_POST['service_data-name'.$i],
                'office_id' => $office_id,
                'path' => $service['url'],
              ),
            );
          }else{
            return $service;
          }
          
        }
      }
    }

    if($_POST['forms_length'] > 0){
      for ($i=1; $i <= intval($_POST['forms_length']); $i++) {
        $form_file_name = 'form_data-file'.$i;
        if(strlen(basename($_FILES[$form_file_name]['name'])) > 0){
          $form = uploadFileSubmitted($form_file_name,false,$_POST['form_data-name'.$i]);

          global $wpdb;
          $wpdb->insert(
            $wpdb->prefix.'office_forms',
            array(
              'title' => $_POST['form_data-name'.$i],
              'office_id' => $office_id,
              'path' => $form['url'],
            ),
          );
        }
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

    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    
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
    if($id){
      if($landmark_image){
        $data['landmark_img'] = $landmark_image['url'];
        $data['landmark_name'] = $_POST['landmark_name'];
      }
      $data_where = array('id' => $id);
      $wpdb->update($table_name, $data, $data_where);
    }else{
      $data['landmark_name'] = $_POST['landmark_name'] ? $_POST['landmark_name'] : null;
      $data['landmark_img'] = $landmark_image ? $landmark_image['url'] : null;
      $wpdb->insert($table_name, $data);
    }

    $barangay_id = $id ? $id : $wpdb->insert_id;

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

function submitTourism() {
  try{
    $user = wp_get_current_user();

    $tourism_file = basename($_FILES["img"]["name"]);
    $tourism_image = null;
    $id = (int)$_POST['id'];

    if($tourism_file){
      $tourism_image = uploadFileSubmitted('img',false,'tourism/');
    }

    global $wpdb;
    $table_name = $wpdb->prefix.'city_tourism';
    $data = array(
      'title' => $_POST['title'],
      'type' => $_POST['type'],
      'description' => $_POST['description'],
      'address' => $_POST['address'],
      'contact_no' => $_POST['contact_no'],
      'map_link' => $_POST['map_link'],
    );
    if($_POST['id']){
      if($tourism_image){
        $data['path'] = $tourism_image['url'];
      }
      $data_where = array('id' => $_POST['id']);
      $wpdb->update($table_name, $data, $data_where);
    }else{
      $data['path'] = $tourism_image ? $tourism_image['url'] : null;
      $wpdb->insert($table_name, $data);
      $id = $wpdb->insert_id;
    }

    
    return array(
      'success' => true,
      'id' => $id,
    );
  }catch(Exception $error){
    return $error;
  }
}

function removeTourism() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'city_tourism';
    $id = $_POST['id'];
    $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function removeOfficeAttachment() {
  try{
    global $wpdb;
    $name = $_POST['type'] == 'service' ? 'office_services' : 'office_forms';
    $table_name = $wpdb->prefix.$name;
    $id = $_POST['id'];
    $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function removeBarangay() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'barangays';
    $table_name2 = $wpdb->prefix.'barangay_services';
    $table_name3 = $wpdb->prefix.'barangay_officials';
    $id = $_POST['id'];
    $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
    $wpdb->delete( $table_name2, array( 'barangay_id' => intval($id) ) );
    $wpdb->delete( $table_name3, array( 'barangay_id' => intval($id) ) );
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function removeBarangayAttachment() {
  try{
    global $wpdb;
    $name = $_POST['type'] == 'service' ? 'barangay_services' : 'barangay_forms';
    $table_name = $wpdb->prefix.$name;
    $id = $_POST['id'];
    $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
    return array( 'success' => true);
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
  $res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
  $res2 = $is_featured ? set_post_thumbnail( $post_id, $attach_id ) : null;
  
  return $res2;
}