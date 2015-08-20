<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_singlepage');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'xK/@}h URY?uLx_Zq~h#[vR:/g%)eF)[.jcj<[9f*AutPbB2XpX=VqIbMkwvkaFM');
define('SECURE_AUTH_KEY',  'C%A i+d?--XrSR?^Y?{o`d`qhFkCagR+c[I5o+|70P+&hEpq|L+LG3F{r*.+lzo-');
define('LOGGED_IN_KEY',    '%n$b1.*-p#I9abA{RUbSfX}i-xXv@kS6PU77;gr^@SZY#mce>nZ Ub=DbbZx5Un+');
define('NONCE_KEY',        '_]R-|e9Hul3ZG~oV`2#-am= OY,a7:, EP4TO%I-@3&;mH,0G%^R-|t9ITVH*>LD');
define('AUTH_SALT',        't0;dXAx(*tAcGQuO9H(-kzb,^Hr]MXoTF0Ksn_Rz|jh+2N,In+t B4X26j|/2~4-');
define('SECURE_AUTH_SALT', '/$|>NZzpZri&< Xw--A.+|oRHz,q]RIDMq|f$gpXpoaW4(.~TN#Pj}bs^u0#|`5O');
define('LOGGED_IN_SALT',   '[}bV+@BYc*?@EA_T?*R#6.xw$PQY[^4Saxy1@!ld-_~ebXyF-c_,R:m+Tb5UxL7d');
define('NONCE_SALT',       '?@S!;{A/D0[yVGmxP9_[8U6/jHbV^K7Vv>&!L}4p)>_*vS6Wi_qn~Jy.ox/Wy~ Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
