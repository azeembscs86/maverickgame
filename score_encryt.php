<?php
function rsa_generate($bits) {
	$rsa = new Crypt_RSA(); 
	define('CRYPT_RSA_EXPONENT', 65537); 
	$keypair = $rsa->createKey($bits); 
	return $keypair;
}
echo rsa_generate(2048);
?>