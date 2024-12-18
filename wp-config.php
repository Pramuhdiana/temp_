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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sanivokasi_wp' );

/** MySQL database username */
define( 'DB_USER', 'sanivoka_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', '4HRHjCvyZXr2' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'qAv>(3%/!CU+MRNSN8kK4H[m[s{[GqM/]6[ (ZAB/.47N)]IV7Xb*k!>9:5Wy?I*' );
define( 'SECURE_AUTH_KEY',   '06723]Aw?kRd~1i&n.DakJC[w|JIx6y=^l#<^fk/A|78 LnG_BFJoLx+H3ME]02f' );
define( 'LOGGED_IN_KEY',     '*RqUx$@/>`Gp,Rr1bXfKO{G EzF/T9diJ<br]ZwiT UC>aR,<[9b@yC>1GAp +qA' );
define( 'NONCE_KEY',         'Pztu)^*+n&jpbYyPo6E3Lpt&gTJt3=|9K]ZET&DXzKK1_-H#97?[qwsUhy&g[9r>' );
define( 'AUTH_SALT',         'zGSy(ND<1}4?APT0^;#!Z~A)Gi|=u8n(:?(#b5AeAw6b@&l%0O?_/`Z4AIDn+Q<:' );
define( 'SECURE_AUTH_SALT',  '1|iT[^Fx~p<xzmzATd-DBA`>h4<H{Sx0e`69]yO#fTL)NjP9;jPim*A/2v[b0^pF' );
define( 'LOGGED_IN_SALT',    'O1b|Ype;}_WXt(q.Ry{ZWcE,scUp+oAhSDyr{Y|^U|p*<na1,])G!h~jQQo2Hfaq' );
define( 'NONCE_SALT',        'zE#RM%qM&&w6C4*JbJAaPffZUBLU`qE7#SpSJ~*G007J(<={2Pm~T}|sdtmQ/e#e' );
define( 'WP_CACHE_KEY_SALT', ';-`GLf`{*&}mcSDKyx4+dupccqmQ5krdNq_CIqjop&j;Us$cJ^iqkQ:-q%BP=W6X' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'csv_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
