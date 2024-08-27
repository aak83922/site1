<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WORDPRESS' );

/** Database username */
define( 'DB_USER', 'Akkumar1' );

/** Database password */
define( 'DB_PASSWORD', 'Akkumar@234678' );

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
define( 'AUTH_KEY',         '9zj!<)!G_=*xC,AxI56Sv*V3]=keITw:V-k}^vA&U]b)MDA `+:J)ZAet)G&buj5' );
define( 'SECURE_AUTH_KEY',  '8MxyTc)oDyvYrv}Pt9om*<&4m?g4{WFa@3Cyxuxk! (=LnO z<|8gF<5QnqN(Hr(' );
define( 'LOGGED_IN_KEY',    'I]$O{qpwn.t2CPX2y/wOs-`LU+bgxPVDIK1wq3y@iuOZgv<AvpK>,eo$=krbS=aU' );
define( 'NONCE_KEY',        '&6rMf*_b!Odq}@3#C(tc(/6(>/F;Y|Fbaz-rm;DsR;& APL1:JrqSxXmfh5!MUl^' );
define( 'AUTH_SALT',        'E:[zIUEE^hx%Q;zR7os`karv]J]}:?wBQJ*]T3zIn^`wv{G%a!bwNvYyN~w_a#4|' );
define( 'SECURE_AUTH_SALT', 'AH+ )`JD=,}$nJq@#8&a?9g#16>N:P1.:<,Bv ?b:o.y[OHNCrKfyy7uoZAD-r+1' );
define( 'LOGGED_IN_SALT',   'Io=`i)E5D54o]aQI3D/9Oj03Sw74XMfhKjri`)ovqy|YUU=&p.EolvTfd A<zGPi' );
define( 'NONCE_SALT',       ':+`@7vJfwTbt5NtI%Oew3&gHhRO?; x#k(VJG5niGy{J4J_c<|;xqpePMEs>`9vS' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
