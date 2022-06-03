<q-card class="page-card">
  <q-card-section class="relative-position" :style="$q.screen.gt.sm ? { 'background-image': 'url(' + header_logo + ')' } : {}"
    style="background-size: 100px 100px;background-repeat: no-repeat;background-position:98% 50%;">
    <div class="row q-gutter-x-md ">
      <div class="col-12 col-md-shrink row justify-center ">
        <q-avatar size="100px" class="shadow-9">
          <img :src="barangay.logo ? barangay.logo : header_logo">
        </q-avatar>
      </div>
      <div class="col-12 col-md-shrink">
        <q-item-label class="text-h6 text-bold" :class="$q.screen.lt.md ? 'text-center q-mt-sm' : 'text-left'">
          Brgy. {{barangay.title}}
        </q-item-label>
        <q-item-label class="text-caption" :class="$q.screen.lt.md ? 'text-center' : 'text-left'" v-if="barangay.chairman">
          Contact number: {{barangay.contact_no}}
        </q-item-label>
        <q-item-label class="text-caption" :class="$q.screen.lt.md ? 'text-center' : 'text-left'" v-if="barangay.chairman">
          Population: {{barangay.population}}
        </q-item-label>
        <q-item-label class="text-caption" :class="$q.screen.lt.md ? 'text-center' : 'text-left'" v-if="barangay.chairman">
          Land area: {{barangay.land_area}}
        </q-item-label>
        <q-item-label class="text-caption" :class="$q.screen.lt.md ? 'text-center' : 'text-left'" v-if="barangay.chairman">
          <q-btn
            flat
            color="primary"
            padding="none"
            size="sm">
            <q-icon name="place"></q-icon>
            <span class="q-pt-xs">
              {{barangay.address}}
            </span>
          </q-btn>
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
        <q-tab name="information" label="Information"></q-tab>
        <q-tab name="mission_vision" label="Mission & Vision"></q-tab>
        <q-tab name="officials" label="Officials"></q-tab>
        <q-tab name="services" label="Services"></q-tab>
      </q-tabs>
      <q-separator></q-separator>

      <q-tab-panels v-model="page_tab" animated class="q-px-md">
        <q-tab-panel name="mission_vision">
          <div class="row q-gutter-y-lg">
            <div class="col-12">
              <div class="text-h6">Mission</div>
              <div>
                The City of Butuan will strive to achieve the community's vision of a great, inspirational, competitive, liveable and sustainable city.
              </div>
            </div>
            <div class="col-12">
              <q-separator></q-separator>
            </div>
            <div class="col-12">
              <div class="text-h6">Vision</div>
              <div>
                Making Butuan a great hub city of opportunities for all that spurs and supports CARAGA's sustainable growth and development.
              </div>
            </div>
          </div>
        </q-tab-panel>
        <q-tab-panel name="information">
          <div class="row q-gutter-y-lg">
            <div class="col-12 q-gutter-y-sm">
              <q-img height="350px" :src="barangay.landmark_img" cover>
                <div :class="$q.screen.lt.sm ? '' : 'text-body1'" style="left:5%;top:10%;background:rgba(33, 150, 243,0.7)">
                  {{barangay.landmark_name}}
                </div>
              </q-img>
            </div>
            <div class="col-12">
              <div v-html="barangay.description">
              </div>
            </div>
          </div>
        </q-tab-panel>
        <q-tab-panel name="officials">
          <div class="row justify-center">
            <div class="col-12 col-md-3 q-pa-sm">
              <q-card class="my-card" flat bordered>
                <q-img
                  cover
                  height="200px"
                  :src="barangay.official_list.chairman.image"
                >
                </q-img>

                <q-card-section>
                  <div class="text-body1 q-mt-sm q-mb-xs">{{barangay.official_list.chairman.name}}</div>
                  <div class="text-body2 text-grey">
                    {{barangay.official_list.chairman.position}}
                  </div>
                </q-card-section>
              </q-card>
            </div>
          </div>
        </q-tab-panel>
        <q-tab-panel name="services">
          services
        </q-tab-panel>
      </q-tab-panels>
    </div>
  </q-card-section>
</q-card>