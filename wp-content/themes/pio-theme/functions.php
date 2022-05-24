<?php
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
require get_template_directory() . '/custom-rest.php';

add_action("after_switch_theme", "cgb_create_tables");
add_action("after_switch_theme", "cgb_create_pages");

function cgb_create_tables(){
    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $carousel_images = $wpdb->prefix . "carousel_images";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $carousel_images (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      path varchar(255) NOT NULL,
      is_display tinyint(1) DEFAULT NULL,
      placement_number int(10) NOT NULL,
      PRIMARY KEY  (id),
      KEY image_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    dbDelta( $sql );

    $reports = $wpdb->prefix . "reports";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $reports (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      year int(10) NOT NULL,
      quarter int(10) DEFAULT NULL,
      path varchar(255) NOT NULL,
      type int(5) NOT NULL,
      PRIMARY KEY  (id),
      KEY file_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    dbDelta( $sql );

    $bids = $wpdb->prefix . "bid_reports";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $bids (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      title varchar(255) NOT NULL,
      year int(10) NOT NULL,
      month int(10) DEFAULT NULL,
      path varchar(255) NOT NULL,
      type int(5) NOT NULL,
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
  ];
  
  foreach ($arr as $key => $value) {
    echo($value['title']);
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