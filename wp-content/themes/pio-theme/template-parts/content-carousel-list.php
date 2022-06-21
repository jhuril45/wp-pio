<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 text-start text-bold text-h5 q-gutter-x-md q-my-md">
    <span>
      Carousel Images
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

  <div v-for="image in carousel_images" :key="image.id" class="col-4 q-px-sm ">
    <q-card class="my-card">
      <q-card-section class="row justify-center relative-position">
        <q-img
          :src="image.path"
          height="200px"
          width="100%"
          cover>
          <div
            v-if="image.caption"
            class="text-caption"
            style="left:35%;top:50%;transform: translate(-50%,-50%);background:rgba(33, 150, 243,0.7)">
            {{image.caption}}
          </div>
        </q-img>
        <div class="absolute-top-right q-gutter-x-xs">
          <q-btn
            round
            icon="edit"
            color="primary"
            @click="editCarouselImage(image)"></q-btn>
          <q-btn
            round
            icon="close"
            color="red"
            @click="deleteImage(image)"></q-btn>
        </div>
      </q-card-section>
      <q-separator ></q-separator>

      <q-card-actions>
        <q-btn flat color="image.is_display ? 'warning' : 'primary'" :label="image.is_display ? 'De Activate' : 'Activate'"
        @click="activateImage(image)">
        </q-btn>
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
        @submit="submitCarouselImage"
        >
        <q-img
          :src="file_display ? file_display : '<?php echo get_template_directory_uri().'/assets/images/empty-image.png';?>'"
          height="150px"
          width="350px"
          contain></q-img>
        <q-file
          filled
          bottom-slots
          v-model="form_carousel.file"
          :label="form_carousel.id ? 'Change Image' : 'Select Image'"
          counter
          for="example-jpg-file"
          :rules="[val => (!!val || !!form_carousel.id) || 'Image is required']"
          accept=".jpg, image/*"
          @input="addedFile">
          <template v-slot:prepend>
            <q-icon name="cloud_upload" @click.stop />
          </template>
          <template v-slot:append v-if="form_carousel.file">
            <q-icon name="close" @click.stop="file = null" class="cursor-pointer" />
          </template>
        </q-file>
        <q-input
          v-model="form_carousel.caption"
          placeholder="Caption"
          outlined
          autogrow
          ></q-input>
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