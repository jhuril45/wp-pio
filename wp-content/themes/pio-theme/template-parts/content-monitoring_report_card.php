<div class="row justify-center">
  <q-card class="report-card">
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{monitoring_report.title}}</div>
      <div class="text-subtitle2">{{ getQuarter(monitoring_report.quarter) + ' of ' + monitoring_report.year }}</div>
    </q-card-section>

    <q-separator></q-separator>

    <q-card-actions align="right">
      <div class="q-gutter-y-sm full-width">
        <q-btn
          class="full-width"
          :label="attachment.title"
          color="primary"
          icon="download"
          v-for="attachment in monitoring_report.attachments"
          :href="attachment.path"
          :target="'_blank'">
      </div>
    </q-card-actions>
  </q-card>
</div>