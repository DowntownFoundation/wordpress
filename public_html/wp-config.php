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
define('DB_NAME', 'downtown_wp604');

/** MySQL database username */
define('DB_USER', 'downtown_wp604');

/** MySQL database password */
define('DB_PASSWORD', 'SPS4)c8)86');

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
define('AUTH_KEY',         '7qv7l8aiu1dllgrs5e8e2vmjx7acyzdtmhwquhqghek8bsezcokdtzwxy1scbtso');
define('SECURE_AUTH_KEY',  'lgxlodfmhvcz9fjwoz5dux8gqvy1ckfprz57kngn0iv8eqykklcrg1xfrwzvtkuu');
define('LOGGED_IN_KEY',    '5xfzxkfgjedycvl0ny9svnveatdqcvnds7xz5aerlppfiij2t9cvl6axtlmwjy9y');
define('NONCE_KEY',        'tclhvfjl0enfk2manp5jxtbjosvujn2lhhnedfjpo4or9iuzbwwbhop3jcg0orko');
define('AUTH_SALT',        'efqsjeiqrcmxpwsy4ofrutdj57w04i5ahdkqilk6ohxgkewqhszjb9zdiiuj3tkm');
define('SECURE_AUTH_SALT', 'qmyswjohjcsugcffgicmq8kkjqkwuzdukx3xgu5vkeirhhb96ijzdh4ot7snn3yt');
define('LOGGED_IN_SALT',   'fimeqwkjvl53nfpvurjtslbksszc0hneswr7vfklqushdfabeeatkjxaydkwlhha');
define('NONCE_SALT',       'lnu2z5gf64tuw5kc7ek17c5it4xetupf5urxuqx5nnkg1nn3u9ihq5r0knpnbuid');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp2h_';

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
