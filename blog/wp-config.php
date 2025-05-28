<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u838013575_7OAmp' );

/** Database username */
define( 'DB_USER', 'u838013575_Y0Sgr' );

/** Database password */
define( 'DB_PASSWORD', 'tuWIYLqMTe' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          ']ETZ9~&vVf{>| sP]}4V!-Yu,Rf)jb+VL~n$%@^3,EkoAEb8[FS9o&KwfHQ,x_o9' );
define( 'SECURE_AUTH_KEY',   'B]yc$q_r^Z^ Jf1`z!HLEG_`=Fp2ly?3nunWJQGZx!jOKSo~y&3H&P(I=v0!VIC6' );
define( 'LOGGED_IN_KEY',     '4K(yI.?il~-p~9d3K_ xfMhJsKr5J (sUn#%U5 Y,1*r]iR?HfwrQKjSEHF&$fL?' );
define( 'NONCE_KEY',         'v8n{SDF8h)7Gn4WAO]I$xMyov_[*>~P`O7wcl$--I7nJqzBXU%qw9x8|Z@)~c]yJ' );
define( 'AUTH_SALT',         'T*Gh3Mr>ug)+>JijP5Wl6w0$a&>y[wGqtu`d}r:tV8t!I9&N7%r):U#SYx4N*B9v' );
define( 'SECURE_AUTH_SALT',  '[.>KRE$gfw8l(e=Bwm/-Xd(;v!dg#|B$#1rGM@b.o4VsITO[ZrFBM;dVUqt*_vE*' );
define( 'LOGGED_IN_SALT',    '*s+6^kB)g5#AU#H /Sh0&Deda5/I8,b!Rzb#)~gUMk-r#7V3hQDaw#e*wa440n|M' );
define( 'NONCE_SALT',        '4Je&H{9U$`/wPd:gxbXmh1a!OPk_DJUhH-(8}U{qGA&mTN>6{Gq8py;gtoo K]=@' );
define( 'WP_CACHE_KEY_SALT', 'J&1&/2-b}hw>yH,Jhcygb$o,!<yqeHM5xZeU&^>S/Z3<f7-6We<a8=K9N#bkT9l4' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
