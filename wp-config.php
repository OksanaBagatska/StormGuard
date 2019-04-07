
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
define( 'DB_NAME', 'stormGuard' );

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
define( 'AUTH_KEY',         '&D]Ui}G7Uy-/wx1;4?&A&HlG[_Ib3_ICtqZ*fr<IxYAeD<Y(%(BLesRYDzV{Ye&S' );
define( 'SECURE_AUTH_KEY',  'T=~Gd [!#^<];^]i)]&>E)QCwM)O`G22GrYf/l=wOCh;p!]Y;01zJ|B6)Pg_qWfg' );
define( 'LOGGED_IN_KEY',    'KTgzJgC.24$mf-o[w@@4IyE5p@S,<Y-C$T}+9qd^harY|=udw)%!+}.^0y4<wO~a' );
define( 'NONCE_KEY',        'MZ7{5[~J>di-MCy xo/;P9$*Mdpn2)_U#9+(^u|vlHzTX%:x9F iwx= 5O]ZS6_.' );
define( 'AUTH_SALT',        'A>@0{)r$nS/_6DcV58fd[f=2SpZzYwmKKVZg?(3SuJZ]@E4#VeEwkvP!Sv5pUC3{' );
define( 'SECURE_AUTH_SALT', 'l.w:=#Z2E;^i|cRAW<%/:ouj=l#J>Jo=VJ{**J)Q_.f-qShS*22g04}JI#_l<Zxk' );
define( 'LOGGED_IN_SALT',   'h_Ric(YDjf`N#H%ehN$`ars:d&&%R*!El:>E1V;%vNNHcQ:AoP8=knaSUH0u~+7b' );
define( 'NONCE_SALT',       'r-%QfTK+x$14/(g^>?[MP=q;Zc$jd,>#RD5N>lfl25O!#O)J)GwtEbDbe8X&hvxu' );

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
@ini_set( 'upload_max_filesize' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );