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
      @click="drawer_left = !drawer_left">
    </q-btn>
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
            v-for="(link,index) in header_menus"
            :key="'header-menu-'+index">
            <a
              :href="link.url ? link.url : ''"
              style="text-decoration:none"
              :class="link.object_slug == 'home' ? 'active' : ''">
              {{link.title}}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </q-toolbar>
</q-header>