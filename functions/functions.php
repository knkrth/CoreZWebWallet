<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

/**
 * Update the config table
 *
 */
function updateConfig() 
{
	global $db;
    $settings = [
        'site_name' => SITE_NAME,
        'site_url' => SITE_URL,
        'site_email' => SITE_EMAIL,
        'site_key' => SITE_KEY,
        'site_timezone' => SITE_TIMEZONE,
        'site_activation_page' => SITE_ACTIVATION_PAGE,
        'site_password_reset_page' => SITE_PASSWORD_RESET_PAGE, 
        'cookie_name' => COOKIE_NAME, 
        'cookie_path' => COOKIE_PATH,
        'cookie_domain' => COOKIE_DOMAIN, 
        'cookie_secure' => COOKIE_SECURE, 
        'cookie_http' => COOKIE_HTTP, 
        'cookie_remember' => COOKIE_REMEMBER, 
        'cookie_forget' => COOKIE_FORGET, 
        'smtp' => SMTP,
        'smtp_debug' => SMTP_DEBUG, 
        'smtp_host' => SMTP_HOST, 
        'smtp_auth' => SMTP_AUTH, 
        'smtp_username' => SMTP_USERNAME, 
        'smtp_password' => SMTP_PASSWORD, 
        'smtp_port' => SMTP_PORT,
        'smtp_security' => SMTP_SECURITY, 
        'verify_password_min_length' => VERIFY_PASSWORD_MIN_LENGTH,
        'verify_email_min_length' => VERIFY_EMAIL_MIN_LENGTH, 
        'verify_email_max_length' => VERIFY_EMAIL_MAX_LENGTH, 
        'verify_email_use_banlist' => VERIFY_EMAIL_USE_BANLIST,
        'attack_mitigation_time' => ATTACK_MITIGATION_TIME, 
        'attempts_before_verify' => ATTEMPTS_BEFORE_VERIFY, 
        'attempt_before_ban' => ATTEMPT_BEFORE_BAN,
        'password_min_score' => PASSWORD_MIN_SCORE
    ];        
    foreach ($settings as $settingKey => $settingValue) 
    {
        $sql = $db->prepare('UPDATE ' . DB_TB_CONFIG . ' SET value = :value WHERE setting = :setting');
        $sql->execute(['value' => $settingValue, 'setting' => $settingKey]);
    }
    die();
}

/**
 * getLanguages
 *
 * @return string HTML language dropdown
 */
function getLanguages() 
{
	global $lang_allowed, $web;
    $language_list = '';
    foreach ($lang_allowed as $lang => $full_language)
    {
        if (strcmp($lang, LANG) != 0) $language_list .= $web->tpl(
                    TEMPLATES_PATH . 'language/language-list.tpl', 
                    [
                      'LANGUAGE'                    => $full_language,
                      'URL'                         => DOMAIN_URL . $lang . '/'
                    ]);
    }
    return $web->tpl(
                    TEMPLATES_PATH . 'language/language.tpl', 
                    [
                      'LANGUAGE_CURRENT'            => $lang_allowed[LANG],
                      'LANGUAGE_LIST'               => $language_list
                    ]);
}

/**
 * getNavigation
 *
 * @return string Return the navigation
 */
function getNavigation() 
{
	global $language, $web;	
    $navigation_list = '';
    foreach ($language['list_navigation'] as $url => $navigation)
    {
        $target = '';
        if ($web->inString('://',$url)) $target = 'target="blank"';
        $navigation_list .= $web->tpl(
                    TEMPLATES_PATH . 'navigation/navigation-list.tpl', 
                    [
                      'NAVIGATION'                  => $navigation,
                      'URL'                         => $url,
                      'TARGET'                      => $target
                    ]);
    }
    return $web->tpl(
                    TEMPLATES_PATH . 'navigation/navigation.tpl', 
                    [
                      'NAVIGATION_LIST'               => $navigation_list
                    ]);
}

/**
 * getDashboardAddresses
 *
 * @return string Return addresses
 */
function getDashboardAddresses($uid)
{
    global $db, $config, $auth, $language, $web;
    $wallet_addresses_list = "";
    $sql = $db->prepare('SELECT * FROM ' . $config->table_wallets . ' WHERE uid = :uid');
    $sql->execute(['uid' => $uid]);
    if (intval($sql->rowCount()) > 0)
    {
        while($row = $sql->fetch()) 
        {
           $wallet_addresses_list .= $web->tpl(
                TEMPLATES_PATH . 'wallet/address-list.tpl', 
                [
                  'ADDRESS'                     => $row['address'],
                  'EXPLORER_URL'                => EXPLORER_ADDRESS_URL,
                  'WID'                         => $row['id'],
                ]);
        }
    } else $wallet_addresses_list = $web->tpl(
                TEMPLATES_PATH . 'wallet/address-empty.tpl', 
                [
                  'CONTENT'                     => $language['text_no_addresses_found']
                ]);
    return $wallet_addresses_list;
}

/**
 * getTransactions
 *
 * @return string Return transactions
 */
function getWalletTransactions()
{
    global $db, $config, $auth, $language, $web;
    $wallet_transactions_list = "";
    $transactions = [];
    $result = $auth->getWalletTransactions();
    if ($result['error']['code'] == 0) $transactions = $result['success'];
    if (is_array($transactions) && (!empty($transactions)))
    {
        foreach ($transactions as $key => $transaction)
        {
            $wallet_transactions_list .= $web->tpl(
                    TEMPLATES_PATH . 'transactions/transactions-list.tpl', 
                    [
                      'ACCOUNT'                     => $transaction['account'],
                      'ADDRESS'                     => $transaction['address'],
                      'CATEGORY'                    => $transaction['category'],
                      'CATEGORY_ICON'               => $language['icon'][$transaction['category']],
                      'AMOUNT'                      => number_format(floatval($transaction['amount']), 8, '.', ''),
                      'LABEL'                       => $transaction['label'],
                      'VOUT'                        => $transaction['vout'],
                      'CONFIRMATIONS'               => $transaction['confirmations'],
                      'TXID'                        => $transaction['txid'],
                      'DATE'                        => date($language['format_date'], $transaction['time']),
                      'EXPLORER_URL'                => EXPLORER_TXID_URL
                    ]);
        }
    } else {
        $message = $language['text_no_transactions_found'];
        if ($result['error'] > 0) $message = $language['text_error_wallet'][$result['error']];
        $wallet_transactions_list = $web->tpl(
                TEMPLATES_PATH . 'transactions/transactions-empty.tpl', 
                [
                  'CONTENT'                     => $message
                ]);
    }
    return $wallet_transactions_list;
}
?>