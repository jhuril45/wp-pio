<?php
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
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      $image = isset($id) ? $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id") : null;

      // unlink($image['url']);
      if(isset($image)){
        $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
        wp_delete_file($image->url);
        $images = $wpdb->get_results("SELECT * FROM $table_name ORDER BY placement_number ASC");
        foreach ($images as $key => $value) {
          if($value->placement_number != 1){
            $data_where = array('id' => $value->id);
            $data = array(
              'placement_number' => $value->placement_number-1,
            );
            $wpdb->update($table_name,$data,$data_where);
          }
        }
        return array( 'success' => true,'image' => $image->url);
      }
    }catch(Exception $error){
      return $error;
    }
  }

  function addHeaderDetails() {
    global $wpdb;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    $table_name = $wpdb->prefix . 'landing_details';
    $header = $wpdb->get_row("SELECT * FROM $table_name");

    $data = array(
      'facebook_page' => $_POST['facebook_page'],
      'twitter_page' => $_POST['twitter_page'],
      'messenger_page' => $_POST['messenger_page'],
      'youtube_id' => $_POST['youtube_id'],
    );
    if(empty($header)){
      $wpdb->insert(
        $table_name,
        $data,
      );
    }else{
      $data_where = array('id' => $header->id);
      $wpdb->update($table_name , $data, $data_where);
    }
    return $data;
  }

  function getLandingDetails() {
    global $wpdb;
    $landing_details = $wpdb->prefix . 'landing_details';
    $header = $wpdb->get_row("SELECT * FROM $landing_details");
    $data = array(
      'facebook_page' => '',
      'twitter_page' => '',
      'messenger_page' => '',
      'youtube_id' => '',
    );
    if(isset($header)){
      $data['facebook_page'] = $header->facebook_page;
      $data['twitter_page'] = $header->twitter_page;
      $data['messenger_page'] = $header->messenger_page;
      $data['youtube_id'] = $header->youtube_id;
    }

    return $data;
  }