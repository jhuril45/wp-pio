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