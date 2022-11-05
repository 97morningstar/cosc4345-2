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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'COSC4354' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'cosc4354' );

/** Database hostname */
define( 'DB_HOST', 'cosc4354.ctbow56krkjr.us-east-1.rds.amazonaws.com' );

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
define( 'AUTH_KEY',         '!6sY8Fvqb(tZrx@Qe0|&ZaF0{k9;1$28-|@;g 5TAs%Y3{sW}sowBM]:XiQePb5J' );
define( 'SECURE_AUTH_KEY',  '<~fG?^=!T`zZ+<iDLXp/nG/*O5]^+iv2a+M%cYQZO)~eW:FPB6-NX-,+&z?zIY_+' );
define( 'LOGGED_IN_KEY',    '/p?Ryg3kp#-,tU*]b{^+7E7Uj5]4Q]G.&uctK:b)R-l?L}.:K=WwAa=8NTLp)vhz' );
define( 'NONCE_KEY',        'my<VFk;F0UI*Ryq]u^o1aDT AwZS+{Ms[?O-SWflY|`$02Do~{GYa|MV#h1o&U0+' );
define( 'AUTH_SALT',        '~%MaqB-j++>[_zn0!p;jG#?jSd/ HK>9|uqVCJy4 ].Z=]@Z5{8H2Gki<JHW0^Zf' );
define( 'SECURE_AUTH_SALT', 'F8K~D%{W>,(W<K3^]O?d[t<sD(czw=Zu7CS[{N]{#P1rtr/:|Z%3nN@df*=&]]9!' );
define( 'LOGGED_IN_SALT',   'UnXf3jEI)9P>$_ulh$i_kkmG9r:By|gI{kO#IIM5QN6&@W?}B=qCB.NSmNz%}S|R' );
define( 'NONCE_SALT',       'qXu)Y(S+W6`$c#{;B9pQ,38!pp/kw.K%&,cSHL 2UpmBH0RkdnB3`8F}CCDD_*bS' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
