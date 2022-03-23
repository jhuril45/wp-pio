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
            <div class="page-content" v-for="i in 3" :key="i">

            </div>
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
      <div class="page-clock q-py-sm">
        <page-clock/>
      </div>
      <div class="page-calendar">
        
      </div>
      <div class="page-left-list">

      </div>
    </div>
  </div>
</main>
<?php get_footer(); ?>