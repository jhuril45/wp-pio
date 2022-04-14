<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       jhuril45@gmail.com
 * @since      1.0.0
 *
 * @package    Add_Post
 * @subpackage Add_Post/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="q-app">
  <div class="row q-py-lg q-gutter-y-md">
    <div class="col-12 row justify-center">
      <q-card class="add-post-card">
        <q-card-section class="text-bold text-h5">
          <span>
            Add Post
          </span>
        </q-card-section>
        <q-card-section>
          <q-form class="row q-gutter-y-lg" @submit="addPost">
            <div class="col-12">
              <q-input v-model="form.title" placeholder="Title"></q-input>
            </div>
            <div class="col-12">
              <q-img
                :src="file_display ? file_display : '<?php echo plugin_dir_url( dirname( __FILE__ ) ).'images/empty-image.png';?>'"
                height="180px"
                class="cursor-pointer"
                @click="$refs.featured_image.$el.click()"
                contain>
                <div class="absolute-bottom text-subtitle1 text-center">
                  Featured Image
                </div>
              </q-img>
              <q-file
                ref="featured_image"
                v-model="form.featured_image"
                accept=".jpg, image/*"
                @input="addedFile"
                v-show="false"></q-file>
            </div>
            <div class="col-12">
              <textarea v-model="form.content" placeholder="Content" class="full-width" style="height:200px;"></textarea>
            </div>
            <div class="col-12 row justify-start">
              <q-btn color="primary" type="submit" :loading="loading">
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
</div>