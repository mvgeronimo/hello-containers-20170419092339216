<!DOCTYPE html>
<html>
<head>
	<title>PHP Starter Application</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<?php
			function lookup(){
			  $statica_env = getenv("STATICA_URL");
			  $statica = parse_url($statica_env);

			  $proxyUrl = $statica['host'].":".$statica['port'];
			  $proxyAuth = $statica['user'].":".$statica['pass'];
			 
			  $url = "http://ip.jsontest.com/";

			  $ch = curl_init();
			  curl_setopt($ch, CURLOPT_URL, $url);
			  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			  curl_setopt($ch, CURLOPT_PROXY, $proxyUrl);
			  curl_setopt($ch, CURLOPT_PROXYAUTH, CURLAUTH_BASIC);
			  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyAuth);
			  $response = curl_exec($ch);
			  return $response;
			}

			$res = lookup();
			print_r($res);

			?>
</body>
</html>
