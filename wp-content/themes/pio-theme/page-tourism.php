<?php get_header();?>
  <div class="row justify-center q-py-xl q-px-lg">
    <div class="col-12 col-md-8">
      <q-img
        contain
        src="<?php echo get_template_directory_uri().'/assets/images/transparencyseal.jpg'; ?>"
        basic
      >
      </q-img>
      <div class="text-h6 text-bold q-mt-sm">
        SYMBOLISM
      </div>
      <div class="text-body1">
      A pearl buried inside a tightly-shut shell is practically worthless. Government information is a pearl, meant to be shared with the public in order to maximize its inherent value. The Transparency Seal, depicted by a pearl shining out of an open shell, is a symbol of a policy shift towards openness in access to government information. On the one hand, it hopes to inspire Filipinos in the civil service to be more open to citizen engagement; on the other, to invite the Filipino citizenry to exercise their right to participate in governance.  This initiative is envisioned as a step in the right direction towards solidifying the position of the Philippines as the Pearl of the Orient a shining example for democratic virtue in the region.
      </div>
    </div>
    <div class="col-12 col-md-8 q-mt-md">
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

          <?php get_template_part('template-parts/content', 'reports-table');?>
        </q-expansion-item>
      </q-list>
    </div>
  </div>
<?php get_footer();?>