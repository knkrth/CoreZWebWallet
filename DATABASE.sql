CREATE TABLE IF NOT EXISTS `attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(39) NOT NULL,
  `expiredate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `config` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `setting` (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `config` (`setting`, `value`) VALUES
('attack_mitigation_time', '+30 minutes'),
('attempts_before_ban', '30'),
('attempts_before_verify', '5'),
('bcrypt_cost', '10'),
('cookie_domain', ''),
('cookie_forget', '+1 hour'),
('cookie_http', '0'),
('cookie_name', 'authID'),
('cookie_path', '/'),
('cookie_remember', '+1 month'),
('cookie_secure', '0'),
('emailmessage_suppress_activation', '0'),
('emailmessage_suppress_reset', '0'),
('mail_charset', 'UTF-8'),
('password_min_score', '0'),
('request_key_expiration', '+10 minutes'),
('site_activation_page', 'activate.html'),
('site_email', 'info@YOURDOMAIN'),
('site_key', '7SHJK239AJKSDA!@SBhRLJWHA24!VJLNS988AHA'),
('site_name', 'CoreZ Web Wallet'),
('site_password_reset_page', 'reset-password.html'),
('site_timezone', 'Europe/Berlin'),
('site_url', 'http://YOURDOMAIN'),
('smtp', '0'),
('smtp_auth', '1'),
('smtp_debug', 'DEBUG'),
('smtp_host', 'smtp.example.com'),
('smtp_password', 'yourPassword'),
('smtp_port', '25'),
('smtp_security', ''),
('smtp_username', 'email@email.com'),
('table_attempts', 'attempts'),
('table_requests', 'requests'),
('table_sessions', 'sessions'),
('table_users', 'users'),
('table_wallets', 'wallets'),
('verify_email_max_length', '100'),
('verify_email_min_length', '5'),
('verify_email_use_banlist', '1'),
('verify_password_min_length', '3');

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `rkey` varchar(20) NOT NULL,
  `expire` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  `expiredate` datetime NOT NULL,
  `ip` varchar(39) NOT NULL,
  `agent` varchar(200) NOT NULL,
  `cookie_crc` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `wallets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;