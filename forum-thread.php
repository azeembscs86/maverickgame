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
$seo=substr($seo, 18);
$subforum=getSubForumBySeo($seo);
$subforums=  mysql_fetch_array($subforum);
$sub_forum_id=$subforums['discussion_forum_id'];
?>
<!DOCTYPE HTML>
<html>
<head>

<title><?php echo $subforums['discussion_forum_title'];  ?></title>
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
      <div class="leader-wrap" style="min-height:425px;"> 
      <div class="breadcrum"><a href="maverick-game-dicussion-forum" style="color:#FFFFFF;">Game Discussion Forum</a></div>
      <div class="col-lg-8">
  <h3 class="white">Welcome to <span>Game Discussion</span></h3>
  </div>
  
   <?php 
$strictthreads=getStrictThreadsBySubForumId($sub_forum_id);
if($strictthreads>0)
{
    while($strictthread=  mysql_fetch_array($strictthreads))
    {
        ?>
   <table class="table-responsive table-bordered table-condensed table-detail">
   
  <tbody>
    <tr>
      <td><img src="assets/images/forum/envelope.png"></td>
      <td class="width30"><div class="main-topic">
              <?php 
            if($strictthread['isStrict']=='yes')
            {
            ?>
            <strong>Sticky:<span class="tabletd"><a href="game-forum-post-<?php echo $strictthread['thread_seo']; ?>"><?php echo $strictthread['thread_name']; ?></a></span></strong>
            <?php
    }else
    {
    ?>
     <span class="tabletd"><a href="game-forum-post-<?php echo $strictthread['thread_seo']; ?>"><?php echo $strictthread['thread_name']; ?></a></span>
       <?php
    }
    ?>
              
              </div></td>
      <td class="width54"><span class="tabletd"><a href="game-forum-post-<?php echo $strictthread['thread_seo']; ?>">
                    <?php            
                   $string = strip_tags($strictthread['thread_message']);
if (strlen($string) > 100) {

    // truncate string
    $stringCut = substr($string, 0, 100);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
}
echo $string;  
        if($strictthread['user_id']>0){
        $user_detail=  getUserById($strictthread['user_id']);
        $user=  mysql_fetch_array($user_detail);
        echo "<br> by ";
        ?>
        <span style='color: #688031'><?php echo $user['name']; ?><br></span>
        <?php      
        echo date("d-m-y",strtotime($strictthread['createdAt']));
        }
        ?>
             </a></td>
      <td class="text-center width8"><span class="tabletd"> <?php
$counter = 0;
if(! isset($_SESSION['visited'])):
        $counter +=1;
        $_SESSION['visited'] = TRUE;
        $_SESSION['counter'] = $counter;
endif;
echo $_SESSION['counter'];
?> </span></td>
      <td class="text-center width8a"><span class="tabletd"> <?php 
         $last_postt=countAllRepliesByThread($strictthread['thread_id']); 
         $lastpost=  mysql_fetch_array($last_postt);
         echo $lastpost[0];
        ?></span></td>
    </tr>
  </tbody>
</table>
<?php        
    }
}
?>
  
 <?php 
$threads=getThreadsBySubForumId($sub_forum_id);
if($threads>0)
{
    while($thread=  mysql_fetch_array($threads))
    {
        ?>  
<table class="table-responsive table-bordered table-condensed table-detail wid-20">
<thead><tr>
<th><a href="new-thread-<?php echo $subforums['discussion_forum_seo']; ?>" class="new-thread">
   Post New Threads
   </a></th>
    <th><span class="tableformyelo">FORUM</span></td>
    <th><span class="tableform">LATEST POST</span></td>
    <th><span class="tableform">VIEW</span></td>
    <th><span class="tableform">REPLY</span></td>
  </tr>
</thead>
  <tbody>
  <tr>
  <td colspan="5" class="nopad"><h1 class="forum-hd1 white">Gaming Forums</h1></td>
  </tr>
    <tr>
      <td class="text-center"><img src="assets/images/forum/envelope.png"></td>
      <td class="width30"><div class="main-topic"><a href="game-forum-post-<?php echo $thread['thread_seo']; ?>"><?php echo $thread['thread_name']; ?></a></span> </div></td>
      <td class="width54"><span class="tabletd"> <a href="game-forum-post-<?php echo $thread['thread_seo']; ?>">
                    <?php            
                   $string = strip_tags($thread['thread_message']);
if (strlen($string) > 100) {

    // truncate string
    $stringCut = substr($string, 0, 100);

    // make sure it ends in a word so assassinate doesn't become ass...
    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
}
echo $string;  
        if($thread['user_id']>0){
        $user_detail=  getUserById($thread['user_id']);
        $user=  mysql_fetch_array($user_detail);
        echo "<br> by ";
        ?>
        <span style='color: #688031'><?php echo $user['name']; ?><br></span>
        <?php      
        echo date("d-m-y",strtotime($thread['createdAt']));
        }
        ?>
             </a></td>
      <td class="text-center width8"><span class="tabletd"> <?php
$counter = 0;
if(! isset($_SESSION['visited'])):
        $counter +=1;
        $_SESSION['visited'] = TRUE;
        $_SESSION['counter'] = $counter;
endif;
echo $_SESSION['counter'];
?> </span></td>
      <td class="text-center width8a"><span class="tabletd"> <?php 
         $last_postt=countAllRepliesByThread($thread['thread_id']); 
         $lastpost=  mysql_fetch_array($last_postt);
         echo $lastpost[0];
        ?></span></td>
    </tr>
  </tbody>
</table>  
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