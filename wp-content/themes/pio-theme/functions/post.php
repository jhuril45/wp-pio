<?php
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
      $featured_image = strlen(basename($_FILES["featured_image"]["name"])) > 0 ? basename($_FILES["featured_image"]["name"]) : null;
      $attachments = [];
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
        $featured_image = uploadFileSubmitted('featured_image',true);
        $attachment_image = insertAttachment($featured_image,$post,true);
      }
      if($_POST['attachment_length'] > 0){
        for ($i=1; $i <= intval($_POST['attachment_length']); $i++) {
          $attachment_file = uploadFileSubmitted('attachment-'.$i,true);
          $attachment = insertAttachment($attachment_file,$post,$featured_image == null && $i == 1 ? true : false);
          
        }
      }
      return array(
        'success' => true,
        'id' => $post,
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
      $id = is_numeric($_POST['id']) ? intval($_POST['id']) : null;
      if ($id) {
        $attachment = wp_delete_attachment($_POST['id']);
      }
      return $attachment;
    }catch(Exception $error){
      return $error;
    }
  }
  
  function fetchPost($id=null) {
    try{
      $id = $id ? $id : $_GET['id'];
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

  function fetchPostCarousel($id=null){
    $id = is_numeric($id) ? intval($id) : null;
    if($id){
      $featured_image_url = get_the_post_thumbnail_url($id);
      $attachments = get_posts( array( 
        'post_type' => 'attachment',
        'post_mime_type'=>'image',
        'posts_per_page' => -1,
        'post_status' => 'published',
        'post_parent' => $id)
        );
      if ( $attachments ) {
        $arr = [];
        if($featured_image_url){
          array_push($arr,$featured_image_url);
        }
        foreach ( $attachments as $attachment ) {
          $src = wp_get_attachment_url( $attachment->ID, 'full');
          $mime = wp_get_attachment_metadata($attachment->ID);
          $type = wp_check_filetype($mime['file']);
          $attachment->mime_type = $type['type'];
          if($src != $featured_image_url){
            array_push($arr,$src);
          }
        }
        $attachments = $arr;
      }else{
        $attachment = new stdClass();
        $attachment->src = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
        array_push($attachments,$attachment);
      }
      return $attachments;
    }else{
      return [];
    }
  }

  function fetchOtherPosts($id=null,$term_id){
    $id = is_numeric($id) ? intval($id) : null;
    $term_id = is_numeric($term_id) ? intval($term_id) : null;
    if($id && $term_id){
      $data = get_posts( array( 
        'post_type' => 'post',
        'posts_per_page' => 5,
        'exclude' => array($id),
        'category' => $term_id,
        )
      );
      
      $recent_posts = [];
      foreach ($data as $key => $value) {
        $post_thumbnail_id = get_post_thumbnail_id($value->ID);
        if ( $post_thumbnail_id ) {
          $recent_src = wp_get_attachment_url( $post_thumbnail_id, 'full');
          $value->fimg_url = $recent_src;
        }else{
          $value->fimg_url = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
        }
        array_push($recent_posts,$value);
      }
      return $recent_posts;
    }else{
      return [];
    }
  }

  function insertAttachment($file,$post_id,$is_featured=false){
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $filename = basename($file);
    $attachment = array(
      'post_mime_type' => wp_check_filetype($filename, null )['type'],
      'post_title' => sanitize_file_name($filename),
      'post_content' => '',
      'post_status' => 'inherit'
    );
    
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
  
  
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2 = $is_featured ? set_post_thumbnail( $post_id, $attach_id ) : null;
    
    return $res2;
  }