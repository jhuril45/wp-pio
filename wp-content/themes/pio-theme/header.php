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
      <q-header elevated reveal>
        <q-toolbar class="bg-primary text-white q-px-lg" v-if="$q.screen.gt.sm">
          <q-toolbar-title class="text-body2 text-italic">
            The Official Website of the City Government of Butuan
          </q-toolbar-title>
          <div class="q-px-sm text-white text-subtitle2">
            <page-clock></page-clock>
          </div>
          <q-separator vertical inset color="white"></q-separator>
          <div class="q-px-sm">
            <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-white">
              <q-icon
                name="fab fa-facebook-f"
                color="white"
                size="xs"></q-icon>
                <span>Facebook</span>
            </a>
          </div>
          <q-separator vertical inset color="white"></q-separator>
          <div class="q-px-sm">
            <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-white">
              <q-icon
                name="fab fa-twitter"
                color="white"
                size="xs"></q-icon>
                <span>Twitter</span>
            </a>
          </div>
          <div class="q-px-sm">
            <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-white">
              <q-icon
                name="fas fa-phone"
                color="white"
                size="xs"></q-icon>
                <span>Call Us</span>
            </a>
          </div>

        </q-toolbar>
        <q-toolbar class="q-py-sm bg-white q-px-lg">
          <q-btn
            flat
            round
            dense
            icon="menu"
            class="q-mr-sm"
            v-if="$q.screen.lt.sm"
            color="primary"
            @click="drawer_left = !drawer_left"></q-btn>
          <div class="row items-center full-height q-gutter-x-sm">
            <div class="col-shrink">
              <a href="<?php echo get_home_url() ?>">
                <q-img
                  cover
                  height="40px"
                  width="150px"
                  src="<?php echo get_template_directory_uri().'/assets/images/ButuanOnDesign.png'; ?>" />
              </a>
            </div>
            <div class="col-shrink header-title" v-if="false">
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
            <q-item clickable v-ripple>
              <q-item-section class="row items-center">
                <q-avatar>
                  <img src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>">
                </q-avatar>
              </q-item-section>
            </q-item>
            <q-item clickable v-ripple>
              <q-item-section>
                <q-item-label class="text-bold">
                  City Government Butuan
                </q-item-label>
                <q-item-label>
                <div class="text-dark text-caption">
                  <page-clock :is_break="false"></page-clock>
                </div>
                </q-item-label>
              </q-item-section>
            </q-item>
            <q-separator></q-separator>
            <template v-for="(link, index) in header_menus">
              <q-item :key="index" clickable :active="link.object_slug == 'home'" v-ripple>
                <q-item-section avatar v-if="false">
                  <q-icon :name="'home'"></q-icon>
                </q-item-section>
                <q-item-section>
                  {{ link.title }}
                </q-item-section>
              </q-item>
              <q-separator :key="'sep' + index"></q-separator>
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