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
    <q-separator vertical inset color="white"></q-separator>
    <div class="q-px-sm">
      <a href="https://www.m.me/butuancitypioofficial" class="footer-link text-white">
        <q-icon
          name="fab fa-facebook-messenger"
          color="white"
          size="xs"></q-icon>
          <span>Message Us</span>
      </a>
    </div>

  </q-toolbar>
  <q-toolbar class="q-py-sm bg-white" :class="$q.screen.gt.xs ? 'q-px-lg' : 'q-px-sm'">
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
    <div class="row items-center full-height full-width" :class="$q.screen.gt.xs ? 'q-gutter-x-sm ' : ''">
      <div class="col-shrink q-px-sm">
        <a href="<?php echo get_home_url() ?>">
          <q-img
            cover
            :height="$q.screen.lt.sm ? '50px' : '70px'"
            :width="$q.screen.lt.sm ? '50px' : '70px'"
            contain
            :src="header_logo" />
        </a>
      </div>
      <div class="col-shrink row q-gutter-x-sm " v-if="$q.screen.gt.xs">
        <div class="col-auto" v-for="(link,index) in header_menus" :key="'header-menu-'+index">
          <q-btn
            flat
            dense
            padding="none"
            class="header-links"
            v-if="link.is_menu"
            >
            <span class="link-item" :class="link.slug == page_name ? 'active' : ''">{{link.title}}</span>
            <q-menu fit>
              <q-list separator>
                <q-item
                  clickable
                  v-close-popup
                  :href="sub_menu.url"
                  v-for="(sub_menu,index2) in link.sub_menu"
                  :key="'submenu'+index2">
                  <q-item-section class="header-links">
                    <q-item-label class="link-item">{{sub_menu.title}}</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
          <q-btn
            flat
            dense
            padding="none"
            class="header-links"
            :href="link.url"
            v-else>
            <span class="link-item" :class="link.slug == page_name ? 'active' : ''">{{link.title}}</span>
          </q-btn>
        </div>
      </div>
      <q-space></q-space v-if="$q.screen.gt.xs">
      <div :class="$q.screen.gt.xs ? 'col-auto ' : 'col-8'">
        <q-form
          @submit="searchPage(search)">
          <q-input
            v-model="search"
            placeholder="Search"
            dense
            outlined>
            <template v-slot:prepend>
              <q-icon name="search"/>
            </template>
          </q-input>
        </q-form>
      </div>
    </div>
  </q-toolbar>
</q-header>