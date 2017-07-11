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
$seo=substr($seo, 16);
$thread=  getThreadBySeo($seo);
$thread_detail=mysql_fetch_array($thread);       
$thread_id=$thread_detail['thread_id'];
$user_id=$thread_detail['user_id'];
$user_record=  getUserById($user_id);
$user=  mysql_fetch_array($user_record);
$thread_sub_forum=  getSubForumByThreads($thread_detail['discussion_forum_id']);
$sub_forum_thread=  mysql_fetch_array($thread_sub_forum);
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Discussion forum thread <?php echo $seo; ?> | Maverick Game </title>
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

<div class="leader-area">
	<div class="container">
    <div class="row">
     <div class="col-md-9 col-sm-9">
      <div class="leader-wrap" style="min-height:500px;"> 
  <h2>Discussion Fourm</span></h2>
  <br/>
  <div class="row">
  <div class="col-lg-1">
  
  <a href="game-thread-reply-<?php echo $thread_detail['thread_seo']; ?>"><button class="btn-reply">Reply</button></a>
  
  </div>
  
  <div class="col-lg-11">
  <div class="breadcrum"><a href="maverick-game-dicussion-forum" style="color:#FFF;">Discussion Forum > </a><a style="color:#FFF;" href="game-forum-thread-<?php echo $sub_forum_thread['discussion_forum_seo']; ?>">
        <?php 
               echo $thread_detail['thread_name'];
               ?>
        </a>
       
        </div>
        
        </div>
        
        
        </div>
   <div class="col-md-12 postdtl">
            <div class="col-md-12 postdtl3 QUICK1">
              <h3 style="" class="posth3">
                  <?php 
               echo $thread_detail['thread_name'];
               ?></h3>
            </div>
            <div class="col-md-3 post-display">
            <?php
if($user['user_name']!="")
{
?>
                <h3> <?php echo $user['user_name']; ?></a>
                <?php
}else
{
?>
               <h3>  <?php echo $user['name']; ?><h3> 
                <?php    
}
?>
              </h3>
              <?php
    if($user['photo']!="")
    {
    ?>
                   <img src="user_images/<?php echo $user['photo']; ?>" alt="" width="100" height="100"/>
              <?php
    }elseif(isset($_SESSION['FBID']))
    {
    ?>
              <img src="https://graph.facebook.com/<?php echo $user['FBID'] ?>/picture" width="100" height="100">
              <?php
    }else{
    ?>
              <img src="images/user-avatar.png" alt="" width="100" height="100"/>
              <?php
    }
    ?>
              <p> join date:<?php echo date("d-M-Y",strtotime($user['registered']));?> <br/>
                location:<?php echo $user['address']; ?> <br/>
                Post:
                <?php $post=countPostByUserId($user['id']); 
$totalpost=  mysql_fetch_array($post);
echo $totalpost[0];
?>
           
                
                
                           
                <!--<button class="btn btn-xs" style="background:#f7b700; color:#fff; margin-left:40px; padding:3px 8px; font-weight:bold; font-size:1.2em;">REPLY</button>--> 
            </p></div>
            <div class="col-md-9 content-display">
              <h3><strong><?php echo $thread_detail['thread_name']; ?></strong></h3>
             <p><?php echo $thread_detail['thread_message']  ?></p>
              <br>
              <br>
              <a href="game-forum-quick-reply-<?php echo $thread_detail['thread_seo']; ?>">
              <button class="btn-reply">QUICK REPLY</button>
              </a>
                      
                      <?php 
if(isset($_SESSION['user_loged_id']))
{
if($_SESSION['user_loged_id']==$thread_detail['user_id'])
{    
?>
                      <a href="game-edit-thread-<?php echo $thread_detail['thread_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread.php?id=<?php echo $thread_detail['thread_id']; ?>"><button class="btn-reply">Delete</button>  </a>
                      
    <?php
}
}
?>  
            
    <?php 
if(isset($_SESSION['FBID']))
{
 $user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
 if($user_facebook_id){
 $face_book_user=  mysql_fetch_array($user_facebook_id);
 $user_id=$face_book_user['id'];
 }
 if($user_id==$thread_detail['user_id'])
 {
?>   
                      
<a href="game-edit-thread-<?php echo $thread_detail['thread_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread.php?id=<?php echo $thread_detail['thread_id']; ?>"><button class="btn-reply">Delete</button>  </a>
 <?php
}
}
?>                      
            </div>
          </div>
  
  <?php
$get_reply=getReplyByThreadByQoute($thread_id);
if($get_reply>0)
{
    while($reply_get=  mysql_fetch_array($get_reply))
    {
        $thread_user=  getUserById($reply_get['user_id']);
        $userthread=  mysql_fetch_array($thread_user);
?>
  <div class="col-md-12 postdtl">
            
            <div class="col-md-3 post-display">
            <?php
if($userthread['user_name']!="")
{
?>
                <h3> <?php echo $userthread['user_name']; ?></h3>
                <?php
}else
{
?>
                <h3> <?php echo $userthread['name']; ?>  </h3>
                <?php    
}
?>
            
              <?php
    if($userthread['photo']!="")
    {
    ?>
              <img src="user_images/<?php echo $userthread['photo']; ?>" alt="" width="100" height="100"/>
              <?php
    }elseif(isset($_SESSION['FBID']))
    {
    ?>
              <img src="https://graph.facebook.com/<?php echo $userthread['Fuid'] ?>/picture" width="100" height="100">
              <?php
    }else{
    ?>
              <img src="images/user-avatar.png" alt="" width="100" height="100"/>
              <?php
    }
    ?>
              <p> join date:<?php echo date("d-M-Y",strtotime($userthread['registered']));?> <br/>
                location:<?php echo $userthread['address']; ?> <br/>
                Post:
                <?php $posts=countPostByUserId($userthread['id']); 
                $totalposts=  mysql_fetch_array($posts);
                echo $totalposts[0];
            ?>
           
                
                
                           
                <!--<button class="btn btn-xs" style="background:#f7b700; color:#fff; margin-left:40px; padding:3px 8px; font-weight:bold; font-size:1.2em;">REPLY</button>--> 
            </p></div>
            <div class="col-md-9 content-display">
                <p>Quote</p>
              <h3><strong><?php echo $reply_get['reply_name'];?></strong></h3>
             <p><?php  echo $reply_get['reply_message'] ?></p>
              <br>
              <br>
              <a href="game-forum-quick-reply-<?php echo $thread_detail['thread_seo']; ?>">
              <button class="btn-reply">QUICK REPLY</button>
              </a>
                      
                      <?php 
if(isset($_SESSION['user_loged_id']))
{
if($_SESSION['user_loged_id']==$reply_get['user_id'])
{    
?>
                      <a href="game-thread-quick-reply-<?php echo $reply_get['thread_reply_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread-reply.php?id=<?php echo $reply_get['thread_reply_id']; ?>" onClick="return confirmThreadReply();"><button class="btn-reply">Delete</button>  </a>
                      
    <?php
}
}
?>  
            
    <?php 
if(isset($_SESSION['FBID']))
{
 $user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
 if($user_facebook_id){
 $face_book_user=  mysql_fetch_array($user_facebook_id);
 $user_id=$face_book_user['id'];
 }
 if($user_id==$reply_get['user_id'])
 {
?>   
                      
<a href="game-thread-quick-reply-<?php echo $reply_get['thread_reply_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread-reply.php?id=<?php echo $reply_get['thread_reply_id']; ?>" onClick="return confirmThreadReply();"><button class="btn-reply">Delete</button>  </a>
 <?php
}
}
?>                      
            </div>
          </div>
  <?php
 }
}
?>
  
  
  
  <?php
$get_reply=getReplyByThreadByReply($thread_id);
if($get_reply>0)
{
    while($reply_get=  mysql_fetch_array($get_reply))
    {
        $thread_user=  getUserById($reply_get['user_id']);
        $userthread=  mysql_fetch_array($thread_user);
?>
  <div class="col-md-12 postdtl">
            
            <div class="col-md-3 post-display">
            <?php
if($userthread['user_name']!="")
{
?>
                <h3> <?php echo $userthread['user_name']; ?>  </h3>
                <?php
}else
{
?>
                <h3> <?php echo $userthread['name']; ?>  </h3>
                <?php    
}
?>
             
              <?php
    if($userthread['photo']!='')
    {
    ?>
              <img src="user_images/<?php echo $userthread['photo']; ?>" alt="" width="100" height="100"/>
              <?php
    }elseif(isset($_SESSION['FBID']))
    {
    ?>
              <img src="https://graph.facebook.com/<?php echo $userthread['Fuid'] ?>/picture" width="100" height="100">
              <?php
    }else{
    ?>
              <img src="images/user-avatar.png" alt="" width="100" height="100"/>
              <?php
    }
    ?>
              <p> join date:<?php echo date("d-M-Y",strtotime($userthread['registered']));?> <br/>
                location:<?php echo $userthread['address']; ?> <br/>
                Post:
                <?php $posts=countPostByUserId($userthread['id']); 
$totalposts=  mysql_fetch_array($posts);
echo $totalposts[0];
?>
           
                
                
                           
                <!--<button class="btn btn-xs" style="background:#f7b700; color:#fff; margin-left:40px; padding:3px 8px; font-weight:bold; font-size:1.2em;">REPLY</button>--> 
            </p></div>
            <div class="col-md-9 content-display">
              <h3><strong><?php echo $reply_get['reply_name'];?></strong></h3>
             <p><?php  echo $reply_get['reply_message'] ?></p>
              <br>
              <br>
              <a href="game-forum-quick-reply-<?php echo $thread_detail['thread_seo']; ?>">
              <button class="btn-reply">QUICK REPLY</button>
              </a>
                    
 <?php 
if(isset($_SESSION['user_loged_id']))
{
if($_SESSION['user_loged_id']==$reply_get['user_id'])
{
?>                    <a href="game-thread-edit-reply-<?php echo $reply_get['thread_reply_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread-reply.php?id=<?php echo $reply_get['thread_reply_id']; ?>" onClick="return confirmThreadReply();"><button class="btn-reply">Delete</button>  </a>
                      
<?php
}
}
?>  
            
    <?php 
if(isset($_SESSION['FBID']))
{
 $user_facebook_id=getUserByFaceBookId($_SESSION['FBID']);
 if($user_facebook_id){
 $face_book_user=  mysql_fetch_array($user_facebook_id);
 $user_id=$face_book_user['id'];
 }
if($user_id==$reply_get['user_id'])
{
?>
                      
<a href="game-thread-edit-reply-<?php echo $reply_get['thread_reply_id']; ?>"><button class="btn-reply">Edit</button></a>
                      
                      <a href="delete-thread-reply.php?id=<?php echo $reply_get['thread_reply_id']; ?>" onClick="return confirmThreadReply();"><button class="btn-reply">Delete</button>  </a>
 <?php
}
}
?>                      
            </div>
          </div>

  <?php
 }
}
?>

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
include("footer-toparea.php");
?>

<?php
include("footer.php");
?>






</body>
</html>