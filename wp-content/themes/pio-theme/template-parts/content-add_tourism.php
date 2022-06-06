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
          Add Tourism
        </span>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_report_form"
          @submit="addTourism">
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_tourism.title"
              label="Title"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Title']">
            </q-input>
          </div>
          <div class="col-12">
            <q-select
              no-error-icon
              v-model="form_tourism.type"
              :options="tourism_type_options"
              label="Type"
              hide-bottom-space
              emit-value
              map-options
              :rules="[val => !!val || 'Invalid Type']">
            </q-select>
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