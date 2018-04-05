<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

/** Make sure script is called correctly. */
if ($validate)
{
    if ($auth->isLogged())
    {
        $uid = $auth->getSessionUID($auth->getSessionHash());
        $wallet_addresses_list = getDashboardAddresses($uid);
        $result = $auth->getWalletAddressBalance();
        if ($result['error']['code'] == 0) $balance = number_format(floatval($result['success']), 8, '.', '');
        else $balance = $language['text_error_wallet'][$result['error']['code']];
        $send = '';
        if (floatval($balance) > 0) 
        {
          $send = $web->tpl(
                    TEMPLATES_PATH . 'wallet/send.tpl', 
                    [
                      'TEXT_SEND'                   => $language['text_send'],
                      'TEXT_AMOUNT'                 => $language['text_amount'],
                      'TEXT_ADDRESS'                => $language['text_address']
                    ]);
        }
        $pagecontent = $web->tpl(
                    TEMPLATES_PATH . 'pages/dashboard.tpl', 
                    [
                      'TITLE'                       => $language['title_dashboard'],
                      'TEXT_CREATE_NEW_ADDRESS'     => $language['text_create_new_address'], 
                      'TEXT_ADDRESS'                => $language['text_address'], 
                      'TEXT_BALANCE'                => $language['text_balance'],
                      'TICKER'                      => COIN_TICKER,
                      'BALANCE'                     => $balance,
                      'ADDRESSES'                   => $wallet_addresses_list,
                      'SEND'                        => $send,
                      'UID'                         => $uid
                    ]);
        $content = $web->tpl(
                    TEMPLATES_PATH . 'layout/fullwidth.tpl', 
                    [
                      'CONTENT'                     => $pagecontent,
                      'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer'],                      
                    ]);        
    } else {
        $s = $web->sanitize($_POST['s']);
        $message = '';
        if (strcmp($s,'submit') == 0)
        {
            $email = $web->sanitize($_POST['email']);
            $password = $web->sanitize($_POST['password']);
            $rememberme = intval($_POST['rememberme']);
            $login = $auth->login($email, $password, $rememberme);
            if ($login['error']) $message = $web->tpl(
                    TEMPLATES_PATH . 'forms/msg-error.tpl', 
                    [
                        'CONTENT'                   => $login['message']
                    ]);
            else {
                setcookie($config->cookie_name, $login['hash'], $login['expire'], $config->cookie_path, $config->cookie_domain, $config->cookie_secure, $config->cookie_http);
                $web->redirect(DOMAIN_URL . LANG . '/');
            }
        } 
        $content = $web->tpl(
                    TEMPLATES_PATH . 'layout/login.tpl', 
                    [
                      'TITLE'                       => $language['title_login'],
                      'TEXT_PLEASE_SIGN_IN'         => $language['text_please_sign_in'],
                      'TEXT_EMAIL_ADDRESS'          => $language['text_email_address'],
                      'TEXT_PASSWORD'               => $language['text_password'],
                      'TEXT_REMEMBER_ME'            => $language['text_remember_me'],
                      'TEXT_SIGN_IN'                => $language['text_sign_in'],
                      'TEXT_FORGOT_PASSWORD'        => $language['text_forgot_password'],
                      'TEXT_REGISTER'               => $language['text_register'],
                      'MESSAGE_VALIDATION'          => $web->tpl(TEMPLATES_PATH . 'forms/msg-validation.tpl', []),
                      'TEXT_ERROR_EMAIL_MISSING'    => $language['text_error_email_missing'],
                      'TEXT_ERROR_PASSWORD_MISSING' => $language['text_error_password_missing'],
                      'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer'],
                      'MESSAGE'                     => $message
                    ]);        
    }
}
?>