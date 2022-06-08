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
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard';?>">
        <q-item-section side>
          <q-icon :name="'add'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Posts
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-separator></q-separator>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=reports';?>">
        <q-item-section side>
          <q-icon :name="'add'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Transparency Report
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-separator></q-separator>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=add-report';?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Add Report
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=add-bid-report';?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Add Bid Report
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=offices';?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Offices
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=barangays';?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Barangays
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item clickable v-ripple href="<?php echo get_home_url().'/dashboard?tab=tourism';?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Tourism
          </q-item-label>
        </q-item-section>
      </q-item>
      <q-item clickable v-ripple href="<?php echo wp_logout_url();?>">
        <q-item-section side>
          <q-icon :name="'picture_as_pdf'"></q-icon>
        </q-item-section>
        <q-item-section>
          <q-item-label class="text-body2 text-bold">
            Logout
          </q-item-label>
        </q-item-section>
      </q-item>
    </q-list>
  </q-scroll-area>
</q-drawer>