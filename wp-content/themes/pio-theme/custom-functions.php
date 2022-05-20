<?php
function getRecentPosts(){
  $data = get_posts( array( 
    'post_type' => 'post',
    'posts_per_page' => 5,
    )
  );
  $recent_posts = [];
  foreach ($data as $key => $value) {
    $post_thumbnail_id = get_post_thumbnail_id($value->ID);
    if ( $post_thumbnail_id ) {
      $src = wp_get_attachment_url( $attachment->ID, 'full');
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
add_action('rest_api_init', 'register_rest_images' );

function get_rest_featured_image( $object, $field_name, $request ) {
  if( $object['featured_media'] ){
      $img = wp_get_attachment_image_src( $object['featured_media'], 'app-thumb' );
      return $img[0];
  }
  return false;
}

function check_news_category() {
	$is_term = term_exists('News');
  wp_create_category('News');
}
add_action( 'admin_init', 'check_news_category' );

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

function add_tab_query_var( $vars ){
  $vars[] = "tab";
  return $vars;
}

function add_id_query_var( $vars ){
  $vars[] = "id";
  return $vars;
}

function add_office_query_var( $vars ){
  $vars[] = "office";
  return $vars;
}

add_filter( 'query_vars', 'add_tab_query_var' );
add_filter( 'query_vars', 'add_id_query_var' );
add_filter( 'query_vars', 'add_office_query_var' );

function myInit() {
  global $globalUrl;
  $globalUrl = url_to_postid(get_permalink());
}
add_action('init', 'myInit');

function getCarouselImages() {
  global $wpdb;
  $results = $wpdb->get_results("SELECT * FROM wp_carousel_images");
  return $results;
}

function getHeaderMenus() {
  $arr = [
    array(
      "title" => "Home",
      "url" => "",
      "slug" => "home",
      "is_menu" => false,
    ),
    array(
      "title" => "About Butuan",
      "url" => "",
      "slug" => "",
      "is_menu" => false,
    ),
    array(
      "title" => "Government",
      "url" => "",
      "slug" => "government",
      "is_menu" => true,
      "sub_menu" => [
        array(
          "title" => "City Offices",
          "url" => "/offices",
          "slug" => "offices",
        ),
      ]
    ),
    array(
      "title" => "Tourism",
      "url" => "",
      "slug" => "",
      "is_menu" => false,
    ),
    array(
      "title" => "Business",
      "url" => "",
      "slug" => "",
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

// add_action('wp', 'redirect_private_page_to_login');

function redirect_private_page_to_login(){

    global $wp_query;

    $queried_object = get_queried_object();

    if ($queried_object->post_status == "private" && !is_user_logged_in()) {
      wp_redirect(home_url('/login'));
    } 
}

function restrict_admin() {
  $user = wp_get_current_user();
  if($user->roles[0] != 'administrator'){
    return wp_redirect(home_url('/dashboard'));
  }
}
add_action( 'admin_init', 'restrict_admin', 1 );

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
add_action( 'login_enqueue_scripts', 'my_login_logo' );