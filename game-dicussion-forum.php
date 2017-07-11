<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Discussion Forum | Maverick Game</title>
<meta content="discussion forum, maverick game, discussion community, community for online gaming, forum for online games, discussion forum for online game players" name="keywords"  />
<meta content="Post your discussion topics about Maverick Game here. Answer queries and discuss hot gaming topics on our online discussion community." name="description"/>

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>

<body>
<?php
	include("user-login-menus.php");
?>
<?php
	include("sidebarlinks.php");
?>

<div class="leader-area">
	<div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
      <div class="leader-wrap"  style="min-height:400px;"> 
  <h3 class="white">Welcome to <span>Game Discussion</span></h3>
  <br/>
 
   
   
   <table class="table-responsive table-bordered table-condensed table-detail">
   <thead>
<tr>
    <th colspan="2"><span class="tableformyelo">FORUM</span></th>
    <th colspan="2"><span class="tableform">LATEST POST</span></th>
    
  </tr>
</thead>
  <tbody>
  <tr>
  <td class="nopad" colspan="4"><h1 class="forum-hd1 white">Gaming Forums</h1></td>
  </tr>
   <?php
   $game_forums=getDiscussionForum();
   if($game_forums>0)
   {
       while($game_forum=  mysql_fetch_array($game_forums))
       {
   ?>
      <tr>
      <td align="center"><img width="50" height="50" src="assets/images/forum/<?php echo $game_forum['discussion_simlies']; ?>"></td>
      <td class="width30"><div class="main-topic"><a href="game-forum-thread-<?php echo $game_forum['discussion_forum_seo']; ?>"><?php echo $game_forum['discussion_forum_title']; ?></a> <br/><span class="smalltext"><?php echo $game_forum['forum_description']; ?></span></div></td>
      <td class="width54"><span class="tabletd">
      <?php 
        $last_thread=getLastThreadBySubForum($game_forum['discussion_forum_id']); 
        $lastthread=  mysql_fetch_array($last_thread);
        ?>
            <a href="game-forum-thread-<?php echo $game_forum['discussion_forum_seo']; ?>"><?php echo $lastthread['thread_name'];  ?></a>
        <?php              
        if($lastthread['user_id']>0){
        $user_detail=  getUserById($lastthread['user_id']);
        $user=  mysql_fetch_array($user_detail);
         echo "<br> by ";
        ?>
        <span style='color: #688031'><?php echo $user['name']; ?></span>    
        <?php
        echo "<br>";
        echo date("d-m-y",strtotime($lastthread['createdAt']));       
        }
        ?> 
      
      </td>      
      </tr>
 <?php     
       }
   }
   ?>
         
  </tbody>
</table>
</div>
     </div>
<div class="col-md-3">       
  <?php
include("recent-discussion.php");
?>
    </div>
    </div>
    </div>
</div>
<?php
include("footer-toparea.php");
?>
<?php
include("footer.php");
?>
</body>
</html>