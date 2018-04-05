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
        $password = $web->sanitize($_POST['password']);
        $repeatpassword = $web->sanitize($_POST['repeatpassword']);
        $register = $auth->register($email, $password, $repeatpassword);
        if ($register['error']) $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-error.tpl', 
                [
                    'CONTENT'                           => $register['message']
                ]);
        else $message = $web->tpl(
                TEMPLATES_PATH . 'forms/msg-success.tpl', 
                [
                    'CONTENT'                           => $register['message']
                ]);
    }
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/register.tpl', 
                [
                  'TITLE'                               => $language['title_register'],
                  'TEXT_EMAIL_ADDRESS'                  => $language['text_email_address'],
                  'TEXT_PASSWORD'                       => $language['text_password'],
                  'TEXT_REPEAT_PASSWORD'                => $language['text_repeat_password'],
                  'TEXT_SIGN_IN'                        => $language['text_sign_in'],
                  'TEXT_FORGOT_PASSWORD'                => $language['text_forgot_password'],
                  'TEXT_REGISTER'                       => $language['text_register'],
                  'MESSAGE_VALIDATION'                  => $web->tpl(TEMPLATES_PATH . 'forms/msg-validation.tpl', []),
                  'TEXT_ERROR_EMAIL_MISSING'            => $language['text_error_email_missing'],
                  'TEXT_ERROR_PASSWORD_MISSING'         => $language['text_error_password_missing'],                  
                  'TEXT_ERROR_REPEATPASSWORD_MISSING'   => $language['text_error_repeatpassword_missing'],
                  'TEXT_ERROR_REPEATPASSWORD_NOTEQUAL'  => $language['text_error_repeatpassword_notequal'],
                  'TEXT_COPYRIGHT_FOOTER'               => $language['text_copyright_footer'],                  
                  'MESSAGE'                             => $message
                ]);
}
?>