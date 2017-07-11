<?php
session_start();
if(isset($_REQUEST['id']))
{
    include("dbconnection.php");
    deleteProduct($_REQUEST['id']);
    header("location:products.php?delete");
    
}  else {
  header("location:products.php");    
}
?>
