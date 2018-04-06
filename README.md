CoreZ Web Wallet
=======

### Installation

Edit config.php and add your database information under 1).
Add the RPC settings from your wallet server (.conf file) under 2).
You can also adjust any additional parameters under 3).
Save the config.php and copy all files to the web wallet server.
Import DATABASE.sql to your MySQL database.
Now visit http://YOURDOMAIN/en/index.html?update=true to update the configuration information in the database.

### Languages
You can add additional languages by creating a language file under languages/ and adding the language in the config.php in the $lang_allowed array.

### Update
04/06/2018	Small fixes
04/05/2018	Initial release

### Donations
Want to help the project? You can donate some CRZ to ZrrEJze7MCA1dQmr8KRfFdugUhxQ28Vrtu