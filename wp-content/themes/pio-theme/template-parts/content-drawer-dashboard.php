<q-drawer
  v-model="dashboard_drawer"
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
        <q-expansion-item
          v-if="menu.is_menu"
          expand-separator
          :icon="menu.icon"
          :label="menu.title"
          :header-class="menu.is_page ? 'text-primary' : ''"
          :expand-icon-class="menu.is_page ? 'text-primary' : ''">
          <template v-slot:header>
            <q-item-section side>
              <q-icon
                :name="menu.icon"
                :color="menu.is_page ? 'primary' : ''"></q-icon>
            </q-item-section>

            <q-item-section>
              <q-item-label class="text-body2 text-bold" :class=" menu.is_page ? 'text-primary' : ''">
                {{menu.title}}
              </q-item-label>
            </q-item-section>
          </template>
          <q-list separator>
            <q-item
              clickable
              v-ripple
              v-for="(sub,index2) in menu.sub_menu"
              :href="sub.url"
              :key="'dashboard-sub-menu-'+index2">
              <q-item-section
                class="q-px-md"
                side>
                <q-icon
                  :name="sub.icon"
                  :class=" sub.is_page ? 'text-primary' : ''"></q-icon>
              </q-item-section>
              <q-item-section>
                <q-item-label
                  class="text-body2 text-bold"
                  :class=" sub.is_page ? 'text-primary' : ''">
                  {{sub.title}}
                </q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-expansion-item>
        <q-item
          v-else
          clickable
          v-ripple
          :href="menu.url"
          :key="'dashboard-menu-'+index">
          <q-item-section side>
            <q-icon
              :name="menu.icon"
              :class=" menu.is_page ? 'text-primary' : ''"></q-icon>
          </q-item-section>
          <q-item-section>
            <q-item-label
              class="text-body2 text-bold"
              :class=" menu.is_page ? 'text-primary' : ''">
              {{menu.title}}
            </q-item-label>
          </q-item-section>
        </q-item>
        <q-separator></q-separator>
      </template>
    </q-list>
  </q-scroll-area>
</q-drawer>