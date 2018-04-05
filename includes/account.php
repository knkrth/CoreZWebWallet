<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

/** Make sure script is called correctly. */
if ($validate && $auth->isLogged())
{
    $s = $web->sanitize($_POST['s']);
    $message = '';
    if (strcmp($s,'submit') == 0)
    {
        $uid = $auth->getSessionUID($auth->getSessionHash());
        $currentpassword = $web->sanitize($_POST['currentpassword']);
        $password = $web->sanitize($_POST['password']);
        $repeatpassword = $web->sanitize($_POST['repeatpassword']);
        if (!empty($password))
        {
            $changePassword = $auth->changePassword($uid, $currentpassword, $password, $repeatpassword);
            if ($changePassword['error']) $message = $web->tpl(
                    TEMPLATES_PATH . 'forms/msg-error.tpl',
                    [
                        'CONTENT'                       => $changePassword['message']
                    ]);
            else $message = $web->tpl(
                    TEMPLATES_PATH . 'forms/msg-success.tpl',
                    [
                        'CONTENT'                       => $changePassword['message']
                    ]);
        }
    } 

    $pagecontent = $web->tpl(
                TEMPLATES_PATH . 'pages/account.tpl', 
                [
                  'TITLE'                               => $language['title_account'],
                  'UID'                                 => $uid,
                  'TEXT_EMAIL_ADDRESS'                  => $language['text_email_address'],
                  'TEXT_CURRENT_PASSWORD'               => $language['text_current_password'],
                  'TEXT_NEW_PASSWORD'                   => $language['text_new_password'],
                  'TEXT_REPEAT_PASSWORD'                => $language['text_repeat_password'],
                  'TEXT_SAVE'                           => $language['text_save'],
                  'MESSAGE_VALIDATION'                  => $web->tpl(TEMPLATES_PATH . 'forms/msg-validation.tpl', []),
                  'TEXT_ERROR_EMAIL_MISSING'            => $language['text_error_email_missing'],
                  'TEXT_ERROR_PASSWORD_MISSING'         => $language['text_error_password_missing'],                  
                  'TEXT_ERROR_REPEATPASSWORD_MISSING'   => $language['text_error_repeatpassword_missing'],
                  'TEXT_ERROR_REPEATPASSWORD_NOTEQUAL'  => $language['text_error_repeatpassword_notequal'],
                  'TEXT_COPYRIGHT_FOOTER'               => $language['text_copyright_footer'],                  
                  'MESSAGE'                             => $message                  
                ]);
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/fullwidth.tpl', 
                [
                  'CONTENT'                     => $pagecontent,
                  'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer'],                     
                ]); 
}
?>