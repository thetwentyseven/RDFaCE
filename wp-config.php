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
define('DB_NAME', 'rdface');

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
define('AUTH_KEY',         '5)@%./QOTP5J;wu,OE`Ki~Dw(#3In/3@!|M:dr6Lk@V zV0*FyJ+|Ju?(y=3Ov]t');
define('SECURE_AUTH_KEY',  'RUcOkE!FCEf/1GIj+c/r-W~@sJXp@Bga=?]*h/fMSgYYW,u6siG2G6MK#yoso$K&');
define('LOGGED_IN_KEY',    'M# 7OPJ;1L%jW1_tXT3;Cwp;kL<!E!Jg_|`v`bz*-k?AcE*&3+^TZ_11s0oIKULk');
define('NONCE_KEY',        '%$Cp#^D_5amk@%GkW|C2p}X{@JT`s_zxoCI9+5[-?8fNj%~HKjD3bSKdD`9|]{*;');
define('AUTH_SALT',        '4-SDWH*M[NyMW#z>j;yZna<WTd D=+edE4G/Q+Peer0B,?0$(3f{`fnr0A%<WH9s');
define('SECURE_AUTH_SALT', 'PbGLgT!p0;y_;]JPg|DE-HFRTW~{_|VVJlBe6PTD2-J3hsvFw3z ;gwBmoUtbm,a');
define('LOGGED_IN_SALT',   'Prm?J{/g|6ot(7CC >*L~i}PMI*v`xKJE!#J/kC;NB>78:=~a;@f`wV8.3GVOrK:');
define('NONCE_SALT',       'FA `ND2lW:U?C5.E<&Y!#Re/J@=Yj+h&~ z=R6{4cK%IggGewwJ%=/8rTz~4}M`?');

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
