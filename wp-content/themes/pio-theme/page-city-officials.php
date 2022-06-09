<?php get_header();?>
  <div class="row justify-center q-py-xl q-px-lg">
    <div class="col-md-10 col-12">
      <q-card class="page-card">
        <q-card-section class="q-pa-none">
          <div class="col-12 q-pb-xl">
            <q-tabs
              v-model="city_official_tab"
              class="text-white bg-primary"
              indicator-color="white"
              align="justify"
              :dense="$q.screen.lt.md"
              :mobile-arrows="$q.screen.lt.md"
            >
              <q-tab name="officials" label="Officials"></q-tab>
              <q-tab name="committee" label="Committee"></q-tab>
            </q-tabs>
            <q-separator></q-separator>

            <q-tab-panels v-model="city_official_tab" animated class="q-px-md">
              <q-tab-panel name="officials">
                <!-- City Mayor -->
                <div class="row justify-center">
                  <div class="official-card q-pa-sm">
                    <q-card class="" bordered>
                      <q-img
                        cover
                        height="150px"
                        :src="city_officials.mayor.image"
                      >
                        <q-btn
                          round
                          size="sm"
                          color="primary"
                          icon="more_horiz"
                          class="absolute-bottom-right q-mb-sm"
                          style="right: 12px;"
                        >
                        </q-btn>
                      </q-img>

                      <q-card-section class="q-px-sm">
                        <div class="official-name q-mb-xs">
                          {{city_officials.mayor.name}}
                        </div>
                        <div class="official-position text-grey">
                          {{city_officials.mayor.position}}
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
                <!-- City Mayor -->
                <div class="row justify-center" style="height:110px;">
                  <q-separator vertical inset size="3px"></q-separator>
                </div>
                <!-- City Vice Mayor -->
                <div class="row justify-center">
                  <div class="official-card q-pa-sm">
                    <q-card class="" bordered>
                      <q-img
                        cover
                        height="150px"
                        :src="city_officials.vice_mayor.image"
                      >
                        <q-btn
                          round
                          size="sm"
                          color="primary"
                          icon="more_horiz"
                          class="absolute-bottom-right q-mb-sm"
                          style="right: 12px;"
                        >
                        </q-btn>
                      </q-img>

                      <q-card-section>
                        <div class="official-name q-mt-sm q-mb-xs">
                          {{city_officials.vice_mayor.name}}
                        </div>
                        <div class="official-position text-grey">
                          {{city_officials.vice_mayor.position}}
                        </div>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
                <!-- City Vice Mayor -->
                <div class="row justify-center" style="height:110px;">
                  <q-separator vertical inset size="3px"></q-separator>
                </div>
                <!-- City SP Members -->
                <div class="row justify-center">
                  <div
                    class="official-card q-pa-sm"
                    v-for="(sp,index) in city_officials.sp_members"
                    :key="'sp'+index">
                    <q-card class="" bordered>
                      <q-img
                        contain
                        height="150px"
                        :src="sp.image"
                      >
                        <q-btn
                          round
                          size="sm"
                          color="primary"
                          icon="more_horiz"
                          class="absolute-bottom-right q-mb-sm"
                          style="right: 12px;"
                        >
                          <q-menu
                            anchor="bottom left" 
                            self="top left"
                            v-if="sp.positions && sp.positions.length">
                            <div
                              class="q-gutter-y-md q-mt-md">
                              <template v-for="(position,index2) in sp.positions">
                                <q-list class="q-px-sm" :key="'pos-t-'+index2">
                                  <q-item-label class="text-subtitle1 q-mb-sm">
                                    {{position.title}}
                                  </q-item-label>
                                  <q-item
                                    dense
                                    class="q-px-none"
                                    v-for="(position_title,index3) in position.list"
                                    :key="'post-n-'+index3">
                                    <q-item-section top class="q-px-none">
                                      - {{position_title}}
                                    </q-item-section>
                                  </q-item>
                                </q-list>
                                <q-separator
                                  v-if="(index2+1) < sp.positions.length"></q-separator>
                              </template>
                            </div>
                          </q-menu>
                        </q-btn>
                        
                      </q-img>

                      <q-card-section style="height:110px">
                        <div class="official-name q-mt-sm q-mb-xs">
                          {{sp.name}}
                        </div>
                        <div class="official-position text-grey">
                          {{sp.position}}
                        </div>
                      </q-card-section>

                      <q-card-section v-if="false">
                        <q-expansion-item
                          header-class="q-px-xs text-subtitle1"
                          label="Affiliations">
                          <div
                            v-if="sp.positions && sp.positions.length"
                            class="q-gutter-y-md q-mt-md">
                            <template v-for="(position,index2) in sp.positions">
                              <q-list class="q-px-sm" :key="'pos-t-'+index2">
                                <q-item-label class="text-subtitle1 q-mb-sm">
                                  {{position.title}}
                                </q-item-label>
                                <q-item
                                  dense
                                  class="q-px-none"
                                  v-for="(position_title,index3) in position.list"
                                  :key="'post-n-'+index3">
                                  <q-item-section top class="q-px-none">
                                    - {{position_title}}
                                  </q-item-section>
                                </q-item>
                              </q-list>
                              <q-separator
                                v-if="(index2+1) < sp.positions.length"></q-separator>
                            </template>
                          </div>
                        </q-expansion-item>
                      </q-card-section>
                    </q-card>
                  </div>
                </div>
                <!-- City SP Members -->
              </q-tab-panel>

              <q-tab-panel name="committee">
                <q-list bordered class="rounded-borders" separator>
                  <q-expansion-item
                    :default-opened="index == 0"
                    group="committees"
                    v-for="(committee,index) in city_officials.committees"
                    expand-separator
                    icon="perm_identity"
                    :label="committee.title">
                    <q-card>
                      <q-card-section>
                        <q-item>
                          <q-item-section side top>
                            Chairman:
                          </q-item-section>
                          <q-item-section top>
                            {{committee.chairman}}
                          </q-item-section>
                        </q-item>

                        <q-item>
                          <q-item-section side top>
                            Vice Chairman:
                          </q-item-section>
                          <q-item-section top>
                            {{committee.vice_chairman}}
                          </q-item-section>
                        </q-item>
                        <q-item>
                          <q-item-section side top>
                            Members:
                          </q-item-section>
                          <q-item-section top>
                            <div v-for="(com_mem,index) in committee.members">
                              {{com_mem}}
                            </div>
                          </q-item-section>
                        </q-item>
                      </q-card-section>
                    </q-card>
                  </q-expansion-item>
                </q-list>
              </q-tab-panel>
            </q-tab-panels>
          </div>
        </q-card-section>
      </q-card>
    </div>
  </div>
<?php get_footer();?>