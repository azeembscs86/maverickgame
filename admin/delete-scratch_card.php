<?php
session_start();
if(isset($_REQUEST['id']))
{
    include("dbconnection.php");
    deleteUsedScratchCard($_REQUEST['id']);
    $result=getUsedScratchCard($id);
    $card=  mysql_fetch_array($result);
    updateScratchCard($card['card_id']);
    header("location:scratch-cards.php");
}  else {
    header("location:scratch-cards.php");
}
?>