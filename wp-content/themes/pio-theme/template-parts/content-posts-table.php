<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row q-gutter-y-md">
      <div class="col-12">
        <q-table
          flat
          title="Posts"
          :data="posts"
          :columns="posts_columns"
          row-key="title"
          :filter="filter"
          hide-header
        >
          <template v-slot:top-right>
            <div class="row q-gutter-x-sm">
              <q-input outlined dense debounce="300" v-model="filter" placeholder="Search">
                <template v-slot:append>
                  <q-icon name="search"></q-icon>
                </template>
              </q-input>
              <q-btn
                size="xs"
                color="primary"
                padding="10px 15px"
                icon="add"
                href="<?php echo get_home_url().'/dashboard?tab=add-post';?>">
              </q-btn>
            </div>
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
              <q-item-section side top>
                <q-btn padding="none" flat @click.prevent="copyToClipBoard('<?php echo get_home_url();?>/?p='+props.row.ID)">
                  <q-icon color="primary" name="content_copy">
                  </q-icon>
                </q-btn>
              </q-item-section>
            </q-item>
          </template>
        </q-table>
        <q-separator></q-separator>
      </div>
    </div>
  </q-card-section>
</q-card>