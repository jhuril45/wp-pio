<?php
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
        $data['url'] = $file['file'];
      }
      if($id){
        $data_where = array('id' => $_POST['id']);
        $prev = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
        $report = $wpdb->update($table_name,$data,$data_where);
        if($attachment){
          if(isset($prev)){
            wp_delete_file($prev->url);
          }
        }
      }else{
        $data['created_at'] = date("Y-m-d h:i:sa");
        // $term = get_term_by('name', 'Reports', 'category');
        // $post = wp_insert_post(
        //   array(
        //     'post_title' => $_POST['title'],
        //     'post_content' => $_POST['title'],
        //     'post_status' => 'publish',
        //     'post_category' => array($term->term_id),
        //   )
        // );
        // $data['post_id'] = $post;
        $report = $wpdb->insert($table_name,$data);
      }
      return $report;
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
        $report = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
        $wpdb->delete( $table_name, array( 'id' => $id ) );
        if(isset($report)){
          wp_delete_file($report->url);
        }
      }
      return array( 'success' => true);
    }catch(Exception $error){
      return $error;
    }
  }