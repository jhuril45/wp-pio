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

add_action("after_switch_theme", "mytheme_create_extra_table");

function mytheme_create_extra_table(){
    global $wpdb;

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    $table_name = $wpdb->prefix . "carousel_images";  //get the database table prefix to create my new table

    $sql = "CREATE TABLE $table_name (
      id int(10) unsigned NOT NULL AUTO_INCREMENT,
      path varchar(255) NOT NULL,
      is_display tinyint(1) DEFAULT NULL,
      placement_number int(10) NOT NULL,
      PRIMARY KEY  (id),
      KEY image_path (path)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    dbDelta( $sql );
}

// function mytheme_create_extra_table(){
//   global $wpdb;

//   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

//   $table_name = $wpdb->prefix . "carousel_images";  //get the database table prefix to create my new table

//   $sql = "CREATE TABLE $table_name (
//     id int(10) unsigned NOT NULL AUTO_INCREMENT,
//     path varchar(255) NOT NULL,
//     is_display tinyint(1) DEFAULT NULL,
//     placement_number int(10) NOT NULL,
//     PRIMARY KEY  (id),
//     KEY Index_2 (path),
//     KEY Index_3 (placement_number),
//   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

//   dbDelta( $sql );
// }