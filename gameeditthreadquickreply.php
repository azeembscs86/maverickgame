<?php
session_start();
include("dbconnection.php");
$link="$_SERVER[REQUEST_URI]";
$links=explode("/",$link);
if(count($links)==2)
{
    $seo=$links[1];
}  else {
    $seo=$links[2];
}
$seo=substr($seo, 24);
?>
<!DOCTYPE HTML>
<html>
<head>

<title><?php echo $seo; ?> thread quick reply | Maverick Game </title>
<meta name="description" content="" />
<meta name="keywords" content="" />

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
<?php
$seo=substr($seo, 24);
 $thread= getThreadReplyById($seo);
 $threads=  mysql_fetch_array($thread);
  $mom_threads=  getThreadById($threads['threadd_id']);
 $mom_thread=  mysql_fetch_array($mom_threads);
 $thread_sub_forum=  getSubForumByThreads($threads['discussion_forum_id']);
$sub_forum_thread=  mysql_fetch_array($thread_sub_forum);
 ?>
<div class="featured-area">
	<div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
      <div class="inner-cnt"> 
  <h2 class="forumhd">Welcome to <span>Game Discussion</span></h2>
  <br/>  
  <div class="breadcrum">
    <a href="maverick-game-dicussion-forum" style="color:#FFFFFF;">Discussion Forum </a> > <a href="game-forum-thread-<?php echo $sub_forum_thread['discussion_forum_seo']; ?>" style="color:#FFFFFF;"><?php echo $sub_forum_thread['discussion_forum_title']; ?></a> > <a href="game-forum-post-<?php echo $mom_thread['thread_seo']; ?>" style="color:#FFFFFF;"><?php echo $mom_thread['thread_name']; ?></a>
</div>
   <div class="col-md-12 postdtl">
            <div class="col-md-12 postdtl3 QUICK1">
              <h3 style="" class="posth3">Quick Reply to Thread </h3>
            </div>            
             <div class="col-md-12">
             <form method="post" class="thread" action="doeitpostquickreplythread.php">
            <input type="hidden" name="thread_reply_id" value="<?php echo $threads['thread_reply_id']; ?>"> 
            <input type="hidden" name="thread_seo" value="<?php echo $mom_thread['thread_seo']; ?>"> 
  <input class="form-control" type="text" name="thread_name" id="thread_name" placeholder="Title" style="background:#f0efeb; margin-top:5px;" value="<?php echo $threads['reply_name']; ?>"/>
   <br/>
    <br/>
      <br/>
      <textarea rows="15" cols="50" name="thread_message" class="form-control" placeholder="WRITE HERE" style="background:#f0efeb; margin-top:5px;"><?php echo $threads['reply_message']; ?></textarea>
    <br/>
    <br/>
      <br/>  
         <input type="submit" name="submit" value="POST" class="btn-reply"> <a href="game-forum-post-<?php echo $mom_thread['thread_seo']; ?>" class="btn-reply">Back</a>
             </form>
             </div>
          </div>
</div>
     </div>
     
<div class="col-md-3">
     
  <?php
include("recent-discussion.php");
?>
     <a target="_blank" href="http://thedigitaltraining.com/"><img width="308" height="229" alt="Left Banner" src="assets/images/left-ads.jpg" class="img-responsive"></a>
     </div>
    </div>
    </div>
</div>

<?php
include("footer.php");
?>






</body>
</html>