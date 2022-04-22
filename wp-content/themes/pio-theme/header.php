<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>
  <?php bloginfo( 'name' ); ?>
  </title>

  <!-- Template CSS -->
  <?php wp_head();$page = get_page_by_title('page-name'); $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_URL = wp_get_attachment_image_src( $custom_logo_id , 'full' );?>
</head>

<body>
  <div id="q-app" style="display:none">
    <q-layout view="lHh lpr lff" container style="height: 100vh" class="shadow-2">
      <?php if($pagename != 'dashboard'):?>
        <?php get_template_part('template-parts/content', 'header');?>
        <?php get_template_part('template-parts/content', 'drawer');?>
      <?php endif;?>

      <?php if($pagename == 'dashboard'):?>
        <?php get_template_part('template-parts/content', 'header-dashboard');?>
        <?php get_template_part('template-parts/content', 'drawer-dashboard');?>
      <?php endif;?>

      

      <q-page-container>
        <q-page id="<?php echo $pagename?>">