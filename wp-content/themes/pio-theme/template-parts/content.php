<?php
  $featured_image_url = get_the_post_thumbnail_url($post->ID);
  $post_date = date('F d Y, l  h:i A',strtotime($post->post_date));
  $attachments = get_posts( array( 
    'post_type' => 'attachment',
    'post_mime_type'=>'image',
    'posts_per_page' => -1,
    'post_status' => 'published',
    'post_parent' => $post->ID)
    );
  // var_dump($post);
  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
      $mime = wp_get_attachment_metadata($attachment->ID);
      $type = wp_check_filetype($mime['file']);
      $attachment->mime_type = $type['type'];
      $attachment->src = $src;
    }
  }

  $data = get_posts( array( 
    'post_type' => 'post',
    'posts_per_page' => 1,
    'exclude' => array($post->ID),
    )
  );
  $recent_posts = [];
  foreach ($data as $key => $value) {
    $post_thumbnail_id = get_post_thumbnail_id($value->ID);
    if ( $post_thumbnail_id ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
      $recent_src = wp_get_attachment_url( $post_thumbnail_id, 'full');
      $value->fimg_url = $recent_src;
    }else{
      $value->fimg_url = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
    }
    array_push($recent_posts,$value);
  }
?>
<div class="row justify-center">
  <div class="col-md-8 col-12 q-py-lg q-px-md">
    <q-card>
      <q-card-section class="">
        <div class="post-title">
          <?php echo $post->post_title;?>
        </div>
        <div class="post-time-stamp">
          <?php echo $post_date;?>
        </div>
      </q-card-section>

      <q-card-section class="q-py-none">
        <q-carousel
          animated
          v-model="slide"
          infinite
          :autoplay="false"
          :padding="false"
          :arrows="Boolean(<?php echo(count($attachments) > 1);?>)"
          control-color="primary"
        >
          <?php for ( $index = 0 ; $index < count($attachments) ; $index++ ) {?>
            <q-carousel-slide
              class="q-pa-none carousel-img"
              :name="<?php echo $index+1;?>"
              img-src="<?php echo $attachments[$index]->src?>">
            </q-carousel-slide>
          <?php }?>
        </q-carousel>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="post-content">
          <?php echo $post->post_content;?>
        </div>
      </q-card-section>
    </q-card>
  </div>
  <div class="col-md-4 col-12 q-py-lg q-px-md" v-if="<?php echo(count($recent_posts))?> > 0">
    <?php
      foreach($recent_posts as $key => $value) { ?>
      <div class="col-12 row q-gutter-y-sm">
        <div class="col-12">
          <q-card class="news-card" >
            <a href="<?php echo($value->guid);?>">
              <q-img
                cover
                height="200px"
                src="<?php echo($value->fimg_url);?>"
                basic
              >
                <div class="absolute-bottom text-caption text-start">
                  <q-item-label lines="3" class="q-px-none q-py-none">
                    <?php echo $value->post_title?>
                  </q-item-label>
                </div>
              </q-img>
            </a>
          </q-card>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</div>