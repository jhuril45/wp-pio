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
          Add Office
        </span>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_report_form"
          @submit="addOffice">
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_office.title"
              label="Title"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Office Title']">
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_office.head"
              label="Head"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Office Head']">
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_office.assistant"
              label="Assistant"
              hide-bottom-space>
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_office.description"
              label="Short Description"
              hide-bottom-space>
            </q-input>
          </div>
          <div class="col-12">
            <q-img
              :src="file_display ? file_display : '<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';?>'"
              height="180px"
              class="cursor-pointer"
              @click="$refs.featured_image.$el.click()"
              contain>
              <div class="absolute-bottom text-subtitle1 text-center">
                Office Logo
              </div>
            </q-img>
            <q-file
              ref="featured_image"
              v-model="form_office.logo"
              accept=".jpg, image/*"
              @input="addedFile"
              v-show="false"></q-file>
          </div>
          <div class="col-12">
            <q-file
              no-error-icon
              ref="attachments"
              v-model="form_office.org_structure"
              accept=".jpg, image/*"
              label="Org Structure"
              hide-bottom-space>
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