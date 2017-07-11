<?php
/*
 * This is the listner page in php (configured on IPN Screen) which OPS server will hit sending 
 * the variable named "url" 
 * the merchant will be recieving this variable using GET parameter method and will be initiating 
 * a REST call. This URL will be the complete path to the Rest Service of OPS and is appended by 
 * merchant account number and order id. The merchant just needs to send that to OPS sample URL that 
 * will be recieved here is as follows:
 * 'https://easypay.easypaisa.com.pk/easypay-service/rest/v1/order-status/1000000000000000/400'
 */

require_once('IPNCall.php');

$test = new IPNCall();
$test->callRestURL($_GET['url']);