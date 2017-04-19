This sample demonstrates how to use this library for basic authentication with Azure AD.

1. Install dependencies and generate autoloader with composer.
  * `curl -sS https://getcomposer.org/installer | php`
  * `php composer.phar install`
2. Copy config.dist.php to config.php (in the same folder).
3. Copy storagedb.dist.sqlite to storagedb.sqlite (in the same folder).
  1. Your webserver needs to write to both the the storagedb.sqlite file and the samples folder, so ensure permissions are set to allow this.
4. Edit config.php and enter your client ID, client secret, and redirect URI.
  1. The redirect URI will be the URI that points to the redirect.php file in this folder, for example "http://example.com/src/samples/redirect.php". This will depend on your environment.
  2. The redirect URI entered in the config.php and in the Azure management portal must match exactly.
5. Visit the index.php page in your browser, for example http://example.com/src/samples/index.php
6. There are three options to demonstrate authentication.
  1. Authorization request login (with login prompt): This will redirect you to the Azure login page and always ask you to log in, regardless of whether you are logged in to Azure or not.
  2. Authorization request login (using existing session): This will redirect your to the Azure login page like the first link, but will use a preexisting session if present, providing a seamless login experience.
  3. Username/Password Grant: This allows you to enter Azure login credentials directly in the login form and have authentication happen behind the scenes. You will not be redirected to Azure to log in.
