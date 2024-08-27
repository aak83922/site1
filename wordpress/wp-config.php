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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'Akkumar' );

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
define( 'AUTH_KEY',         'G`gU#bXNs?%AUzVbZP]f&B:6.(q9roO0)$2M Nu)3]h<*S}((G8w<[~Z[7,,;]Jq' );
define( 'SECURE_AUTH_KEY',  '$p]5sIsA2Cay)mWfO6_b#6pk1/ne[hz)EIOxxJ-D`dwMO6;/4;CX`2A3gViv6fcb' );
define( 'LOGGED_IN_KEY',    '*hZ2AmmCArA7B 69XL%M?oBv|:}Ej3^[yC=uEL5`!BgQH#np/&lPK`<|/ix;Syw@' );
define( 'NONCE_KEY',        'mf.JskrTHrfM),sHBI@ro@nq$,O*PiZHPIea8Qrt|hW(n+LuGeT*+Fk5*yIl3qNr' );
define( 'AUTH_SALT',        'cD:}|S~tj[&VBR/y&}yofq_Jj,*]^jlJC7r,TA5B<4T]%$?QC*gc$^k;eH^HZ[3a' );
define( 'SECURE_AUTH_SALT', 'Vt7Wf[M#}Ao1{Gt Cl4;i_RW[<&mKca7;F7DnO@(,]q}sk^ucOTx`;Dx.`mK>!H(' );
define( 'LOGGED_IN_SALT',   'Ol]~d~ILA-8E-~Po!U~^gL)Wy:8]B1r75lzH(0@y0?WrW>oz+X iBsQ;:H+XA)|?' );
define( 'NONCE_SALT',       ';Npw^m0D]>!Z#~Z{iyi~oUM,PUz9AzhnPKtYd@#}QOPWA=z]Q{Xgei;7Hz_E(0C?' );

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
