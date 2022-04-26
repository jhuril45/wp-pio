<?php 
if(!is_user_logged_in()){
  get_template_part('template-parts/content', '404'); 
}else{
  get_header();
  if(get_query_var( 'tab' ) == 'add-post'){
    get_template_part('template-parts/content', 'add_post');
  }else if(get_query_var( 'tab' ) == 'add-report'){
    get_template_part('template-parts/content', 'add_report');
  }
  get_footer();
}
?>