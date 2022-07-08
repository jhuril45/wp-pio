<div class="row justify-center">
  <q-card class="report-card">
    <q-card-section class="bg-primary text-white">
      <div class="text-h6">{{bid.title}}</div>
      <div class="text-subtitle2">{{ getBidType(bid.type) }}</div>
      <div class="text-subtitle2">{{ getMonth(bid.month) + ' of ' + bid.year }}</div>
    </q-card-section>

    <q-separator></q-separator>

    <q-card-actions align="right">
      <q-btn
        class="full-width"
        label="Download"
        color="primary"
        icon="download"
        :href="bid.path"
        :target="'_blank'">
    </q-card-actions>
  </q-card>
</div>