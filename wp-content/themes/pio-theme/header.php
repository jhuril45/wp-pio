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
    <!--header-->
    <header class="main-header q-px-md" v-if="false">
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
    
    <q-layout view="lHh lpr lff" container style="height: 100vh" class="shadow-2">
      <q-header elevated reveal>
        <q-toolbar class="q-py-md">
          <q-btn flat round dense icon="menu" class="q-mr-sm" v-if="$q.screen.lt.sm" @click="drawer_left = !drawer_left"></q-btn>
          <div class="row items-center full-height q-gutter-x-sm">
            <div class="col-shrink">
              <?php the_custom_logo();?>
            </div>
            <div class="col-shrink header-title">
              <?php bloginfo( 'name' ); ?>
            </div>
            <div class="col" v-if="$q.screen.gt.xs">
              <ul class="header-links">
                <li
                  :class="link.object_slug == 'home' ? 'active' : ''"
                  v-for="(link,index) in header_menus"
                  :key="'header-menu-'+index" v-text="link.title">
                </li>
              </ul>
            </div>
          </div>
        </q-toolbar>
      </q-header>

      <q-drawer
        v-model="drawer_left"
        :width="200"
        side="left" 
        behavior="mobile"
        bordered
        content-class="bg-grey-3"
        v-if="$q.screen.lt.sm"
      >
        <q-scroll-area class="fit">
          <q-list>

            <template v-for="(link, index) in header_menus">
              <q-item :key="index" clickable :active="link.object_slug == 'home'" v-ripple>
                <q-item-section avatar>
                  <q-icon :name="'home'" />
                </q-item-section>
                <q-item-section>
                  {{ link.title }}
                </q-item-section>
              </q-item>
              <q-separator :key="'sep' + index"/>
            </template>

          </q-list>
        </q-scroll-area>
      </q-drawer>

      

      <q-page-container>
        <q-page>
          

      

    <q-layout view="hhh LpR fFf" v-if="false">

      <q-header elevated class="bg-primary text-white">
        <q-toolbar>
          <q-btn dense flat round icon="menu" @click="left = !left" />

          <q-toolbar-title>
            <q-avatar>
              <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
            </q-avatar>
            Title
          </q-toolbar-title>
        </q-toolbar>
      </q-header>

      <q-drawer show-if-above v-model="left" side="left" elevated>
        <!-- drawer content -->
      </q-drawer>

      <q-page-container>
        <router-view />
      </q-page-container>

      <q-footer elevated class="bg-grey-8 text-white">
        <q-toolbar>
          <q-toolbar-title>
            <q-avatar>
              <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
            </q-avatar>
            Title
          </q-toolbar-title>
        </q-toolbar>
      </q-footer>

    </q-layout>