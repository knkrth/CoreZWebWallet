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
    $amount = floatval($_GET['amount']);
    $toAddress = trim($web->sanitize($_GET['address']));
    if ($amount > 0)
    {
      if (!empty($toAddress))
      {
        $result = $auth->sendWalletAmount($toAddress, $amount);
        if ($result['error']['code'] == 0) echo $web->tpl(
                    TEMPLATES_PATH . 'forms/toastr-success.tpl', 
                    [
                      'CONTENT'                     => $language['text_amount_sent']
                    ]);
        else echo $web->tpl(
                    TEMPLATES_PATH . 'forms/toastr-error.tpl', 
                    [
                      'CONTENT'                     => $language['text_error_wallet'][$result['error']['code']]
                    ]);
      } else echo $web->tpl(
                    TEMPLATES_PATH . 'forms/toastr-error.tpl', 
                    [
                      'CONTENT'                     => $language['text_error_receiver_missing']
                    ]);
    } else echo $web->tpl(
                    TEMPLATES_PATH . 'forms/toastr-error.tpl', 
                    [
                      'CONTENT'                     => $language['text_error_amount_too_low']
                    ]);
} else redirect(DOMAIN_URL . LANG_DEFAULT . '/');                  
?>