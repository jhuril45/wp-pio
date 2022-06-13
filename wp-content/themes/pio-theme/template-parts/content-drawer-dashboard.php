<q-drawer
  v-model="drawer_left"
  :width="250"
  side="left"
  bordered
  content-class="bg-grey-3"
  >
  <q-scroll-area class="fit">
    <q-list>
      <q-item v-ripple>
        <q-item-section class="row items-center">
          <q-avatar>
            <img src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>">
          </q-avatar>
        </q-item-section>
      </q-item>
      <q-item class="q-py-none" v-ripple href="<?php echo get_home_url().'/dashboard'?>">
        <q-item-section class="q-py-none">
          <q-item-label class="text-bold cursor-pointer text-center">
            City Government Butuan
          </q-item-label>
          <q-item-label>
            <div class="text-dark text-caption text-center">
              <page-clock :is_break="false"></page-clock>
            </div>
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-separator></q-separator>
      <template v-for="(menu,index) in dashboard_drawer_menu">
        <q-item clickable v-ripple :href="menu.url" :key="'dashboard-menu-'+index">
          <q-item-section side>
            <q-icon :name="menu.icon" :class=" menu.is_page ? 'text-primary' : ''"></q-icon>
          </q-item-section>
          <q-item-section>
            <q-item-label class="text-body2 text-bold" :class=" menu.is_page ? 'text-primary' : ''">
              {{menu.title}}
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-separator></q-separator>
      </template>
    </q-list>
  </q-scroll-area>
</q-drawer>