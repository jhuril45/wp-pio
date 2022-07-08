<?php get_header();?>
<?php
  if(get_query_var( 'bid' )){?>
    <div class="row justify-center">
      <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="bid">
        <?php get_template_part('template-parts/content', 'bid_card');?>
      </div>
      <div class="col-12" v-else>
        <?php
          get_template_part('template-parts/content', 'content-404'); 
        ?>
      </div>
    </div>
  <?php
  }else{?>
    <div class="row justify-center q-py-xl q-px-lg">
      <div class="col-12 col-md-8 q-mt-md">
        <?php get_template_part('template-parts/content', 'bids-table');?>
      </div>
    </div>
  <?php } ?>
  
<?php get_footer();?>