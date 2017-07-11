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
$seo=substr($seo, 17);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Discussion Forum Update Thread | Maverick Game</title>
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
   $seo=substr($seo, 17);
  $thread=  getThreadById($seo);
  $thread_detail=  mysql_fetch_array($thread);
  $thread_sub_forum=  getSubForumByThreads($thread_detail['discussion_forum_id']);
  $sub_forum_thread=  mysql_fetch_array($thread_sub_forum);
  ?>
<div class="leader-area">
  <div class="container">
    <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="leader-wrap">
          <h2 class="forumhd">Welcome to <span>Game Discussion</span></h2>
          <br/>
          <div class="breadcrum"><a href="maverick-game-dicussion-forum" style="color:#FFFFFF;">Game Discussion Forum </a> > <a href="game-forum-thread-<?php echo $sub_forum_thread['discussion_forum_seo']; ?>" style="color:#FFFFFF;"><?php echo $sub_forum_thread['discussion_forum_title']; ?></a></div>
          <div class="col-md-12 postdtl">
            <div class="col-md-12 postdtl3 QUICK1">
              <h3 style="" class="posth3">Update Thread <?php echo $thread_detail['thread_name'];  ?></h3>
            </div>
            <div class="col-md-12">
              <form action="doeditpostthread.php" method="post" class="thread" name="newQuickReplyThreadForm" id="newQuickReplyThreadForm">
                <input type="hidden" name="thread_id" value="<?php echo $seo; ?>">
                <input class="form-control" type="text" name="thread_name"  id="thread_name" value="<?php echo $thread_detail['thread_name']; ?>"  placeholder="Title" style="background:#f0efeb; margin-top:5px;"/>
                <br/>
                <br/>
                <br/>
                <textarea rows="15" cols="50" name="thread_message" class="form-control" placeholder="WRITE HERE" style="background:#f0efeb; margin-top:5px;"><?php echo $thread_detail['thread_message']; ?></textarea>
                <br/>
                <br/>
                <br/>
                <input type="submit" name="submit" value="POST" class="btn-reply">
                <a href="game-forum-thread-<?php echo $sub_forum_thread['discussion_forum_seo']; ?>" class="btn-reply">Back</a>
              </form>
            </div>
          </div>
        </div>
      </div>
   
    </div>
  </div>
</div>
<?php
include("footer.php");
?>
</body>
</html>