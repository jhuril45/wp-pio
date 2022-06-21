<?php
date_default_timezone_set("Asia/Manila");
add_theme_support( 'html5', array( 'navigation-widgets' ) );
add_theme_support('custom-header');
add_theme_support('menus');
add_theme_support('widgets');
add_theme_support( 'post-thumbnails' );

add_theme_support( 'custom-logo', array(
  'height' => 50,
  'width'  => 50,
) );

/**
 * Custom script and styles.
 */
require get_template_directory() . '/load-script.php';
require get_template_directory() . '/load-styles.php';

/**
 * Custom functions.
 */
require get_template_directory() . '/custom-functions.php';
require get_template_directory() . '/rest-functions.php';

require get_template_directory() . '/functions/post.php';
require get_template_directory() . '/functions/carousel.php';
require get_template_directory() . '/functions/tourism.php';
require get_template_directory() . '/functions/report.php';
require get_template_directory() . '/functions/bid_report.php';
require get_template_directory() . '/functions/office.php';
require get_template_directory() . '/functions/barangay.php';
require get_template_directory() . '/functions/city_official.php';

require get_template_directory() . '/routes.php';


add_action("after_switch_theme", "cgb_create_tables");
add_action("after_switch_theme", "cgb_create_pages");
add_action("after_switch_theme", "cgb_create_roles");

function cgb_create_tables(){
    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $carousel_images = $wpdb->prefix . "carousel_images";  
    $sql = "CREATE TABLE $carousel_images (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      caption varchar(255) DEFAULT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      is_display tinyint(1) DEFAULT NULL,
      placement_number int(10) NOT NULL,
      PRIMARY KEY  (id),
      KEY image_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    dbDelta( $sql );

    $reports = $wpdb->prefix . "reports";  
    $sql = "CREATE TABLE $reports (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      year int(10) NOT NULL,
      quarter int(10) DEFAULT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      type int(5) NOT NULL,
      created_at timestamp DEFAULT NULL,
      post_id int(10) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $bids = $wpdb->prefix . "bid_reports";  

    $sql = "CREATE TABLE $bids (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      year int(10) NOT NULL,
      month int(10) DEFAULT NULL,
      date_posted DATE DEFAULT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      type int(5) NOT NULL,
      mode int(5) DEFAULT NULL,
      created_at timestamp DEFAULT NULL,
      post_id int(10) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $offices = $wpdb->prefix . "offices";  
    $sql = "CREATE TABLE $offices (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      head varchar(255) NOT NULL,
      assistant varchar(255) DEFAULT NULL,
      mandate LONGTEXT DEFAULT NULL,
      description varchar(255) DEFAULT NULL,
      facebook varchar(255) DEFAULT NULL,
      instagram varchar(255) DEFAULT NULL,
      youtube varchar(255) DEFAULT NULL,
      email varchar(255) DEFAULT NULL,
      contact_no varchar(255) DEFAULT NULL,
      twitter varchar(255) DEFAULT NULL,
      messenger varchar(255) DEFAULT NULL,
      logo varchar(255) DEFAULT NULL,
      logo_url varchar(255) DEFAULT NULL,
      org_structure varchar(255) DEFAULT NULL,
      org_structure_url varchar(255) DEFAULT NULL,
      order_number int(10) DEFAULT NULL,
      is_published tinyint(1) DEFAULT NULL,
      created_at timestamp DEFAULT NULL,
      post_id int(10) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (logo)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $office_services = $wpdb->prefix . "office_services";  
    $sql = "CREATE TABLE $office_services (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      office_id int(10) NOT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $office_forms = $wpdb->prefix . "office_forms";  
    $sql = "CREATE TABLE $office_forms (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      office_id int(10) NOT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $barangays = $wpdb->prefix . "barangays";  
    $sql = "CREATE TABLE $barangays (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      chairman varchar(255) NOT NULL,
      address varchar(255) DEFAULT NULL,
      contact_no varchar(255) DEFAULT NULL,
      description LONGTEXT DEFAULT NULL,
      mandate LONGTEXT DEFAULT NULL,
      land_area varchar(255) DEFAULT NULL,
      population int(25) DEFAULT NULL,
      landmark_name varchar(255) DEFAULT NULL,
      landmark_img varchar(255) DEFAULT NULL,
      landmark_img_url varchar(255) DEFAULT NULL,
      created_at timestamp DEFAULT NULL,
      post_id int(10) NOT NULL,
      PRIMARY KEY  (id),
      KEY file_path (landmark_img)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $barangays = $wpdb->prefix . "barangay_officials";  
    $sql = "CREATE TABLE $barangays (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      barangay_id int(10) NOT NULL,
      name varchar(255) NOT NULL,
      position varchar(255) NOT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $barangay_services = $wpdb->prefix . "barangay_services";  
    $sql = "CREATE TABLE $barangay_services (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      barangay_id int(10) NOT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $city_tourism = $wpdb->prefix . "city_tourism";  
    $sql = "CREATE TABLE $city_tourism (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      type int(10) NOT NULL,
      description LONGTEXT DEFAULT NULL,
      address varchar(255) DEFAULT NULL,
      contact_no varchar(255) DEFAULT NULL,
      map_link varchar(255) DEFAULT NULL,
      path varchar(255) NOT NULL,
      url varchar(255) DEFAULT NULL,
      created_at timestamp DEFAULT NULL,
      post_id int(10) DEFAULT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );


}

function cgb_create_pages(){
  $arr = [
    array(
      'title' => 'Offices',
    ),
    array(
      'title' => 'Bids',
    ),
    array(
      'title' => 'Transparency',
    ),
    array(
      'title' => 'Tourism',
    ),
    array(
      'title' => 'Dashboard',
    ),
    array(
      'title' => 'City Officials',
    ),
    array(
      'title' => 'Barangays',
    ),
    array(
      'title' => 'About',
    ),
    array(
      'title' => 'Contents',
    ),
  ];
  
  foreach ($arr as $key => $value) {
    $page = get_page_by_title(strtolower($value['title']),);
    if(empty($page)) {
      wp_insert_post(
        array(
        'comment_status' => 'close',
        'ping_status'    => 'close',
        'post_author'    => 1,
        'post_title'     => ucwords(strtolower($value['title'])),
        'post_name'      => strtolower(str_replace(' ', '-', trim($value['title']))),
        'post_status'    => 'publish',
        'post_content'   => '',
        'post_type'      => 'page',
        )
      );
    }
  }
}

function cgb_create_roles(){
  global $wp_roles;
  if ( ! isset( $wp_roles ) )
      $wp_roles = new WP_Roles();

  $subscriber = $wp_roles->get_role('subscriber');
  $wp_roles->add_role('pio', 'Pio', $subscriber->capabilities);
  $wp_roles->add_role('bac', 'Bac', $subscriber->capabilities);
  $wp_roles->add_role('tourism', 'Tourism', $subscriber->capabilities);
}