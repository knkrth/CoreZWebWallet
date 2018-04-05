<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

/**
 *		Change DEBUG to true to set debug mode.
 */
define('DEBUG', 						false);

/**
 * 1) 	Fill in your database information.
 */
define('DB_NAME', 						'');
define('DB_USER', 						'');
define('DB_PASSWORD', 					'');
define('DB_HOST', 						'');
define('DB_CHARSET', 					'utf8');

/**
 * 2) 	Add the RPC settings from your wallet server (.conf file).
 */
define('RPC_PROTOCOL', 					'http://');
define('RPC_USER',						'');
define('RPC_PASSWORD',					'');
define('RPC_HOST',						'');
define('RPC_PORT',						'');

/**
 * 3) 	Edit the following lines to match your requirements.
 */
define('COIN_TICKER',					'CRZ');
define('SITE_NAME',						'CoreZ Web Wallet');
define('SITE_URL',						'http://YOURDOMAIN');
define('SITE_EMAIL',					'info@YOURDOMAIN');
define('SITE_KEY',						'7SHJK239AJKSDA!@SBhRLJWHA24!VJLNS988AHA');
define('EXPLORER_ADDRESS_URL',			'http://explorer.corez.site:3001/address/');
define('EXPLORER_TXID_URL',				'http://explorer.corez.site:3001/tx/');
define('SITE_TIMEZONE',					'Europe/Berlin');
define('SITE_ACTIVATION_PAGE',			'activate.html');
define('SITE_PASSWORD_RESET_PAGE',		'reset-password.html');
define('SMTP',							0); // 0 = sendmail, 1 = smtp
define('SMTP_DEBUG',					DEBUG);
define('SMTP_HOST',						'smtp.example.com');
define('SMTP_AUTH',						1); // 0 = doesn't require auth., 1 = requires auth.
define('SMTP_USERNAME',					'email@email.com');
define('SMTP_PASSWORD',					'yourPassword');
define('SMTP_PORT',						'25');
define('SMTP_SECURITY',					'');
define('VERIFY_PASSWORD_MIN_LENGTH',	3);
define('VERIFY_EMAIL_MIN_LENGTH',		5);
define('VERIFY_EMAIL_MAX_LENGTH',		100);
define('VERIFY_EMAIL_USE_BANLIST',		1);
define('ATTACK_MITIGATION_TIME',		'+30 minutes');
define('ATTEMPTS_BEFORE_VERIFY',		5);
define('ATTEMPT_BEFORE_BAN', 			30);
define('PASSWORD_MIN_SCORE',			0);
define('COOKIE_NAME',					'authID');
define('COOKIE_PATH',					'/');
define('COOKIE_DOMAIN',					'');
define('COOKIE_SECURE',					0); 
define('COOKIE_HTTP',					0);
define('COOKIE_REMEMBER',				'+1 month');
define('COOKIE_FORGET',					'+1 hour');
define('USE_SSL', 						false);

/** 
 * Google Recaptcha is NOT implemented yet!
 * Do NOT change the USE_GOOGLE_RECAPTCHA to true!
 */
define('USE_GOOGLE_RECAPTCHA',		false);
define('GOOGLE_RECAPTCHA_SECRET',	'');

/**
 * 4) 	Visit http://YOURDOMAIN/en/index.html?update=true
 * 		to update the current information in your DB to
 *		match the changes you made in step 3).
 *		Now you are ready to go!
 *
 */

/** Define the config table */
define('DB_TB_CONFIG',	 				'config');

/** Set default language */
define('LANG_DEFAULT', 					'en');

/** Allowed / Installed languages */
$lang_allowed = [						'en' => 'English',
										'de' => 'Deutsch'
				];

/** Convert languages for phpauth */
$lang_convert = [						'en' => 'en_GB',
										'de' => 'de_DE',
										'ar' => 'ar_TN',
										'cs' => 'cs_CZ',
										'da' => 'da_DK',
										'es' => 'es_MX',
										'fa' => 'fa_IR',
										'fr' => 'fr_FR',
										'gr' => 'gr_GR',
										'hu' => 'hu_HU',
										'id' => 'id_ID',
										'it' => 'it_IT',
										'be' => 'nl_BE',
										'nl' => 'nl_NL',
										'pl' => 'pl_PL',
										'ps' => 'ps_AF',
										'pt' => 'pt_BR',
										'ro' => 'ro_RO',
										'ru' => 'ru_RU',
										'se' => 'se_SE',
										'sr' => 'sr_RS',
										'th' => 'th_TH',
										'tr' => 'tr_TR',
										'uk' => 'uk_UA',
										'vi' => 'vi_VN'
				];
?>