<?php
  function fetchFlipCards() {
    try{
      $user = wp_get_current_user();
      global $wpdb;
      $table_name = $wpdb->prefix . "flip_cards";
      $results = $wpdb->get_results("SELECT * FROM $table_name");
      return $results;
    }catch(Exception $error){
      return $error;
    }
  }

  function submitFlipCard() {
    try{
      global $wpdb;
      $image = basename($_FILES["image"]["name"]);
      $icon = basename($_FILES["icon"]["name"]);
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      $table_name = $wpdb->prefix . 'flip_cards';

      $data = array(
        'title' => $_POST['title'],
        'description' => $_POST['description'],
      );
      if($image){
        $file = uploadFileSubmitted('image',false,'flip_card');
        $data['image_path'] = $file['url'];
        $data['image_url'] = $file['file'];
      }

      if($icon){
        $icon = uploadFileSubmitted('icon',false,'flip_card');
        $data['icon_path'] = $icon['url'];
        $data['icon_url'] = $icon['file'];
      }

      if($id){
        $data_where = array('id' => $id);
        $prev_image = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
        // $data['placement_number'] = $_POST['placement_number'] ? $_POST['placement_number'] : $prev_image->placement_number;
        $flip_card = $wpdb->update($table_name,$data,$data_where);
        if($image){
          if(isset($prev_image)){
            wp_delete_file($prev_image->image_url);
          }
        }
        if($icon){
          if(isset($prev_image)){
            wp_delete_file($prev_image->icon_url);
          }
        }
      }else{
        $flip_card = $wpdb->insert($table_name,$data);
      }


      
    }catch(Exception $error){
      return $error;
    }
  }

  function deleteFlipCard() {
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