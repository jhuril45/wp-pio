<?php
function fetchBarangays($id=null,$is_edit=false,$is_post = false){
  $id = is_numeric($id) ? intval($id) : null;
  if($id){
    global $wpdb;
    $table_name = $wpdb->prefix . "barangays";
    $barangay = $is_post ? $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $id") : $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    if(empty($barangay)){
      return null;
    }
    $officials = getBarangayOfficials($barangay->id);
    $barangay->services = getBarangayServices($barangay->id);
    if($is_edit){
      $barangay->officials = $officials;
    }else{
      $barangay->official_list = array(
        'kagawad' => [],
        'sk_kagawad' => [],
      );
      foreach ($officials as $key => $value) {
        if($value->position == 'Kagawad'){
          array_push($barangay->official_list[strtolower($value->position)],$value);
        }
        else if($value->position == 'SK Kagawad'){
          array_push($barangay->official_list['sk_kagawad'],$value);
        }
        else if($value->position == 'SK Chairman'){
          $barangay->official_list['sk_chairman'] = $value;
        }
        else{
          $barangay->official_list[strtolower($value->position)] = $value;
        }
      }
    }
    
    return $barangay;
  }else{
    global $wpdb;
    $table_name = $wpdb->prefix . "barangays";
    $table_name2 = $wpdb->prefix . "barangay_officials";
    $barangays = $wpdb->get_results("
    SELECT * FROM $table_name as barangay 
    LEFT JOIN $table_name2 as barangay_officials 
    ON barangay.id = barangay_officials.barangay_id 
    WHERE barangay_officials.position = 'Chairman'
    ");
    return $barangays;
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
        $data['landmark_img_url'] = $landmark_image['file'];
      }
      $data_where = array('id' => $id);
      $wpdb->update($table_name, $data, $data_where);
    }else{
      $data['landmark_name'] = $_POST['landmark_name'] ? $_POST['landmark_name'] : null;
      $data['landmark_img'] = $landmark_image ? $landmark_image['url'] : null;
      $data['landmark_img_url'] = $landmark_image ? $landmark_image['file'] : null;

      $term = get_term_by('name', 'Barangay', 'category');
      $post = insertCustomPost($data,$term->term_id);
      $data['post_id'] = $post;
      
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
            'url' => $official_image['file'],
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
            'url' => $service_image['file'],
          ),
        );
      }
    }
    
    return true;
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
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;

    if(isset($id)){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      $services = $wpdb->get_results("SELECT * FROM $table_name2 WHERE barangay_id = $id");
      $officials = $wpdb->get_results("SELECT * FROM $table_name3 WHERE barangay_id = $id");
      
      $wpdb->delete( $table_name, array( 'id' => $id));
      $wpdb->delete( $table_name2, array( 'barangay_id' => $id));
      $wpdb->delete( $table_name3, array( 'barangay_id' => $id));

      if(isset($prev)){
        $wpdb->delete( $table_name, array( 'id' => $id ) );
        wp_delete_file($prev->landmark_img_url);
      }
      foreach ($services as $key => $value) {
        wp_delete_file($value->url);
      }
      foreach ($officials as $key => $value) {
        wp_delete_file($value->url);
      }
      if(isset($prev->post_id)){
        wp_delete_post($prev->post_id);
      }
    }

    $wpdb->delete( $table_name, array( 'id' => $id ) );
    $wpdb->delete( $table_name2, array( 'barangay_id' => $id ) );
    $wpdb->delete( $table_name3, array( 'barangay_id' => $id ) );
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function removeBarangayAttachment() {
  try{
    global $wpdb;
    $name = $_POST['type'] == 'service' ? 'barangay_services' : 'barangay_officials';
    $table_name = $wpdb->prefix.$name;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    
    if(isset($id)){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      if(isset($prev)){
        $wpdb->delete( $table_name, array( 'id' => $id ) );
        wp_delete_file($prev->url);
      }
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function getBarangayOfficials($barangay_id) {
  global $wpdb;
  $table_name = $wpdb->prefix . "barangay_officials";
  $services = $wpdb->get_results("SELECT * FROM $table_name WHERE barangay_id = $barangay_id");
  return $services;
}

function getBarangayServices($barangay_id) {
  global $wpdb;
  $table_name = $wpdb->prefix . "barangay_services";
  $services = $wpdb->get_results("SELECT * FROM $table_name WHERE barangay_id = $barangay_id");
  return $services;
}