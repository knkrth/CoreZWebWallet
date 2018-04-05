<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

include('init.php');

$lang = $web->toSlug($_GET['lang']);
$pageurl = $web->toSlug($_GET['pageurl']);

/** Check if language is set, else use default language. */
if ( !empty($lang) && array_key_exists($lang, $lang_allowed) ) 
{
  /** Set language */
  define('LANG', $lang);

  /** Check if language file exists, else use default language file. */
  if (file_exists(LANGUAGES_PATH . LANG . '.php')) include(LANGUAGES_PATH . LANG . '.php');
  else include(LANGUAGES_PATH . LANG_DEFAULT . '.php');

} else {

  /** No language defined. Redirect to default language. */
  $web->redirect(DOMAIN_URL . LANG_DEFAULT . '/');
}

$config = new PHPAuth\Config($db);
$auth   = new User\Auth($db, $config, RPC_PROTOCOL, RPC_USER, RPC_PASSWORD, RPC_HOST, RPC_PORT, $lang_convert[LANG], USE_GOOGLE_RECAPTCHA, GOOGLE_RECAPTCHA_SECRET, DOMAIN_URL . LANG );

/** Update the config table. */
$update = $web->sanitize($_GET['update']);
if ($update) updateConfig();

/** Page empty? Load index.html */
if (empty($pageurl)) $pageurl = 'index';

/** Check if page exists and load it. */
if (file_exists(INCLUDES_PATH . $pageurl . '.php') && !(strcmp($pageurl, 'error') == 0)) include(INCLUDES_PATH . $pageurl . '.php');
else include(INCLUDES_PATH . 'error.php');
if (empty($content)) include(INCLUDES_PATH . 'error.php');

$content = $web->tpl(
            TEMPLATES_PATH . 'frame.tpl', 
            [
              'TITLE' 		        => $language['website_title'],
              'CONTENT' 	        => $content,
              'SELECT_LANGUAGE'   => getLanguages(),
              'NAVIGATION'        => getNavigation(),
              'ASSETS_URL'        => ASSETS_URL,              
              'AJAX_URL'          => AJAX_URL,              
              'DOMAIN_URL'        => DOMAIN_URL,
              'LANG'		          => LANG
            ]);

echo $content;

?>