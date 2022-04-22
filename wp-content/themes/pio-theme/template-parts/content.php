<?php
  $featured_image_url = get_the_post_thumbnail_url($post->ID);
  $post_date = date('d F Y l / h:i A',strtotime($post->post_date));
  $attachments = get_posts( array( 
    'post_type' => 'attachment',
    'post_mime_type'=>'image',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'post_parent' => $post->ID)
    );
  // var_dump($attachments);
  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
      $mime = wp_get_attachment_metadata($attachment->ID);
      $type = wp_check_filetype($mime['file']);
      $attachment->mime_type = $type['type'];
      $attachment->src = $src;
    }
  }
?>
<div class="row justify-center">
  <div class="col-md-12 col-12 q-px-xl">
    <div>
      <q-carousel
        animated
        v-model="slide"
        infinite
        :autoplay="false"
      >
        <?php for ( $index = 0 ; $index < count($attachments) ; $index++ ) {?>
          <q-carousel-slide
            :name="<?php echo $index+1;?>">
            <q-img cover height="100%" width="100%" src="<?php echo $attachments[$index]->src?>"></q-img>
          </q-carousel-slide>
        <?php }?>
      </q-carousel>
    </div>
    <div class="post-title q-mt-md">
      <?php echo $post->post_title;?>
    </div>
    <div class="post-time-stamp">
      <?php echo $post_date;?>
    </div>
    
    <div class="post-content">
      <?php echo $post->post_content;?>
    </div>
  </div>
</div>