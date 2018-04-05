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
    $uid = $auth->getSessionUID($auth->getSessionHash());
    $wallet_transaction_list = getWalletTransactions();
    $result = $auth->getWalletAddressBalance();
    if ($result['error']['code'] == 0) $balance = number_format(floatval($result['success']), 8, '.', '');
    else $balance = $language['text_error_wallet'][$result['error']['code']];
    $pagecontent = $web->tpl(
                TEMPLATES_PATH . 'pages/transactions.tpl', 
                [
                  'TITLE'                       => $language['title_transactions'],
                  'TEXT_BALANCE'                => $language['text_balance'],
                  'TEXT_DATE'                   => $language['text_date'],
                  'TEXT_TXID'                   => $language['text_txid'],
                  'TEXT_AMOUNT'                 => $language['text_amount'],
                  'TICKER'                      => COIN_TICKER,
                  'BALANCE'                     => $balance,
                  'TRANSACTIONS'                => $wallet_transaction_list,
                  'UID'                         => $uid
                ]);
    $content = $web->tpl(
                TEMPLATES_PATH . 'layout/fullwidth.tpl', 
                [
                  'CONTENT'                     => $pagecontent,
                  'TEXT_COPYRIGHT_FOOTER'       => $language['text_copyright_footer'],                      
                ]);
}
?>