<?php
function fetchProcurementMonitoring($id=null,$is_post = false) {
  // return $is_post;
  global $wpdb;
  $table_name = $wpdb->prefix . "procurement_monitoring_reports";
  $id = is_numeric($id) ? intval($id) : null;
  if(isset($id)){
    $procurement_monitoring_report = $is_post ? $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $id") : $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
    if(empty($procurement_monitoring_report)){
      return null;
    }
    $procurement_monitoring_report->attachments = fetchProcurementMonitoringAttachments($procurement_monitoring_report->id);
    return $procurement_monitoring_report;
  }else{
    $procurement_monitoring_reports = $wpdb->get_results("SELECT * FROM $table_name");
    foreach ($procurement_monitoring_reports as $key => $value) {
      $value->attachments = fetchProcurementMonitoringAttachments($value->id);
      // array_push($arr,$key);
    }
    return $procurement_monitoring_reports;
  }
}

function getProcurementMonitoring() {
  global $wpdb;
  $table_name = $wpdb->prefix . "offices";
  $offices = $wpdb->get_results("SELECT * FROM $table_name");
  return $offices;
}

function submitProcurementMonitoring() {
  try{
    $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
    
    global $wpdb;
    $table_name = $wpdb->prefix.'procurement_monitoring_reports';
    $data = array(
      'title' => $_POST['title'],
      'year' => $_POST['year'],
      'quarter' => $_POST['quarter'],
    );
    if($id){
      $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      // return $table_name;
      $data_where = array('id' => $id);
      $wpdb->update($table_name , $data, $data_where);
    }else{
      $office = $wpdb->insert(
        $table_name,
        $data,
      );
    }
    
    

    $procurement_monitoring_report_id = $id ? intval($id) : $wpdb->insert_id;
    if($_POST['attachment_length'] > 0){
      for ($i=1; $i <= intval($_POST['attachment_length']); $i++) {
        $attachment_file = 'attachment_data-file'.$i;
        if(strlen(basename($_FILES[$attachment_file]['name'])) > 0){
          $attachment = uploadFileSubmitted($attachment_file,false,$_POST['attachment_data-title'.$i]);
          if(!$attachment['error']){
            global $wpdb;
            $wpdb->insert(
              $wpdb->prefix.'procurement_monitoring_report_attachments',
              array(
                'title' => $_POST['attachment_data-title'.$i],
                'procurement_monitoring_report_id' => $procurement_monitoring_report_id,
                'path' => $attachment['url'],
                'url' => $attachment['file'],
              ),
            );
          }else{
            return $attachment;
          }
          
        }
      }
    }
    return $procurement_monitoring_report_id;
  }catch(Exception $error){
    return $error;
  }
}

function removeProcurementMonitoring() {
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
    }
    return array( 'success' => true);
  }catch(Exception $error){
    return $error;
  }
}

function fetchProcurementMonitoringAttachments($id) {
  global $wpdb;
  $table_name = $wpdb->prefix . "procurement_monitoring_report_attachments";
  $attachments = $wpdb->get_results("SELECT * FROM $table_name WHERE procurement_monitoring_report_id = $id");
  return $attachments;
}

function removeProcurementMonitoringAttachment() {
  try{
    global $wpdb;
    $table_name = $wpdb->prefix.'procurement_monitoring_report_attachments';
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