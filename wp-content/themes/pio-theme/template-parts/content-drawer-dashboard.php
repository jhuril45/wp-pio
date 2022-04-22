<q-drawer
  v-model="drawer_left"
  :width="200"
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
      <q-item v-ripple>
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
      <q-item clickable v-ripple href="<?php echo esc_url( add_query_arg( 'tab', 'add-post' ) );?>">
        <q-item-section side>
          <q-icon :name="'add'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Add New Post
          </q-item-label>
        </q-item-section>
      </q-item>
    </q-list>
  </q-scroll-area>
</q-drawer>