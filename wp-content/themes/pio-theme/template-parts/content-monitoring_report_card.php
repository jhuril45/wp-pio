<div class="row justify-center">
  <q-card class="report-card">
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{monitoring_report.title}}</div>
      <div class="text-subtitle2">{{ getQuarter(monitoring_report.quarter) + ' of ' + monitoring_report.year }}</div>
    </q-card-section>

    <q-separator></q-separator>

    <q-card-actions align="right">
      <div class="q-gutter-y-sm full-width">
        <q-list separator>
          <q-item v-for="(attachment,index) in monitoring_report.attachments" :key="'attachment'+index">
            <q-item-section top>
              <q-item-label lines="2">
                {{attachment.title}}
              </q-item-label>
            </q-item-section>
            <q-item-section side top>
              <q-btn
                class="full-width"
                color="primary"
                icon="download"
                size="sm"
                :href="attachment.path"
                :target="'_blank'">
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </q-card-actions>
  </q-card>
</div>