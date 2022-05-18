<?php get_header();?>
  <div class="row justify-center q-py-xl q-px-lg">
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
                Bids
              </q-item-label>
            </q-item-section>
          </template>

          <?php get_template_part('template-parts/content', 'bids-table');?>
        </q-expansion-item>
      </q-list>
    </div>
  </div>
<?php get_footer();?>