<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bolsa');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'OLE[l6l)ZJ4PQ$P=k)mQH=C=j7$z[jJ!YxCgmP||tA(NZM< {~(HzldmB=<7]T  ');
define('SECURE_AUTH_KEY',  'B57|8.x@[@+Ho7(dTRMPMmvb[<xX+cuvY~Y!@9+WxD~G_x xC4GM]F[$v_o[R,g/');
define('LOGGED_IN_KEY',    '~=fXr<}q)>/oI$}aH2M9$NNS5Cf].9}r:^= jgQ37^_>~4jC]lzcNb]7V@}>=?4X');
define('NONCE_KEY',        '3H#}T06MW@5g)sh1om_d!/[i~v3 v/>qd0:Fh+[9ZO)J{#0W1?H^S3W*:=`d)]2M');
define('AUTH_SALT',        '|y@OVy8[m=i/TKk&9)be+~c (<`ii|#2P$`zlT,v@c-b2E/4 _S+F.I)P9.[0?.p');
define('SECURE_AUTH_SALT', 'f@k[.{C$UXPS@#HyXScbz4v|E|-hMN|l1v|BveI/M}:F{*-Nu[G*5uU[2ul&-o8s');
define('LOGGED_IN_SALT',   'ft`_cTgzd90c3:62 !_mpdtwcS&.uVxWId.TE@X|h-q&Aq%1#`M/]*I%P{B%dkU5');
define('NONCE_SALT',       'Rt)jVP4e`5<|[VaMHLC*ZuD8Sq2fL<5??Oj*nsZgpIc]>Iv77_T+9r5q~avjcX_x');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
