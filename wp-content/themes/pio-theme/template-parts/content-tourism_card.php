<div class="row justify-center">
  <q-card class="col-12">
    <q-img :src="tourism.path"
      height="200px"
      cover>
      <q-btn
        v-if="tourism.map_link"
        round
        size="sm"
        color="primary"
        icon="place"
        class="absolute-bottom-right q-mb-sm"
        style="right: 12px;"
        :href="tourism.map_link"
        target="_blank"
      ></q-btn>
    </q-img>

    <q-card-section class="q-pb-none">
      <div class="row no-wrap items-center">
        <div class="col text-caption text-bold ellipsis" :class="$q.screen.lt.md ? 'q-pt-md' : ''">
          {{tourism.title}}
        </div>
      </div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div class="text-caption">
        {{tourism.address}}
      </div>
      <div class="text-caption text-grey">
        Contact Number: {{tourism.contact_no}}
      </div>
    </q-card-section>
  </q-card>
</div>