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
    if ($auth->isLogged()) $auth->logout($auth->getSessionHash());
    $web->redirect(DOMAIN_URL . LANG . '/');
}
?>