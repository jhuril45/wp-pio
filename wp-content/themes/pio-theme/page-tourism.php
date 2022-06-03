<?php get_header();?>
  <div class="row justify-center q-py-xl q-px-lg">
    <div class="col-md-10 col-12">
      <q-card class="page-card">
        <q-card-section class="q-pa-none">
          <div class="col-12 q-pb-xl">
            <q-tabs
              v-model="tourism_tab"
              class="text-white bg-primary"
              indicator-color="white"
              align="justify"
              :dense="$q.screen.lt.md"
              :mobile-arrows="$q.screen.lt.md"
            >
              <q-tab name="place_to_go" label="Places to Go"></q-tab>
              <q-tab name="place_to_stay" label="Places to Stay"></q-tab>
            </q-tabs>
            <q-separator></q-separator>

            <q-tab-panels v-model="tourism_tab" animated class="q-px-md">
              <q-tab-panel name="place_to_go">
                <div class="row">
                  <div class="col-12 col-md-4 q-pa-sm" v-for="(place,index) in places_to_go" :key="'place'+index">
                    <q-card class="my-card">
                      <q-img :src="place.img_path"
                      height="250px"
                      contain></q-img>

                      <q-card-section class="q-pb-none" >
                        <q-btn
                          fab
                          color="primary"
                          icon="place"
                          class="absolute"
                          style="top: 0; right: 12px; transform: translateY(-50%);"
                          href="https://goo.gl/maps/FThLwV21GEiyTRsH8"
                          target="_blank"
                        ></q-btn>

                        <div class="row no-wrap items-center">
                          <div class="col text-h6 ellipsis" :class="$q.screen.lt.md ? 'q-pt-md' : ''">
                            {{place.title}}
                          </div>
                        </div>
                      </q-card-section>

                      <q-card-section class="q-pt-none">
                        <div class="text-subtitle1">
                          {{place.address}}
                        </div>
                        <div class="text-caption text-grey">
                          {{lorem}}
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
              </q-tab-panel>

              <q-tab-panel name="place_to_stay">
                <div class="row">
                  <div class="col-12 col-md-4 q-pa-sm" v-for="(place_go,index) in places_to_stay" :key="'place_go'+index">
                    <q-card class="my-card">
                      <q-img :src="place_go.img_path"
                      height="250px"
                      cover></q-img>

                      <q-card-section class="q-pb-none" >
                        <q-btn
                          fab
                          color="primary"
                          icon="place"
                          class="absolute"
                          style="top: 0; right: 12px; transform: translateY(-50%);"
                          href="https://goo.gl/maps/FThLwV21GEiyTRsH8"
                          target="_blank"
                        ></q-btn>

                        <div class="row no-wrap items-center">
                          <div class="col text-h6 ellipsis" :class="$q.screen.lt.md ? 'q-pt-md' : ''">
                            {{place_go.title}}
                          </div>
                        </div>
                      </q-card-section>

                      <q-card-section class="q-pt-none">
                        <div class="text-subtitle1">
                          {{place_go.title}}
                        </div>
                        <div class="text-caption text-grey">
                          Contact Number {{place_go.contact}}
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
              </q-tab-panel>
            </q-tab-panels>
          </div>
        </q-card-section>
      </q-card>
    </div>
  </div>
<?php get_footer();?>