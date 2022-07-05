<?php get_header(); ?>
  <div class="row justify-center q-gutter-y-md q-pa-lg">
    <div class="col-10">
      <q-breadcrumbs gutter="sm">
        <q-breadcrumbs-el>
          <span class="text-primary text-body1">
            Home
          </span>
        </q-breadcrumbs-el>
        <q-breadcrumbs-el>
          <span class="text-body1">
            Search
          </span>
        </q-breadcrumbs-el>
      </q-breadcrumbs>
    </div>
    <div class="col-10">
      <q-list
        separator
        bordered>
        <q-item
          clickable
          v-ripple
          v-for="item in searched_contents" :key="item.ID"
          :href="item.guid">
          <q-item-section>
            <q-item-label lines="1" class="text-primary text-weight-bold">
              {{item.post_title}}
            </q-item-label>
          </q-item-section>
          <q-item-section side>
            <q-icon
              name="arrow_forward_ios"
              color="primary"></q-icon>
          </q-item-section>
        </q-item>
        <q-item v-if="searched_contents.length == 0">
          <q-item-section>
            <q-item-label lines="1" class="text-grey-7 text-weight-bold">
              Empty
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </div>
<?php get_footer(); ?>