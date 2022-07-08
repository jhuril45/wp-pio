<?php 
if(!is_user_logged_in()){
  wp_redirect( wp_login_url() );
}else{
  get_header();
  if(get_query_var( 'tab' )){
    if(get_query_var( 'tab' ) == 'carousel'){?>
      <div class="row justify-center">
        <div class="col-12 col-md-10 q-py-lg">
          <?php get_template_part('template-parts/content', 'carousel-list');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'flip-cards'){?>
      <div class="row justify-center">
        <div class="col-12 col-md-10 q-py-lg">
          <?php get_template_part('template-parts/content', 'flip-cards-list');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'quick-links'){?>
      <div class="row justify-center">
        <div class="col-12 col-md-10 q-py-lg">
          <?php get_template_part('template-parts/content', 'quick-links-list');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'partners-list'){?>
      <div class="row justify-center">
        <div class="col-12 col-md-10 q-py-lg">
          <?php get_template_part('template-parts/content', 'partners-list');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'add-post'){
      get_template_part('template-parts/content', 'add_post');
    }
    else if(get_query_var( 'tab' ) == 'reports' && checkUser('bac')){?>
      <div class="row justify-center">
        <div class="col-12 col-md-6 q-py-lg">
          <?php get_template_part('template-parts/content', 'reports-table');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'add-report' && checkUser('bac')){
      get_template_part('template-parts/content', 'add_report');
    }
    else if(get_query_var( 'tab' ) == 'bid-reports' && checkUser('bac')){?>
      <div class="row justify-center">
        <div class="col-12 col-md-6 q-py-lg">
          <?php get_template_part('template-parts/content', 'bids-table');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'add-bid-report' && checkUser('bac')){
      get_template_part('template-parts/content', 'add_bid_report');
    }
    else if(get_query_var( 'tab' ) == 'procurement-monitoring-reports' && checkUser('bac')){?>
      <div class="row justify-center">
        <div class="col-12 col-md-8 q-py-lg">
          <?php get_template_part('template-parts/content', 'procurement-monitoring-reports-table');?>
        </div>
      </div>
    <?php }
    else if(get_query_var( 'tab' ) == 'add-procurement-monitoring-report' && checkUser('bac')){
      get_template_part('template-parts/content', 'add_procurment_monitoring_report');
    }
    else if(get_query_var( 'tab' ) == 'offices'){
      get_template_part('template-parts/content', 'offices-table');
    }
    else if(get_query_var( 'tab' ) == 'add-office'){
      get_template_part('template-parts/content', 'add_office');
    }
    else if(get_query_var( 'tab' ) == 'barangays'){
      get_template_part('template-parts/content', 'barangays-table');
    }
    else if(get_query_var( 'tab' ) == 'add-barangay'){
      get_template_part('template-parts/content', 'add_barangay');
    }
    else if(get_query_var( 'tab' ) == 'tourism' && checkUser('tourism')){
      get_template_part('template-parts/content', 'tourism-table');
    }
    else if(get_query_var( 'tab' ) == 'add-tourism' && checkUser('tourism')){
      get_template_part('template-parts/content', 'add_tourism');
    }
    else{?>
      <div class="row justify-center">
        <div class="col-12 col-md-6 q-py-lg">
          <?php get_template_part('template-parts/content', 'posts-table');?>
        </div>
      </div>
    <?php
    }
  }else{?>
    <?php if(checkUser('pio')) {?>
      <div class="row justify-center">
        <div class="col-12 col-md-6 q-py-lg">
          <?php get_template_part('template-parts/content', 'posts-table');?>
        </div>
      </div>
    <?php 
  }
  else if(checkUser('bac')) {?>
      <div class="row justify-center">
        <div class="col-12 col-md-6 q-py-lg">
          <?php get_template_part('template-parts/content', 'reports-table');?>
        </div>
      </div>
    <?php }
    else if(checkUser('tourism')) {?>
      <div class="row justify-center">
        <div class="col-12 q-py-lg">
          <?php get_template_part('template-parts/content', 'tourism-table');?>
        </div>
      </div>
    <?php }?>
  <?php
  }
  get_footer();
}
?>