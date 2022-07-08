<?php get_header(); ?>
  <?php
  if(get_query_var( 'monitoring_report' )){?>
    <div class="row justify-center">
      <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="monitoring_report">
        <?php get_template_part('template-parts/content', 'monitoring_report_card');?>
      </div>
      <div class="col-12" v-else>
        <?php
          get_template_part('template-parts/content', 'content-404'); 
        ?>
      </div>
    </div>
  <?php
  }else{ ?>
    <div class="row justify-center q-py-xl">
      <div class="col-12 col-md-8">
        <?php
          get_template_part('template-parts/content', 'procurement-monitoring-reports-table'); 
        ?>
      </div>
    </div>
  <?php } ?>
<?php get_footer(); ?>