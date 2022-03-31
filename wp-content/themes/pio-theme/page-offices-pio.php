<?php get_header(); ?>
  <div class="row justify-center">
    <div class="col-12 col-md-8 " :class="$q.screen.lt.md ? 'q-pa-md' : 'q-pa-xl'">
      <q-card class="page-card">
        <q-card-section class="bg-grey-3">
          <div class="row q-gutter-x-md">
            <div class="col-12 col-md-shrink row justify-center">
              <q-avatar size="100px" class="shadow-9">
                <img src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>">
              </q-avatar>
            </div>
            <div class="col-12 col-md-shrink">
              <q-item-label class="text-h6 text-bold" :class="$q.screen.lt.md ? 'text-center q-mt-sm' : 'text-left'">
                Public Information Office
              </q-item-label>
              <q-item-label class="text-body2" :class="$q.screen.lt.md ? 'text-center' : 'text-left'">
                Lorem ipsum dolor sit amet, consectetur adipiscit elit.
              </q-item-label>
              <q-item-label class="text-body2 q-pt-md row q-gutter-x-md">
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fab fa-facebook-f"
                      color="blue"
                      class="relative-position"
                      style="top:-2px"
                      size="xs"></q-icon>
                      <span>Facebook</span>
                  </a>
                </div>
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fab fa-twitter"
                      color="blue"
                      size="xs"></q-icon>
                      <span>Twitter</span>
                  </a>
                </div>
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fas fa-phone"
                      color="blue"
                      size="xs"></q-icon>
                      <span>Call Us</span>
                  </a>
                </div>
              </q-item-label>
            </div>
          </div>
          <q-item v-if="false">
            <q-item-section avatar>
              <q-avatar size="100px" class="shadow-9">
                <img src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>">
              </q-avatar>
            </q-item-section>

            <q-item-section class="">
              <q-item-label class="text-h6 text-bold" :class="$q.screen.lt.md ? 'text-center' : 'text-left'">
                Public Information Office
              </q-item-label>
              <q-item-label class="text-body2">
                Lorem ipsum dolor sit amet, consectetur adipiscit elit.
              </q-item-label>
              <q-item-label class="text-body2 q-pt-md row q-gutter-x-md">
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fab fa-facebook-f"
                      color="blue"
                      class="relative-position"
                      style="top:-2px"
                      size="xs"></q-icon>
                      <span>Facebook</span>
                  </a>
                </div>
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fab fa-twitter"
                      color="blue"
                      size="xs"></q-icon>
                      <span>Twitter</span>
                  </a>
                </div>
                <div class="col-shrink">
                  <a href="https://www.facebook.com/butuancitypioofficial" class="footer-link text-dark">
                    <q-icon
                      name="fas fa-phone"
                      color="blue"
                      size="xs"></q-icon>
                      <span>Call Us</span>
                  </a>
                </div>
              </q-item-label>
            </q-item-section>
          </q-item>
        </q-card-section>

        <q-separator ></q-separator>

        <q-card-section class="q-pa-none">
          <div class="col-12 q-pb-xl">
            <q-tabs
              v-model="page_tab"
              class="text-white bg-primary"
              indicator-color="white"
              align="justify"
              :dense="$q.screen.lt.md"
              :mobile-arrows="$q.screen.lt.md"
            >
              <q-tab name="mission_vision" label="Mission & Vision"></q-tab>
              <q-tab name="home" label="Home"></q-tab>
              <q-tab name="services" label="Services"></q-tab>
              <q-tab name="organization" label="Organizational Structure"></q-tab>
              <q-tab name="forms" label="Forms"></q-tab>
            </q-tabs>
            <q-separator></q-separator>

            <q-tab-panels v-model="page_tab" animated class="q-px-md">
              <q-tab-panel name="home">
                <div class="text-h6">Home</div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </q-tab-panel>

              <q-tab-panel name="services">
                <div class="text-h6">Home</div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </q-tab-panel>

              <q-tab-panel name="mission_vision">
                <div class="row q-gutter-y-lg">
                  <div class="col-12">
                    <div class="text-h6">Mission</div>
                    <div>
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur, at inventore repellendus, est cupiditate qui commodi possimus repellat beatae incidunt ratione, dolores accusamus debitis molestias quas! Totam velit animi expedita.
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur, at inventore repellendus, est cupiditate qui commodi possimus repellat beatae incidunt ratione, dolores accusamus debitis molestias quas! Totam velit animi expedita.
                    </div>
                  </div>
                  <div class="col-12">
                    <q-separator></q-separator>
                  </div>
                  <div class="col-12">
                    <div class="text-h6">Vision</div>
                    <div>
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur, at inventore repellendus, est cupiditate qui commodi possimus repellat beatae incidunt ratione, dolores accusamus debitis molestias quas! Totam velit animi expedita.
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur, at inventore repellendus, est cupiditate qui commodi possimus repellat beatae incidunt ratione, dolores accusamus debitis molestias quas! Totam velit animi expedita.
                    </div>
                  </div>
                </div>
              </q-tab-panel>

              <q-tab-panel name="organization">
                <div class="text-h6">Organizational Structure</div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
              </q-tab-panel>
              <q-tab-panel name="forms">
                <div class="row justify-center">
                  <div class="col-12 col-md-10">
                    <q-list padding separator>
                      <q-item-label class="text-subtitle2 text-bold q-mb-sm">Form List</q-item-label>
                      <q-item v-for="form in 3" :key="'form'+form">
                        <q-item-section top avatar>
                          <q-avatar color="primary" text-color="white" icon="description" ></q-avatar>
                        </q-item-section>

                        <q-item-section class="q-gutter-y-md">
                          <q-item-label>Form No. 001-2022</q-item-label>
                          <q-item-label caption lines="2">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit nihil eligendi repellendus. Exercitationem excepturi rem nemo culpa veniam, eum, fuga architecto nam soluta delectus, non in nobis ut? Explicabo, repellendus.
                          </q-item-label>
                        </q-item-section>

                        <q-item-section side top class="q-gutter-y-md">
                          <q-item-label caption>5 min ago</q-item-label>
                          <q-icon name="file_download" color="primary" class="cursor-pointer"></q-icon>
                        </q-item-section>
                      </q-item>
                    </q-list>
                  </div>
                </div>
              </q-tab-panel>
            </q-tab-panels>
          </div>
        </q-card-section>
      </q-card>
      
    </div>
  </div>
<?php get_footer(); ?>