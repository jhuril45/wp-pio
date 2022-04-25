<?php get_header();?>
<?php 
if(get_query_var( 'tab' ) == 'add-post'){
?>
  <?php get_template_part('template-parts/content', 'add_post');?>
<?php 
}
?>
<?php get_footer(); ?>