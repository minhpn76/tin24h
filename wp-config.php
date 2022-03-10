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
define( 'DB_NAME', 'tin24h' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'x56]zy!VJ_onJVq2_Tf!hF6>9N3L+RHn I+ X7fS1-T,KUE$5$~R=OOE7V O8oR)' );
define( 'SECURE_AUTH_KEY',  '4n1CqX_(8WTm(]+=ts&r3Q/ZM1|9M?A!EZu)]Z^<u o[;/[mg)~u$!:!9EMF_kd7' );
define( 'LOGGED_IN_KEY',    'Ufx0[9?4l5fv8bcUyJ TU2 !vV1 LZxru$}`:a@=BBX.7u6!}=QoTUp3x1uY@dlA' );
define( 'NONCE_KEY',        'W`p7gz(Qv&iRe^HHf+tDZ+=;.L,/+0]&zLwH= Fhu;_Vo2)=syTM5[:S]a|p)X: ' );
define( 'AUTH_SALT',        '^%J~%xu>k/fwbhT[k<29J)4oUJ8uEYWAgArj=HVWLOU*eDb#k{(1CIa/`]pr|o l' );
define( 'SECURE_AUTH_SALT', 'p]~8N2hXI+swY7Hyqxr5As,>P<o=a]gNiu;B_6&UoQ+{iBgB-QyoNO!UG0*87E!l' );
define( 'LOGGED_IN_SALT',   'm3ST,~Q&eP:=_|WXu[?k$3Li_ALU;77QV%R)Qb0S;qqPVa>N4^R5$a3h;PbCWqxq' );
define( 'NONCE_SALT',       '/Mh,2i#6|.rcQCW0C,?[*]e9ZSR]OH&l0Inh*:pN7|}$2n~~.R0u7%p*XiVU;P=U' );

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
