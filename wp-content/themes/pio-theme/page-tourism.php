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
                  <div class="col-12 col-md-3 q-pa-sm" v-for="(place,index) in places_to_go" :key="'place'+index">
                    <q-card class="tourism-card">
                      <q-img :src="place.path"
                        height="200px"
                        cover>
                        <q-btn
                          v-if="place.map_link"
                          round
                          size="sm"
                          color="primary"
                          icon="place"
                          class="absolute-bottom-right q-mb-sm"
                          style="right: 12px;"
                          :href="place.map_link"
                          target="_blank"
                        ></q-btn>
                      </q-img>

                      <q-card-section class="q-pb-none">
                        <div class="row no-wrap items-center">
                          <div class="col text-caption text-bold ellipsis" :class="$q.screen.lt.md ? 'q-pt-md' : ''">
                            {{place.title}}
                          </div>
                        </div>
                      </q-card-section>

                      <q-card-section class="q-pt-none">
                        <div class="text-caption">
                          {{place.address}}
                        </div>
                        <div class="text-caption text-grey">
                          Contact Number: {{place.contact_no}}
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
              </q-tab-panel>

              <q-tab-panel name="place_to_stay">
                <div class="row">
                  <div class="col-12 col-md-3 q-pa-sm" v-for="(place_stay,index) in places_to_stay" :key="'place_stay'+index">
                    <q-card class="tourism-card">
                      <q-img :src="place_stay.path"
                        height="200px"
                        cover>
                        <q-btn
                          v-if="place_stay.map_link"
                          round
                          size="sm"
                          color="primary"
                          icon="place"
                          class="absolute-bottom-right q-mb-sm"
                          style="right: 12px;"
                          :href="place_stay.map_link"
                          target="_blank"
                        ></q-btn>
                      </q-img>

                      <q-card-section class="q-pb-none" >
                        <div class="row no-wrap items-center">
                          <div class="col text-caption text-bold ellipsis" :class="$q.screen.lt.md ? 'q-pt-md' : ''">
                            {{place_stay.title}}
                          </div>
                        </div>
                      </q-card-section>

                      <q-card-section class="q-pt-none">
                        <div class="text-caption">
                          {{place_stay.address}}
                        </div>
                        <div class="text-caption text-grey">
                          {{place_stay.description}}
                        </div>
                        <div class="text-caption text-grey">
                          Contact Number: {{place_stay.contact_no}}
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