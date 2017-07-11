<?php
session_start();
include("dbconnection.php");
function getWords($text, $limit)
{
$array = explode(" ", $text, $limit+1);
if (count($array) > $limit)
{
unset($array[$limit]);
}
return implode(" ", $array);
}
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game search</title>
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

<div class="login-area">
	<div class="container">
    <div class="row">
    <div class="col-md-1 col-sm-1"></div>
     <div class="col-md-10 col-sm-10">
      <div class="leader-wrap" style="min-height:200px;"> 
  <h2>Search  <span>Result</span></h2>
  
  <div class="row">
      <?php 
  if(isset($_REQUEST['search']))
  {
  $search_name=$_REQUEST['search'];

  $search_results=getGamesBySearch($search_name);
  if($search_results>0)
  {
   while($search_result=  mysql_fetch_array($search_results))
   {  
  ?>   
  <div class="col-md-4 col-sm-4 col-xs-12">
  <div class="search-box">
  <div class="border-line">
  <img width="221" height="125" alt="" class="img-responsive" src="silverhat_games/game_image/<?php echo $search_result['game_image']; ?>">
  </div>
  <div class="clearfix"></div>
  <h3><?php echo $search_result['game_name']; ?></h3>
  <p><?php $mycontent = $search_result['game_description'];
  echo getWords($mycontent, 18)."..."; ?></span> 
 <a href="maverick-game-<?php echo $search_result['game_seo'];  ?>">MORE</a></p>
  </div>
  </div>
 <?php
  }
  }
  }else if(isset($_REQUEST['search'])=='Maverick Games')
  {
  $search_results=getAllMaverickGames();
  if($search_results>0)
  {
   while($search_result=  mysql_fetch_array($search_results))
   {  
 ?>
 <div class="col-md-4 col-sm-4 col-xs-12">
  <div class="search-box">
  <div class="border-line">
  <img width="221" height="125" alt="" class="img-responsive" src="silverhat_games/game_image/<?php echo $search_result['game_image']; ?>">
  </div>
  <div class="clearfix"></div>
  <h3><?php echo $search_result['game_name']; ?></h3>
  <p><?php $mycontent = $search_result['game_description'];
        echo getWords($mycontent, 18)."..."; ?></span> 
 <a href="maverick-game-<?php echo $search_result['game_seo'];  ?>">MORE</a></p>
  </div>
  </div>
 <?php
  }
  }
  }else
  {
  ?>  
      <p>Not Found.</p>
 <?php     
  }
  ?>
  
  
  
  

  
   </div>
   
</div>
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