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
        $key = $web->sanitize($_POST['key']);
        $password = $web->sanitize($_POST['password']);
        $repeatpassword = $web->sanitize($_POST['repeatpassword']);
        $resetpassword = $auth->resetPass($key, $password, $repeatpassword);
        if ($resetpassword['error']) $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-error.tpl', 
                [
                    'CONTENT'                           => $resetpassword['message']
                ]);
        else $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-success.tpl', 
                [
                    'CONTENT'                           => $resetpassword['message']
                ]);
    } 
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/reset-password.tpl', 
                [
                  'TITLE'                               => $language['title_reset_password'],
                  'TEXT_REPEAT_PASSWORD'                => $language['text_repeat_password'],
                  'TEXT_KEY'                            => $language['text_key'],
                  'TEXT_PASSWORD'                       => $language['text_password'],
                  'TEXT_RESET_PASSWORD'                 => $language['text_reset_password'],
                  'TEXT_CHANGE_PASSWORD'                => $language['text_change_password'],
                  'TEXT_SIGN_IN'                        => $language['text_sign_in'],
                  'TEXT_FORGOT_PASSWORD'                => $language['text_forgot_password'],
                  'TEXT_REGISTER'                       => $language['text_register'],                  
                  'MESSAGE_VALIDATION'                  => $web->tpl(TEMPLATES_PATH . 'forms/msg-validation.tpl', []),
                  'TEXT_ERROR_KEY_MISSING'              => $language['text_error_key_missing'],
                  'TEXT_ERROR_PASSWORD_MISSING'         => $language['text_error_password_missing'],                  
                  'TEXT_ERROR_REPEATPASSWORD_MISSING'   => $language['text_error_repeatpassword_missing'],
                  'TEXT_ERROR_REPEATPASSWORD_NOTEQUAL'  => $language['text_error_repeatpassword_notequal'],
                  'TEXT_COPYRIGHT_FOOTER'               => $language['text_copyright_footer'],                  
                  'MESSAGE'                             => $message                    
                ]);
}
?>