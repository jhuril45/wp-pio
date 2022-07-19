<?php
  if(is_user_logged_in()){
    wp_register_script('add-post-script', get_template_directory_uri() . '/assets/js/add_post.js',array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'add-post-script');
  }
?>

<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 row justify-center">
    <q-card class="add-post-card col-12 col-md-6">
      <q-card-section class="text-bold text-h5 row">
        <span>
          {{form_post.id ? 'Edit Post' : 'Add Post'}}
        </span>
        <q-space></q-space>
        <q-btn
          size="sm"
          round
          color="red"
          icon="delete"
          v-if="form_post.id"
          @click="deletePost(form_post)"></q-btn>
      </q-card-section>
      <q-card-section>
        <q-form
          class="row q-gutter-y-lg"
          ref="add_post_form"
          greedy
          @submit="addPost">
          <div class="col-12">
            <q-input
              v-model="form_post.title"
              placeholder="Title"
              :rules="[val => !!val || 'Invalid Post Title']">
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
                Featured Image
              </div>
            </q-img>
            <q-file
              ref="featured_image"
              v-model="form_post.featured_image"
              accept=".jpg, image/*"
              @input="addedFile"
              v-show="false"></q-file>
          </div>
          <div class="col-12">
            <q-editor
              ref="editor_ref"
              v-model="form_post.content"
              @paste.native="evt => pasteCapture(evt)"
              :toolbar="[
                ['bold', 'italic', 'underline']
              ]"
              height="50vh">
            </q-editor>
            <q-input
              v-if="false"
              v-model="form_post.content"
              placeholder="Content"
              class="full-width"
              outlined
              autogrow
              :rules="[val => !!val || 'Invalid Post Title']">
            </q-input>
          </div>
          <div class="col-12">
            <div class="text-body1">
              Attachments
            </div>
            <q-file
              ref="attachments"
              v-model="images"
              accept=".jpg, image/*"
              @input="(value) => {addedFile(value,true)}"
              multiple
              v-show="false"></q-file>
            <q-scroll-area class="row q-py-xs" style="height:220px;">
              <div class="row no-wrap q-gutter-x-sm relative-position">
                <div @click="$refs.attachments.$el.click()" class="q-px-sm z-top bg-white row items-center justify-center cursor-pointer" style="height:200px;width:150px;position: -webkit-sticky;position: sticky;left: 0;">
                  <div class="relative-position row">
                    <div class="col-12 flex justify-center">
                      <q-icon style="font-size: 100px;" name="fa fa-images"></q-icon>
                    </div>
                    <div class="col-12 text-center text-subtitle2 text-bold q-pt-sm">Add attachment</div>
                  </div>
                </div>
                <div v-for="(attachment,index) in form_post.existing_attachments" :key="attachment.ID" class="q-pa-sm relative-position" style="height:200px;width:150px">
                  <q-img
                    cover
                    height="100%"
                    width="100%"
                    :src="attachment.src">
                  </q-img>
                  <span class="absolute-top-right">
                    <q-btn
                      @click="removePostAttachment(attachment)"
                      size="sm"
                      padding="5px 5px"
                      round
                      color="red"
                      icon="close">
                    </q-btn>
                  </span>
                </div>
                <div v-for="(attachment,index) in form_post.attachments" :key="attachment['__key']" class="q-pa-sm relative-position" style="height:200px;width:150px">
                  <q-img
                    cover
                    height="100%"
                    width="100%"
                    :src="getImageUrl(attachment)">
                  </q-img>
                  <span class="absolute-top-right">
                    <q-btn
                      @click="removeAttachment(attachment)"
                      size="sm"
                      padding="5px 5px"
                      round
                      color="red"
                      icon="close">
                    </q-btn>
                  </span>
                </div>
              </div>
            </q-scroll-area>
          </div>
          
          <div class="col-12 row justify-start q-gutter-x-md">
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