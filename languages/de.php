<?php
/**
 * CoreZ Web Wallet
 * 
 * @author Bavamont, www.bavamont.com
 * @link https://github.com/bavamont
 * 
 */

$language = [

  /** Website */
  'website_title'                       => 'CoreZ Web Wallet',
  'text_copyright_footer'               => 'Copyright &copy; CoreZ - The future of payment.<br>All rights reserved.',

  /** Page titles */
  'title_login'                         => 'Anmelden',
  'title_register'                      => 'Registrieren',
  'title_forgot_password'               => 'Passwort zur&uuml;cksetzen',
  'title_reset_password'                => 'Passwort &auml;ndern',  
  'title_dashboard'                     => 'Web Wallet',
  'title_transactions'                  => 'Transaktionen',
  'title_error'                         => 'Fehler',
  'title_account'                       => 'Konto',

  'text_please_sign_in'                 => 'Anmelden',
  'text_email_address'                  => 'Email-Adresse',
  'text_password'                       => 'Passwort',
  'text_current_password'               => 'Aktuelles Passwort',
  'text_key'                            => 'Sicherheitsschl&uuml;ssel',
  'text_change_password'                => 'Passwort &auml;ndern',
  'text_new_password'                   => 'Neues Passwort',
  'text_remember_me'                    => 'Angemeldet bleiben',
  'text_sign_in'                        => 'Anmelden',
  'text_forgot_password'                => 'Passwort vergessen',
  'text_save'                           => 'Speichern',
  'text_register'                       => 'Registrieren',
  'text_reset_password'                 => 'Passwort zur&uuml;cksetzen',
  'text_repeat_password'                => 'Passwort wiederholen',
  'text_address'                        => 'Adresse',
  'text_balance'                        => 'Kontostand',
  'text_create_new_address'             => 'Adresse erstellen',
  'text_date'                           => 'Datum',
  'text_txid'                           => 'Txid',
  'text_amount'                         => 'Summe',
  'text_send'                           => 'Senden',
  'text_amount_sent'                    => 'Betrag wurde gesendet.',
  'text_error'                          => 'Seite nicht gefunden oder Zugriff eingeschr&auml;nkt.',

  'text_no_addresses_found'             => 'Sie haben noch keine Wallet-Adresse.<br>Erstellen Sie jetzt eine, indem Sie auf "Adresse erstellen" klicken.',
  'text_no_transactions_found'          => 'Keine Transaktionen gefunden.',

  /** Errors */
  'text_error_email_missing'            => 'Geben Sie bitte Ihre Email-Adresse ein.',
  'text_error_key_missing'              => 'Bitte geben Sie Ihren Sicherheitsschl&uuml;ssel ein.',
  'text_error_password_missing'         => 'Bitte geben Sie Ihr Passwort ein.',
  'text_error_repeatpassword_missing'   => 'Bitte wiederholen Sie Ihr Passwort.',
  'text_error_repeatpassword_notequal'  => 'Bitte geben Sie dasselbe Passwort noch einmal ein.',
  'text_error_amount_too_low'           => 'Der Betrag, den Sie senden m&ouml;chten, ist zu niedrig.',
  'text_error_receiver_missing'         => 'Die Empf&auml;ngeradresse fehlt.',
  'text_error_wallet'                   => [
                                            -1 => 'Wallet-Fehler.',
                                            -2 => 'Der Server befindet sich im abgesicherten Modus und der Befehl ist im abgesicherten Modus nicht zul&auml;ssig.',
                                            -3 => 'Unerwarteter Typ wurde als Parameter &uuml;bergeben.',
                                            -4 => 'Ihr Guthaben ist zu niedrig (Sendungsbetrag + Transaktionsgeb&uuml;hr).',
                                            -5 => 'Ung&uuml;ltige Adresse.',
                                            -6 => 'Ihr Guthaben ist zu niedrig.',
                                            -7 => 'W&auml;hrend des Betriebs wurde kein Speicher mehr verf&uuml;gbar.',
                                            -8 => 'Ung&uuml;ltiger, fehlender oder duplizierter Parameter.',
                                            -9 => 'Nicht verbunden.',
                                            -10 => 'Immer noch erste Bl&ouml;cke herunterladen.',
                                            -11 => 'Ung&uuml;ltiger Kontoname.',
                                            -12 => 'Keypool lief aus, ruf keypoolrefill zuerst an.',
                                            -13 => 'Geben Sie zuerst die Wallet-Passphrase mit der Brieftaschenphrase ein.',
                                            -14 => 'Die eingegebene Wallet-Passphrase war falsch.',
                                            -15 => 'Befehl in falschem Brieftaschen-Verschl&uuml;sselungsstatus (Verschl&uuml;sseln einer verschl&uuml;sselten Brieftasche usw.)',
                                            -16 => 'Fehler beim Verschl&uuml;sseln der Brieftasche.',
                                            -17 => 'Brieftasche ist bereits entsperrt.',
                                            -20 => 'Datenbankfehler.',
                                            -22 => 'Fehler beim Analysieren oder &Uuml;berpr&uuml;fen der Struktur im Raw-Format.',
                                            -23 => 'Knoten ist bereits hinzugef&uuml;gt.',
                                            -24 => 'Der Knoten wurde noch nicht hinzugef&uuml;gt.',
                                            -25 => 'Allgemeiner Fehler w&auml;hrend der Transaktion oder Block&uuml;bertragung.',
                                            -26 => 'Transaktion oder Block wurde von Netzwerkregeln abgelehnt.',
                                            -27 => 'Transaktion bereits in der Kette.',
                                            -28 => 'Klient w&auml;rmt sich noch auf.',
                                            -29 => 'Zu trennender Knoten nicht in verbundenen Knoten gefunden.',
                                            -30 => 'Ung&uuml;ltige IP / Subnetz.',
                                            -200 => 'Konto existiert nicht.'
                                            ],

  /** Format */
  'format_date'                         => 'd.m.Y H:s:i',

  /** Lists */
  'list_navigation'                     => [
                                            'index.html'                        => 'Web Wallet',
                                            'transactions.html'                 => 'Transaktionen',
                                            'http://explorer.corez.site:3001/'  => 'Explorer',
                                            'account.html'                      => 'Einstellungen',                                            
                                            'logout.html'                       => 'Abmelden'
                                            ],
  'icon'                                => [
                                            'send'                              => '<i class="fas fa-caret-square-right" style="font-size:10px; color:red;"></i>',
                                            'receive'                           => '<i class="fas fa-caret-square-left" style="font-size:10px; color:green;"></i>'
                                            ]
];

?>