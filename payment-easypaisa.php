<?php
session_start();
include("dbconnection.php");
if(isset($_GET['orderRefNum']))
$order_number = $_GET['orderRefNum'];// geting order number
$createdAt=  date('Y-m-d');
$updatedAt=  date("Y-m-d");  
$query="insert into easypaisa_payment(order_number,createdAt,updatedAt) values('$order_number','$createdAt','$updatedAt')";
mysql_query($query) or die(mysql_error())
?>
