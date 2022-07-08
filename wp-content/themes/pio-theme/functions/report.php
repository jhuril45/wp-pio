<?php
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
  
  function deleteReport() {
    try{
      global $wpdb;
      $table_name = $wpdb->prefix.'reports';
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

  function getReport($id,$is_bid=false,$is_post=false) {
    global $wpdb;
    $id = is_numeric($id) ? intval($id) : null;
    if($id){
      $table_name = $wpdb->prefix . ($is_bid  ? 'bid_reports' : 'reports');
      $report = $is_post ? $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $id") : $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id");
      
      if(empty($report)){
        return null;
      }
      return $report;
    }else{
      return null;
    }
  }

  function paginateReports() {
    try{
      // $term = get_term_by('name', 'News', 'category');
      // $args = array(
      //   'post_type'=>'post',
      //   'posts_per_page' => $_POST['rows'],
      //   'paged' => $_POST['page'],
      //   'cat' => $term->term_id,
      // );
      // if($_POST['user_id']){
      //   $args['author'] = intval($_POST['user_id']);
      // }
      // if($_POST['search']){
      //   $args['s'] = $_POST['search'];
      // }
      // $query = new WP_Query($args);
      // // $data = get_posts($args);
      // $data = $query->posts;
      // $posts = [];
      // foreach ($data as $key => $value) {
      //   $post_thumbnail_id = get_post_thumbnail_id($value->ID);
      //   if ( $post_thumbnail_id ) {
      //     $recent_src = wp_get_attachment_url( $post_thumbnail_id, 'full');
      //     $value->fimg_url = $recent_src;
      //   }else{
      //     $value->fimg_url = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
      //   }
      //   array_push($posts,$value);
      // }
      return array(
        'posts' => $posts,
        'max_num_pages' => $query->max_num_pages,
        'count' => $query->found_posts,
        'page_number' => $query->query['paged'],
        'query' => $query,
      );

    }catch(Exception $error){
      return $error;
    }
  }