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
define( 'DB_NAME', 'happygifter' );

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
define( 'AUTH_KEY',         '#d*t}6jej@%oc?{@H@=(3x,I1vqIWk&2n@Hd8O}y3U|cegV^TGb4!/?!V,b,+BX7' );
define( 'SECURE_AUTH_KEY',  '}~|&}=>1DU^Qi9~^?_ee%vd7nVq.=P?&@_EJN2v-~Ere$k`qAeJ).2eV<zW,^&90' );
define( 'LOGGED_IN_KEY',    'lbwGN]GYSm1cgWJ-<r2K4Y_t5]4^4S.e$?/]*ph1hiG8m _qve@}&%K^z`83-kU5' );
define( 'NONCE_KEY',        'e>j^pdXbW_ea5p{;j*,LxPtczITfh8wo_5g@bx|pN_KCK j?@:!b1c{_SP!0c3~6' );
define( 'AUTH_SALT',        'oR#1sQQ}SFOx4@(]gWgy9496^&>!Mx|}x>G%,{h&$Q.SH.%1&0AbTTaJVUP7zNPl' );
define( 'SECURE_AUTH_SALT', '0sNvlCF8HBx`QB(2x19KB8>Rpbp:HC0(>oh_~)/xYwmE v=ntayc|5uoymiUE=bS' );
define( 'LOGGED_IN_SALT',   '&Hd@Ki1*9C`f;s?:{JkK48fEa`;?@1pE`$!OWy]}Y{edf g[n)sB{Mf3Qcgn*<KB' );
define( 'NONCE_SALT',       '_=B)(gA~Pa/|fH2:?Gp?{<bNNM<a#WryYh`NbhJmI&z;K;|n?1 E=-<{@Y*UgoBZ' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
