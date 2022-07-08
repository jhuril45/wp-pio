<div class="row justify-center">
  <q-card class="report-card">
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{report.title}}</div>
      <div class="text-subtitle2" v-if="report.type == 1">{{ 'Annually' }}</div>
      <div class="text-subtitle2" v-else>{{ getQuarter(report.quarter) + ' of ' + report.year }}</div>
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