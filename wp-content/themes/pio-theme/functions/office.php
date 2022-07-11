<?php
function fetchOffices($id=null,$is_post = false) {
  // return $is_post;
  global $wpdb;
  $table_name = $wpdb->prefix . "offices";
  $id = is_numeric($id) ? intval($id) : null;
  if(isset($id)){
    $office = $is_post ? $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $id") : $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    if(empty($office)){
      return null;
    }
    $office->services = fetchOfficeServices($office->id);
    $office->forms = fetchOfficeForms($office->id);
    if($office->facebook){
      $office->messenger = explode('www.facebook.com/',$office->facebook)[1];
    }
    return $office;
  }else{
    $offices = $wpdb->get_results("SELECT * FROM $table_name");
    return $offices;
  }
}

function getOffices() {
  global $wpdb;
  $table_name = $wpdb->prefix . "offices";
  $offices = $wpdb->get_results("SELECT * FROM $table_name");
  return $offices;
}

function submitOffice() {
  try{
    // return 1;
    $user = wp_get_current_user();
    $logo_file = basename($_FILES["logo"]["name"]);
    $org_file = basename($_FILES["org_structure"]["name"]);
    $logo = null;
    $org_structure = null;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    
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
    if($id){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      if($logo){
        $data['logo'] = $logo['url'];
        $data['logo_url'] = $logo['file'];
      }
      if($org_structure){
        $data['org_structure'] = $org_structure['url'];
        $data['org_structure_url'] = $org_structure['file'];
      }
      // return $table_name;
      $data_where = array('id' => $id);
      $wpdb->update($table_name , $data, $data_where);
      if($logo){
        if(isset($prev)){
          wp_delete_file($prev->logo_url);
        }
      }
      if($org_structure){
        if(isset($prev)){
          wp_delete_file($prev->org_structure_url);
        }
      }
    }else{
      $data['logo'] = $logo ? $logo['url'] : null;
      $data['logo_url'] = $logo ? $logo['file'] : null;
      $data['org_structure'] = $org_structure ? $org_structure['url'] : null;
      $data['org_structure_url'] = $org_structure ? $org_structure['file'] : null;
      
      $term = get_term_by('name', 'Offices', 'category');
      $post = insertCustomPost($data,$term->term_id);
      $data['post_id'] = $post;

      $office = $wpdb->insert(
        $table_name,
        $data,
      );
    }
    
    

    $office_id = $id ? intval($id) : $wpdb->insert_id;

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
                'url' => $service['file'],
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
              'url' => $form['file'],
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

function removeOffice() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'offices';
    $table_name2 = $wpdb->prefix.'office_services';
    $table_name3 = $wpdb->prefix.'office_forms';
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;

    if(isset($id)){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      $services = $wpdb->get_results("SELECT * FROM $table_name2 WHERE office_id = $id");
      $forms = $wpdb->get_results("SELECT * FROM $table_name3 WHERE office_id = $id");
      
      $wpdb->delete( $table_name, array( 'id' => intval($id)));
      $wpdb->delete( $table_name2, array( 'office_id' => intval($id)));
      $wpdb->delete( $table_name3, array( 'office_id' => intval($id)));

      if(isset($prev)){
        $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
        wp_delete_file($prev->url);
      }
      foreach ($services as $key => $value) {
        wp_delete_file($value->url);
      }
      foreach ($forms as $key => $value) {
        wp_delete_file($value->url);
      }
      if(isset($prev->post_id)){
        wp_delete_post($prev->post_id);
      }
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function fetchOfficeServices($office_id) {
  global $wpdb;
  $table_name = $wpdb->prefix . "office_services";
  $services = $wpdb->get_results("SELECT * FROM $table_name WHERE office_id = $office_id");
  return $services;
}

function fetchOfficeForms($office_id) {
  global $wpdb;
  $table_name = $wpdb->prefix . "office_forms";
  $forms = $wpdb->get_results("SELECT * FROM $table_name WHERE office_id = $office_id");
  return $forms;
}

function removeOfficeAttachment() {
  try{
    global $wpdb;
    $name = $_POST['type'] == 'service' ? 'office_services' : 'office_forms';
    $table_name = $wpdb->prefix.$name;
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    
    if(isset($id)){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      if(isset($prev)){
        $wpdb->delete( $table_name, array( 'id' => intval($id) ) );
        wp_delete_file($prev->url);
      }
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}