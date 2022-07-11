<?php
  function fetchTourism($is_place=true,$id=null,$all=false) {
    global $wpdb;
    $id = is_numeric($id) ? intval($id) : null;
    if($all){
      $table_name = $wpdb->prefix . "city_tourism";
      $arr = $wpdb->get_results("SELECT * FROM $table_name");
    }
    else if($id){
      $table_name = $wpdb->prefix . "city_tourism";
      $tourism = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      return $tourism;
    }
    else if($is_place){
      $table_name = $wpdb->prefix . "city_tourism";
      $arr = $wpdb->get_results("SELECT * FROM $table_name WHERE type = 2");
    }else{
      $table_name = $wpdb->prefix . "city_tourism";
      $arr = $wpdb->get_results("SELECT * FROM $table_name WHERE type = 1");
    }
    return $arr;
  }

  function fetchPostTourism($id){
    $id = is_numeric($id) ? intval($id) : null;
    if($id){
      global $wpdb;
      $table_name = $wpdb->prefix . "city_tourism";
      $tourism = $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $id");
      return $tourism;
    }
  }
  
  function submitTourism() {
    try{
      $user = wp_get_current_user();

      $tourism_file = basename($_FILES["img"]["name"]);
      $tourism_image = null;
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;

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
      if(isset($id)){
        if($tourism_image){
          $data['path'] = $tourism_image['url'];
          $data['url'] = $tourism_image['file'];
        }
        $data_where = array('id' => $_POST['id']);
        $wpdb->update($table_name, $data, $data_where);
      }else{
        $data['path'] = $tourism_image ? $tourism_image['url'] : null;
        $data['url'] = $tourism_image ? $tourism_image['file'] : null;

        $term = get_term_by('name', 'Tourism', 'category');
        $post = insertCustomPost($data,$term->term_id);
        $data['post_id'] = $post;

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
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      if(isset($id)){
        $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
        if(isset($prev)){
          $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
          wp_delete_file($prev->url);
          if(isset($prev->post_id)){
            wp_delete_post($prev->post_id);
          }
        }
      }
      return array( 'success' => true);
    }catch(Exception $error){
      return $error;
    }
  }