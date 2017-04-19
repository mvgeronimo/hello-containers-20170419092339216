# Microsoft Azure Active Directory Authentication Library (ADAL) for PHP
The ADAL SDK for PHP gives your application the full functionality of Microsoft Azure AD, including industry standard protocol support for OAuth2, Web API integration with user level consent, and two factor authentication support.

## NOTE
This is an early, pre-release version of the library.

## Installation
To install this library:
```
git clone git@github.com:AzureAD/azure-activedirectory-for-php.git
```

This library is mostly self-contained, however it uses PSR-4 for autoloading, and PHPUnit for unit testing. You can use Composer to install PHPUnit and generate a PSR-4 autoloader.

1. See [https://getcomposer.org/](https://getcomposer.org/) for information on how to install composer on your system.
2. Run ```php composer.phar install``` to install PHPUnit and generate a PSR-4 autoloader.
3. You can then use the Composer autoloader by requiring the vendor/autoload.php file in your scripts.

## Usage
Construct an HttpClient object:
```
$httpclient = new \microsoft\adalphp\HttpClient;
```
Construct a storage object. A storage object needs to implement the \microsoft\adalphp\OIDC\StorageInterface interface. Currently, two sample implementations are available under `microsoft\adalphp\OIDC\StorageProviders` namespace - `SQLite` and `Session`, but you may need to implement this class yourself based on your storage needs or environment.
Initialize `SQLite` storage provider (as shown in `samples` folder):
```
$storage = new \microsoft\adalphp\OIDC\StorageInterface\SQLite(__DIR__.'/storagedb.sqlite');
```
or initialize the `Session` storage provider:
```
$storage = new \microsoft\adalphp\OIDC\StorageInterface\Session();
```
Construct the AzureAD client class using the $httpclient and $storage instances.
```
$client = new \microsoft\adalphp\AAD\Client($httpclient, $storage);
```
Set your client ID, client secret, and redirect URI.
```
$client->set_clientid($clientid);
$client->set_clientsecret($clientsecret);
$client->set_redirecturi($redirecturi);
```

You client is now ready to use.

To initiate an authorization request:
```
$client->authrequest();
```

To handle an authorization request response (this should be in your redirect URI page):
```
list($idtoken, $tokenparams, $stateparams) = $client->handle_auth_response($_REQUEST);
```

To perform a resource-owner credentials request:
```
$returned = $client->rocredsrequest($_POST['username'], $_POST['password']);
$idtoken = \microsoft\adalphp\AAD\IDToken::instance_from_encoded($returned['id_token']);
```

To get user information from an IDToken, call ->claim() on the $idtoken object. This returns OpenID Connect claims:
```
$idtoken->claim('name');
$idtoken->claim('upn');
```

## Samples and Documentation
The `samples` folder contains a sample implementation of the library demonstrating basic authentication in several different ways.

## Community Help and Support
We leverage [Stack Overflow](http://stackoverflow.com/) to work with the community on supporting Azure Active Directory and its SDKs, including this one! We highly recommend you ask your questions on Stack Overflow (we're all on there!) Also browse existing issues to see if someone has had your question before.

We recommend you use the "adal" tag so we can see it! Here is the latest Q&A on Stack Overflow for ADAL: [http://stackoverflow.com/questions/tagged/adal](http://stackoverflow.com/questions/tagged/adal)

## Contributing
All code is licensed under the MIT license and we triage actively on GitHub. We enthusiastically welcome contributions and feedback. You can fork the repo and start contributing now. [More details](https://github.com/AzureAD/azure-activedirectory-library-for-php/blob/master/contributing.md) about contributing.

## License
Copyright (c) Microsoft Corporation. Licensed under the MIT License.
