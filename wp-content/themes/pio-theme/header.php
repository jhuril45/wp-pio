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
  <?php wp_head(); ?>
</head>

<body>
  <div id="q-app" style="max-width: 1190px;margin: 0 auto">
    <!--header-->
    <header class="main-header q-px-md">
      <div class="row items-center full-height q-gutter-x-sm">
        <div class="col-shrink">
          <?php the_custom_logo();?>
        </div>
        <div class="col-shrink header-title">
          <?php bloginfo( 'name' ); ?>
        </div>
        <div class="col">
          <ul class="header-links">
            <li
              :class="link.object_slug == 'home' ? 'active' : ''"
              v-for="(link,index) in header_menus"
              :key="'header-menu-'+index" v-text="link.title">
            </li>
          </ul>
        </div>
      </div>
    </header>
    <!-- //header -->