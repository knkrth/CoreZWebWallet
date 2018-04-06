<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

include('../init.php');
$lang = $web->toSlug($_GET['lang']);

/** Check if language is set, else use default language. */
if ( !empty($lang) && array_key_exists($lang, $lang_allowed) ) 
{
  /** Set language */
  define('LANG', $lang);

  /** Check if language file exists, else use default language file. */
  if (file_exists(LANGUAGES_PATH . LANG . '.php')) include(LANGUAGES_PATH . LANG . '.php');
  else include(LANGUAGES_PATH . LANG_DEFAULT . '.php');

} else {

  /** Set language */
  define('LANG', LANG_DEFAULT);
  include(LANGUAGES_PATH . LANG_DEFAULT . '.php');
}

$config = new PHPAuth\Config($db);
$auth   = new User\Auth($db, $config, RPC_PROTOCOL, RPC_USER, RPC_PASSWORD, RPC_HOST, RPC_PORT, $lang_convert[LANG], USE_GOOGLE_RECAPTCHA, GOOGLE_RECAPTCHA_SECRET, DOMAIN_URL . LANG );

if ($auth->isLogged())
{
    $uid = $auth->getSessionUID($auth->getSessionHash());
    $wallet_addresses_list = getDashboardAddresses($uid);
    echo $wallet_addresses_list;
} else $web->redirect(DOMAIN_URL . LANG_DEFAULT . '/');
?>