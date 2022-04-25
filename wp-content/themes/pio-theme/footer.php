<!-- footer -->
  </q-page>
</q-page-container>
<?php if($pagename != 'dashboard'):?>
  <?php get_template_part('template-parts/content', 'footer');?>
<?php endif;?>
  
</q-layout>
<!-- //footer -->
</div>
<?php wp_footer();?>

</body>

</html>