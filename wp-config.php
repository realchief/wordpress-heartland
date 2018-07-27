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
define('DB_NAME', 'wp_new');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'FF1LA2n%N9PTRdu-1Yn&#3OEqirA`Jcur6n0VWGAWAKt x)o ``%lrn+7zrplEr?');
define('SECURE_AUTH_KEY',  '_bmvamG<QW7-%sW5FunMR8BLi5W,WR|Pu]k&pz>/85j u84{}xqGbYHogWIDfIK ');
define('LOGGED_IN_KEY',    'L]?.MqCtu&.}?;*x.dy)pH).>I0=k:rz03/ V u/B).Tvao_D5.)o.ohvcPUpm,Y');
define('NONCE_KEY',        '4r]gAwsb>g-)#7+0P[.X.`NVv59Gcj_5Y9}6gP@hNL,u]5E!PNB()d/wlW1D+{uD');
define('AUTH_SALT',        '@;}}DO=X:]o_~EOJ^8!F4MOh5qb.Qay/d.?()N=O9VFYtnyZ4{Uhe9S<3bfiTE]$');
define('SECURE_AUTH_SALT', ' >>geJ|1]F4hLfab{m,=AG#h/ii0GTxm?!rW!bDIuP[`l3.gvnbYyS+bl|_:)zCV');
define('LOGGED_IN_SALT',   'ocXC.&1oq8r-x`^CCX}G2uS9`U3tUl)DiG+BO|Be~>&+W]I h#%)ri##_$wzF/,(');
define('NONCE_SALT',       'a*xK8>AJ#jmcjx@|Gg:]W7R6m7^+GPaoFx%3!p>m)zES?2hD[11<dW_/=-r-SP!&');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
