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
    <q-card class="add-post-card col-10 col-md-6">
      <q-card-section class="text-bold text-h5 row">
        <span>
          {{form_barangay.id ? 'Edit Barangay' : 'Add Barangay'}}
        </span>
        <q-space></q-space>
        <q-btn
          size="sm"
          round
          color="red"
          icon="delete"
          v-if="form_barangay.id"
          @click="deleteBarangay(barangay,true)"></q-btn>
      </q-card-section>
      <q-card-section
        class="q-pa-none">
        <q-form
          class="row"
          greedy
          ref="add_barangay_form"
          @submit="form_step < 4 ? validForm('add_barangay_form','form_step') : addBarangay()">
          <q-stepper
            class="col-12"
            v-model="form_step"
            vertical
            color="primary"
            animated
            header-nav
            flat>
            <q-step
              :name="1"
              title="Information "
              icon="info"
              :done="form_step > 1"
              :header-nav="form_step > 1">
              <div class="row q-gutter-y-sm">
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.title"
                    label="Title"
                    hide-bottom-space
                    :rules="[val => !!val || 'Invalid Barangay Title']">
                  </q-input>
                </div>
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.address"
                    label="Address"
                    hide-bottom-space
                    :rules="[val => !!val || 'Invalid Barangay Address']">
                  </q-input>
                </div>
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.contact_no"
                    label="Contact Number"
                    hide-bottom-space
                    :rules="[val => !!val || 'Invalid Barangay Contact Number']">
                  </q-input>
                </div>
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.population"
                    label="Population"
                    type="number"
                    hide-bottom-space
                    :rules="[val => !!val && val > 0 || 'Invalid Barangay Population']">
                  </q-input>
                </div>
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.land_area"
                    label="Land area"
                    type="number"
                    hide-bottom-space
                    :rules="[val => !!val && val > 0 || 'Invalid Barangay Land area']">
                  </q-input>
                </div>
              </div>

              <q-stepper-navigation>
                <q-btn type="submit" color="primary" label="Continue" v-if="form_step == 1"></q-btn>
              </q-stepper-navigation>
            </q-step>

            <q-step
              :name="2"
              title="Landmark"
              icon="landscape"
              :done="form_step > 2"
              :header-nav="form_step > 2">
              <div class="row q-gutter-y-sm">
                <div class="col-12 relative-position">
                  <q-img
                    :src="form_barangay.landmark_preview"
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
                    v-model="form_barangay.landmark_image"
                    accept=".jpg, image/*"
                    @input="() => {form_barangay.landmark_preview = getImageUrl(form_barangay.landmark_image)}"
                    v-show="false">
                  </q-file>
                  <q-btn
                    class="absolute-top-right"
                    size="sm"
                    round
                    color="red"
                    icon="close"
                    v-if="form_barangay.id && form_barangay.landmark_image"
                    @click="form_barangay.landmark_image=null;form_barangay.landmark_preview=barangay.landmark_img"></q-btn>
                </div>
                <div class="col-12">
                  <q-input
                    no-error-icon
                    v-model="form_barangay.landmark_name"
                    label="Name"
                    hide-bottom-space
                    :rules="[val => !!val || 'Invalid Landmark']">
                  </q-input>
                </div>
                <div class="col-12">
                  <q-editor
                    ref="editor_ref"
                    v-model="form_barangay.description"
                    @paste.native="evt => pasteCapture(evt)"
                    placeholder="Description"
                    :toolbar="[
                      ['bold', 'italic', 'underline']
                    ]"
                    height="50vh">
                  </q-editor>
                </div>
              </div>

              <q-stepper-navigation>
                <q-btn type="submit" color="primary" label="Continue" v-if="form_step == 2"></q-btn>
                <q-btn flat @click="form_step = 1" color="primary" label="Back" class="q-ml-sm"></q-btn>
              </q-stepper-navigation>
            </q-step>

            <q-step
              :name="3"
              title="Officials"
              icon="groups"
              :done="form_step > 3"
              :header-nav="form_step > 3">
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
                      label="Add Officials"
                      @click="add_barangay_dialog.is_service = false;add_barangay_dialog.open = true">
                    </q-btn>
                  </div>
                </q-card-section>
                <q-card-section>
                  <q-field
                    ref="field"
                    v-model="form_barangay.officials"
                    borderless
                    :rules="[val => val.length > 0 || 'Officials is required']"
                  >
                    <template v-slot:control>
                      <q-list class="full-width" separator>
                        <q-item 
                          clickable 
                          v-ripple 
                          v-for="(official,index) in form_barangay.officials"
                          :key="'official-'+index">
                          <q-item-section thumbnail class="q-px-sm">
                            <img :src="official.id ? official.path : getImageUrl(official.image)">
                          </q-item-section>
                          <q-item-section>
                            <q-item-label>
                              {{official.name}}
                            </q-item-label>
                            <q-item-label caption>{{getBarangayPosition(official.position) ? getBarangayPosition(official.position).label : ''}}</q-item-label>
                          </q-item-section>
                          <q-item-section side>
                            <q-btn
                              round
                              size="sm"
                              color="red"
                              icon="cancel"
                              @click="official.id ? removeBarangayAttachments('official',official) : form_barangay.officials.splice(index,1)"></q-btn>
                          </q-item-section>
                        </q-item>
                        <q-item v-if="form_barangay.officials.length == 0">
                          <q-item-section>
                            <q-item-label class="text-center text-body2">
                              Empty
                            </q-item-label>
                          </q-item-section>
                        </q-item>
                      </q-list>
                    </template>
                  </q-field>
                </q-card-section>
              </q-card>

              <q-stepper-navigation>
                <q-btn type="submit" color="primary" label="Continue" v-if="form_step == 3"></q-btn>
                <q-btn flat @click="form_step = 1" color="primary" label="Back" class="q-ml-sm"></q-btn>
              </q-stepper-navigation>
            </q-step>

            <q-step
              :name="4"
              title="Services"
              icon="home_repair_service"
              :done="form_step > 4"
              :header-nav="form_step > 4">
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
                      label="Add Services"
                      @click="add_barangay_dialog.is_service = true;add_barangay_dialog.open = true">
                    </q-btn>
                  </div>
                </q-card-section>
                <q-card-section>
                  <q-list separator>
                    <q-separator></q-separator>
                    <q-item 
                      clickable 
                      v-ripple 
                      v-for="(service,index) in form_barangay.services"
                      :key="'service-'+index">
                      <q-item-section thumbnail class="q-px-sm">
                        <img :src="service.id ? service.path : getImageUrl(service.image)">
                      </q-item-section>
                      <q-item-section>
                        <q-item-label>
                          {{service.title}}
                        </q-item-label>
                      </q-item-section>
                      <q-item-section side>
                        <q-btn
                          round
                          size="sm"
                          color="red"
                          icon="cancel"
                          @click="service.id ? removeBarangayAttachments('service',service) : form_barangay.services.splice(index,1)"></q-btn>
                      </q-item-section>
                    </q-item>
                    <q-item v-if="form_barangay.services.length == 0">
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
                <q-btn type="submit" color="primary" label="Submit" v-if="form_step == 4"></q-btn>
                <q-btn flat @click="form_step = 1" color="primary" label="Back" class="q-ml-sm"></q-btn>
              </q-stepper-navigation>
            </q-step>
          </q-stepper>
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</div>

<q-dialog 
  v-model="add_barangay_dialog.open"
  persistent>
  <q-card style="width: 500px" class="q-px-sm q-pb-md">
    <q-card-section class="row items-center q-pb-none">
      <div class="text-h6">
        {{add_barangay_dialog.is_service ? 'Add Service' : 'Add Officials'}}
      </div>
      <q-space></q-space>
      <q-btn icon="close" flat round dense v-close-popup></q-btn>
    </q-card-section>
    <q-card-section>
      <q-form
        v-if="add_barangay_dialog.is_service"
        greedy
        class="row q-gutter-y-md"
        @submit="addBarangayDialog(true)">
        <div class="col-12 q-gutter-y-md">
          <q-img
            :src="add_barangay_dialog.service.image ? add_barangay_dialog.preview : '<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';?>'"
            height="180px"
            class="cursor-pointer"
            @click="$refs.featured_image.$el.click()"
            contain>
          </q-img>
          <q-file
            outlined
            ref="featured_image"
            v-model="add_barangay_dialog.service.image"
            label="Service Image"
            accept=".jpg,image/*"
            @input="() => {add_barangay_dialog.preview = getImageUrl(add_barangay_dialog.service.image)}"
            :rules="[val => !!val || 'Invalid Service Image']"
            hide-bottom-space>
          </q-file>
        </div>
        <div class="col-12">
          <q-input
            outlined
            v-model="add_barangay_dialog.service.title"
            outlined
            placeholder="Service name"
            :rules="[val => !!val && val.length > 0 || 'Invalid Service Name']"
            hide-bottom-space>
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
        @submit="addBarangayDialog()">
        <div class="col-12 q-gutter-y-sm">
          <q-img
            :src="add_barangay_dialog.official.image_preview ? add_barangay_dialog.official.image_preview : '<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';?>'"
            height="180px"
            class="cursor-pointer"
            @click="$refs.featured_image.$el.click()"
            contain>
          </q-img>
          <q-file
            outlined
            ref="featured_image"
            v-model="add_barangay_dialog.official.image"
            label="Image"
            accept=".jpg,image/*"
            @input="() => {add_barangay_dialog.official.image_preview = getImageUrl(add_barangay_dialog.official.image)}"
            :rules="[val => !!val || 'Invalid Image']"
            hide-bottom-space>
          </q-file>
        </div>
        <div class="col-12">
          <q-input
            outlined
            v-model="add_barangay_dialog.official.name"
            label="Name"
            :rules="[val => !!val && val.length > 0 || 'Invalid name']"
            hide-bottom-space>
          </q-input>
        </div>
        <div class="col-12">
          <q-select
            outlined
            v-model="add_barangay_dialog.official.position"
            :options="form_barangay_positions"
            label="Position"
            :rules="[val => !!val || 'Invalid name']"
            hide-bottom-space
            emit-value
            map-options></q-select>
        </div>
        <div class="col-12">
          <q-btn
            class="full-width"
            label="Add"
            color="primary"
            type="submit">
          </q-btn>
        </div>
      </q-form>
      
    </q-card-section>
  </q-card>
</q-dialog>