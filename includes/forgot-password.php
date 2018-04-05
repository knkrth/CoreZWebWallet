<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

/** Make sure script is called correctly. */
if ($validate && !$auth->isLogged())
{
    $s = $web->sanitize($_POST['s']);
    $message = '';
    if (strcmp($s,'submit') == 0)
    {
        $email = $web->sanitize($_POST['email']);
        $forgotpassword = $auth->requestReset($email);
        if ($forgotpassword['error']) $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-error.tpl', 
                [
                    'CONTENT'                   => $forgotpassword['message']
                ]);
        else $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-success.tpl', 
                [
                    'CONTENT'                   => $forgotpassword['message']
                ]);
    } 
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/forgot-password.tpl', 
                [
                  'TITLE'                       => $language['title_forgot_password'],
                  'TEXT_EMAIL_ADDRESS'          => $language['text_email_address'],
                  'TEXT_SIGN_IN'                => $language['text_sign_in'],
                  'TEXT_RESET_PASSWORD'         => $language['text_reset_password'],
                  'TEXT_REGISTER'               => $language['text_register'],
                  'MESSAGE_VALIDATION'          => $web->tpl(TEMPLATES_PATH . 'forms/msg-validation.tpl', []),
                  'TEXT_ERROR_EMAIL_MISSING'    => $language['text_error_email_missing'],
                  'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer'],                  
                  'MESSAGE'                     => $message                    
                ]);
}
?>