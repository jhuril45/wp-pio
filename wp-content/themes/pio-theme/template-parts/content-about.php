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
            </q-item-label>
          </div>
        </div>
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
            <q-tab name="about" label="About Butuan"></q-tab>
            <q-tab name="geography" label="Geography"></q-tab>
          </q-tabs>
          <q-separator></q-separator>

          <q-tab-panels v-model="page_tab" animated class="q-px-md">
            <q-tab-panel name="about">
              <div class="text-h6 q-mb-md">About Butuan</div>
              Butuan (pronounced /buːˈtwɑːn/), officially the City of Butuan (Butuanon: Dakbayan hong Butuan; Cebuano: Dakbayan sa Butuan; Tagalog: Lungsod ng Butuan) and often referred to as Butuan City, is a highly urbanized city in the Philippines and the regional center of Caraga. It is located at the northeastern part of the Agusan Valley, Mindanao, sprawling across the Agusan River. It is bounded to the north, west and south by Agusan del Norte, to the east by Agusan del Sur and to the northwest by Butuan Bay. According to the 2015 census, it has a population of 337,063 people. Butuan City was the capital of the province of Agusan del Norte until 2000, when Republic Act 8811 transferred the capital to Cabadbaran City. For statistical and geographical purposes, Butuan City is grouped with Agusan del Norte but governed administratively independent from the province but legislatively administered by the province's 1st congressional district. The name "Butuan" is also believed to have originated from the sour fruit locally called batuan. Other etymological sources say that it comes from a certain Datu Buntuan, a chieftain who once ruled over areas of the present-day city
            </q-tab-panel>

            <q-tab-panel name="geography">
              <div class="text-h6 q-mb-md">Geography</div>
              Butuan City has a land area of 81,662 hectares (201,790 acres),[3] which is roughly 4.1% of the total area of the Caraga region. The existing land use of the city consists of the following uses: agriculture areas (397.23 km2), forestland (268 km2), grass/shrub/pasture land (61.14 km2) and other uses (90.242 km2). Of the total forestland, 105 km2 is production forest areas while 167.5 km2 is protection forest areas. The forestland, as mentioned earlier, comprised both the production and protection forest. The classified forest is further specified as production forest and protection forest. In the production forest industrial tree species are mostly grown in the area. The protection forest on the other hand, is preserved to support and sustain necessary ecological performance. Included in this are the watershed areas in Taguibo, which is the main source of water in the area, The city is endowed with swamplands near its coastal area. These swamp areas are interconnected with the waterways joined by the Agusan River. Most of the swamplands are actually mangroves that served as habitat to different marine species. Filling material needs of the city are extracted usually from the riverbank of Taguibo River. Others are sourced out from promontories with special features and for special purpose. The fishing ground of Butuan is the Butuan Bay of which two coastal barangays are located. It extends some two kilometers to the sea and joins the Bohol Sea. These are the barangays of Lumbocan and Masao
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

            <q-tab-panel name="organization">
              <div @click="orgClick">
                <organization-chart :datasource="ds" ref="org_chart" class="org_chart_parent">
                  <template slot-scope="{ nodeData }" >
                    <div :class="['node-box',  nodeData.id == '1' ? 'parent' : '']" class="cursor-pointer">
                      <div class="node-title">{{nodeData.title}}</div>
                      <div class="node-content">
                        <q-avatar>
                          <img :src="nodeData.img">
                        </q-avatar>
                        <div>
                          <span class="text-capitalize">{{nodeData.name}}</span>
                        </div>
                      </div>
                    </div>
                  </template>
                </organization-chart>
              </div>
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