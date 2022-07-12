<?php
  $term = get_term_by('name', 'News', 'category');
  if(has_category($term->term_id,$post->ID)){
    get_template_part('template-parts/content', 'post_content');
  }
  else{
    $report = get_term_by('name', 'Reports', 'category');
    $bids = get_term_by('name', 'Bids', 'category');
    $offices = get_term_by('name', 'Offices', 'category');
    $barangay = get_term_by('name', 'Barangay', 'category');
    $tourism = get_term_by('name', 'Tourism', 'category');
    $procurement_monitoring = get_term_by('name', 'Procurement Monitoring', 'category');
    if(has_category($report->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="report">
          <?php get_template_part('template-parts/content', 'report_card');?>
        </div>
      </div>
    <?php }
    else if(has_category($bids->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="bid">
          <?php get_template_part('template-parts/content', 'bid_card');?>
        </div>
      </div>
    <?php }
    else if(has_category($offices->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="office">
          <?php get_template_part('template-parts/content', 'office_card');?>
        </div>
      </div>
    <?php }
    else if(has_category($barangay->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="barangay">
          <?php get_template_part('template-parts/content', 'barangay_card');?>
        </div>
      </div>
    <?php }
    else if(has_category($tourism->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-6 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="tourism">
          <?php get_template_part('template-parts/content', 'tourism_card');?>
        </div>
      </div>
    <?php }
    else if(has_category($procurement_monitoring->term_id,$post->ID)){?>
      <div v-show="false">
        <?php echo($post->post_title);?>
        <?php echo($post->post_content);?>
      </div>
      <div class="row justify-center">
        <div class="col-12 col-md-6 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'" v-if="monitoring_report">
          <?php get_template_part('template-parts/content', 'monitoring_report_card');?>
        </div>
      </div>
    <?php }
    else{
      get_template_part('template-parts/content', '404');
    }
  }
?>