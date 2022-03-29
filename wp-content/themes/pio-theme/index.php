<?php get_header(); ?>
    <div class="full-width">
      <q-carousel
        animated
        v-model="slide"
        arrows
        navigation
        infinite
        height="600px"
      >
        <q-carousel-slide class="1" :name="1" img-src="<?php echo get_template_directory_uri().'/assets/images/banner1.png'; ?>"></q-carousel-slide>
        <q-carousel-slide :name="2" img-src="<?php echo get_template_directory_uri().'/assets/images/banner2.png'; ?>" ></q-carousel-slide>
        <q-carousel-slide :name="3" img-src="<?php echo get_template_directory_uri().'/assets/images/banner3.png'; ?>" ></q-carousel-slide>
      </q-carousel>
    </div>
    <div class="full-width row justify-start q-my-xl" :class="$q.screen.lt.sm ? 'q-pa-md' : 'q-pa-xl'">
      <div class="col-12 text-center q-my-md text-bold" :class="$q.screen.lt.sm ? 'text-h5' : 'text-h4'">
        PLANS AND PROGRAMS
      </div>
      <div
        class="col-12 col-md-3 col-sm-6 q-pa-xs"
        v-for="(flip,index) in flip_cards"
        :key="'flip-card-'+index">
        <div class="flip-card">
          <div class="flip-card-inner">
            <div class="flip-card-front rounded-borders" :class="flip.class_front ? flip.class_front : ''">
              <div class="fit row justify-center items-center">
                <div class="col-12 text-center">
                  <q-icon :name="flip.icon" size="60px"></q-icon>
                  <p class="text-h6">
                    {{flip.title}}
                  </p>
                </div>
              </div>
            </div>
            <div class="flip-card-back rounded-borders" :class="flip.class_back ? flip.class_back : ''">
              <div class="fit row items-center">
                <div class="text-white text-center q-px-sm">
                  <p>{{flip.description}}</p>
                  <q-btn
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
      </div>
    </div>
    <q-dialog v-model="page_dialog.open">
      <q-card style="width:350px">
        <q-card-section class="row items-center q-pa-none">
          <div class="text-h6 q-pa-sm">{{page_dialog.data.title}}</div>
          <q-space></q-space>
          <q-btn class="q-ma-sm" icon="close" flat round dense v-close-popup></q-btn>
          <div class="col-12 q-mt-md">
            <q-tabs
              v-model="tab"
              dense
              class="text-grey"
              active-color="primary"
              indicator-color="primary"
              align="justify"
            >
              <q-tab name="description" label="Description"></q-tab>
              <q-tab name="offices" label="Offices"></q-tab>
            </q-tabs>
          </div>
        </q-card-section>

        <q-separator></q-separator>

        <q-card-section style="max-height: 50vh;height:50vh" class="scroll q-pa-none">
          <q-tab-panels v-model="tab" animated>
            <q-tab-panel name="description">
              {{page_dialog.data.description}}
            </q-tab-panel>

            <q-tab-panel name="offices" class="q-pa-none">
              <q-list class="q-py-none" separator>
                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="primary" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>February 22nd, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info" color="green"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="orange" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Movies</q-item-label>
                    <q-item-label caption>March 1st, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section avatar top>
                    <q-avatar icon="folder" color="teal" text-color="white"></q-avatar>
                  </q-item-section>

                  <q-item-section>
                    <q-item-label lines="1">Photos</q-item-label>
                    <q-item-label caption>January 15th, 2019</q-item-label>
                  </q-item-section>

                  <q-item-section side>
                    <q-icon name="info"></q-icon>
                  </q-item-section>
                </q-item>

                <q-separator ></q-separator>
              </q-list>
            </q-tab-panel>
          </q-tab-panels>
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</q-page-container>
<?php get_footer(); ?>