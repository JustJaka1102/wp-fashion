<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_fashion_page' );

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
define( 'AUTH_KEY',         'HV3.}>vpe, +lo_tBoghb_t?r=WJ:qQoYX*P{[$^FC1yM]w[-QS9zOb[!R!,Dlqa' );
define( 'SECURE_AUTH_KEY',  'A3&YLP^^###Hx D2>x#8Jmb5gY;%uP?+~YJu9.g,39&h8c1Ad?<F}idNOY;~`,};' );
define( 'LOGGED_IN_KEY',    '_}=5sQGM7x+LWI0z2HTQ%i ,F4+|-0?zC)R_naud ikBYV(o:U,r&6_aO (~[peE' );
define( 'NONCE_KEY',        'vxQfz`b.Py4sarSrYeQ.E8WBWB&AB60X{{/&q[}A&UUzo$)]@{IK0w!x@OWl#-BC' );
define( 'AUTH_SALT',        ':m[W:|%D=M*Kq 6R_^ljh -1lIQv8OHK]?F@~V.sa54Aw3gWd8cs2u*gw2?[:;d%' );
define( 'SECURE_AUTH_SALT', '!q~nX F5Hf3#oPh.XE/0C(YH@G=eT6Q_^#m&d6_?+IcnR%h<_s; =pSayhHU0<*(' );
define( 'LOGGED_IN_SALT',   '{2K7X[39;dZ|1ua6`=NrO47%[tqB>qoj}jn8=egUYx917=Qf7upL~@ya,y^}?izX' );
define( 'NONCE_SALT',       'e+&a8[rCPl~#j% dpad#-$aO49n}~U<]~)5Fw@8,Ze>SHi=M4jM{)gy72%GSJ3%?' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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

define( 'WP_ENVIRONMENT_TYPE', 'staging' );