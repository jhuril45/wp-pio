<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 row justify-center">
    <q-card class="add-post-card col-10 col-md-4">
      <q-card-section class="text-bold text-h5 row">
        <span>
          {{form_procurement_monitoring.id ? 'Edit Procurement Monitoring Report' : 'Add Procurement Monitoring Report'}}
        </span>
        <q-space></q-space>
        <q-btn
          size="sm"
          round
          color="red"
          icon="delete"
          v-if="form_procurement_monitoring.id"
          @click="deleteReport(report)"></q-btn>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_procurement_monitoring_form"
          @submit="addProcurementMonitoring">
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_procurement_monitoring.title"
              label="Title"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Title']">
            </q-input>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_procurement_monitoring.year"
              :options="year_options"
              label="Year"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Year']">
            </q-select>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_procurement_monitoring.quarter"
              :options="quarter_options"
              label="Quarter"
              hide-bottom-space
              emit-value
              map-options
              :rules="[val => !!val || 'Invalid Report Quarter']">
            </q-select>
          </div>
          
          <div class="col-12">
            <q-field
              ref="field"
              v-model="form_procurement_monitoring.attachments"
              :rules="[val => val.length > 0 || 'Attachments is required']"
              no-error-icon>
              <template v-slot:control>
                <q-list class="full-width" separator>
                  <q-item 
                    clickable 
                    v-ripple 
                    v-for="(attachment,index) in form_procurement_monitoring.attachments"
                    :key="'attachment-'+index">
                    <q-item-section>
                      <q-item-label>
                        {{attachment.title}}
                      </q-item-label>
                    </q-item-section>
                    <q-item-section side>
                      <q-btn
                        round
                        size="sm"
                        color="red"
                        icon="cancel"
                        @click="attachment.id ? removeProcurementMonitoringAttachment(attachment) : form_procurement_monitoring.attachments.splice(index,1)"></q-btn>
                    </q-item-section>
                  </q-item>
                  <q-item v-if="form_procurement_monitoring.attachments.length == 0">
                    <q-item-section>
                      <q-item-label class="text-center text-body2">
                        Attachments is Empty
                      </q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </template>
            </q-field>
          </div>
          <div class="col-12">
            <q-btn
              class="col-12 full-width"
              color="warning"
              @click="add_procurement_report_dialog.open = true">
              Add attachments
            </q-btn>
          </div>
          <div class="col-12 row justify-start q-gutter-x-md">
            <q-btn
              class="col-12"
              color="primary"
              type="submit"
              :loading="loading">
              <span>
                Submit
              </span>
            </q-btn>
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</div>


<q-dialog 
  v-model="add_procurement_report_dialog.open"
  persistent>
  <q-card style="width: 500px" class="q-px-sm q-pb-md">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">
        Add Procurement Report
      </div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup></q-btn>
    </q-card-section>
    <q-card-section>
      <q-form
        greedy
        class="row q-gutter-y-md"
        @submit="submitProcurementMonitoringDialog()">
        <div class="col-12">
          <q-input
            outlined
            v-model="add_procurement_report_dialog.data.title"
            outlined
            placeholder="Attachment name"
            :rules="[val => !!val && val.length > 0 || 'Invalid Attachment Name']"
            hide-bottom-space>
          </q-input>
        </div>
        <div class="col-12">
          <q-file
            outlined
            no-error-icon
            ref="attachments"
            v-model="add_procurement_report_dialog.data.file"
            accept=".txt, .pdf, .doc, .xls, .xlsx"
            label="Attachment"
            hide-bottom-space
            :rules="[val => !!val || 'Invalid Attachment']">
          </q-file>
        </div>
        
        <div class="col-12">
          <q-btn
            class="full-width"
            label="Add"
            color="primary"
            type="submit"></q-btn>
        </div>
      </q-form>
    </q-card-section>
  </q-card>
</q-dialog>