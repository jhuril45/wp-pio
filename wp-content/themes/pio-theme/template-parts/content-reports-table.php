<?php
  if(is_user_logged_in()){
    wp_register_script('add-post-script', get_template_directory_uri() . '/assets/js/add_post.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'add-post-script');
  }
?>

<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row q-gutter-y-md">
      <div class="col-12">
        <q-table
          flat
          title="Posts"
          :data="data"
          :columns="columns"
          row-key="name"
          :filter="filter"
          hide-header
        >
          <template v-slot:top-right>
            <q-input outlined dense debounce="300" v-model="filter" placeholder="Search">
              <template v-slot:append>
                <q-icon name="search"></q-icon>
              </template>
            </q-input>
          </template>

          <template v-slot:body="props">
            <q-item :props="props" clickable>
              <q-item-section side top>
                <q-icon color="primary" name="description"></q-icon>
              </q-item-section>
              <q-item-section :props="props">
                <q-item-label>
                  {{ props.row.name }}
                </q-item-label>
              </q-item-section>
            </q-item>
          </template>
        </q-table>
        <q-separator></q-separator>
      </div>
    </div>
  </q-card-section>
</q-card>