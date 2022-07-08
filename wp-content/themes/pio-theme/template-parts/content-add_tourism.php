<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 row justify-center">
    <q-card class="add-post-card col-10 col-md-4">
      <q-card-section class="text-bold text-h5">
        <span>
          Add Tourist Spot
        </span>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          greedy
          ref="add_tourism_form"
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
              map-options
              emit-value
              :rules="[val => !!val || 'Invalid Type']">
            </q-select>
          </div>
          <div class="col-12">
            <q-img
              :src="form_tourism.img ? form_tourism.img_preview : form_tourism.img_preview"
              height="180px"
              class="cursor-pointer"
              @click="$refs.img.$el.click()"
              contain>
              <div class="absolute-center full-height full-width text-subtitle1 row justify-center items-center">
                <span>
                  Click to change
                </span>
              </div>
            </q-img>
            <q-file
              ref="img"
              no-error-icon
              ref="attachments"
              v-model="form_tourism.img"
              accept=".jpg, image/*"
              label="Image"
              :rules="[val => (!!val || !!form_tourism.id) || 'Invalid Image']"
              @input="() => {form_tourism.img_preview = getImageUrl(form_tourism.img)}"
              hide-bottom-space>
            </q-file>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_tourism.address"
              label="Address"
              hide-bottom-space
              :rules="[val => !!val || 'Invalid Address']">
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              autogrow
              no-error-icon
              v-model="form_tourism.description"
              label="Description"
              hide-bottom-space>
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_tourism.contact_no"
              label="Contact Number"
              hide-bottom-space>
            </q-input>
          </div>
          <div class="col-12">
            <q-input
              no-error-icon
              v-model="form_tourism.map_link"
              label="Map Link"
              hide-bottom-space>
            </q-input>
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