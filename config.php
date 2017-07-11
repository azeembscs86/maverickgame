<?php
session_start();
include_once("src/Google_Client.php");
include_once("src/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '370514934637-lj21vhjjlr7nnik03dk40l89kbkdfvtf.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'hUhQgFR8cg42c_k_Dov6oZpE'; //Google CLIENT SECRET
$redirectUrl = 'http://maverickgame.com/oauth2callback';  //return url (url to script)
$homeUrl = 'http://maverickgame.com';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('Login to maverickgame.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>