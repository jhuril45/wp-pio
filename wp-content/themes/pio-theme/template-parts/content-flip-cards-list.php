<div class="row q-py-lg q-gutter-y-md">
  <div class="col-12 text-start text-bold text-h5 q-gutter-x-md q-my-md">
    <span>
      Flip Cards
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

  <div v-for="flip in flip_cards" :key="flip.id" class="col-4 q-pa-sm ">
    <q-card class="my-card">
      <q-card-section class="q-pa-sm">
          <div class="row justify-end q-gutter-x-xs relative">
          <q-btn
            round
            icon="edit"
            color="primary"
            @click="editFlipCard(flip)"></q-btn>
          <q-btn
            round
            icon="close"
            color="red"
            @click="deleteFlipCard(flip)"></q-btn>
        </div>
      </q-card-section>
      <q-separator></q-separator>
      <q-card-section class="q-pa-none">
        <div class="flip-card relative-position">
          <div class="flip-card-inner">
            <div class="flip-card-front rounded-borders relative-position" >
              <q-img
                cover
                height="100%"
                :src="flip.image_path">
                <div
                  class="absolute-full flex flex-center"
                  style="opacity: 0.6;"
                  :style="{backgroundColor:flip.bg_color,color:flip.text_color}">
                </div>
              </q-img>
              <div class="text-h6 absolute-center" :style="{color:flip.text_color}">
                <q-icon
                  :name="'img:'+flip.icon_path"
                  color="white"
                  size="60px">
                </q-icon>
                <p class="text-h6">
                  {{flip.title}}
                </p>
              </div>
            </div>
            <div class="flip-card-back rounded-borders" :style="{backgroundColor:flip.bg_color,color:flip.text_color}">
              <div class="fit row items-center">
                <div class="text-center q-px-sm">
                  <p>{{flip.description}}</p>
                  <q-btn
                    v-if="false"
                    rounded
                    color="primary"
                    label="View More"
                    @click="page_dialog.data=flip;tab='description';page_dialog.open=true"
                    text-color="white"
                    outline></q-btn>
                </div>
              </div>
            </div>
          </div>
        </div>
      </q-card-section>
    </q-card>
    
    
  </div>
</div>

<q-dialog
  v-model="carousel_dialog"
  persistent>
  <q-card class="my-card">
    <q-card-section class="q-pa-sm row">
      <div class="text-h6">
        Add Flip Card
      </div>
      <q-space></q-space>
      <q-btn icon="close" color="red" round dense v-close-popup/>
    </q-card-section>
    <q-separator></q-separator>
    <q-card-section style="max-height: 80vh" class="scroll">
      <q-form
        class="q-gutter-md"
        @submit="submitFlipCard"
        greedy>
        <q-img
          :src="form_flip_cards.image_preview ? form_flip_cards.image_preview : '<?php echo get_template_directory_uri().'/assets/images/empty-image.png';?>'"
          height="100px"
          width="350px"
          contain></q-img>
        <q-file
          filled
          bottom-slots
          v-model="form_flip_cards.image"
          :label="form_flip_cards.id ? 'Change Image' : 'Select Image'"
          counter
          for="example-jpg-file"
          :rules="[val => (!!val || !!form_flip_cards.id) || 'Image is required']"
          accept=".jpg, image/*"
          @input="() => {form_flip_cards.image_preview = getImageUrl(form_flip_cards.image)}">
          <template v-slot:prepend>
            <q-icon name="cloud_upload" @click.stop></q-icon>
          </template>
          <template v-slot:append v-if="form_flip_cards.image">
            <q-icon name="close" @click.stop="form_flip_cards.image = null" class="cursor-pointer"></q-icon>
          </template>
        </q-file>
        <div class="bg-dark q-py-md">
          <q-img
            :src="form_flip_cards.icon_preview ? form_flip_cards.icon_preview : '<?php echo get_template_directory_uri().'/assets/images/empty-image.png';?>'"
            height="50px"
            width="350px"
            contain></q-img>
        </div>
        <q-file
          filled
          bottom-slots
          v-model="form_flip_cards.icon"
          :label="form_flip_cards.id ? 'Change Icon' : 'Select Icon'"
          counter
          for="example-jpg-file"
          :rules="[val => (!!val || !!form_flip_cards.id) || 'Icon is required']"
          accept=".jpg, image/*"
          @input="() => {form_flip_cards.icon_preview = getImageUrl(form_flip_cards.icon)}">
          <template v-slot:prepend>
            <q-icon name="cloud_upload" @click.stop></q-icon>
          </template>
          <template v-slot:append v-if="form_flip_cards.icon">
            <q-icon name="close" @click.stop="form_flip_cards.icon = null" class="cursor-pointer"></q-icon>
          </template>
        </q-file>
        <q-input
          v-model="form_flip_cards.title"
          placeholder="Title"
          outlined
          :rules="[val => (!!val && val.length > 0) || 'Title is required']"
          hide-bottom-space
          ></q-input>
        <q-input
          v-model="form_flip_cards.description"
          placeholder="Description"
          outlined
          autogrow
          :rules="[val => (!!val && val.length > 0) || 'Description is required']"
          hide-bottom-space></q-input>
        <q-input
          filled
          v-model="form_flip_cards.text_color"
          label="Text Color"
          readonly
          :rules="[val => (!!val && val.length > 0) || 'Color is required']"
          :input-style="{color:form_flip_cards.text_color}">
          <template v-slot:append>
            <q-icon name="colorize" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-color v-model="form_flip_cards.text_color"></q-color>
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
        <q-input
          filled
          v-model="form_flip_cards.bg_color"
          label="Background Color"
          readonly
          :rules="[val => (!!val && val.length > 0) || 'Background color is required']"
          :input-style="{color:form_flip_cards.bg_color}">
          <template v-slot:append>
            <q-icon name="colorize" class="cursor-pointer">
              <q-popup-proxy transition-show="scale" transition-hide="scale">
                <q-color v-model="form_flip_cards.bg_color"></q-color>
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
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