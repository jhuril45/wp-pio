<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cgb_new' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '. KF|rIlOo# $[-|6KqxgThHhb *#kXhcE4!TtX:S:<d-rQzO+Ms[,Nl6U:09dqy' );
define( 'SECURE_AUTH_KEY',  'ja^9.zn1z; VV4W.^FqFg7Y9h^rVc,skqadw8Cp+!]#vwFMrU9va&k};N7zi|46c' );
define( 'LOGGED_IN_KEY',    'APcOHdjrC5t L]xXiXdrDpe{UNRRY@_jz&D!(LjZ587e@iMlO6JM}~XSpQ` QQU6' );
define( 'NONCE_KEY',        'z=?:-T PpiTC^^ilc%45/b9pTZ[?<=T[IBbA:/kJXnJAMV9jl}Utga$ocU^<hi]#' );
define( 'AUTH_SALT',        '{0yE}!aUi?p[4,k?.&}$qJLT7fUFYrB,zz5nr~P{fAGWul2u@>N8dAEYF>UPqxXz' );
define( 'SECURE_AUTH_SALT', '2<r;W#;Ti|G2QtqEk)Pul|Skhrc&Gue0))8L5=g;_ve)A3bc2l84{rXBE;.LuHpO' );
define( 'LOGGED_IN_SALT',   'Z}ZfL[$;m3vNnp[40K[bJrpC$9)dQSLu/^)X(G;P5>^OIcmLc6c5]#yLy#%G2Yg[' );
define( 'NONCE_SALT',       '$d=zik4<K7fw<;$-/j&hPcr-?Q-pO@1%}R/:AM}J/D?YJ@p3H4.[YP#w*/gz 5J~' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
