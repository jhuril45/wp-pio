<?php
  wp_register_script('dashboard-script', get_template_directory_uri() . '/assets/js/dashboard.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'dashboard-script');
?>

<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row q-gutter-y-md">
      <div class="col-12 col-md-6 q-px-sm">
        <q-select
          dense
          outlined
          v-model="transparency_type"
          :options="['Anually','Quarterly']"
          label="Report type" />
      </div>
      <div class="col-12 col-md-6 q-px-sm">
        <q-select
          dense
          outlined
          v-model="transparency_year"
          :options="[2019,2020,2021,2022]"
          label="Year" />
      </div>
      <div class="col-12" v-if="posts">
        <q-table
          flat
          title="Posts"
          :data="posts.data"
          :columns="posts.columns"
          row-key="title"
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
            <q-item :props="props">
              <q-item-section :props="props">
                <q-item-label lines="2">
                  {{ props.row.post_title }}
                </q-item-label>
              </q-item-section>
              <q-item-section side top>
                <a :href="'<?php echo get_home_url();?>/dashboard/?tab=add-post&id='+props.row.ID">
                  
                  <q-icon color="primary" name="edit">
                  </q-icon>
                </a>
              </q-item-section>
            </q-item>
          </template>
        </q-table>
        <q-separator></q-separator>
      </div>
    </div>
  </q-card-section>
</q-card>