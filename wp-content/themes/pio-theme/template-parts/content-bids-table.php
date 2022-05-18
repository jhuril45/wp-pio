<?php
  wp_register_script('load-bids-script', get_template_directory_uri() . '/assets/js/load_bids.js',array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'load-bids-script');
?>
<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row q-gutter-y-md">
      <div class="col-12">
        <q-table
          flat
          title="Bids"
          :data="bids_data"
          :columns="columns_report"
          row-key="name"
          :filter="filter"
          :pagination.sync="pagination"
          :rows-per-page-options="[0]"
          hide-header
        >
          <template v-slot:top>
            <div class="row full-width">
              <div class="col-4 q-px-sm">
                <q-select
                  dense
                  outlined
                  v-model="transparency_type"
                  :options="report_options"
                  label="Report type"
                  emit-value
                  map-options/>
              </div>
              <div class="col-4 q-px-sm">
                <q-select
                  dense
                  outlined
                  v-model="transparency_year"
                  :options="['All',...year_options]"
                  label="Year" />
              </div>
              <div class="col-4 q-px-sm" v-if="transparency_type == 2">
                <q-select
                  dense
                  outlined
                  v-model="transparency_quarter"
                  :options="quarter_options"
                  label="Quarter"
                  emit-value
                  map-options/>
              </div>
            </div>
          </template>

          <template v-slot:body="props">
            <q-item :props="props" clickable>
              <q-item-section side top>
                <q-icon
                  size="sm"
                  color="primary"
                  name="description"></q-icon>
              </q-item-section>
              <q-item-section :props="props">
                <q-item-label>
                  {{ props.row.title }} ({{ props.row.year }})
                </q-item-label>
              </q-item-section>
              <q-item-section
                side
                top
                :props="props">
                <q-btn
                  round
                  color="primary"
                  size="sm"
                  icon="download"
                  :href="props.row.path"
                  :target="'_blank'">
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

<q-dialog v-model="report_pdf">
  <q-card style="width:700px" v-if="reportSource">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">
        {{ reportSource.title }} ({{ reportSource.year }})
      </div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup ></q-btn>
    </q-card-section>

    <q-card-section style="max-height: 70vh" class="scroll">
      <vue-pdf-embed :source="reportSource.path" ></vue-pdf-embed>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn label="Download" color="primary" :href="reportSource.path" :download="reportSource.title+'('+reportSource.year+')'"></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>