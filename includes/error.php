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
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/error.tpl', 
                [
                  'TITLE'                       => $language['title_error'],
                  'CONTENT'                     => $language['text_error'],
                  'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer']
                ]);
}
?>