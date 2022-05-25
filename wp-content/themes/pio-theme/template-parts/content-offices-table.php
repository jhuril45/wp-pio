<?php 
global $pagename;
?>
<div class="row justify-center">
  <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'">
    <q-table
      title="CITY GOVERNMENT OFFICES"
      :data="offices"
      :columns="offices_table_columns"
      row-key="name"
      :title-class="'text-primary text-h5 text-weight-medium'"
      :filter="filter"
    >
      <template v-slot:top-right>
        <div class="row q-gutter-x-sm">
          <?php if($pagename == 'dashboard'){?>
            <q-btn size="sm" color="primary" padding="0 15px" icon="add" href="<?php echo get_home_url().'/dashboard?tab=add-office';?>"></q-btn>
            </q-btn>
          <?php }?>
          <q-input class="col-auto" outlined dense debounce="300" v-model="filter" placeholder="Search">
            <template v-slot:append>
              <q-icon name="search"></q-icon>
            </template>
          </q-input>
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
            <a :href="'<?php echo get_home_url();?>/offices?office='+props.row.id" class="text-primary text-weight-bold" style="text-decoration: none;">
              {{ props.row.title }}
            </a>
          </q-td>
          <q-td key="head" :props="props">
            {{ props.row.head }}
          </q-td>
          <q-td key="assistant" :props="props">
            {{ props.row.assistant }}
          </q-td>
          <?php if($pagename == 'dashboard'){?>
            <q-td class="text-center" v-if="page_name == 'dashboard'">
              <q-btn size="sm" round color="primary" icon="edit">  
              </q-btn>
            </q-td>
          <?php }?>
          
        </q-tr>
      </template>
    </q-table>
  </div>
</div>