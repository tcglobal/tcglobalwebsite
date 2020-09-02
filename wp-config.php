<?php
# Database Configuration
define( 'DB_NAME', 'wp_tcglobalnew' );
define( 'DB_USER', 'tcglobalnew' );
define( 'DB_PASSWORD', 'aemZi0SE577JbZo1SVbn' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'tc19_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '=M(t7O$MWWJ6?i)HR;Uj+Zo2}4VTYGFP.n`?D31On<ePF,)2<K/:w 7YI~Y{DlZ)');
define('SECURE_AUTH_KEY',  'ly~?YEOvIu^Fm>jmxT/M%u}bAqh&(eB:uG8Y(1Ui*Hq}A-FUy1L1R7ge$|a%3SFe');
define('LOGGED_IN_KEY',    '9WIe[V 9yW:I(&_P0f|L:/!u^Qp,8BTz`p[=,@=m+DP8[)g7N}Z/j`x0*F8?8(<v');
define('NONCE_KEY',        'o4h$*7%S)e*lThg6fVC+_o(y_7ep3%p8Iw{h<j!:c]w?.hO` a6};&/8!S=>M`t>');
define('AUTH_SALT',        '1uLXdg^o28EEKECK*1,O{2,0Ph}*/+xy6WI{[i1+IxRd 30*So@J[OGLc7}6}~b-');
define('SECURE_AUTH_SALT', '6vV IPg2b4cx-n9/Rt%gDxBzQw]SoZ;zze}Wl=@@tf}i9~w;N?eWbJp8r,6S0W#?');
define('LOGGED_IN_SALT',   '!GD,7P:b h6l  dEhN%pPht_l.;f15PDQSa3vv9P{IUZqBgY.XJvigt pjN|5(qo');
define('NONCE_SALT',       'f_?3B^L?Sr4J.Ey4B9;Ot[r6AX*.7$DBTr!A<@hJQ!W([h}2-NaeT&)L2;?OyleL');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'tcglobalnew' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '268d992b5cf43f9b2b5f79cd9c32fab78de4e8fd' );

define( 'WPE_CLUSTER_ID', '140254' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', true );

define( 'FORCE_SSL_LOGIN', true );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'tcglobalnew.wpengine.com', 1 => 'www.tcglobal.com', 2 => 'tcglobal.com', );

$wpe_varnish_servers=array ( 0 => 'pod-140254', );

$wpe_special_ips=array ( 0 => '35.197.185.6', );

$wpe_netdna_domains=array ( 0 =>  array ( 'zone' => '2q1b1u46tfi11tpkbihxiabm', 'match' => 'www.tcglobal.com', 'secure' => true, 'enabled' => true, 'dns_check' => '0', ), 1 =>  array ( 'zone' => '3vodpj3kxxn1k9abn3p8y03o', 'match' => 'tcglobalnew.wpengine.com', 'secure' => false, 'enabled' => true, 'dns_check' => '0', ), 2 =>  array ( 'zone' => '3lv22p17ivv97aoz6425hk31', 'match' => 'tcglobal.com', 'secure' => true, 'enabled' => true, 'dns_check' => '0', ), );

$wpe_netdna_domains_secure=array ( 0 =>  array ( 'zone' => '2q1b1u46tfi11tpkbihxiabm', 'match' => 'www.tcglobal.com', 'secure' => true, 'enabled' => true, 'dns_check' => '0', ), 2 =>  array ( 'zone' => '3lv22p17ivv97aoz6425hk31', 'match' => 'tcglobal.com', 'secure' => true, 'enabled' => true, 'dns_check' => '0', ), );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG', '');

# WP Engine ID


# WP Engine Settings










# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');




