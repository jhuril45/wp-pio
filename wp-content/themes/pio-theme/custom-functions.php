<?php
function uploadFileSubmitted($file_name,$is_post=true,$prefix=''){
  $upload_dir = wp_upload_dir();
  $temp = explode('.',basename($_FILES[$file_name]['name']));
  $extension = end($temp);
  $file_data = file_get_contents($_FILES[$file_name]['tmp_name'] );
      
  $name = $prefix.time().'.'.$extension;
  $file = null;
  if($is_post){
    $file = wp_mkdir_p($upload_dir['path']) ? $upload_dir['path'] . '/' . $name : $upload_dir['basedir'] . '/' . $name;
    file_put_contents($file, $file_data);
  }else{
    $file = wp_upload_bits( $name, null, $file_data);
  }

  return $file;
}

function checkUser($role){
  if(!is_user_logged_in()) return false;
  $user = wp_get_current_user();
  return in_array($role,$user->roles);
}

function getDashboardDrawerMenu(){
  global $pagename;
  if(!is_user_logged_in()) return [];
  $arr = [];
  if(checkUser('pio')){
    array_push($arr,
      array(
        'title' => 'Carousel',
        'url' => get_home_url().'/dashboard?tab=carousel',
        'icon' => 'collections',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'carousel'),
      ),
      array(
        'title' => 'Posts',
        'url' => get_home_url().'/dashboard?tab=posts',
        'icon' => 'rss_feed',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'post' || get_query_var( 'tab' ) == 'posts' || get_query_var( 'tab' ) == ''),
      ),
      array(
        'title' => 'Offices',
        'url' => get_home_url().'/dashboard?tab=offices',
        'icon' => 'business',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'offices' || get_query_var( 'tab' ) == 'add-office'),
      ),
      array(
        'title' => 'Barangays',
        'url' => get_home_url().'/dashboard?tab=barangays',
        'icon' => 'foundation',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'barangays' || get_query_var( 'tab' ) == 'add-barangay'),
      ),
      array(
        'title' => 'Flip Cards',
        'url' => get_home_url().'/dashboard?tab=flip-cards',
        'icon' => 'foundation',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'flip-cards'),
      ),
    );
  }else if(checkUser('bac')){
    array_push($arr,
      array(
        'title' => 'Reports',
        'url' => get_home_url().'/dashboard?tab=reports',
        'icon' => 'summarize',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'reports' || get_query_var( 'tab' ) == 'add-report'),
      ),
      array(
        'title' => 'Bid Reports',
        'url' => get_home_url().'/dashboard?tab=bid-reports',
        'icon' => 'receipt_long',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'bid-reports' || get_query_var( 'tab' ) == 'add-bid-report'),
        'is_menu' => false,
        'sub_menu' => [
          array(
            'title' => 'Offices',
            'url' => get_home_url().'/dashboard?tab=offices',
            'icon' => 'business',
            'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'offices' || get_query_var( 'tab' ) == 'add-office'),
          ),
        ]
      ),
    );
  }else if(checkUser('tourism')){
    array_push($arr,
      array(
        'title' => 'Tourism',
        'url' => get_home_url().'/dashboard?tab=tourism',
        'icon' => 'tour',
        'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'tourism' || get_query_var( 'tab' ) == 'add-tourism'),
      ),
    );
  }
  array_push($arr,
    array(
      'title' => 'Logout',
      'url' => wp_logout_url(),
      'icon' => 'logout',
      'is_page' => false,
    ),
  );
  return $arr;
  return $arr = [
    
    // array(
    //   'title' => 'Officials',
    //   'url' => get_home_url().'/dashboard?tab=official',
    //   'icon' => 'groups',
    //   'is_page' => $pagename == 'dashboard' && (get_query_var( 'tab' ) == 'official' || get_query_var( 'tab' ) == 'add-official'),
    // ),
    array(
      'title' => 'Logout',
      'url' => wp_logout_url(),
      'icon' => 'logout',
      'is_page' => false,
    ),
  ];
}

function getRecentPosts(){
  $term = get_term_by('name', 'News', 'category');
  $data = get_posts( array( 
    'post_type' => 'post',
    'posts_per_page' => 5,
    'category' => $term->term_id,
    )
  );
  $recent_posts = [];
  foreach ($data as $key => $value) {
    $post_thumbnail_id = get_post_thumbnail_id($value->ID);
    if ( $post_thumbnail_id ) {
      $recent_src = wp_get_attachment_url( $post_thumbnail_id, 'full');
      $value->fimg_url = $recent_src;
    }else{
      $value->fimg_url = get_template_directory_uri().'/assets/images/Butuan_Logo_Transparent.png';
    }
    array_push($recent_posts,$value);
  }
  return $recent_posts;
}

function register_rest_images(){
  register_rest_field( array('post'),
      'fimg_url',
      array(
        'get_callback'    => 'get_rest_featured_image',
        'update_callback' => null,
        'schema'          => null,
      )
  );
}

function get_rest_featured_image( $object, $field_name, $request ) {
  if( $object['featured_media'] ){
      $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
      return $img[0];
  }
  return false;
}

function check_categories() {
	$is_term = term_exists('News');
  wp_create_category('News');
  wp_create_category('Bids');
  wp_create_category('Tourism');
  wp_create_category('Barangay');
  wp_create_category('Offices');
  wp_create_category('Reports');
}


function custom_get_custom_logo(){
  $logo = get_theme_mod( 'custom_logo' );
  $image = wp_get_attachment_image_src( $logo , 'full' );
  return $image[0];
}

function custom_get_post_data(){
  $post_id = url_to_postid(get_permalink());
  // $data = get_post($post_id);
  return $post_id;
}

function custom_get_user_role(){
  return wp_get_current_user()->roles[0];
}

function add_query_vars( $vars ){
  $vars[] = "search";
  $vars[] = "barangay";
  $vars[] = "office";
  $vars[] = "id";
  $vars[] = "tab";
  $vars[] = "searched";
  return $vars;
}

function myInit() {
  global $globalUrl;
  $globalUrl = url_to_postid(get_permalink());
}

function getHeaderMenus() {
  $arr = [
    array(
      "title" => "Home",
      "url" => get_home_url()."",
      "slug" => "",
      "is_menu" => false,
    ),
    array(
      "title" => "About Butuan",
      "url" => get_home_url()."/about",
      "slug" => "about",
      "is_menu" => false,
    ),
    array(
      "title" => "Government",
      "url" => get_home_url()."",
      "slug" => "government",
      "is_menu" => true,
      "sub_menu" => [
        array(
          "title" => "City Officials",
          "url" => get_home_url()."/city-officials",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
        array(
          "title" => "City Offices",
          "url" => get_home_url()."/offices",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
        // array(
        //   "title" => "City Issuances",
        //   "url" => get_home_url()."/offices",
        //   "slug" => "offices",
        //   "parent_slug" => "government"
        // ),
        array(
          "title" => "City Barangays",
          "url" => get_home_url()."/barangays",
          "slug" => "offices",
          "parent_slug" => "government"
        ),
      ]
    ),
    array(
      "title" => "Tourism",
      "url" => get_home_url()."/tourism",
      "slug" => "tourism",
      "is_menu" => false,
    ),
    array(
      "title" => "Business",
      "url" => get_home_url()."",
      "slug" => "business",
      "is_menu" => false,
    ),
    array(
      "title" => "Login",
      "url" => get_home_url()."/login",
      "slug" => "login",
      "is_menu" => false,
    )
  ];

  return $arr;
}

function getFlipCards() {
  $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec nisl tincidunt, condimentum nibh vitae, bibendum neque. Donec vitae hendrerit arcu. Donec enim lacus, elementum sed justo sed,';
  $arr = [
    array(
      'icon' => 'agriculture',
      'image' => 'agriculture.jpg',
      'class_front' => 'bg-green-5 text-white',
      'class_back' => 'bg-green-8 text-white',
      'title' => 'Agriculture',
      'description' => $lorem,
    ),
    array(
      'icon' => 'warning',
      'image' => 'disaster.jpg',
      'class_front' => 'bg-light-blue-6 text-white',
      'class_back' => 'bg-light-blue-8 text-white',
      'title' => 'Disaster Risk Reduction',
      'description' => $lorem,
    ),
    array(
      'icon' => 'school',
      'image' => 'school.jpg',
      'class_front' => 'bg-purple-4 text-white',
      'class_back' => 'bg-purple-7 text-white',
      'title' => 'Education',
      'description' => $lorem,
    ),
    array(
      'icon' => 'health_and_safety',
      'image' => 'health.jpg',
      'class_front' => 'bg-light-green-6 text-white',
      'class_back' => 'bg-light-green-8 text-white',
      'title' => 'Health',
      'description' => $lorem,
    ),
    array(
      'icon' => 'apartment',
      'image' => 'infrastracture.jpg',
      'class_front' => 'bg-deep-orange-6 text-white',
      'class_back' => 'bg-deep-orange-8 text-white',
      'title' => 'Infrastracture Development',
      'description' => $lorem,
    ),
    array(
      'icon' => 'beach_access',
      'image' => 'tourism.jpg',
      'class_front' => 'bg-yellow-6 text-white',
      'class_back' => 'bg-yellow-8 text-white',
      'title' => 'Tourism',
      'description' => $lorem,
    ),
    array(
      'icon' => 'traffic',
      'image' => 'traffic.jpg',
      'class_front' => 'bg-cyan-6 text-white',
      'class_back' => 'bg-cyan-8 text-white',
      'title' => 'Transportation and Traffic Management',
      'description' => $lorem,
    ),
    array(
      'icon' => 'recycling',
      'image' => 'recycle.jpg',
      'class_front' => 'bg-green-6 text-white',
      'class_back' => 'bg-green-8 text-white',
      'title' => 'Solid Waste Management',
      'description' => $lorem,
    ),
  ];
  
  return $arr;
}

function get_posted_date() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
  }

  $time_string = sprintf(
    $time_string,
    esc_attr( get_the_date( DATE_W3C ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( DATE_W3C ) ),
    esc_html( get_the_modified_date() )
  );

  $posted_on = sprintf(
    /* translators: %s: post date. */
    esc_html_x( '%s', 'post date', 'pio' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );

  echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

function restrict_admin() {
  $user = wp_get_current_user();
  if($user->roles[0] != 'administrator'){
    return wp_redirect(home_url('/dashboard'));
  }
}

function searchContents($data=null){
  $post_array = get_posts(array(
    'post_status' => 'publish',
    'numberposts' => 5,
    's' => $data ? $data : $_POST['search'],
  ));

  foreach ($post_array as $key => $value) {
    if(has_category('Offices',$value->ID)){
      $value->guid = get_home_url().'/offices?office='.$value->ID.'&searched=1';
    }else if(has_category('Barangay',$value->ID)){
      $value->guid = get_home_url().'/barangays?barangay='.$value->ID.'&searched=1';
    }
  }

  return $post_array;
}

function isCategory($post_id,$category){
  $post_category = get_the_category($post_id);
  return false;
}


function my_login_logo() { ?>
  <style type="text/css">
      #login h1 a, .login h1 a {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/Butuan_Logo_Transparent.png);
        height:150px;
        width:150px;
        background-size: 150px 150px;
        background-repeat: no-repeat;
      }
  </style>
<?php }

add_action('rest_api_init', 'register_rest_images' );
add_action( 'admin_init', 'check_categories' );
add_filter( 'query_vars', 'add_query_vars' );
add_action('init', 'myInit');
add_action( 'admin_init', 'restrict_admin', 1 );
add_action( 'login_enqueue_scripts', 'my_login_logo' );