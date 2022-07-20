<?php
$featured_image_url = get_the_post_thumbnail_url($post->ID);
$post_date = date('F d Y, l  h:i A',strtotime($post->post_date));
$term = get_term_by('name', 'News', 'category');

$fetched_post = fetchPost($post->ID);
$attachments = fetchPostCarousel($post->ID);
$recent_posts = fetchOtherPosts($post->ID,$term->term_id,5);
?>

<div class="row" :class="<?php echo(count($recent_posts))?> > 0 ? 'justify-end' : 'justify-center'">
  <div class="col-md-7 col-12" :class="$q.screen.lt.sm ? 'q-py-sm q-px-md' : 'q-py-lg q-px-xl'">
    <q-card flat :class="$q.screen.lt.sm ? '' : ''">
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
          ref="carousel"
          infinite
          :autoplay="false"
          :padding="true"
          height="300px">
          <?php for ( $index = 0 ; $index < count($attachments) ; $index++ ) {?>
            <q-carousel-slide
              class="q-pa-none carousel-img cursor-pointer"
              :name="<?php echo $index+1;?>"
              img-src="<?php echo $attachments[$index]?>"
              @click="post_attachments=true">
            </q-carousel-slide>
          <?php }?>
          <template v-slot:control v-if="<?php echo(count($attachments))?> > 1">
            <q-carousel-control
              position="bottom-right"
              :offset="[18, 18]"
              class="q-gutter-xs">
              <q-btn
                push round dense color="primary" text-color="white" icon="arrow_left"
                @click="$refs.carousel.previous()"
              ></q-btn>
              <q-btn
                push round dense color="primary" text-color="white" icon="arrow_right"
                @click="$refs.carousel.next()"
              ></q-btn>
            </q-carousel-control>
          </template>
        </q-carousel>
      </q-card-section>

      <q-card-section class="q-pt-none">
        <div class="post-content">
          <?php echo $post->post_content;?>
        </div>
      </q-card-section>
    </q-card>
  </div>
  <div class="col-md-3 col-12 q-py-lg q-px-md" v-if="<?php echo(count($recent_posts))?> > 0">
    <div class="text-h6 q-my-md">
      NEWS ARTICLES
    </div>
    <?php
      foreach($recent_posts as $key => $value) { ?>
      <div class="col-12 row q-gutter-y-sm">
        <div class="col-12 q-pt-md">
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