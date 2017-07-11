<?php
session_start();
include("dbconnection.php");
$user_id = mysql_real_escape_string($_REQUEST['user_id']);
$reward_id  = mysql_real_escape_string($_REQUEST['reward_id']);
$users=  getUserById($user_id);
$user=  mysql_fetch_array($users);
$user_email=$user['email'];
$username=$user['name'];
$rewards=getRewardById($reward_id);
$reward=  mysql_fetch_array($rewards);
$reward_name=$reward['reward_name'];
$reward_point=$reward['reward_points'];
$user_redeem_points=getRedeemPointsByUserId($user_id);
$user_redeem_point=  mysql_fetch_array($user_redeem_points);
addNewReedemPoints($user_id,$reward_id,$reward_point);
$point_leader_boards=  getPointsLeaderBoardByUserId($user_id);
$point_leader_board=  mysql_fetch_array($point_leader_boards);
$leader_borad_score=$point_leader_board['total_points']-$reward_point;
updatePointRedemLeaderBoard($user_id,$leader_borad_score);
$subject="Maverick Game Rewards Redeem Details";
    $from = "info@maverickgame.com";
    $email_server="info@maverickgame.com"; 
    $to = "info@maverickgame.com";
    $mail_body="Dear $username,<br/><br/>Your request of maverick reward has been received our team will contact you in 48 hours during weekdays for any queries or cancellation of this reward please write to us with in 24 hrs at <strong>info@maverickgame.com</strong>.<br>We wish you best of luck on better game performance and more rewards in future. Keep Playing Keep Winning.  <br/> <br/> Regards,<br/><br/>Team Maverick Game";    
    $body = wordwrap($mail_body,2000);
    //$body_user = wordwrap($mail_body_user,70);
    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  	    $headers .= "From: " . $from ."\r\n";
            $headers .= 'Bcc:info@maverickgame.com' . "\r\n";
            $headers .= "Reply-To: " . $user_email . "\r\n";   
    //------------------------Thanks You Email-------------------------------------------------------------------        
    mail($to,$subject,$mail_body,$headers);    
?>
