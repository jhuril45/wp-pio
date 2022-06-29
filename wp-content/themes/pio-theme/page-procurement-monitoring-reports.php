<?php get_header(); ?>
  <?php
  if(get_query_var( 'office' )){?>
    <div class="row justify-center">
      <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="office">
        <?php get_template_part('template-parts/content', 'office_card');?>
      </div>
      <div class="col-12 col-md-8" v-else>
        <?php
          get_template_part('template-parts/content', 'procurement-monitoring-reports-table'); 
        ?>
      </div>
    </div>
  <?php
  }else{
    get_template_part('template-parts/content', 'procurement-monitoring-reports-table');
  }
    
  ?>
<?php get_footer(); ?>