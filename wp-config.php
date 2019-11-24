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
define( 'DB_NAME', 'ohmshree' );

/** MySQL database username */
define( 'DB_USER', 'bhargav' );

/** MySQL database password */
define( 'DB_PASSWORD', 'bhargav' );

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
define( 'AUTH_KEY',         '.Jrbf$6+>N&,4P(YKv}@5V<l~H+EoUkai.LP03n_K3FE.?o%_[_1,%F>Wn}+-i4a' );
define( 'SECURE_AUTH_KEY',  'nAA]XPO*%(fJ*O:Lgy)t@]y[>^BvA2#o>u>[8tacnmr#*VhzHx.dB5Pw:zp$h62g' );
define( 'LOGGED_IN_KEY',    '+|Py&G_Xw)WfD?09|.:1x6!_porV^Y-e._nZNCE QsAF?QHl%u[DSx7p+`2]z;9 ' );
define( 'NONCE_KEY',        '< f(B9= {j`?A@sKih7mpx!OwJ>*wCPHe!tClY&fpn6Y~t6,0bl2l/4N>X6y4rd=' );
define( 'AUTH_SALT',        'o=]r}T_dbQb U3E.bo*]D=Y@l`p`5 s+JDw4VNZu<t9rZJxRo$q99`P6 06U${>=' );
define( 'SECURE_AUTH_SALT', 'j!u/EZt  Dhd>v.%nA(|r1LnkN:g?h$W%WeDMLi-!WZM?_BZ`iIAu[.Nt5jg$r-O' );
define( 'LOGGED_IN_SALT',   'F<K~E#4eF)v@e;GD{#0;3nm*BC}w^[1E+>v:MF-2RO6B=S;j/ C8HWso9=0*?beb' );
define( 'NONCE_SALT',       '6(_O/eqO*(S)8$<9qwiF[$j-Xd3] xLz2f;8x:bzEThP&ahA&>=mBad0L5TVARLb' );

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
