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
                <div v-for="(attachment,index) in form.attachments" :key="attachment['__key']" class="q-pa-sm relative-position" style="height:200px;width:150px">
                  <q-img cover height="100%" width="100%" :src="URL.createObjectURL(attachment)">
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