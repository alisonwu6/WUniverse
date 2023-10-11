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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}


define('AUTH_KEY',         '6Xm4D1YUsE3H/eFnn9UDpLhogLXUmpc9cI/DHxeJ5pNGdFje6o9zFGHPjlby8C+BNAJAlW6uNFgTSGZvxdHhdQ==');
define('SECURE_AUTH_KEY',  'gyOVMWc5S3Pnwvo74ujlwpHtq6paRxXNM8Ixat1aJN0J9eGwf97B2oRgrdiFeIoENa7ApmbTKln4x25sJM/MGw==');
define('LOGGED_IN_KEY',    'n0xRmnVrvTD8lzqHAPwQk2dyBvwm40zPepHY4IIh0D0Ypza4R1cS8tGN2UV9IotauJ0QkQ/TEdTIaXZ3QeBbTQ==');
define('NONCE_KEY',        'PTYzILnyKj1kxvXJOHIYpkHTsk8h9v0LIJkr225mf7cb9xcK9yJsefaUBdEX/rEIO0Vl1LLtHiHTfIESugi17Q==');
define('AUTH_SALT',        'Rw/VvFIbK8/6DvoP4Dm4UomKtqjrO1BKOYQ9RECtwbYdD1ql5vke58d+LwLDH8ExmTkj576YnQgxmMzOXUSRXg==');
define('SECURE_AUTH_SALT', 'qDuIAm9k8Ql0xg06JAAuA8G4Ng0b0ShYILi8E8jp9c3e3ovZ5kHoh+6nRHF/UX85pzVf1DjpEoWAslCj01m0sw==');
define('LOGGED_IN_SALT',   'sfmFCa4u/uUBZocwYYs9jxyNa2xuplLraiK8hZQXt12Gzy+6CWzTn2nC2eebGmiwm/EXCNaHG/rjIwcOWNk3DA==');
define('NONCE_SALT',       'D0bjQvUCNq23C6NFvXv2fr/LHEk5YHaxxy1PUAvBnzldk5+zLiI/qHEznWs47lI1cQgx/cql51RCSnf8se6bEg==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
