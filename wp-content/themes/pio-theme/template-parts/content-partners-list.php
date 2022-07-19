<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 text-start text-bold text-h5 q-gutter-x-md q-my-md">
    <span>
      Partner's List
    </span>
    <q-btn
      size="sm"
      color="primary"
      icon="add"
      outline
      @click="carousel_dialog=true">
      <span class="relative-position" style="top:1px;">Add</span>
    </q-btn>
  </div>

  <div v-for="image in partners_list" :key="image.id" class="col-12 col-md-3 q-px-sm ">
    <q-card class="my-card">
      <q-card-section class="row justify-center relative-position">
        <q-img
          :src="image.path"
          height="200px"
          width="100%"
          contain>
        </q-img>
        <div class="absolute-top-right q-gutter-x-xs">
          <q-btn
            round
            icon="edit"
            color="primary"
            @click="editPartnersList(image)"></q-btn>
          <q-btn
            round
            icon="close"
            color="red"
            @click="deletePartnersList(image)"></q-btn>
        </div>
      </q-card-section>
      <q-separator ></q-separator>

      <q-card-actions>
        <q-input
          class="full-width"
          filled
          v-model="image.link"
          label="Link"
          readonly>
        </q-input>
      </q-card-actions>
    </q-card>
    
  </div>
</div>

<q-dialog
  v-model="carousel_dialog"
  persistent>
  <q-card class="my-card">
    <q-card-section class="q-pa-none row">
      <q-space></q-space>
      <q-btn icon="close" color="red" round dense v-close-popup/>
    </q-card-section>
    <q-card-section class="">
      <q-form
        class="q-gutter-md"
        @submit="submitPartnersList"
        >
        <q-img
          :src="form_partners_list.image_preview ? form_partners_list.image_preview : '<?php echo get_template_directory_uri().'/assets/images/empty-image.png';?>'"
          height="100px"
          width="350px"
          contain></q-img>
        <q-file
          filled
          bottom-slots
          v-model="form_partners_list.image"
          :label="form_partners_list.id ? 'Change Image' : 'Select Image'"
          counter
          for="example-jpg-file"
          :rules="[val => (!!val || !!form_partners_list.id) || 'Image is required']"
          accept=".jpg, image/*"
          @input="() => {form_partners_list.image_preview = getImageUrl(form_partners_list.image)}">
          <template v-slot:prepend>
            <q-icon name="cloud_upload" @click.stop></q-icon>
          </template>
          <template v-slot:append v-if="form_partners_list.image">
            <q-icon name="close" @click.stop="form_partners_list.image = null" class="cursor-pointer"></q-icon>
          </template>
        </q-file>
        <q-input
          v-model="form_partners_list.link"
          placeholder="Link"
          outlined
          :rules="[val => !!val || 'Link is required']"></q-input>
        <div>
          <q-btn
            class="full-width"
            label="Submit"
            type="submit"
            color="primary"
            :loading="loading"></q-btn>
        </div>
      </q-form>
    </q-card-section>
  </q-card>
</q-dialog>