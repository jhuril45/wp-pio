<div class="row justify-center q-py-lg">
  <div class="col-12 col-md-6">
    <q-list bordered class="rounded-borders">
      <q-expansion-item
      default-opened>
        <template v-slot:header>
          <q-item-section avatar>
            <q-avatar icon="view_headline" color="primary" text-color="white"></q-avatar>
          </q-item-section>

          <q-item-section>
            Landing Details
          </q-item-section>
        </template>

        <q-card class="q-px-none">
          <q-card-section>
            <q-form
              class="q-gutter-y-md"
              @submit="submitHeaderDetails">
              <q-input
                placeholder="Facebook page link"
                dense
                outlined
                v-model="landing_details.facebook_page"
                :rules="[val => !!val || 'Invalid Facebook Page']"
                hide-bottom-space>
                <template v-slot:prepend>
                  <q-icon
                    name="fab fa-facebook-f"
                    color="primary"
                    size="xs"></q-icon>
                </template>
              </q-input>
              <q-input
                placeholder="Twitter page link"
                dense
                outlined
                v-model="landing_details.twitter_page"
                :rules="[val => !!val || 'Invalid Twitter Page']"
                hide-bottom-space>
                <template v-slot:prepend>
                  <q-icon
                    name="fab fa-twitter"
                    color="primary"
                    size="xs"></q-icon>
                </template>
              </q-input>
              <q-input
                placeholder="Messenger page link"
                dense
                outlined
                v-model="landing_details.messenger_page"
                :rules="[val => !!val || 'Invalid Messenger Page']"
                hide-bottom-space>
                <template v-slot:prepend>
                  <q-icon
                    name="fab fa-facebook-messenger"
                    color="primary"
                    size="xs"></q-icon>
                </template>
              </q-input>
              <q-input
                placeholder="Youtube video id"
                dense
                outlined
                v-model="landing_details.youtube_id"
                :rules="[val => !!val || 'Invalid Youtube video id']"
                hide-bottom-space>
                <template v-slot:prepend>
                  <q-icon
                    name="fab fa-youtube"
                    color="red"
                    size="xs"></q-icon>
                </template>
              </q-input>
              <q-btn
                class="full-width"
                type="submit"
                label="Submit"
                color="primary"
                :loading="loading"></q-btn>
            </q-form>
          </q-card-section>
        </q-card>
      </q-expansion-item>

      <q-separator></q-separator>
    </q-list>
  </div>
</div>