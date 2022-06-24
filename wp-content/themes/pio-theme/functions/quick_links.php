<?php
  function fetchQuickLinks() {
    try{
      $user = wp_get_current_user();
      global $wpdb;
      $table_name = $wpdb->prefix . "quick_links";
      $results = $wpdb->get_results("SELECT * FROM $table_name");
      return $results;
    }catch(Exception $error){
      return $error;
    }
  }

  function submitQuickLink() {
    try{
      global $wpdb;
      $image = basename($_FILES["image"]["name"]);
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      $table_name = $wpdb->prefix . 'quick_links';

      $data = array(
        'link' => $_POST['link'],
      );
      if($image){
        $file = uploadFileSubmitted('image',false,'quick_link');
        $data['path'] = $file['url'];
        $data['url'] = $file['file'];
      }

      if($id){
        $data_where = array('id' => $id);
        $prev_image = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
        // $data['placement_number'] = $_POST['placement_number'] ? $_POST['placement_number'] : $prev_image->placement_number;
        $flip_card = $wpdb->update($table_name,$data,$data_where);
        if($image){
          if(isset($prev_image)){
            wp_delete_file($prev_image->url);
          }
        }
      }else{
        $flip_card = $wpdb->insert($table_name,$data);
      }


      
    }catch(Exception $error){
      return $error;
    }
  }

  function deleteQuickLink() {
    try{
      global $wpdb;
      $table_name = $wpdb->prefix . 'quick_links';
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      $quick = isset($id) ? $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id") : null;

      if(isset($quick)){
        $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
        wp_delete_file($quick->url);
        return array( 'success' => true);
      }
    }catch(Exception $error){
      return $error;
    }
  }