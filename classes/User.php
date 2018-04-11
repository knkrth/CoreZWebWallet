<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

namespace User;

use PHPRpcWalletWrapper\Wallet as Wallet;

use ZxcvbnPhp\Zxcvbn;

use PHPMailer;

class Auth extends \PHPAuth\Auth
{
    public $useGoogleRecapcha = false;
    public $googleRecapchaSecret = '';
    protected $coreRpcClient = '';
    protected $domainUrl = '';

    public function __construct(\PDO $dbh, $config, $rpcProtocol, $rpcUser, $rpcPassword, $rpcHost, $rpcPort, $language = "en_GB", $useGoogleRecapcha = false, $googleRecapchaSecret = '', $domainUrl) {
        $this->coreRpcClient = new Wallet($rpcProtocol, $rpcUser, $rpcPassword, $rpcHost, $rpcPort);
        $this->useGoogleRecapcha = $useGoogleRecapcha;
        $this->googleRecapchaSecret = $googleRecapchaSecret;
        $this->domainUrl = $domainUrl;
        parent::__construct($dbh, $config, $language);
    }

    /**
     * Get current wallet address balance
     * @return array
     */
    public function getWalletAddressBalance()
    {
        $sql = $this->dbh->prepare('SELECT * FROM ' . $this->config->table_wallets . ' WHERE uid = :uid LIMIT 1');
        $sql->execute(['uid' => $this->getCurrentUser()['uid']]);
        if (intval($sql->rowCount()) > 0)
        {
            while($row = $sql->fetch()) 
            {
                $walletAddress = $row['address'];
                $walletAccount = $row['account'];
            }
            $response = $this->coreRpcClient->getBalance($walletAccount, 6);
            if (!$response['error'])
            {
                $returnResult['success'] = number_format(floatval(preg_replace('/\s+/', '', $response['result'])), 8, '.', '');
                $returnResult['error']['code'] = 0;
                $returnResult['error']['message'] = '';
            } else {
                $returnResult['success'] = '';
                $returnResult['error']['code'] = $response['error']['code'];
                $returnResult['error']['message'] = $response['error']['message'];
            }
        } else {
            $returnResult['success'] = number_format(0, 8, '.', '');
            $returnResult['error']['code'] = 0;
            $returnResult['error']['message'] = '';
        }
        return $returnResult;
    }

    /**
     * Creates a wallet address
     * @return array
     */
    public function createWalletAddress()
    {
        $walletAccount = preg_replace('/[^A-Za-z0-9-]+/', '', preg_replace('/[\']/', '', md5($this->getCurrentUser()['email'])));
        $response = $this->coreRpcClient->getNewAddress($walletAccount);
        if (!$response['error'])
        {
            $returnResult['success'] = $response['result'];
            $returnResult['error']['code'] = 0;
            $returnResult['error']['message'] = '';
            $sql = $this->dbh->prepare('INSERT INTO ' . $this->config->table_wallets . ' (uid, address, account) VALUES (:uid, :address, :account)');
            $sql->execute(['uid' => $this->getCurrentUser()['uid'], 'address' => $response['result'], 'account' => $walletAccount]);
        } else {
            $returnResult['success'] = '';
            $returnResult['error']['code'] = $response['error']['code'];
            $returnResult['error']['message'] = $response['error']['message'];
        }
        return $returnResult;
    }

    /**
     * Send crypto
     * @return bool
     */
    public function sendWalletAmount($toAddress, $amount)
    {
        $newAmount = floatval(preg_replace('/\s+/', '', $amount)) - floatval(0.0001); // Subtract an amount for the transaction fee         
        if ($newAmount > 0)
        {
            $sql = $this->dbh->prepare('SELECT * FROM ' . $this->config->table_wallets . ' WHERE uid = :uid LIMIT 1');
            $sql->execute(['uid' => $this->getCurrentUser()['uid']]);
            if (intval($sql->rowCount()) > 0)
            {
                while($row = $sql->fetch()) 
                {
                    $fromAddress = $row['address'];
                    $fromAccount = $row['account'];
                }
                $newAmount = number_format(floatval(preg_replace('/\s+/', '', $newAmount)), 8, '.', '');
                $response = $this->coreRpcClient->sendFrom($fromAccount, $toAddress, $newAmount);
                if (!$response['error'])
                {
                    $returnResult['success'] = $response['result'];
                    $returnResult['error']['code'] = 0;
                    $returnResult['error']['message'] = '';
                } else {
                    $returnResult['success'] = '';
                    $returnResult['error']['code'] = $response['error']['code'];
                    $returnResult['error']['message'] = $response['error']['message'];
                }
            } else {
                $returnResult['success'] = '';
                $returnResult['error']['code'] = -200;
                $returnResult['error']['message'] = 'No wallet found.';
            }
        } else {
            $returnResult['success'] = '';
            $returnResult['error']['code'] = 4;
            $returnResult['error']['message'] = 'Your balance is too low (sending amount + transaction fee).';
        }
        return $returnResult;
    }

    /**
     * Get current wallet transactions
     * @return array Wallet transactions list
     */
    public function getWalletTransactions()
    {
        $sql = $this->dbh->prepare('SELECT * FROM ' . $this->config->table_wallets . ' WHERE uid = :uid LIMIT 1');
        $sql->execute(['uid' => $this->getCurrentUser()['uid']]);
        if (intval($sql->rowCount()) > 0)
        {
            while($row = $sql->fetch()) 
            {
                $walletAddress = $row['address'];
                $walletAccount = $row['account'];
            }

            $response = $this->coreRpcClient->listTransactions($walletAccount);
            if (!$response['error'])
            {
                $returnResult['success'] = $response['result'];
                $returnResult['error']['code'] = 0;
                $returnResult['error']['message'] = '';
            } else {
                $returnResult['success'] = '';
                $returnResult['error']['code'] = $response['error']['code'];
                $returnResult['error']['message'] = $response['error']['message'];
            }
        } else {
            $returnResult['success'] = '';
            $returnResult['error']['code'] = -200;
            $returnResult['error']['message'] = 'No wallet found.';
        }
        return $returnResult;
    }    

    /**
     * Verifies a captcha code using Google Recaptcha
     * @param string $captcha
     * @return boolean
     */
    protected function checkCaptcha($captcha)
    {
        if ($this->useGoogleRecapcha)
        {
            try 
            {
                $url    = 'https://www.google.com/recaptcha/api/siteverify';
                $data   = [
                            'secret'   => $this->googleRecapchaSecret,
                            'response' => $captcha,
                            'remoteip' => $this->getIp()
                          ];

                $options = [
                    'http' => [
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => http_build_query($data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                return json_decode($result)->success;
            }
            catch (\Exception $e) {
                return false;
            }

        } else return true;
    }

    /**
    * Creates an activation entry and sends email to user
    * @param int $uid
    * @param string $email
    * @param string $type
    * @param boolean $sendmail
    * @return boolean
    */

    protected function addRequest($uid, $email, $type, &$sendmail)
    {
        $return['error'] = true;

        if ($type != "activation" && $type != "reset") {
            $return['message'] = $this->lang["system_error"] . " #08";

            return $return;
        }

        // if not set manually, check config data
        if ($sendmail === NULL) {
            $sendmail = true;
            if ($type == "reset" && $this->config->emailmessage_suppress_reset === true ) {
                $sendmail = false;
                $return['error'] = false;

                return $return;
            }

            if ($type == "activation" && $this->config->emailmessage_suppress_activation === true ) {
                $sendmail = false;
                $return['error'] = false;

                return $return;
            }
        }

        $query = $this->dbh->prepare("SELECT id, expire FROM {$this->config->table_requests} WHERE uid = ? AND type = ?");
        $query->execute(array($uid, $type));

        if ($row = $query->fetch(\PDO::FETCH_ASSOC)) {

            $expiredate = strtotime($row['expire']);
            $currentdate = strtotime(date("Y-m-d H:i:s"));

            if ($currentdate < $expiredate) {
                $return['message'] = $this->lang["reset_exists"];

                return $return;
            }

            $this->deleteRequest($row['id']);
        }

        if ($type == "activation" && $this->getBaseUser($uid)['isactive'] == 1) {
            $return['message'] = $this->lang["already_activated"];

            return $return;
        }

        $key = $this->getRandomKey(20);
        $expire = date("Y-m-d H:i:s", strtotime($this->config->request_key_expiration));

        $query = $this->dbh->prepare("INSERT INTO {$this->config->table_requests} (uid, rkey, expire, type) VALUES (?, ?, ?, ?)");

        if (!$query->execute(array($uid, $key, $expire, $type))) {
            $return['message'] = $this->lang["system_error"] . " #09";

            return $return;
        }

        $request_id = $this->dbh->lastInsertId();

        if ($sendmail === true) {
            // Check configuration for SMTP parameters
            $mail = new PHPMailer;
            $mail->CharSet = $this->config->mail_charset;
            if ($this->config->smtp) {
                if ($this->config->smtp_debug) {
                    $mail->SMTPDebug = 3;
                }
                $mail->isSMTP();
                $mail->Host = $this->config->smtp_host;
                $mail->SMTPAuth = $this->config->smtp_auth;
                if (!is_null($this->config->smtp_auth)) {
                    $mail->Username = $this->config->smtp_username;
                    $mail->Password = $this->config->smtp_password;
                }
                $mail->Port = $this->config->smtp_port;

                if (!is_null($this->config->smtp_security)) {
                    $mail->SMTPSecure = $this->config->smtp_security;
                }
            }

            $mail->From = $this->config->site_email;
            $mail->FromName = $this->config->site_name;
            $mail->addAddress($email);
            $mail->isHTML(true);

            if ($type == "activation") {
                    $mail->Subject = sprintf($this->lang['email_activation_subject'], $this->config->site_name);
                    $mail->Body = sprintf($this->lang['email_activation_body'], $this->domainUrl, $this->config->site_activation_page, $key);
                    $mail->AltBody = sprintf($this->lang['email_activation_altbody'], $this->domainUrl, $this->config->site_activation_page, $key);
            } else {
                $mail->Subject = sprintf($this->lang['email_reset_subject'], $this->config->site_name);
                $mail->Body = sprintf($this->lang['email_reset_body'], $this->domainUrl, $this->config->site_password_reset_page, $key);
                $mail->AltBody = sprintf($this->lang['email_reset_altbody'], $this->domainUrl, $this->config->site_password_reset_page, $key);
            }

            if (!$mail->send()) {
                $this->deleteRequest($request_id);
                $return['message'] = $this->lang["system_error"] . " #10";

                return $return;
            }

        }

        $return['error'] = false;

        return $return;
    }    
}