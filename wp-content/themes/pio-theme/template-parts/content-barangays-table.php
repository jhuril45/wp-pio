<div class="row justify-center">
  <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'">
    <q-table
      title="CITY BARANGAYS"
      :data="city_barangays"
      :columns="barangay_table_columns"
      row-key="name"
      :title-class="'text-primary text-h5 text-weight-medium'"
    >
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
        </q-tr>
      </template>
      <template v-slot:body="props">
        <q-tr :props="props" no-hover>
          <q-td key="title" :props="props">
            <a :href="props.row.url" class="text-primary text-weight-bold" style="text-decoration: none;">
              {{ props.row.title }}
            </a>
          </q-td>
          <q-td key="head" :props="props">
            {{ props.row.head }}
          </q-td>
        </q-tr>
      </template>
    </q-table>
  </div>
</div>