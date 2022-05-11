<?php 
  wp_localize_script('vue-main', 'Rest', [
    'nonce' => wp_create_nonce('wp_rest'),
  ]);
  if(is_user_logged_in()){
    wp_register_script('add-post-script', get_template_directory_uri() . '/assets/js/add_post.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'add-post-script');
  }
?>

<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 row justify-center">
    <q-card class="add-post-card col-10 col-md-4">
      <q-card-section class="text-bold text-h5">
        <span>
          Add Report
        </span>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_report_form"
          @submit="addReport">
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_report.title"
              label="Title"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Title']">
            </q-input>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_report.type"
              :options="report_options"
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
              v-model="form_report.year"
              :options="year_options"
              label="Year"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Year']">
            </q-select>
          </div>
          <div class="col-12" v-if="form_report.type == '2'">
            <q-select
              no-error-icon
              v-model="form_report.quarter"
              :options="quarter_options"
              label="Quarter"
              hide-bottom-space
              emit-value
              map-options
              :rules="[val => !!val || 'Invalid Report Quarter']">
            </q-select>
          </div>
          <div class="col-12">
            <q-file
              no-error-icon
              ref="attachments"
              v-model="form_report.attachment"
              accept=".txt, .pdf, .doc, .xls, .xlsx"
              label="Attachment"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Report Attachment']">
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