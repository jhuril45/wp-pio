<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row q-gutter-y-md">
      <div class="col-12">
        <q-table
          flat
          title="Reports"
          :data="reports_data"
          :columns="columns_report"
          row-key="name"
          :filter="filter"
        >
          <template v-slot:top>
            <?php if($pagename == 'dashboard'){?>
              <div class="row full-width q-py-sm justify-end q-mb-sm">
                <div class="col-shrink q-px-md">
                  <q-btn
                    size="sm"
                    color="primary"
                    padding="10px 15px"
                    icon="add"
                    href="<?php echo get_home_url().'/dashboard?tab=add-report';?>"></q-btn>
                </div>
              </div>
            <?php }?>
            <div class="row full-width">
              <div class="q-px-sm" :class="transparency_type == 2 ? 'col-4' : 'col-6'">
                <q-select
                  dense
                  outlined
                  v-model="transparency_type"
                  :options="report_options"
                  label="Report type"
                  emit-value
                  map-options></q-select>
              </div>
              <div class="q-px-sm" :class="transparency_type == 2 ? 'col-4' : 'col-6'">
                <q-select
                  dense
                  outlined
                  v-model="transparency_year"
                  :options="['All',...year_options]"
                  label="Year"></q-select>
              </div>
              <div class="col-4 q-px-sm" v-if="transparency_type == 2">
                <q-select
                  dense
                  outlined
                  v-model="transparency_quarter"
                  :options="quarter_options"
                  label="Quarter"
                  emit-value
                  map-options></q-select>
              </div>
            </div>
          </template>

          <template v-slot:header="props">
            <q-tr :props="props">
              <q-th
                v-for="col in props.cols"
                :key="col.name"
                :props="props"
              >
                <span class="text-body2">
                  {{ col.label }}
                </span>
              </q-th>
              <q-th>
                <span class="text-body2">
                  Actions
                </span>
              </q-th>
            </q-tr>
          </template>

          <template v-slot:body="props">
            <q-tr :props="props">
              <q-td key="title" :props="props" class="text-primary text-weight-bold">
                <q-icon
                  size="sm"
                  color="primary"
                  name="description"></q-icon>
                <span class="q-pl-sm">
                  {{ props.row.title }} ({{ props.row.year }})
                </span>
              </q-td>
              
                <q-td class="text-center" >
                  <?php if($pagename == 'dashboard'){?>
                    <q-btn v-if="page_name == 'dashboard'" size="sm" round color="primary" icon="edit" :href="'<?php echo get_home_url();?>/dashboard?tab=add-report&id='+props.row.id">  
                    </q-btn>
                  <?php }?>
                  <q-btn
                    size="sm"
                    round
                    color="primary"
                    icon="navigate_next"
                    :href="'<?php echo get_home_url();?>/reports?report='+props.row.id">
                  </q-btn>
                </q-td>
              
            </q-tr>
            <q-item :props="props" clickable v-if="false">
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