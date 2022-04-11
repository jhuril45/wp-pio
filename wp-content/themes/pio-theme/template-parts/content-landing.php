<div class="full-width">
  <q-carousel
    animated
    v-model="slide"
    arrows
    navigation
    infinite
    :height="$q.screen.lt.sm ? '200px' : '400px'"
    control-text-color="primary"
  >
    <q-carousel-slide class="q-pa-none" :name="1">
      <q-img
        src="<?php echo get_template_directory_uri().'/assets/images/banner1.png'; ?>"
        style="height:100%; width:100%"
        :cover="!$q.screen.lt.sm"
        :contain="$q.screen.lt.sm"></q-img>
    </q-carousel-slide>
    <q-carousel-slide class="q-pa-none" :name="2">
      <q-img
        src="<?php echo get_template_directory_uri().'/assets/images/banner2.png'; ?>"
        style="height:100%; width:100%"
        :cover="!$q.screen.lt.sm"
        :contain="$q.screen.lt.sm"></q-img>
    </q-carousel-slide>
    <q-carousel-slide class="q-pa-none" :name="3">
      <q-img
        src="<?php echo get_template_directory_uri().'/assets/images/banner3.png'; ?>"
        style="height:100%; width:100%"
        :cover="!$q.screen.lt.sm"
        :contain="$q.screen.lt.sm"></q-img>
    </q-carousel-slide>
  </q-carousel>
</div>
<div class="full-width row justify-start q-my-xl" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-xl'">
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
<div class="full-width">
  <q-parallax>
    <template v-slot:media>
      <img src="https://cdn.quasar.dev/img/parallax2.jpg">
    </template>

    <template v-slot:content="scope">
      <div
        class="absolute items-start row q-px-lg"
      >
        <div class="col-12 col-md-6 rounded-borders q-pa-lg q-gutter-y-md" style="background: rgba(79, 195, 247, 0.8)">
          <div class="text-h4 text-white text-start">DEPARTMENTS & OFFICES</div>
          <div class="text-subtitle2 text-white text-start">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sequi, similique maxime rerum soluta modi ut illum impedit minima ipsam fugit quis veritatis amet distinctio nulla vitae? Cum, dolor illo.
          </div>
          <div class="full-width">
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
    </template>
  </q-parallax>
</div>
<div class="full-width row justify-start q-my-xl" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    LATEST NEWS
  </div>
  <div class="col-12 row q-pt-md">
    <div v-for="(post,index) in page_posts" :key="'news-card-'+index" class="q-py-xs col-6 col-md-3 q-px-md">
      <q-card class="news-card">
        <a :href="post.link">
        <q-img
          contain
          height="200px"
          :src="post.fimg_url ? post.fimg_url : '<?php 
            echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
          ?>'"
          basic
        >
          <div class="absolute-bottom text-caption text-start">
            <q-item-label lines="3" class="q-px-none q-py-none">
              {{post.title.rendered}}
            </q-item-label>
          </div>
        </q-img>
        </a>
      </q-card>
    </div>
  </div>
</div>
<div class="full-width row justify-start q-my-xl" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    QUICK LINKS
  </div>
  <div class="col-12 row q-pt-md">
    <div class="q-py-xs col-12 col-md-4 q-px-md">
      <q-card class="news-card" style="max-height:150px">
        <a href="<?php echo site_url()?>/transparency">
          <q-img
            contain
            src="<?php echo get_template_directory_uri().'/assets/images/transparency-seal.jpg'; ?>"
            basic
          >
          </q-img>
        </a>
      </q-card>
    </div>
    <div class="q-py-xs col-12 col-md-4 q-px-md">
      <q-card class="news-card" style="max-height:150px">
        <a href="">
          <q-img
            contain
            src="<?php echo get_template_directory_uri().'/assets/images/bids-awards.jpg'; ?>"
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
            <q-item clickable v-ripple v-for="off in 4" :key="'office-'+off">
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