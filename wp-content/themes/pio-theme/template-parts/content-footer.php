<q-footer>
  <div class="row q-py-lg" :class="$q.screen.lt.sm ? 'text-start q-px-md' : 'q-px-xl'">
    <div class="col-12 col-md-3" >
      <q-list dense padding class="rounded-borders">
        <q-item>
          <q-item-section>
            <q-item-label class="text-h6 q-mb-md">
              Visit Us
            </q-item-label>
            <q-item-label>
              City Government of Butuan
            </q-item-label>
            <q-item-label>
              City Information Communication Technology Office
            </q-item-label>
            <q-item-label>
              2nd Floor City Hall Bldg.
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>

    <div class="col-12 col-md-3" :class="$q.screen.lt.sm ? 'q-px-sm' : 'q-px-lg'">
      <q-list dense padding class="rounded-borders">
        <q-item>
          <q-item-section>
            <q-item-label class="text-h6 q-mb-md">
              ABOUT THE LGU
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Know Butuan City
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Departments
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Services
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Transparency
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                News
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Contact Us
              </a>
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>

    <div class="col-12 col-md-3" :class="$q.screen.lt.sm ? 'q-px-sm' : 'q-px-lg'">
      <q-list dense padding class="rounded-borders">
        <q-item>
          <q-item-section>
            <q-item-label class="text-h6 q-mb-md">
              SERVICES
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Career Opportunities
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Landmark Legislations
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Processing of Business Permits
              </a>
            </q-item-label>
            <q-item-label>
              <a href="" class="text-white footer-link">
                Online Payment
              </a>
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>

    <div class="col-12 col-md-3" :class="$q.screen.lt.sm ? 'q-px-sm' : 'q-px-lg'">
      <q-list dense padding class="rounded-borders">
        <q-item>
          <q-item-section>
            <q-item-label class="text-h6 q-mb-md">
              GOVERNMENT LINKS
            </q-item-label>
            <q-item-label>
              <a href="https://www.gov.ph/" class="text-white footer-link">
                Republic of the Philippines
              </a>
            </q-item-label>
            <q-item-label>
              <a href="https://www.dilg.gov.ph/" class="text-white footer-link">
                DILG
              </a>
            </q-item-label>
            <q-item-label>
              <a href="https://www.dti.gov.ph/" class="text-white footer-link">
                DTI
              </a>
            </q-item-label>
            <q-item-label>
              <a href="https://www.deped.gov.ph/" class="text-white footer-link">
                DepEd
              </a>
            </q-item-label>
            <q-item-label>
              <a href="http://tourism.gov.ph/" class="text-white footer-link">
                Tourism
              </a>
            </q-item-label>
          </q-item-section>
        </q-item>
      </q-list>
    </div>
  </div>
  <q-toolbar class="bg-blue-10 text-white q-px-lg relative-position" v-if="$q.screen.gt.sm">
    <q-toolbar-title class="text-body2 text-italic text-center">
      Ⓒ 2022. City Government of Butuan. All Rights Reserved.
    </q-toolbar-title>
    <span class="text-body2 absolute-right row items-center q-px-sm">
      Version 1.0.0
    </span>
  </q-toolbar>
</q-footer>