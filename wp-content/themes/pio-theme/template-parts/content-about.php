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
              Butuan City
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
              <div class="col-shrink">
                <a
                  href="https://goo.gl/maps/FThLwV21GEiyTRsH8"
                  target="_blank"
                  class="footer-link text-dark">
                  <q-icon
                    name="place"
                    color="blue"
                    size="xs"></q-icon>
                    <span>Location</span>
                </a>
              </div>
              <div class="col-shrink">
              </div>
            </q-item-label>
          </div>
        </div>
      </q-card-section>

      <q-separator ></q-separator>

      <q-card-section class="q-pa-none">
        <div class="col-12 q-pb-xl">
          <q-tabs
            v-model="about_page"
            class="text-white bg-primary"
            indicator-color="white"
            align="justify"
            :dense="$q.screen.lt.md"
            :mobile-arrows="$q.screen.lt.md"
          >
            <q-tab name="about" label="About Butuan"></q-tab>
            <q-tab name="mission_vision" label="Mission & Vision"></q-tab>
            <q-tab name="media" label="Media"></q-tab>
          </q-tabs>
          <q-separator></q-separator>

          <q-tab-panels v-model="about_page" animated class="q-px-md">
            <q-tab-panel name="about">
              <q-list separator padding>
                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark text-right">
                      Origin :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      The name "Butuan" is believed to have originated from the sour fruit locally called batuan. Othey etymological sources say that it came from a certain Datu Buntuan, a chieftain who once ruled over areas of the present Butuan City.
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark">
                      Category :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      Highly Urbanized City in the Philippines and the regional center of Caraga Region.
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark">
                      Location :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      Northeastern part of Agusan Valley, Mindanao, sprawling across the Agusan River.
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark">
                      Population :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      337, 063 people (according to 2015 census).
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark">
                      Charter Day :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      August 2, 2022 known as "Adlaw Hong Butuan".
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item>
                  <q-item-section 
                  side
                  top>
                    <q-item-label class="text-body2 text-bold text-dark">
                      Festival :
                    </q-item-label>
                  </q-item-section>
                  <q-item-section top>
                    <q-item-label>
                      Balangay Festival celebrated on May 19 of every year.
                    </q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-tab-panel>

            <q-tab-panel name="mission_vision">
              <div class="row q-gutter-y-lg">
                <div class="col-12">
                  <div class="text-h6 q-mb-sm">Mission</div>
                  <div>
                  The City of Butuan will strive to achieve the community's vision of a great, inspirational, competitive, liveable and sustainable city.
                  </div>
                </div>
                <div class="col-12">
                  <q-separator></q-separator>
                </div>
                <div class="col-12">
                  <div class="text-h6 q-mb-sm">Vision</div>
                  <div>
                  Making Butuan a great hub city of opportunities for all that spurs and supports CARAGA's sustainable growth and development.
                  </div>
                </div>
              </div>
            </q-tab-panel>

            <q-tab-panel name="media">
              <div class="q-pa-md q-gutter-sm">
                <q-carousel
                  animated
                  v-model="about_slide"
                  infinite>
                  <q-carousel-slide name="1">
                    <q-video
                      class="absolute-full"
                      src="https://www.youtube.com/embed/k3_tw44QsZQ"></q-video>
                  </q-carousel-slide>

                  <q-carousel-slide name="2">
                    <q-video
                      class="absolute-full"
                      src="https://www.youtube.com/embed/kOkQ4T5WO9E"></q-video>
                  </q-carousel-slide>

                  <q-carousel-slide name="3">
                    <q-video
                      class="absolute-full"
                      src="https://www.youtube.com/embed/p87miJIYEEk"></q-video>
                  </q-carousel-slide>
                </q-carousel>
                <div class="row justify-center">
                  <q-btn-toggle
                    v-model="about_slide"
                    :options="[
                      { label: 'Soft Jazz', value: '1' },
                      { label: 'Rihanna', value: '2' },
                      { label: 'Ibiza Mix', value: '3' }
                    ]"
                  ></q-btn-toggle>
                </div>
              </div>
            </q-tab-panel>
          </q-tab-panels>
        </div>
      </q-card-section>
    </q-card>
  </div>
</div>