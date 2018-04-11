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
  'title_login'                         => 'Login',
  'title_register'                      => 'Register',
  'title_forgot_password'               => 'Reset password',
  'title_reset_password'                => 'Change password',
  'title_dashboard'                     => 'Web Wallet',
  'title_transactions'                  => 'Transactions',
  'title_error'                         => 'Error',
  'title_account'                       => 'Account',

  'text_please_sign_in'                 => 'Sign in',
  'text_email_address'                  => 'Email address',
  'text_password'                       => 'Password',
  'text_current_password'               => 'Current password',
  'text_key'                            => 'Reset key',
  'text_change_password'                => 'Change password',  
  'text_new_password'                   => 'New password',
  'text_remember_me'                    => 'Remember me',
  'text_sign_in'                        => 'Sign in',
  'text_forgot_password'                => 'Forgot password',
  'text_save'                           => 'Save',
  'text_register'                       => 'Register',
  'text_reset_password'                 => 'Reset password',
  'text_repeat_password'                => 'Repeat password',
  'text_address'                        => 'Address',
  'text_balance'                        => 'Balance',
  'text_create_new_address'             => 'Create address',
  'text_date'                           => 'Date',
  'text_txid'                           => 'Txid',
  'text_amount'                         => 'Amount',
  'text_send'                           => 'Send',
  'text_amount_sent'                    => 'Amount has been sent.',
  'text_error'                          => 'Page not found or access restricted.',

  'text_no_addresses_found'             => 'You do not have a wallet address yet.<br>Create one now by clicking "Create address".',
  'text_no_transactions_found'          => 'No transactions found.',

  /** Errors */
  'text_error_email_missing'            => 'Please enter your email address.',
  'text_error_key_missing'              => 'Please enter your password reset key.',
  'text_error_password_missing'         => 'Please enter your password.',
  'text_error_repeatpassword_missing'   => 'Please repeat your password.',
  'text_error_repeatpassword_notequal'  => 'Please enter the same password as above.',
  'text_error_amount_too_low'           => 'The amount you want to send is too low.',
  'text_error_receiver_missing'         => 'The receiver address is missing.',
  'text_error_wallet'                   => [
                                            -1 => 'Wallet error.',
                                            -2 => 'Server is in safe mode, and command is not allowed in safe mode.',
                                            -3 => 'Unexpected type was passed as parameter.',
                                            -4 => 'Your balance is too low (sending amount + transaction fee).',
                                            -5 => 'Invalid address.',
                                            -6 => 'Your balance is too low.',
                                            -7 => 'Ran out of memory during operation.',
                                            -8 => 'Invalid, missing or duplicate parameter.',
                                            -9 => 'Not connected.',
                                            -10 => 'Still downloading initial blocks.',
                                            -11 => 'Invalid account name.',
                                            -12 => 'Keypool ran out, call keypoolrefill first.',
                                            -13 => 'Enter the wallet passphrase with walletpassphrase first.',
                                            -14 => 'The wallet passphrase entered was incorrect.',
                                            -15 => 'Command given in wrong wallet encryption state (encrypting an encrypted wallet etc.)',
                                            -16 => 'Failed to encrypt the wallet.',
                                            -17 => 'Wallet is already unlocked.',
                                            -20 => 'Database error.',
                                            -22 => 'Error parsing or validating structure in raw format.',
                                            -23 => 'Node is already added.',
                                            -24 => 'Node has not been added before.',
                                            -25 => 'General error during transaction or block submission.',
                                            -26 => 'Transaction or block was rejected by network rules.',
                                            -27 => 'Transaction already in chain.',
                                            -28 => 'Client still warming up.',
                                            -29 => 'Node to disconnect not found in connected nodes.',
                                            -30 => 'Invalid IP/Subnet',
                                            -200 => 'Wallet does not exist'
                                            ],

  /** Format */
  'format_date'                         => 'm/d/Y H:s:i',

  /** Lists */
  'list_navigation'                     => [
                                            'index.html'                        => '<strong>Web</strong>Wallet',
                                            'transactions.html'                 => 'Transactions',
                                            'http://explorer.corez.site:3001/'  => 'Explorer',
                                            'account.html'                      => 'Settings',                                            
                                            'logout.html'                       => 'Logout'
                                            ],
  'icon'                                => [
                                            'send'                              => '<i class="fas fa-caret-square-right" style="font-size:10px; color:red;"></i>',
                                            'receive'                           => '<i class="fas fa-caret-square-left" style="font-size:10px; color:green;"></i>'
                                            ]
];

?>