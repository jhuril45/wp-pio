<?php 
if(!is_user_logged_in()){
  get_template_part('template-parts/content', '404'); 
}else{
  wp_localize_script('vue-main', 'Rest', [
    'nonce' => wp_create_nonce('wp_rest'),
  ]);
  
  get_header();
  if(get_query_var( 'tab' )){
    if(get_query_var( 'tab' ) == 'add-post'){
      get_template_part('template-parts/content', 'add_post');
    }else if(get_query_var( 'tab' ) == 'add-report'){
      get_template_part('template-parts/content', 'add_report');
    }
  }else{?>
    <div class="row justify-center">
      <div class="col-10 q-py-lg">
        <?php get_template_part('template-parts/content', 'posts-table');?>
      </div>
    </div>
  <?php
  }
  get_footer();
}
?>