<?php get_header(); ?>
  <?php
  if(get_query_var( 'report' )){?>
    <div class="row justify-center">
      <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="report">
        <?php get_template_part('template-parts/content', 'report_card');?>
      </div>
      <div class="col-12" v-else>
        <?php
          get_template_part('template-parts/content', 'content-404'); 
        ?>
      </div>
    </div>
  <?php
  }else{
    get_template_part('template-parts/content', 'content-404');
  }
    
  ?>
<?php get_footer(); ?>