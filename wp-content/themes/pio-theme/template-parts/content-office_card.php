<q-card class="page-card">
  <q-card-section class="relative-position" :style="$q.screen.gt.sm ? { 'background-image': 'url(' + header_logo + ')' } : {}"
    style="background-size: 100px 100px;background-repeat: no-repeat;background-position:98% 50%;">
    <div class="row q-gutter-x-md ">
      <div class="col-12 col-md-shrink row justify-center ">
        <q-avatar size="100px" class="shadow-9">
          <img :src="office.logo ? office.logo : header_logo">
        </q-avatar>
      </div>
      <div class="col-12 col-md-shrink">
        <q-item-label class="text-h6 text-bold" :class="$q.screen.lt.md ? 'text-center q-mt-sm' : 'text-left'">
          {{office.title}}
        </q-item-label>
        <q-item-label class="text-body2" :class="$q.screen.lt.md ? 'text-center' : 'text-left'" v-if="office.description">
          {{office.description}}
        </q-item-label>
        <q-item-label class="text-body2 q-pt-md row">
          <div class="col-shrink" v-if="office.facebook">
            <a :href="office.facebook" class="footer-link text-dark">
              <q-icon
                name="fab fa-facebook-f"
                color="blue"
                class="relative-position"
                style="top:-2px"
                size="xs"></q-icon>
                <span>Facebook</span>
            </a>
          </div>
          <div class="col-shrink q-pl-md" v-if="office.twitter">
            <a :href="office.twitter" class="footer-link text-dark">
              <q-icon
                name="fab fa-twitter"
                color="blue"
                size="xs"></q-icon>
                <span>Twitter</span>
            </a>
          </div>
          <div class="col-shrink q-pl-md" v-if="office.messenger">
            <a :href="'http://m.me/'+office.messenger" class="footer-link text-dark" target="_blank">
              <q-icon
                name="fab fa-facebook-messenger"
                color="blue"
                size="xs"></q-icon>
                <span>Message Us</span>
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
        <q-tab name="services" label="Services"></q-tab>
        <q-tab name="organization" label="Organizational Structure"></q-tab>
        <q-tab name="forms" label="Forms"></q-tab>
      </q-tabs>
      <q-separator></q-separator>

      <q-tab-panels v-model="page_tab" animated class="q-px-md">
        <q-tab-panel name="services">
          <q-list bordered separator>
            <q-expansion-item
              group="services"
              icon="info"
              :label="service.title"
              v-for="service in office.services"
              :key="'service-'+service.id"
              header-class="">
              <q-card>
                <q-card-section>
                  <img :src="service.path">
                </q-card-section>
              </q-card>
            </q-expansion-item>
          </q-list>
        </q-tab-panel>

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

        <q-tab-panel name="organization">
          <img :src="office.org_structure">
        </q-tab-panel>
        <q-tab-panel name="forms">
          <div class="row justify-center">
            <div class="col-12 col-md-10">
              <q-list padding separator>
                <q-item-label class="text-subtitle2 text-bold q-mb-sm">Form List</q-item-label>
                <q-item v-for="(form) in office.forms" :key="'form'+form.id">
                  <q-item-section top avatar>
                    <q-avatar color="primary" text-color="white" icon="description" ></q-avatar>
                  </q-item-section>

                  <q-item-section class="q-gutter-y-md">
                    <q-item-label>{{form.title}}</q-item-label>
                    <q-item-label caption lines="2">
                      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sit nihil eligendi repellendus. Exercitationem excepturi rem nemo culpa veniam, eum, fuga architecto nam soluta delectus, non in nobis ut? Explicabo, repellendus.
                    </q-item-label>
                  </q-item-section>

                  <q-item-section side top class="q-gutter-y-md">
                    <q-btn
                      icon="file_download"
                      color="primary"
                      round
                      size="md"
                      target="_blank"
                      :href="form.path"></q-btn>
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