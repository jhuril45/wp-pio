<?php get_header(); ?>
<main id="main" class="site-main">
  <div class="site-page row">
    <div class="col-12 page-header q-px-md q-py-md">
      <span class="page-header-title">
        Welcome to Butuan
      </span>
    </div>
    <div class="col-12 page-banner-section">
      <img src="<?php echo get_template_directory_uri().'/assets/images/banner1.webp'; ?>"/>
    </div>
    <div class="col-9">
      <div class="row page-main-content">
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
      <div class="row q-py-lg q-gutter-x-sm">
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
    </div>
    <div class="col-3 q-px-md q-gutter-y-md">
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
              name="play_arrow" />
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
<?php get_footer(); ?>