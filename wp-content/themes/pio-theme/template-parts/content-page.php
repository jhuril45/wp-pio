<?php 
get_header();
?>
<div class="q-pa-xl">
  <?php 
    get_header();
    if(strtolower(get_the_title()) == 'about'){
      get_template_part( 'template-parts/content', 'about' );
    }
  ?>
</div>
<?php 
get_footer();
?>
