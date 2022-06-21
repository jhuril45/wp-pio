<?php get_header(); ?>
  <?php
  if(get_query_var( 'barangay' )){?>
    <div class="row justify-center">
      <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="barangay">
        <?php 
          get_template_part('template-parts/content', 'barangay_card');
        ?>
      </div>
      <div class="col-12" v-else>
        <?php 
          get_template_part('template-parts/content', 'barangays-table');
        ?>
      </div>
    </div>
  <?php
  }else{
    get_template_part('template-parts/content', 'barangays-table');
  }
    
  ?>
<?php get_footer(); ?>