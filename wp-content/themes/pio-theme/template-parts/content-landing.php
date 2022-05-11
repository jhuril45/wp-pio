<?php 
$carousel_images = fetchCarouselImages();

$data = get_posts( array( 
  'post_type' => 'post',
  'posts_per_page' => 5,
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
<div class="full-width">
  <q-carousel
    animated
    v-model="slide"
    ref="carousel"
    height="400px"
    infinite
  >
    <?php 
      if($carousel_images){
      $index = 1;
      foreach ($carousel_images as $key => $value) {
    ?>
    <q-carousel-slide class="q-pa-none" :name="<?php echo $index?>">
      <img
        src="<?php echo($value->path); ?>"
        style="max-height:100%;width:100%;height:90%">
    </q-carousel-slide>
    <?php 
        $index = $index + 1;
      }
    }else{
    ?>
    <q-carousel-slide class="q-pa-none" :name="1">
      <img
        src="<?php echo get_template_directory_uri().'/assets/images/ButuanOnDesign.png'; ?>"
        style="max-height:100%;width:100%;height:90%">
    </q-carousel-slide>
    <?php 
    }
    ?>
    <template v-slot:control v-if="Boolean(<?php echo(count($carousel_images) > 1);?>)">
      <q-carousel-control
        position="bottom-right"
        :offset="[18, 18]"
        class="q-gutter-xs"
      >
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
</div>

<div class="full-width row justify-start q-my-md" :class="$q.screen.lt.sm ? 'q-px-md' : 'q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    PLANS AND PROGRAMS
  </div>
  <div
    class="col-12 col-md-3 col-sm-6 q-pa-xs q-pt-md"
    v-for="(flip,index) in flip_cards"
    :key="'flip-card-'+index">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front rounded-borders" :class="flip.class_front ? flip.class_front : ''">
          <div class="fit row justify-center items-center">
            <div class="col-12 text-center">
              <q-icon :name="flip.icon" size="60px"></q-icon>
              <p class="text-h6">
                {{flip.title}}
              </p>
            </div>
          </div>
        </div>
        <div class="flip-card-back rounded-borders" :class="flip.class_back ? flip.class_back : ''">
          <div class="fit row items-center">
            <div class="text-white text-center q-px-sm">
              <p>{{flip.description}}</p>
              <q-btn
                rounded
                color="primary"
                label="View More"
                @click="page_dialog.data=flip;tab='description';page_dialog.open=true"
                text-color="white"
                outline></q-btn>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="full-width row justify-center bg-primary" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-lg'">
  <div class="col-md-8 col-12 q-py-md text-white text-center q-px-md" :class="$q.screen.lt.sm ? 'q-px-sm' : ''">
    <div :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
      ButuanOn News Update Noon Time Cast
    </div>
    <div class="q-mb-md" :class="$q.screen.lt.sm ? 'text-body2' : 'text-body1'">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, minus tempora nemo quia consectetur totam iste eius officiis quo nulla vitae et eveniet laborum voluptas in? Unde facilis praesentium iusto?
    </div>
    <q-video
      style="height:400px;"
      src="https://www.youtube.com/embed/YmBY9yNfNos"
    />
  </div>
  <div class="col-md-4 col-12 q-py-md text-white text-center q-px-md" :class="$q.screen.lt.sm ? 'q-px-sm' : ''">
    <div class="q-py-lg">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbutuancitypioofficial&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
      </iframe>
    </div>
  </div>
</div>

<div class="full-width">
  <div class="row relative-position">
    <q-img cover src="<?php echo get_template_directory_uri().'/assets/images/city-hall-drone.png'; ?>" height="500px">
      <div class="absolute-left full-width row justify-end" style="background:none !important;">
        <div class="col-12 col-md-6 rounded-borders q-pa-lg q-my-lg" style="background: rgba(79, 195, 247, 0.8)">
          <div class="text-h4 text-white text-start">DEPARTMENTS & OFFICES</div>
          <div class="text-subtitle2 text-white text-start q-mt-md">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sequi, similique maxime rerum soluta modi ut illum impedit minima ipsam fugit quis veritatis amet distinctio nulla vitae? Cum, dolor illo.
          </div>
          <div class="full-width q-mt-md">
            <q-item>
              <q-item-section>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    Know Butuan City
                  </a>
                </q-item-label>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    Departments
                  </a>
                </q-item-label>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    Services
                  </a>
                </q-item-label>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    Transparency
                  </a>
                </q-item-label>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    News
                  </a>
                </q-item-label>
                <q-item-label>
                  <a href="" class="text-white footer-link text-body1">
                    Contact Us
                  </a>
                </q-item-label>
              </q-item-section>
            </q-item>
          </div>
        </div>
      </div>
    </q-img>
    
  </div>
</div>

<div class="full-width row justify-start" :class="$q.screen.lt.sm ? 'q-my-lg q-px-md' : 'q-my-xl q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    LATEST NEWS
  </div>
  <div class="col-12 row q-pt-md">
    <?php
      foreach($recent_posts as $key => $value) { ?>
      <div class="col-6 col-md-3 row q-gutter-y-sm q-px-sm">
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

<div class="full-width row justify-start" :class="$q.screen.lt.sm ? 'q-my-lg q-px-md' : 'q-my-xl q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    QUICK LINKS
  </div>
  <div class="col-12 row">
    <div class="q-py-xs col-12 col-md-4 q-px-md">
      <q-card class="news-card" style="max-height:200px">
        <a href="<?php echo site_url()?>/transparency">
          <q-img
            cover
            height="150px"
            src="<?php echo get_template_directory_uri().'/assets/images/transparency-seal.jpg'; ?>"
            basic
          >
          </q-img>
        </a>
      </q-card>
    </div>
    <div class="q-py-xs col-12 col-md-4 q-px-md">
      <q-card class="news-card" style="max-height:200px">
        <a href="">
          <q-img
            cover
            height="150px"
            src="<?php echo get_template_directory_uri().'/assets/images/bids-awards.jpg'; ?>"
            basic
          >
          </q-img>
        </a>
      </q-card>
    </div>
    <div class="q-py-xs col-12 col-md-4 q-px-md">
      <q-card class="news-card" style="max-height:200px">
        <a href="https://www.jobstreet.com.ph/">
          <q-img
            cover
            height="150px"
            src="<?php echo get_template_directory_uri().'/assets/images/jobstreet.jpg'; ?>"
            basic
          >
          </q-img>
        </a>
      </q-card>
    </div>
  </div>
</div>

<q-dialog v-model="page_dialog.open">
  <q-card style="width:350px">
    <q-card-section class="row items-center q-pa-none">
      <div class="text-h6 q-pa-sm">{{page_dialog.data.title}}</div>
      <q-space></q-space>
      <q-btn class="q-ma-sm" icon="close" flat round dense v-close-popup></q-btn>
      <div class="col-12 q-mt-md">
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
        >
          <q-tab name="description" label="Description"></q-tab>
          <q-tab name="offices" label="Offices"></q-tab>
        </q-tabs>
      </div>
    </q-card-section>

    <q-separator></q-separator>

    <q-card-section style="max-height: 50vh;height:50vh" class="scroll q-pa-none">
      <q-tab-panels v-model="tab" animated>
        <q-tab-panel name="description">
          {{page_dialog.data.description}}
        </q-tab-panel>

        <q-tab-panel name="offices" class="q-pa-none">
          <q-list class="q-py-none" separator>
            <q-item clickable v-ripple v-for="off in 4" :key="'office-'+off" href="<?php echo get_home_url().'/offices-pio' ?>">
              <q-item-section avatar top>
                <q-avatar>
                  <img src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>">
                </q-avatar>
              </q-item-section>

              <q-item-section>
                <q-item-label lines="1">Lorem ipsum</q-item-label>
                <q-item-label caption lines="1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, quis nam, odio commodi minus accusantium itaque, enim facere veniam suscipit eos voluptatem fugiat saepe. Itaque iste molestiae libero harum! Perspiciatis.</q-item-label>
              </q-item-section>

              <q-item-section side>
                <q-icon name="info"></q-icon>
              </q-item-section>
            </q-item>

            <q-separator ></q-separator>
          </q-list>
        </q-tab-panel>
      </q-tab-panels>
    </q-card-section>
  </q-card>
</q-dialog>