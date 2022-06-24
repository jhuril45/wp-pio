<div class="row justify-center">
  <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'">
    <q-table
      title="CITY TOURISM"
      :data="city_tourism"
      :columns="tourism_table_columns"
      row-key="name"
      :title-class="'text-primary text-h5 text-weight-medium'"
      :filter="filter"
    >
      <template v-slot:top>
        <div class="row full-width justify-end">
          <div class="col-grow text-start text-h5 text-primary">
            City Tourism
          </div>
          <div class="col-3 q-px-md">
            <q-select
              outlined
              v-model="tourism_type"
              :options="[{label:'All',value:0},...tourism_type_options]"
              label="Type"
              dense
              emit-value
              map-options></q-select>
          </div>
          <div class="col-4 q-px-md">
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
            <div class="col-shrink q-px-md">
              <q-btn
                size="sm"
                color="primary"
                padding="10px 15px"
                icon="add"
                href="<?php echo get_home_url().'/dashboard?tab=add-tourism';?>"></q-btn>
            </div>
          <?php }?>
          
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
          <?php if($pagename == 'dashboard'){?>
            <q-th>
              <span class="text-body2">
                ACTIONS
              </span>
            </q-th>
          <?php }?>
        </q-tr>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props" no-hover>
          <q-td key="title" :props="props">
            <span class="text-primary text-weight-bold">
              {{ props.row.title }}
            </span>
          </q-td>
          <q-td key="type" :props="props">
            {{ props.row.type == 1 ? 'Place to Go' : 'Place to Stay' }}
          </q-td>
          <?php if($pagename == 'dashboard'){?>
            <q-td class="text-center" v-if="page_name == 'dashboard'">
              <q-btn size="sm" round color="primary" icon="edit" :href="'<?php echo get_home_url();?>/dashboard?tab=add-tourism&id='+props.row.id">  
              </q-btn>
              <q-btn size="sm" round color="red" icon="delete" @click="removeTourism(props.row)">  
              </q-btn>
            </q-td>
          <?php }?>
        </q-tr>
      </template>
    </q-table>
  </div>
</div>