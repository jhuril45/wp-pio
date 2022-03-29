<?php get_header(); ?>
<main id="main" class="site-main" v-if="false">
  <div class="site-page row">
    <div class="col-12 page-header q-px-md q-py-md">
      <span class="page-header-title">
        Welcome to Butuan
      </span>
    </div>
    <div class="col-12 page-banner-section">
      <img src="<?php echo get_template_directory_uri().'/assets/images/banner1.webp'; ?>"/>
    </div>
    <div class="col-12">
      <div class="row page-main-content" v-if="false">
        <div class="full-width site-main-links row q-pb-sm" id="page-links">
          <div
            :class="link.object_slug == 'news-and-events' ? 'active' : ''"
            class="col-shrink site-main-link"
            v-for="(link,index) in page_menus"
            :key="'page-link'+index">
            <span v-text="link.title"></span>
          </div>
        </div>
        <div class="full-width q-pa-lg">
          <div class="page-contents q-px-md">
            <q-list separator v-if="page_posts.length">
              <q-item class="q-px-none" v-for="post in page_posts" :key="'post-'+post.slug">
                <q-item-section avatar size="sm">
                  <q-img
                    cover
                    height="80px"
                    width="100px" 
                    :src="post.fimg_url ? post.fimg_url : '<?php 
                      echo custom_get_custom_logo()
                    ?>'"/>
                </q-item-section>
                  
                <q-item-section top>
                  <q-item-label class="text-blue-10 text-h6">
                    <span class="cursor-pointer" @click="redirectPage(post.link)">
                      {{post.title.rendered}}
                    </span>
                  </q-item-label>
                  <q-item-label lines="3" class="q-pt-sm" v-html="post.excerpt.rendered">
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </div>
        </div>
      </div>
      <div class="row q-py-lg q-gutter-x-sm" v-if="false">
        <div class="col-5 page-main-content q-pa-md q-gutter-y-sm">
          <p class="q-ma-none text-center text-h4 text-blue-10">Title</p>
          <div class="page-content full-width bg-white" v-for="i in 2" :key="i">

          </div>
        </div>
        <div class="col page-main-content q-pa-md q-gutter-y-sm">
          <div class="q-ma-none text-center text-h4 text-blue-10">Title</div>
          <div class="row full-width full-height content-start">
            <div class="col-6 q-pa-sm" v-for="i in 4" :key="i">
              <div class="bg-white" style="height:125px">

              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="full-width row justify-start q-py-xl">
        <div
          class="col-3 q-pa-xs"
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
                  <div class="text-white text-center">
                    {{flip.description}}
                  </div>
                </div>
                <q-menu fit anchor="bottom left">
                  <q-list style="min-width: 100px" separator>
                    <q-item clickable>
                      <q-item-section>New tab</q-item-section>
                    </q-item>
                    <q-item clickable>
                      <q-item-section>New incognito tab</q-item-section>
                    </q-item>
                    <q-item clickable>
                      <q-item-section>New incognito tab</q-item-section>
                    </q-item>
                  </q-list>
                </q-menu>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-3 q-px-md q-gutter-y-md" v-if="false">
      <div class="full-width page-clock q-py-sm">
        <page-clock/>
      </div>
      <div class="full-width row justify-center q-py-sm">
        <q-date
          flat
          class="q-pa-none"
          minimal
          v-model="date" />
      </div>
      <div class="full-width page-left-list q-py-sm">
      <q-list separator>
        <q-item v-for="i in 3" :key="'left'+i">
          <q-item-section side>
            <q-icon
              color="blue-10"
              name="play_arrow" ></q-icon>
          </q-item-section>
          <q-item-section>
            <q-item-label lines="1" class="cursor-pointer text-body-2">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, atque laudantium repellat recusandae iste consectetur a nostrum veritatis minus assumenda fuga ab beatae cupiditate enim nemo, blanditiis vel, itaque vitae!
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
      </div>
    </div>
  </div>
</main>
    <div class="full-width">
      <q-carousel
        animated
        v-model="slide"
        arrows
        navigation
        infinite
        height="600px"
      >
        <q-carousel-slide class="1" :name="1" img-src="<?php echo get_template_directory_uri().'/assets/images/banner1.png'; ?>"></q-carousel-slide>
        <q-carousel-slide :name="2" img-src="<?php echo get_template_directory_uri().'/assets/images/banner2.png'; ?>" ></q-carousel-slide>
        <q-carousel-slide :name="3" img-src="<?php echo get_template_directory_uri().'/assets/images/banner3.png'; ?>" ></q-carousel-slide>
      </q-carousel>
    </div>
    <div class="full-width row justify-start q-my-xl" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-xl'">
      <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
        PLANS AND PROGRAMS
      </div>
      <div
        class="col-12 col-md-3 col-sm-6 q-pa-xs"
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
                <div class="text-white text-center">
                  <p>{{flip.description}}</p>
                  <q-btn
                    rounded
                    color="primary"
                    label="View More"
                    @click="page_dialog.data=flip;page_dialog.open=true"
                    text-color="white"
                    outline></q-btn>
                </div>
              </div>
            </div>
          </div>
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
                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="primary" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>February 22nd, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info" color="green"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="orange" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Movies</q-item-label>
                    <q-item-label caption>March 1st, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
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
    <q-dialog v-model="page_dialog.open" v-if="false">
      <q-card>
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">{{page_dialog.data.title}}</div>
          <q-space></q-space>
          <q-btn icon="close" flat round dense v-close-popup></q-btn>
        </q-card-section>

        <q-card-section class="q-px-none q-pt-md q-pb-none fit" style="height:60vh;max-height: 60vh;width:350px">
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

          <q-separator></q-separator>

          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="description">
              {{page_dialog.data.description}}
            </q-tab-panel>

            <q-tab-panel name="offices" class="q-pa-none">
              <q-list class="q-py-none" separator>
                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="primary" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>February 22nd, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info" color="green"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="orange" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Movies</q-item-label>
                    <q-item-label caption>March 1st, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
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
  </q-page>
</q-page-container>
<?php get_footer(); ?>