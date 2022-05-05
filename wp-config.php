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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pekokis' );

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
define( 'AUTH_KEY',         '!n:mld @^8M)XwCo%ar6A,J;G)IR>72TbQrTQ3%4TW~ugv<mA?uK`/^Htb|P/2O;' );
define( 'SECURE_AUTH_KEY',  'E.A*!*|]t4nmNvutz C h~XOW~<P9%%n3t8[M0kbk~W6?^+p^0 %+<:`jN,qMg6S' );
define( 'LOGGED_IN_KEY',    'L#D0)RM9J 0P(`A|5}2RegErL7ll?=K@2v$Km=Z17+$1?k,J;EjJQF.Iy/[@xm9I' );
define( 'NONCE_KEY',        'N#@vD8cz$?{k-5kdu<@$7Tq.B/jDV|dQ71@l+krq@i=qY:K~X:B6P^_C)1|~Aq_0' );
define( 'AUTH_SALT',        'QTq(h34)xk[oZ2Gh* |)sS<$4A)*.^3YLc`#VlNC1)*^&bckCYaWrg1%[=I:#T;a' );
define( 'SECURE_AUTH_SALT', 'c[~MMl:`fy4Bv&od@R%!4eYRF9)*>GB[,frlQ6!<iv,jY/7:i(-+4,#!L?oyh];$' );
define( 'LOGGED_IN_SALT',   'j~5M[~CT1h|*U~Bzu(H!p]$==XXwExseUZZfwV@2&7zyQ:H;.2ebTG+]*usC{33l' );
define( 'NONCE_SALT',       '?n*+Rwz^_Z+7W!LO0c[qA_p@9+6>x~%Bd#d43Y<]<79YiZM&3$qF7._]$^g}I?#:' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pe_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
