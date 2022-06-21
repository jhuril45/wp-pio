<?php
  global $post;
  if(have_posts()){
    get_header();
      get_template_part('template-parts/content', 'landing');
    get_footer();
  }
  else{
    get_header();
      get_template_part('template-parts/content', '404');
    get_footer();
  }
?>