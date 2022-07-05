<?php
  $term = get_term_by('name', 'News', 'category');
  if(has_category($term->term_id,$post->ID)){
    get_template_part('template-parts/content', 'post_content');
  }
else{
  get_template_part('template-parts/content', '404');
}?>