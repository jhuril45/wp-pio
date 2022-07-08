<q-card>
  <q-card-section class="q-px-sm q-py-md">
    <div class="row justify-center">
      <div class="col-12" :class="$q.screen.lt.md ? 'q-pa-sm' : 'q-pa-sm'">
        <q-table
          flat
          title="Procurement Monitoring Reports"
          :data="procurement_monitorings_data"
          :columns="columns_monitoring_report"
          row-key="name"
          :filter="filter"
        >
          <template v-slot:top>
              <div class="row full-width q-py-sm justify-between q-mb-sm q-gutter-x-sm">
                <div class="col-auto text-h5 text-primary">
                  Procurement Monitoring Reports
                </div>
                <div class="col-grow q-px-sm">
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
                </div>
                <?php if($pagename == 'dashboard'){?>
                  <div class="col-shrink">
                    <q-btn
                      size="sm"
                      color="primary"
                      padding="10px 15px"
                      icon="add"
                      href="<?php echo get_home_url().'/dashboard?tab=add-procurement-monitoring-report';?>"></q-btn>
                  </div>
                <?php }?>
              </div>
            
            <div class="row full-width q-mt-md">
              <div class="col-6 q-px-sm">
                <q-select
                  dense
                  outlined
                  v-model="transparency_year"
                  :options="['All',...year_options]"
                  label="Year"></q-select>
              </div>
              <div class="col-6 q-px-sm">
                <q-select
                  dense
                  outlined
                  v-model="transparency_quarter"
                  :options="[{label:'All',value:0},...quarter_options]"
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

              <q-td key="quarter" :props="props" class="text-primary text-weight-bold">
                <span class="q-pl-sm">
                  {{ getQuarter(props.row.quarter) }}
                </span>
              </q-td>
              
              <q-td class="text-center">
                <?php if($pagename == 'dashboard'){?>
                  <q-btn v-if="page_name == 'dashboard'" size="sm" round color="primary" icon="edit" :href="'<?php echo get_home_url();?>/dashboard?tab=add-procurement-monitoring-report&id='+props.row.id">  
                  </q-btn>
                <?php }?>
                <!-- <q-btn
                  round
                  color="primary"
                  size="sm"
                  icon="view_list"
                  @click="reportSource=props.row;procurements_report_dialog=true">
                </q-btn> -->

                <q-btn
                  size="sm"
                  round
                  color="primary"
                  icon="navigate_next"
                  :href="'<?php echo get_home_url();?>/procurement-monitoring-reports?monitoring_report='+props.row.id">
                </q-btn>
              </q-td>
            </q-tr>
          </template>
        </q-table>
        <q-separator></q-separator>
      </div>
    </div>
  </q-card-section>
</q-card>

<q-dialog v-model="procurements_report_dialog">
  <q-card style="width:700px" v-if="reportSource">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">
        {{ reportSource.title }} ({{ reportSource.year }})
      </div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup ></q-btn>
    </q-card-section>
    <q-card-section style="max-height: 70vh" class="scroll">
      <q-list bordered separator>
        <q-item
          clickable
          v-ripple
          v-for="(attachment,index) in reportSource.attachments"
          :key="'attachment-'+index"
          :href="attachment.path"
          target="_blank">
          <q-item-section>{{attachment.title}}</q-item-section>
        </q-item>
      </q-list>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Close" color="primary" v-close-popup></q-btn>
    </q-card-actions>
  </q-card>
</q-dialog>