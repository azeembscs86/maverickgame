<?php
require_once 'includes/google-api-php-client/apiClient.php';
require_once 'includes/google-api-php-client/contrib/apiOauth2Service.php';
require_once 'includes/idiorm.php';
require_once 'includes/relativeTime.php';

// Session. Pass your own name if you wish.


// Database configuration with the IDIORM library

$host = 'localhost';
$user = 'maverick_hatsil';
$pass = '2*5&{QJp=#Za';
$database = 'maverick_silverhat';

ORM::configure("mysql:host=$host;dbname=$database");
ORM::configure('username', $user);
ORM::configure('password', $pass);

// Changing the connection to unicode
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Google API. Obtain these settings from https://code.google.com/apis/console/

$redirect_url = 'http://www.maverickgame.com/index.php'; // The url of your web site
$client_id = '370514934637-3rc4jvhcne8prckv6ib3g1ss3kb2hsi0.apps.googleusercontent.com';
$client_secret = 'jV_Tf_S-886ivLFztHswK49H';
$api_key = 'AIzaSyC5etU_ETug-xeFhGMw6ix7GF0yDthuHRM';
