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
    <q-card class="add-post-card col-10 col-md-5">
      <q-card-section class="text-bold text-h5">
        <span>
          {{form_office.id ? 'Edit Office' : 'Add Office'}}
        </span>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_office_form"
          @submit="form_step < 6 ? validForm('add_office_form','form_step') : addOffice()">
          <div class="col-12">
            <q-stepper
              v-model="form_step"
              vertical
              header-nav
              color="primary"
              animated
              flat>
              <q-step
                :name="1"
                title="Details"
                icon="reorder"
                :done="form_step > 1"
                :header-nav="form_step > 1">
                <div class="row q-gutter-y-md">
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
                </div>
                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                </q-stepper-navigation>
              </q-step>

              <q-step
                :name="2"
                title="Social Media"
                icon="language"
                :done="form_step > 2"
                :header-nav="form_step > 2">
                <div class="row q-gutter-y-md">
                  <div class="col-12">
                    <q-input
                      no-error-icon
                      v-model="form_office.email"
                      label="Email"
                      hide-bottom-space>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input
                      no-error-icon
                      v-model="form_office.facebook"
                      label="Facebook"
                      hide-bottom-space>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input
                      no-error-icon
                      v-model="form_office.twitter"
                      label="Twitter"
                      hide-bottom-space>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input
                      no-error-icon
                      v-model="form_office.instagram"
                      label="Instagram"
                      hide-bottom-space>
                    </q-input>
                  </div>
                  <div class="col-12">
                    <q-input
                      no-error-icon
                      v-model="form_office.youtube"
                      label="Youtube"
                      hide-bottom-space>
                    </q-input>
                  </div>
                </div>

                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                  <q-btn flat @click="form_step--" color="primary" label="Back" class="q-ml-sm"></q-btn>
                </q-stepper-navigation>
              </q-step>

              <q-step
                :name="3"
                title="Office Logo"
                icon="image"
                :done="form_step > 3"
                :header-nav="form_step > 3">
                <div class="row q-gutter-y-md">
                  <div class="col-12">
                    <q-img
                      :src="form_office.logo ? getImageUrl(form_office.logo) : form_office.logo_preview"
                      height="180px"
                      class="cursor-pointer"
                      @click="$refs.featured_image.$el.click()"
                      contain>
                      <div class="absolute-center full-height full-width text-subtitle1 row justify-center items-center">
                        <span>
                          Click to change
                        </span>
                      </div>
                    </q-img>
                    <q-file
                      ref="featured_image"
                      v-model="form_office.logo"
                      accept=".jpg, image/*"
                      @input="addedFile"
                      label="Office Logo"
                      :rules="[val => (!!val || !!form_office.id) || 'Invalid Office Logo']">
                    </q-file>
                  </div>
                </div>

                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                  <q-btn flat @click="form_step--" color="primary" label="Back" class="q-ml-sm"></q-btn>
                </q-stepper-navigation>
              </q-step>

              <q-step
                :name="4"
                title="Office Structure"
                icon="image"
                :done="form_step > 4"
                :header-nav="form_step > 4">
                <div class="row q-gutter-y-md">
                  <div class="col-12">
                    <q-img
                      :src="form_office.org_structure ? getImageUrl(form_office.org_structure) : form_office.org_structure_preview"
                      height="180px"
                      class="cursor-pointer"
                      @click="$refs.org_structure.$el.click()"
                      contain>
                      <div class="absolute-center full-height full-width text-subtitle1 row justify-center items-center">
                        <span>
                          Click to change
                        </span>
                      </div>
                    </q-img>
                    <q-file
                      ref="org_structure"
                      no-error-icon
                      ref="attachments"
                      v-model="form_office.org_structure"
                      accept=".jpg, image/*"
                      label="Org Structure"
                      :rules="[val => (!!val || !!form_office.id) || 'Invalid Office Logo']">
                    </q-file>
                  </div>
                </div>

                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                  <q-btn flat @click="form_step--" color="primary" label="Back" class="q-ml-sm"></q-btn>
                </q-stepper-navigation>
              </q-step>

              <q-step
                :name="5"
                title="Services"
                icon="image"
                :done="form_step > 5"
                :header-nav="form_step > 5">
                <q-card class="q-px-none" flat>
                  <q-card-section>
                    <div class="row">
                      <q-space></q-space>
                      <q-btn
                        class=""
                        size="sm"
                        color="primary"
                        padding="10px 15px"
                        icon="add"
                        label="Add Service"
                        @click="add_office_dialog.is_service = true;add_office_dialog.open = true">
                      </q-btn>
                    </div>
                  </q-card-section>
                  <q-card-section>
                    <q-list separator>
                      <q-separator></q-separator>
                      <q-item 
                        clickable 
                        v-ripple 
                        v-for="(service,index) in form_office.services"
                        :key="'service-'+index">
                        <q-item-section thumbnail class="q-px-sm">
                          <img :src="service.id ? service.path : getImageUrl(service.image)">
                        </q-item-section>
                        <q-item-section>
                          {{service.title}}
                        </q-item-section>
                        <q-item-section side>
                          <q-btn
                            round
                            size="sm"
                            color="red"
                            icon="cancel"
                            @click="service.id ? '' : form_office.services.splice(index,1)"></q-btn>
                        </q-item-section>
                      </q-item>
                      <q-item v-if="form_office.services.length == 0">
                        <q-item-section>
                          <q-item-label class="text-center text-body2">
                            Empty
                          </q-item-label>
                        </q-item-section>
                      </q-item>
                    </q-list>
                  </q-card-section>
                </q-card>

                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                  <q-btn flat @click="form_step--" color="primary" label="Back" class="q-ml-sm"></q-btn>
                </q-stepper-navigation>
              </q-step>

              <q-step
                :name="6"
                title="Forms"
                icon="image"
                :done="form_step > 6"
                :header-nav="form_step > 6">
                <q-card class="q-px-none">
                  <q-card-section>
                    <div class="row">
                      <q-space></q-space>
                      <q-btn
                        class=""
                        size="sm"
                        color="primary"
                        padding="10px 15px"
                        icon="add"
                        label="Add Form"
                        @click="add_office_dialog.is_service = false;add_office_dialog.open = true">
                      </q-btn>
                    </div>
                  </q-card-section>
                  <q-card-section>
                    <q-list separator>
                      <q-separator></q-separator>
                      <q-item 
                        clickable 
                        v-ripple 
                        v-for="(form,index) in form_office.forms"
                        :key="'form-'+index">
                        <q-item-section>
                          {{form.title}}
                        </q-item-section>
                        <q-item-section side>
                          <q-btn
                            round
                            size="sm"
                            color="red"
                            icon="cancel"
                            @click="form.id ? '' : form_office.forms.splice(index,1)"></q-btn>
                        </q-item-section>
                      </q-item>
                      <q-item v-if="form_office.forms.length == 0">
                        <q-item-section>
                          <q-item-label class="text-center text-body2">
                            Empty
                          </q-item-label>
                        </q-item-section>
                      </q-item>
                    </q-list>
                  </q-card-section>
                </q-card>

                <q-stepper-navigation>
                  <q-btn type="submit" color="primary" label="Continue"></q-btn>
                  <q-btn flat @click="form_step--" color="primary" label="Back" class="q-ml-sm"></q-btn>
                </q-stepper-navigation>
              </q-step>
            </q-stepper>
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</div>

<q-dialog v-model="add_office_dialog.open">
  <q-card style="width: 500px" class="q-px-sm q-pb-md">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">
        {{add_office_dialog.is_service ? 'Add Service' : 'Add Form'}}
      </div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup></q-btn>
    </q-card-section>
    <q-card-section>
      <q-form
        v-if="add_office_dialog.is_service"
        greedy
        class="row q-gutter-y-md"
        @submit="addOfficeService(true)">
        <div class="col-12 q-gutter-y-md">
          <q-img
            :src="add_office_dialog.service.image ? getImageUrl(add_office_dialog.service.image) : '<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';?>'"
            height="180px"
            class="cursor-pointer"
            @click="$refs.featured_image.$el.click()"
            contain>
          </q-img>
          <q-file
            outlined
            ref="featured_image"
            v-model="add_office_dialog.service.image"
            label="Service Image"
            accept=".jpg,image/*"
            :rules="[val => !!val || 'Invalid Service Image']">
          </q-file>
        </div>
        <div class="col-12">
          <q-input
            v-model="add_office_dialog.service.title"
            outlined
            placeholder="Service name"
            :rules="[val => !!val && val.length > 0 || 'Invalid Service Name']">
          </q-input>
        </div>
        <div class="col-12">
          <q-btn
            class="full-width"
            label="Add"
            color="primary"
            type="submit"></q-btn>
        </div>
      </q-form>

      <q-form
        v-else
        greedy
        class="row q-gutter-y-md"
        @submit="addOfficeService()">
        <div class="col-12 q-gutter-y-md">
          <q-file
            outlined
            ref="featured_image"
            v-model="add_office_dialog.form.file"
            label="Form"
            :rules="[val => !!val || 'Invalid Form']">
          </q-file>
        </div>
        <div class="col-12">
          <q-input
            v-model="add_office_dialog.form.title"
            outlined
            placeholder="Form name"
            :rules="[val => !!val && val.length > 0 || 'Invalid Form name']">
          </q-input>
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