<div class="full-width">
  <q-carousel
    animated
    v-model="slide"
    ref="carousel"
    :height="$q.screen.lt.sm ? '250px' : '600px'"
    autoplay
    infinite>

    <template v-if="carousel_images.length">
      <q-carousel-slide class="q-pa-none" :name="index+1" v-for="(carousel,index) in carousel_images" :key="'landing-carousel'+index">
        <q-img
          :src="carousel.path"
          style="max-height:100%;width:100%;height:100%"
          >
          <div
            v-if="carousel.caption"
            :class="$q.screen.lt.sm ? '' : 'text-body1'"
            style="left:15%;top:50%;transform: translate(-50%,-50%);background:rgba(33, 150, 243,0.7)">
            {{carousel.caption}}
          </div>
        </q-img>
      </q-carousel-slide>
    </template>
    <template v-else>
      <q-carousel-slide class="q-pa-none" :name="1">
        <q-img
          :src="template_dir+'/assets/images/ButuanOnDesign.png'"
          style="max-height:100%;width:100%;height:100%"
          :contain="$q.screen.lt.sm"></q-img>
      </q-carousel-slide>
    </template>

    <template v-slot:control v-if="carousel_images.length > 1">
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

<!-- Plans and Programs must be dynamic -->
<div class="full-width row justify-center q-my-md" :class="$q.screen.lt.sm ? 'q-px-md' : 'q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    PLANS AND PROGRAMS
  </div>
  <div v-for="flip in flip_cards" :key="flip.id" class="col-12 col-md-3 col-sm-6 q-pa-xs q-pt-md">
    <div class="flip-card relative-position">
      <div class="flip-card-inner">
        <div class="flip-card-front rounded-borders relative-position" >
          <q-img
            cover
            height="100%"
            :src="flip.image_path">
            <div
              class="absolute-full flex flex-center"
              style="opacity: 0.6;"
              :style="{backgroundColor:flip.bg_color,color:flip.text_color}">
            </div>
          </q-img>
          <div class="text-h6 absolute-center" :style="{color:flip.text_color}">
            <q-icon
              :name="'img:'+flip.icon_path"
              color="white"
              size="60px">
            </q-icon>
            <p class="text-h6">
              {{flip.title}}
            </p>
          </div>
        </div>
        <div
          class="flip-card-back rounded-borders"
          :style="{backgroundColor:flip.bg_color,color:flip.text_color}">
          <div class="fit row items-center">
            <div class="text-center q-px-sm" :style="{color:flip.text_color}">
              <p>{{flip.description}}</p>
              <q-btn
                v-if="false"
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

<!-- Youtube video must be dynamic -->
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
      :src="'https://www.youtube.com/embed/'+(landing_details.youtube_id ? landing_details.youtube_id : 'YmBY9yNfNos')"
    />
  </div>
  <div class="col-md-4 col-12 q-py-md text-white text-center " :class="$q.screen.lt.sm ? '' : ''">
    <div class="q-py-lg">
      <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbutuancitypioofficial&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
      </iframe>
    </div>
  </div>
</div>

<div class="full-width">
  <div class="row relative-position">
    <q-img cover :src="template_dir + '/assets/images/city-hall-drone.png'" height="500px">
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

<!-- Latest news must be dynamic -->
<div class="full-width row justify-start" :class="$q.screen.lt.sm ? 'q-my-lg q-px-md' : 'q-my-xl q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold relative-position" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    LATEST NEWS
    <q-btn
      :href="home_url+'/news'"
      flat
      label="View More"
      class="text-body2 absolute-right items-end text-primary text-bold"
      v-if="recent_posts.length >= 4">
    </q-btn>
  </div>
  <div class="col-12 row q-pt-md">
    <div
      v-for="(post,index) in recent_posts"
      :key="'landing_recent'+index"
      class="col-6 col-md-3 row q-gutter-y-sm q-px-sm">
      <div class="col-12 q-pt-md">
        <q-card class="news-card" >
          <a :href="post.guid">
            <q-img
              cover
              height="200px"
              :src="post.fimg_url"
              basic
            >
              <div class="absolute-bottom text-caption text-start">
                <q-item-label lines="3" class="q-px-none q-py-none">
                  {{post.post_title}}
                </q-item-label>
              </div>
            </q-img>
          </a>
        </q-card>
      </div>
    </div>
  </div>
</div>

<!-- Quick Links must be dynamic -->
<div class="full-width row justify-start" :class="$q.screen.lt.sm ? 'q-my-lg q-px-md' : 'q-my-xl q-pa-xl'">
  <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
    QUICK LINKS
  </div>
  <div class="col-12 row q-gutter-y-lg justify-center">
    <div
      class="q-py-xs col-12 col-md-4 q-px-md"
      v-for="quick_link in quick_links"
      :key="'link-'+quick_link.id">
      <q-card class="news-card" style="max-height:200px">
        <a :href="quick_link.link.charAt(0) == '/' ? home_url+quick_link.link : quick_link.link">
          <q-img
            cover
            :height="$q.screen.lt.sm ? '100px' : '135px'"
            :src="quick_link.path"
            basic
          >
          </q-img>
        </a>
      </q-card>
    </div>
  </div>
</div>

<!-- Links must be dynamic -->
<div class="full-width row justify-around" :class="$q.screen.lt.sm ? 'q-my-lg q-px-md' : 'q-my-xl q-pa-xl'">
  <div class="col-12 row justify-center q-mt-lg" :class="$q.screen.lt.sm ? 'q-gutter-y-xl' : 'q-gutter-x-xl'">
    <div
      class=""
      :class="$q.screen.lt.sm ? 'col-12 row justify-center' : 'col-shrink'"
      v-for="partner in partners_list" 
      :key="'partner-'+partner.id">
      <a :href="partner.link.charAt(0) == '/' ? home_url+partner.link : partner.link">
        <img :src="partner.path" style="height:70px">
      </a>
    </div>
  </div>
</div>

<q-dialog v-model="page_dialog.open">
  <q-card >
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
            <q-item clickable v-ripple v-for="off in 4" :key="'office-'+off" href="<?php echo get_home_url().'/offices' ?>">
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