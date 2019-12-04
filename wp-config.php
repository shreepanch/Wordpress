<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kirtipur' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Zpdq=j%Y>EmPo<uZB16q<z2Eo$oxQH]mY<b:*woL@Iqg|}GDy0a[B@li/e8Mke%v' );
define( 'SECURE_AUTH_KEY',  'zJhc34`F8xsJbCd0x:pVN-)qP?9CY SilBlu|[T<j!l6@>ew`j&iAvE`8F6::gP[' );
define( 'LOGGED_IN_KEY',    '3O5%#w6[ui]Pu-~Sp%G+?<2iF4iq^A!u1zWC?igjppD-JL;WjHdXA@uFc `<d~]M' );
define( 'NONCE_KEY',        ')T|73/(4fHMlsT4N-7_FZgij<w6PH5hO.Nv?o3MC,(E}&|;7VwA[mgL.6=*^/fxJ' );
define( 'AUTH_SALT',        'c<%T^w}HBB0e%,k2R_LPW<VF?bkf}*7K#k#bzf#xLJ_uaR9pybBS%F1J==]3QHg^' );
define( 'SECURE_AUTH_SALT', 'm12OnmYiZ@ YTB-na!H?] |ZAoW:olL$aRxf/3Bc)as}<D]P;L&Af7OJ9V:9nW`L' );
define( 'LOGGED_IN_SALT',   'Brx#Dm~,5WNY/qg>cz^/Ar:fiIp:iPW{UpS`+8-rc TQFfKL{KAKZQ4tb:w+NK3T' );
define( 'NONCE_SALT',       '2exrK@TlRC<J[!9HqZ_0)FAun4(XxSE>.01;exj?QW4-^gQ,m~8M#Xj$!{|Gl.6r' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
