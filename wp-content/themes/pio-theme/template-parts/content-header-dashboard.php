<q-header elevated class="bg-white" >
  <q-toolbar class="q-py-md bg-white q-px-lg">
    <q-btn
      flat
      @click="drawer_left = !drawer_left"
      round
      dense
      color="primary"
      icon="menu"></q-btn>
    <q-toolbar-title>
      <a href="<?php echo get_home_url().'/dashboard' ?>">
        <q-img
          cover
          height="40px"
          width="150px"
          src="<?php echo get_template_directory_uri().'/assets/images/ButuanOnDesign.png'; ?>" />
      </a>
    </q-toolbar-title>
  </q-toolbar>
</q-header>