<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       cgb-carousel
 * @since      1.0.0
 *
 * @package    Cgb_Carousel
 * @subpackage Cgb_Carousel/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="q-app">
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

    <div v-for="image in images" :key="image.id" class="col-3 q-px-sm ">
      <q-card class="my-card">
        <q-card-section class="row justify-center relative-position">
          <q-img
            :src="image.path"
            height="250px"
            width="100%"
            contain>
          </q-img>
          <div class="absolute-top-right">
            <q-btn round icon="close" color="red" @click="deleteImage(image)"></q-btn>
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

  <q-dialog v-model="carousel_dialog">
    <q-card class="my-card">

      <q-card-section class="">
        <q-form
          class="q-gutter-md"
          @submit="submitCarouselImage"
          >
          <q-img
            :src="file_display ? file_display : '<?php echo plugin_dir_url( dirname( __FILE__ ) ).'images/empty-image.png';?>'"
            height="150px"
            width="350px"
            contain></q-img>
          <q-file
            filled
            bottom-slots
            v-model="file"
            label="Select Image"
            counter
            for="example-jpg-file"
            :rules="[val => !!val || 'Image is required']"
            accept=".jpg, image/*"
            @input="addedFile">
            <template v-slot:prepend>
              <q-icon name="cloud_upload" @click.stop />
            </template>
            <template v-slot:append v-if="file">
              <q-icon name="close" @click.stop="file = null" class="cursor-pointer" />
            </template>
          </q-file>

          <div>
            <q-btn label="Submit" type="submit" color="primary" :loading="loading"></q-btn>
            <q-btn v-close-popup label="Close" type="reset" color="primary" flat class="q-ml-sm"></q-btn>
          </div>
        </q-form>
      </q-card-section>
    </q-card>
  </q-dialog>
</div>