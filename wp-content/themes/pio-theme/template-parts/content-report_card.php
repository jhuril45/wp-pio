<div class="row justify-center">
  <div class="report-card" v-if="loading_report">
    <q-skeleton height="200px" square>
    </q-skeleton>
  </div>
  <q-card class="report-card" v-else>
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{report.title}}</div>
      <template v-if="report.type == 1">
        <div class="text-subtitle2">Anually</div>
        <div class="text-subtitle2">Year: {{report.year}}</div>
      </template>
      <template v-else>
      <div class="text-subtitle2">{{ getQuarter(report.quarter) + ' of ' + report.year }}</div>
      </template>
      
    </q-card-section>

    <q-separator></q-separator>

    <q-card-actions align="right">
      <q-btn
        class="full-width"
        label="Download"
        color="primary"
        icon="download"
        :href="report.path"
        :target="'_blank'">
    </q-card-actions>
  </q-card>
</div>