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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/u2252279/data/www/gg-estate.ru/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', "u2252279_golden" );

/** Database username */
define( 'DB_USER', "u2252279_golden_" );

/** Database password */
define( 'DB_PASSWORD', "^55%4jk58220\$#" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'sM^_Xpf32C/ll<+gDvo6uqf,<W%+TYS*VytEMRGwO!|CxAqsX2p~rAf9`NO,PaP:' );
define( 'SECURE_AUTH_KEY',  'mc5B<O2S(22k{] cm&6nojN0vy-(Ck,95fy6Ks6LxD#Bs+<rbEG/{ G4WLAu?F9c' );
define( 'LOGGED_IN_KEY',    '#h@l^6oT,?D192)evX;YydTKJ1s6>K9pWCk{I;d)NHE+WbXXP<m6%W/s/~_4[{h}' );
define( 'NONCE_KEY',        'L4y/K@g@oP%=h~dWE]ii~AJ=.2P%U&*3~OT-ri]?_3O[^mg+TQCNxDP>.2C(20@K' );
define( 'AUTH_SALT',        'WF,eoQT@gvPc{G%^i:#O8@:1UbzIf0E#lce)Iv[u$tXTpMWu`_m@.jBpVmb.p^S7' );
define( 'SECURE_AUTH_SALT', 'b$neT$@YXr)m;zw{i 0UFm2 OS>0?6O5R79BoBQ#IPigDRk2TYd(LHw{WnF| G9t' );
define( 'LOGGED_IN_SALT',   'pQEU1LnSL|LdJq2&v%fK0)FP,^mB7*RO(4iH9xMn59y(M8Q&{l0w5RvnG*0Y!`Xq' );
define( 'NONCE_SALT',       'nd`pF]~i/.hp4C`=23]AgxV)4i+wntqN.jS98tQDtx:ttK{^K:X$j%moRfY_V2ct' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
