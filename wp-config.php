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
define( 'DB_NAME', 'gruzde_dk' );

/** MySQL database username */
define( 'DB_USER', 'gruzde_dk' );

/** MySQL database password */
define( 'DB_PASSWORD', 'AGG5HrnVnHmSnuenNJRnikwy' );

/** MySQL hostname */
define( 'DB_HOST', 'gruzde.dk.mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '%,-eG$0,zOA8NF}JbzbX=y>PhNgcpa8EDKgd2_}6-{Wgz*Kyj4y<||_nf]{($?l=');
define('SECURE_AUTH_KEY',  '`|>smb^_^{M<D&:A3yI@F+wLi7c_;3!/mPzFLr}Nbk?|{EH7T62iA-j)5^]R*bbo');
define('LOGGED_IN_KEY',    'g]l&ud>cHE>.B(q^J6aWDO8l*;.OY*IHtRjo}{-0/5`%K#,m4|b Wtnq`T^GuubQ');
define('NONCE_KEY',        '(fK&+,B@uodcYJ[+;ON6w7w@$Hk|)e:*-_zDme1E9M^C8P=S-e8Y`}3f8--tatpr');
define('AUTH_SALT',        'qa{}ZCN1.^[X=tCkN<xb**n(R,5^Ql$-Rjf[7J^p4~4-$_.~ZF|t7M[Icrn+`n1~');
define('SECURE_AUTH_SALT', 'Ec$%RN+-$TM?0ue_=,#s<j}E908~$R?84fUCK/.G8v(2z|+/6o=J<ER5+|;`[Kor');
define('LOGGED_IN_SALT',   'BAHWY){%;P{)ly|$dA-]~i2N-e<l {[&:JDS[#r+A.x&R.s#.!e=QpZR/8:VZb{d');
define('NONCE_SALT',       'S98j7ed;36ow1H-Rv/gS|}{+w/]O7`4;ai$F29FS$^euY[XA2Uz`nt-gW|-kurZn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'portfoliowp_';

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
