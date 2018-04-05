<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

define('ABS_PATH', 					dirname(__FILE__) . '/');
define('ASSETS_PATH', 				ABS_PATH . 'assets/');
define('AJAX_PATH', 				ABS_PATH . 'ajax/');
define('CLASSES_PATH', 				ABS_PATH . 'classes/');
define('FUNCTIONS_PATH', 			ABS_PATH . 'functions/');
define('INCLUDES_PATH', 			ABS_PATH . 'includes/');
define('LANGUAGES_PATH', 			ABS_PATH . 'languages/');
define('TEMPLATES_PATH', 			ASSETS_PATH . 'tpl/');
define('THIRDPARTY_PATH', 			ABS_PATH . 'vendor/');

include('config.php');

if (USE_SSL) define('DOMAIN_URL',	'https://' . $_SERVER['SERVER_NAME'] . '/');
else define('DOMAIN_URL', 			'http://' . $_SERVER['SERVER_NAME'] . '/');
define('ASSETS_URL', 				DOMAIN_URL . 'assets/');
define('AJAX_URL', 					DOMAIN_URL . 'ajax/');

try 
{
	$db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD); 
	$db->exec('set names ' . DB_CHARSET);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
	echo 'Database connection failed: ' . $e->getMessage();
	exit();
}

if (DEBUG) error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
else error_reporting(E_ERROR);

if (file_exists(THIRDPARTY_PATH . 'autoload.php'))
{
	include(THIRDPARTY_PATH . 'autoload.php');
}

include(CLASSES_PATH . 'jsonRPCClient.php');

include(CLASSES_PATH . 'Wallet.php');

include(CLASSES_PATH . 'Web.php');

include(CLASSES_PATH . 'User.php');

include(FUNCTIONS_PATH . 'functions.php');

$web = new Web\Web();

$validate = true;

?>