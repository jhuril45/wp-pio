<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 row justify-center">
    <q-card class="add-post-card col-10 col-md-4">
      <q-card-section class="text-bold text-h5 row">
        <span>
          {{form_bid_report.id ? 'Edit Bid Report' : 'Add Bid Report'}}
        </span>
        <q-space></q-space>
        <q-btn
          size="sm"
          round
          color="red"
          icon="delete"
          v-if="form_bid_report.id"
          @click="deleteReport(bid,true)"></q-btn>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_bid_report_form"
          @submit="addBidReport">
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_bid_report.title"
              label="Title"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Title']">
            </q-input>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_bid_report.type"
              :options="bid_report_options"
              label="Type"
              hide-bottom-space
              emit-value
              map-options
              :rules="[val => !!val || 'Invalid Report Type']">
            </q-select>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_bid_report.year"
              :options="year_options"
              label="Year"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Year']">
            </q-select>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_bid_report.month"
              :options="month_options"
              label="Month"
              hide-bottom-space
              emit-value
              map-options
              :rules="[val => !!val && val > 0 || 'Invalid Report Month']">
            </q-select>
          </div>
          <div class="col-12">
            <q-file
              no-error-icon
              ref="attachments"
              v-model="form_bid_report.attachment"
              accept=".txt, .pdf, .doc, .xls, .xlsx"
              :label="form_bid_report.id ? 'Change Attachment' : 'Attachment'"
              hide-bottom-space
              :rules="[val => (!!val || !!form_bid_report.id) || 'Invalid Report Attachment']">
            </q-file>
          </div>
          
          <div class="col-12 row justify-start q-gutter-x-md">
            <q-btn class="col-12" color="primary" type="submit" :loading="loading">
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