<?php get_header(); ?>
  <div class="q-pa-md row justify-center">
    <div class="col-12 col-md-8">
      <q-table
        title="News"
        :data="paginate_posts"
        :columns="columns_news"
        row-key="name"
        :filter="filter"
        :loading="loading"
        hide-header
        :pagination.sync="newsPagination"
        @request="getPosts">
        <template v-slot:top-right>
          <div class="q-gutter-x-sm row">
            <q-input
              outlined
              dense
              debounce="300"
              v-model="filter"
              placeholder="Search">
              <template v-slot:append>
                <q-icon name="search"></q-icon>
              </template>
            </q-input>
            <q-btn
              color="primary"
              label="Search"
              size="sm"
              @click="getPosts">
            </q-btn>
          </div>
        </template>
        <template v-slot:body="props">
          <q-tr :props="props" >
            <q-separator></q-separator>
            <q-item
              clickable
              ripple
              class="q-px-sm"
              :href="props.row.guid">
              <q-item-section top avatar class="q-px-md">
                <img :src="props.row.fimg_url" style="width:130px;height:80px;object-fit:cover">
              </q-item-section>

              <q-item-section>
                <q-item-label class="text-h6">
                  {{props.row.post_title}}
                </q-item-label>
                <q-item-label class="text-body2 text-grey" lines="3">
                  {{props.row.post_content}}
                </q-item-label>
              </q-item-section>
            </q-item>
            <q-separator></q-separator>
          </q-tr>
        </template>
      </q-table>
    </div>
  </div>
<?php get_footer(); ?>