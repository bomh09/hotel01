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
define( 'DB_NAME', 'hotel.com' );

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
define( 'AUTH_KEY',         '*z-a>xyf0HBB@G<D|`Fgmj:_1EBEL%(8;2=nS5e|{Les&CX},X#~T40JZ9<_mn]v' );
define( 'SECURE_AUTH_KEY',  'Oe-c^p8Y3gm|59rn<cvUjAW#V;,-=<%9Q`XS3jpzJs<@x^n$H0alKaCvJxeVw!ac' );
define( 'LOGGED_IN_KEY',    ',W.h]d7Vr!p0k}WgHmM@cZB$c}^2s8+_Fth=V`gm>cWATfSx>3:<.Hq#`t.;_v<W' );
define( 'NONCE_KEY',        'pS5eI8lLH1(B8<7~oqMReHdR!wGL`wItYF6Hw!mAI]Y-T5?e/r7pwUdEdtC6L.a/' );
define( 'AUTH_SALT',        'JF,KB7x;eGk=!Rg4/h]um|9MUnon&jWl:~(YwZjh{Oi2EZbKfr GU79[M0g)Y?/h' );
define( 'SECURE_AUTH_SALT', 'q=]EG}={.Gp *( Lz)f48lUhR5NAO?$;!cZ{;.MnQ-t4&jMnI(L.>WFXqR<Rey,t' );
define( 'LOGGED_IN_SALT',   '&Im>?e!1kInI2U`~.fuJVlxp;2((7!qBFT[;~oCz|k1VCVx[mcf_-z{%,a{31UT>' );
define( 'NONCE_SALT',       'H2cw|f%eb[ .wxF6A.T?d1P)4j00aq<d8`&Zlf1-|$|cN/}4!xBI|Rb^QS[ryu*<' );

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
