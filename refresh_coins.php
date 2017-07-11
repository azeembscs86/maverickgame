<?php
    session_start();
    include("dbconnection.php");
    $user_coins=getCoinsByUserId($_SESSION['user_loged_id']);
    $user_coin=  mysql_fetch_array($user_coins);
?>

<p><?php echo $user_coin['total_coins']; ?></p>