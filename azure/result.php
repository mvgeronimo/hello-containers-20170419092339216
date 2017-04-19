<?php 

require(__DIR__.'/vendor/autoload.php');

// Construct.
$httpclient = new \microsoft\adalphp\HttpClient;
$storage = new \microsoft\adalphp\OIDC\StorageProviders\SQLite(__DIR__.'/storagedb.sqlite');
$client = new \microsoft\adalphp\AAD\Client($httpclient, $storage);

// Set credentials.
require(__DIR__.'/config.php');

$client->set_clientid(ADALPHP_CLIENTID);

$client->set_clientsecret(ADALPHP_CLIENTSECRET);

$client->set_redirecturi(ADALPHP_CLIENTREDIRECTURI);

// Make request.
$returned = $client->rocredsrequest($_POST['email'], $_POST['password']);

if($returned['id_token']!=''){
	$idtoken = \microsoft\adalphp\AAD\IDToken::instance_from_encoded($returned['id_token']);

	echo "<pre>";
	print_r($idtoken);
	/*echo '<h1>Welcome to Sales Force Automation</h1>';
	echo '<h2>Hello, '.$idtoken->claim('name').' ('.$idtoken->claim('upn').'). </h2>';
	echo '<h4>You have successfully authenticated with Azure AD using OpenID Connect. ';
				//.'This is just a demo, but the libraries contained in this package will provide an OpenID Connect idtoken and an '
				//.'oAuth2 access token to use Azure AD APIs</h4>';

	echo '<a href="index.php">Click here start again.</a>';*/
}
else{
	echo "error";
}