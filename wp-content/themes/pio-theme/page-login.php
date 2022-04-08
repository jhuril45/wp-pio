<?php get_header(); ?>
  <div class="row justify-center q-py-xl q-px-lg" id="login-custom-page">
    <div class="col-12 col-md-4 login-card">
      <q-card class="my-card ">
        <q-card-section class="bg-primary">
          <div class="full-width">
            <q-img
              src="<?php echo get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png'; ?>"
              contain
              height="150px"
            >
            </q-img>
          </div>
          <div class="text-center text-h5 q-pa-none text-white">
            City Government of Butuan
          </div>
        </q-card-section>

        <q-card-section>
          <q-form
            action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>"
            method="post"
            class="q-gutter-md"
            >
            <q-input
              outlined
              v-model="login_form.username"
              for="user_login"
              label="Username"
              lazy-rules
              :rules="[ val => val && val.length > 0 || 'Please enter your username']"
            ></q-input>

            <q-input
              outlined
              type="password"
              for="user_pass"
              v-model="login_form.password"
              label="Password"
              lazy-rules
              :rules="[
                val => val !== null && val !== '' || 'Please enter your password',
              ]"
            ></q-input>

            <div>
              <q-btn size="lg" class="full-width" label="Submit" type="submit" color="primary"></q-btn>
            </div>
          </q-form>
        </q-card-section>
      </q-card>
    </div>
  </div>
<?php get_footer(); ?>