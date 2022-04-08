<?php get_header();?>
  <div class="row justify-center q-py-xl q-px-lg">
    <div class="col-12 col-md-6">
      <q-list bordered class="rounded-borders">
        <q-expansion-item default-opened>
          <q-separator></q-separator>
          <template v-slot:header>
            <q-item-section avatar>
              <q-icon color="primary" name="description"></q-icon>
            </q-item-section>

            <q-item-section>
              <q-item-label class="text-body1 text-bold">
                REPORTS
              </q-item-label>
            </q-item-section>
          </template>

          <q-card>
            <q-card-section class="q-px-sm q-py-md">
              <div class="row q-gutter-y-md">
                <div class="col-12 col-md-6 q-px-sm">
                  <q-select
                    dense
                    outlined
                    v-model="transparency_type"
                    :options="['Anually','Quarterly']"
                    label="Report type" />
                </div>
                <div class="col-12 col-md-6 q-px-sm">
                  <q-select
                    dense
                    outlined
                    v-model="transparency_year"
                    :options="[2019,2020,2021,2022]"
                    label="Year" />
                </div>
                <div class="col-12">
                  <q-table
                    flat
                    title="Reports"
                    :data="data"
                    :columns="columns"
                    row-key="name"
                    :filter="filter"
                    hide-header
                  >
                    <template v-slot:top-right>
                      <q-input outlined dense debounce="300" v-model="filter" placeholder="Search">
                        <template v-slot:append>
                          <q-icon name="search"></q-icon>
                        </template>
                      </q-input>
                    </template>

                    <template v-slot:body="props">
                      <q-item :props="props" clickable>
                        <q-item-section side top>
                          <q-icon color="primary" name="description"></q-icon>
                        </q-item-section>
                        <q-item-section :props="props">
                          <q-item-label>
                            {{ props.row.name }}
                          </q-item-label>
                        </q-item-section>
                      </q-item>
                    </template>
                  </q-table>
                  <q-separator></q-separator>
                </div>
              </div>
            </q-card-section>
          </q-card>
        </q-expansion-item>

        <q-separator></q-separator>

        <q-expansion-item>
          <template v-slot:header>
            <q-item-section avatar>
              <q-icon color="primary" name="description"></q-icon>
            </q-item-section>

            <q-item-section>
              <q-item-label class="text-body1 text-bold">
                BIDS AND AWARDS
              </q-item-label>
            </q-item-section>
          </template>

          <q-card>
            <q-card-section class="q-pa-none">
              <q-list>
                <q-separator></q-separator>
                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      CONSTRUCTION OF COMMAND CENTER FOR DISASTER RESPONSE & RISK REDUCTION-2nd BIDDING
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      Completion of Rehab. of Panaad Building
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      CONCRETING OF FARM TO MARKET ROAD FROM PUROK 6 TO 5
                    </q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-card-section>
          </q-card>
        </q-expansion-item>

        <q-separator></q-separator>

        <q-expansion-item>
          <template v-slot:header>
            <q-item-section avatar>
              <q-icon color="primary" name="description"></q-icon>
            </q-item-section>

            <q-item-section>
              <q-item-label class="text-body1 text-bold">
                Minutes of the Pre-bid Conference
              </q-item-label>
            </q-item-section>
          </template>

          <q-card>
            <q-card-section class="q-pa-none">
              <q-list>
                <q-separator></q-separator>
                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      CONSTRUCTION OF COMMAND CENTER FOR DISASTER RESPONSE & RISK REDUCTION-2nd BIDDING
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      Completion of Rehab. of Panaad Building
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-item clickable v-ripple>
                  <q-item-section>
                    <q-item-label class="text-primary">
                      CONCRETING OF FARM TO MARKET ROAD FROM PUROK 6 TO 5
                    </q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-card-section>
          </q-card>
        </q-expansion-item>
      </q-list>
    </div>
  </div>
<?php get_footer(); ?>