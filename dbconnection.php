<?php
//------------------------Variable for Server name,Database,User name,Password--------------------------------
error_reporting(E_ALL ^ E_DEPRECATED);
//------------------------Variable for Server name,Database,User name,Password--------------------------------
    $adb ="maverick_silverhat";
    $db_server ="localhost";
    $db_user = "root";
    $db_password = "";
 $link_db=mysql_connect($db_server,$db_user,$db_password);
 if(!$link_db) {
        die('Failed to connect to server: ' . mysql_error());
    }
 $db=mysql_select_db($adb,$link_db);    
    if(!$db) {
        die('Unable to select database:'.mysql_error());
    }
date_default_timezone_set("Asia/Karachi"); 

function clean($str){
$str = @trim($str);
if(get_magic_quotes_gpc()) {
$str = stripslashes($str);
}
return mysql_real_escape_string($str);
}  
//-------------------------------------- code for activation-------------------------------    

function SSL_page() 
{ 
   if ($_SERVER['HTTPS'] != 'on') 
   { 
      header("Location: https://{$_SERVER['HTTP_HOST']}". 
                               "{$_SERVER['REQUEST_URI']}"); 
      exit(); 
   } 
}  


function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
		$possible = '1234567890abcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 4);
			$i++;
		}
		return $code;
	}
        
      
//---------------------------------register new user-------------------------------------------------------------
 function  registerNewUser($name,$email,$user_name,$password,$gender,$birth_date,$location,$phone_number,$activation,$verificationcode,$android_app,$country_id,$city_id)
 {   
   $createdAt=  date('Y-m-d H:i:s');
    $updatedAt=  date("Y-m-d");   
    if($gender=='male')
    {
        $user_image='male.jpg';
    }else
    {
        $user_image='female.jpg';
    }  
 echo    $query="insert into glogin_users(name,email,user_name,password,registered,updatedAt,birth_date,isActive,address,mobile_number,gender,activation,verificationcode,resitration_type,photo,country_id,city_id) values('$name','$email','$user_name','$password','$createdAt','$updatedAt','$birth_date','no','$location','$phone_number','$gender','$activation','$verificationcode','$android_app','$user_image',$country_id,$city_id)";
 exit;
 mysql_query($query) or die(mysql_error());
 }
 
 //---------------------------------register new user-------------------------------------------------------------
 function  Userlogin($email,$password)
 {  
    $query="select id,name,email,user_name,password,mobile_number,gender,updatedAt,activation,verificationcode,isActive,birth_date,address,photo,islogin from glogin_users where (email='$email' or user_name='$email') and password='$password'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;  
 }
 
 //--------------------------------------get User By Email-----------------------------------------------------------
 function getUserByEmail($email)
 {
     $query="select id,name,email,user_name,password,mobile_number,gender,registered,updatedAt,activation,verificationcode,isActive,birth_date,address,photo from glogin_users where email='$email'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;  
 }
 //-------------------------------------get user by verification code--------------------------------------------------
 function getUserByVerificationCode($passkey)
 {
    $query="select id,name,email,user_name,password,mobile_number,gender,registered,updatedAt,activation,verificationcode,isActive,birth_date,address,photo from glogin_users where verificationcode='$passkey'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;  
 }
 
 
 
 
 //----------------------------update password------------------------------------------------
 function updateUserPassword($email,$newpassword)
 {
    $query="update glogin_users set password='$newpassword' where email='$email'";
    mysql_query($query) or die(mysql_error());
 }
 //---------------------------check face book user-----------------------------------------------------
 function checkFaceBookUser($fuid,$ffname,$femail){
    	$check = mysql_query("select * from glogin_users where Fuid=$fuid");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	echo $query = "INSERT INTO glogin_users (Fuid,name) VALUES ('$fuid','$ffname')";
	exit;
	mysql_query($query) or die(mysql_error());	
	} else {   // If Returned user . update the user record		
	
	echo $query = "UPDATE glogin_users SET name='$ffname' where Fuid='$fuid'";
	exit;
	mysql_query($query) or die(mysql_error());	
	}
}



//---------------------get User By Id---------------------------------------------------------------------
function getUserById($user_loged_id)
{
    $query="select id,name,email,user_name,password,mobile_number,gender,registered,updatedAt,activation,verificationcode,isActive,birth_date,address,photo from glogin_users where id=$user_loged_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//------------------------------------------------get user By Facebook Id------------------------------------------------
function getUserByFbId($session_id)
{
  $query="select id,name,email,user_name,password,mobile_number,gender,registered,updatedAt,activation,verificationcode,isActive,birth_date,address,photo,Fuid from glogin_users where Fuid='$session_id'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;   
}
//-----------------------------get User By user name--------------------------------------------------------
function getUserByUserName($user_name)
{
   $query="select id,name,email,user_name,password,mobile_number,gender,registered,updatedAt,activation,verificationcode,isActive,birth_date,address,photo from glogin_users where user_name='$user_name'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result; 
}

//------------------------------update user---------------------------------------------------------------
function updateUser($user_id,$user_name,$email,$name,$gender,$phone_number)
{
   $updatedAt=  date("Y-m-d");  
  $query="update glogin_users set user_name='$user_name',email='$email',mobile_number='$phone_number',name='$name',gender='$gender',updatedAt='$updatedAt' where id=$user_id";
  mysql_query($query) or die(mysql_error());
}
//----------------------------------update app user----------------------------------------------------------------------------------------
function updateAppUser($user_id,$name,$user_name,$phone,$profile_image)
{
 $updatedAt=  date("Y-m-d");  
  $query="update glogin_users set user_name='$user_name',mobile_number='$phone',name='$name',photo='$profile_image',updatedAt='$updatedAt' where id=$user_id";
  mysql_query($query) or die(mysql_error());
}



//------------------------------update user----------------------------------------------------------------
function updateUserImage($user_id,$user_image)
{
   $updatedAt=  date("Y-m-d");  
   $query="update glogin_users set photo='$user_image' where id=$user_id";
   mysql_query($query) or die(mysql_error());
}


//--------------------------------update user password-----------------------------------------------------
function changeUserPassword($user_id,$new_password)
{
   $updatedAt=  date("Y-m-d"); 
   $query="update glogin_users set password='$new_password',updatedAt='$updatedAt' where id=$user_id"; 
   mysql_query($query) or die(mysql_error());
}



function updateAppUserPassword($email,$password,$verificationcode)
{
  $updatedAt=  date("Y-m-d"); 
   $query="update glogin_users set password='$password',verificationcode='$verificationcode',updatedAt='$updatedAt' where email='$email'"; 
   mysql_query($query) or die(mysql_error());
}

//-----------------------get All Games-------------------------------------------------------------------
function getAllGames()
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,game_slider,thumb_game_image FROM silverhat_games  where isActive='yes' order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}


//-----------------------get All Games-------------------------------------------------------------------
function getAllScoresGames()
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,game_slider,thumb_game_image FROM silverhat_games order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}

function getAllViewGames()
{
    $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,thumb_game_image FROM silverhat_games where isActive='yes' order by RAND() limit 0,3"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-----------------------get Game By Id----------------------------------------------------------------
function getGameById($game_id)
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description,game_price,game_point_ratio, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,thumb_game_image,game_score_limit FROM silverhat_games where game_id=$game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}

//-------------------------game webservice------------------------------------------------------------------
function getAllGameWebservice()
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image FROM silverhat_games order by createdAt"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}

//-------------------------------get Game By id webservice----------------------------------------------------
function getGameByIdWebService($game_id)
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image FROM silverhat_games where game_id=$game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;  
}
//---------------------------------get featured games-----------------------------------------------------------
function getFeaturedGames()
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image FROM silverhat_games where isFeatured='yes' and isActive='yes' order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;  
}

//----------------------------------get Top header images-------------------------------------------------------
function getGameTopHeader()
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image FROM silverhat_games order by rand() limit 0,1"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;    
}

function getUserWebServiceById($user_id)
{
    $query="select id,name,email,user_name from glogin_users where id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------get game By id Web services-----------------------------------------------------------
function getGameWebServiceById($game_id)
{
    $query="SELECT game_id, game_name FROM silverhat_games where game_id=$game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;  
}
//--------------------------get Score By Id-----------------------------------------------------------------
function getGameScoreByScoreId($game_id)
{
   $query="select game_id,user_id,score_id,game_score as game_score,createdAt,updateAt,isgarbeg from game_scores where game_id=$game_id and isgarbeg='no' order by game_score DESC LIMIT 0,10";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//--------------------------insert game score----------------------------------------------------------------------
function addNewGameScore($game_id,$user_id,$game_score)
{
    $createdAt=  date("Y-m-d H:i:s");
    $updatedAt=  date("Y-m-d H:i:s");
    $query="insert into game_scores(game_id,user_id,game_score,createdAt,updateAt) values($game_id,$user_id,$game_score,'$createdAt','$updatedAt')"; 
    mysql_query($query) or die(mysql_error());
    if (mysql_query($sQuery))
    {
        echo "Record inserted";
}
else
{
echo "Error inserting record: " . mysql_error();
}
}
function updateGameScore($game_id,$user_id,$game_score)
{
    $updatedAt=  date("Y-m-d H:i:s");
    $query="update game_scores set game_score=$game_score,updateAt='$updatedAt' where game_id=$game_id and user_id=$user_id";
    mysql_query($query) or die(mysql_error());
}
function getGameByFile($game_file)
{
   $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image FROM silverhat_games where game_file='$game_file'";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//------------------------------------search for games----------------------------------------------------------
function getGamesBySearch($search_name)
{
  $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,thumb_game_image FROM silverhat_games where game_name like '%$search_name%'";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result; 
}
//-----------------------------get All Maverick Games---------------------------------------------------------
function getAllMaverickGames()
{
    $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,thumb_game_image FROM silverhat_games where isActive='yes'";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result; 
}

//---------------------------------get Maverick game Packages-------------------------------------------------
function getMaverickGamePackages()
{
   $query="select package_id,package_name,package_image,createdAt,updatedAt,expiredAt,package_coins,package_price,package_description,package_type,isActive from maverick_packages order by package_type";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}


function getGameScoreByUser($user_id,$game_id)
{
    $query="select game_score from game_scores where game_id=$game_id and user_id=$user_id order by game_score DESC limit 0,1";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}

//-------------------------get game  by seo name----------------------------------------------------------
function getGameBySeo($seo)
{
    $query="SELECT game_id, game_name, game_image, game_home_image,game_background_image, game_description, game_file, isActive, createdAt, updatedAt, isFeatured, game_seo, meta_tag_keywords, meta_tag_description,game_top_header,game_leaderboard_image,game_instrustion_image,game_seo_title FROM silverhat_games where game_seo='$seo'"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}


//-------------------------------------get Disscussion forum---------------------------------------------
function getDiscussionForum()
{
  $query="select discussion_forum_id,discussion_forum_title,isActive,isStrict,createdAt,updatedAt,discussion_forum_seo,forum_description,discussion_simlies from game_discussion_forum order by discussion_forum_id DESC";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result;
}

//--------------------------get Latest Thread By Sub Forum-------------------------------------------
function getLastThreadBySubForum($mom_sub_forum_id)
{
  $query="select discussion_forum_id,user_id,thread_id,thread_name,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive from discussion_forum_threads where discussion_forum_id=$mom_sub_forum_id order by thread_id desc limit 0,1";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;  
}


//----------------------------get thread recent post------------------------------------------------------------
function getRecentThreadPost()
{
   $query="select discussion_forum_id,user_id,thread_id,thread_name,thread_message,createdAt,updatedAt,thread_seo from discussion_forum_threads order by thread_id DESC limit 0,7";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}

//-----------------------------count post by User Id------------------------------------------------
function countPostByUserId($user_id)
{
   $query="select COUNT(thread_reply_id) FROM discussion_forum_replies where user_id=$user_id";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;  
}

//--------------------------------get Subforum By Seo-------------------------------------------------------------
function getSubForumBySeo($momforum_seo)
{
    $query="select discussion_forum_id,discussion_forum_title,isActive,isStrict,createdAt,updatedAt,discussion_forum_seo,forum_description,discussion_simlies from game_discussion_forum where discussion_forum_seo='$momforum_seo'";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result;
}

function getSubForumByThreads($mom_sub_forum_id)
{
  $query="select discussion_forum_id,discussion_forum_title,isActive,isStrict,createdAt,updatedAt,discussion_forum_seo,forum_description,discussion_simlies from game_discussion_forum where discussion_forum_id=$mom_sub_forum_id";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result;    
}
//------------------------------------get Strict thread Forum Id--------------------------------------------------------
function getStrictThreadsBySubForumId($sub_forum_id)
{
  $query="select discussion_forum_id,user_id,thread_id,thread_name,isStrict,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive,thread_seo,thread_image from discussion_forum_threads where discussion_forum_id=$sub_forum_id and isStrict='yes'  order by thread_id DESC";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;
}

//-----------------------count thread replies-----------------------------------

function countAllRepliesByThread($thread_id)
{
   $query="select COUNT(thread_reply_id) FROM discussion_forum_replies where threadd_id=$thread_id";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;  
}


//------------------------------------get thread Forum Id--------------------------------------------------------
function getThreadsBySubForumId($sub_forum_id)
{
  $query="select discussion_forum_id,user_id,thread_id,thread_name,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive,thread_seo,thread_image from discussion_forum_threads where discussion_forum_id=$sub_forum_id and isStrict='no' order by thread_id DESC";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;
}

function getSubForumByThread($mom_sub_forum_id)
{
  $query="select discussion_forum_id,user_id,thread_id,thread_name,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive,thread_seo,thread_image from discussion_forum_threads where discussion_forum_id=$mom_sub_forum_id";
  $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

//----------------------------get thread By Id----------------------------------------------------
function getThreadBySeo($seo)
{
    $query="select discussion_forum_id,user_id,thread_id,thread_name,isStrict,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive,thread_seo,thread_image from discussion_forum_threads where thread_seo='$seo'";
   $result=  mysql_query($query) or die(mysql_error());
  return $result;  
}

function getReplyByThreadByQoute($thread_id)
{
  $query="select threadd_id,user_id,thread_reply_id,reply_name,reply_message,reply_tags,reply_trackback,createdAt,updatedAt,isActive,reply_image,reply_type from discussion_forum_replies where threadd_id=$thread_id and reply_type='quote'";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;
}

function getReplyByThreadByReply($thread_id)
{
  $query="select threadd_id,user_id,thread_reply_id,reply_name,reply_message,reply_tags,reply_trackback,createdAt,updatedAt,isActive,reply_image,reply_type from discussion_forum_replies where threadd_id=$thread_id and reply_type='reply'";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;  
}

function addnewThreads($sub_forum_id,$user_id,$thread_name,$thread_message,$thread_seo)
{
  $createdAt=  date("Y-m-d");
   $updatedAt=  date("Y-m-d");   
   $query="insert into discussion_forum_threads(discussion_forum_id,user_id,thread_name,thread_message,createdAt,updatedAt,thread_seo,isActive)values($sub_forum_id,$user_id,'$thread_name','$thread_message','$createdAt','$updatedAt','$thread_seo','no')";
    mysql_query($query) or die(mysql_error());
}

//-------------------------------------
function addNewQuickThreadReplys($thread_id,$user_id,$thread_name,$thread_message,$mom_sub_forum_id)
{
   $createdAt=  date("Y-m-d");
   $updatedAt=  date("Y-m-d");     
   $query="insert into discussion_forum_replies(threadd_id,user_id,reply_name,reply_message,createdAt,updatedAt,reply_type,discussion_forum_id,isActive)values($thread_id,$user_id,'$thread_name','$thread_message','$createdAt','$updatedAt','quote',$mom_sub_forum_id,'no')";
   mysql_query($query) or die(mysql_error());
}


//-----------------------update thread--------------------------------------------------------
function updateThreads($thread_id,$thread_name,$thread_message,$thread_seo)
{
   $query="update discussion_forum_threads set thread_name='$thread_name',thread_message='$thread_message',thread_seo='$thread_seo' where thread_id=$thread_id";
   mysql_query($query) or die(mysql_error());
}  

//----------------------------get thread By Id----------------------------------------------------
function getThreadById($thread_id)
{
   $query="select discussion_forum_id,user_id,thread_id,thread_name,thread_message,thread_tags,thread_trackback,createdAt,updatedAt,isActive,thread_image,thread_seo from discussion_forum_threads where thread_id=$thread_id";
  $result=  mysql_query($query) or die(mysql_error());
  return $result;  
}

//------------------------------delete thread---------------------------------------------------
function deletethread($thread_id){
   $query="delete from discussion_forum_threads where thread_id=$thread_id";
    mysql_query($query) or die(mysql_error());
}

//-----------------------------delete post-------------------------------------------------------
function deletethreadReply($thread_id)
{
    $query="delete from discussion_forum_replies where thread_reply_id=$thread_id";
    mysql_query($query) or die(mysql_error());
}

//--------------------------------Add new Thread--------------------------------------------------------------------
function addNewThreadReplys($thread_id,$user_id,$thread_name,$thread_message,$mom_sub_forum_id)
{
  $createdAt=  date("Y-m-d");
  $updatedAt=  date("Y-m-d"); 
  $query="insert into discussion_forum_replies(threadd_id,user_id,reply_name,reply_message,createdAt,updatedAt,reply_type,discussion_forum_id,isActive)values($thread_id,$user_id,'$thread_name','$thread_message','$createdAt','$updatedAt','reply',$mom_sub_forum_id,'no')";
  mysql_query($query) or die(mysql_error());
}

//--------------------------get Post By ID-----------------------------------------------------
function getThreadReplyById($thred_reply_id)
{
  $query="select threadd_id,user_id,thread_reply_id,reply_name,reply_message,reply_tags,reply_trackback,createdAt,updatedAt,isActive,reply_image,reply_type,discussion_forum_id from discussion_forum_replies where thread_reply_id=$thred_reply_id";  
  $result=  mysql_query($query) or die(mysql_error());
  return $result;  
}

//-----------------------------update post----------------------------------------------------
function updateThreadReplys($thread_reply_id,$thread_name,$thread_message)
{
  $createdAt=  date("Y-m-d");
  $updatedAt=  date("Y-m-d"); 
  $query="update discussion_forum_replies set reply_name='$thread_name',reply_message='$thread_message' ,updatedAt='$updatedAt' where thread_reply_id=$thread_reply_id";
  mysql_query($query) or die(mysql_error());
}

function resetPassword($userId,$email,$password,$verificationcode)
{           	
   	$query="update glogin_users set password='$password', verificationcode='$verificationcode' where id=$userId";
   	mysql_query($query) or die(mysql_error());
}
//-------------------------------get user points by id--------------------------------------------------
function getUserGameCoins($user_id)
{
    $query  ="select user_id,game_coins_id,registration_coins,createdAt,heightest_score_coins,heightest_score_coins_date,utilize_coins,utilize_coins_date,total_coins from user_game_coins where user_id=$user_id";
    $result =  mysql_query($query) or die(mysql_error());
    return $result;  
}
//-------------------insert user points----------------------------------------------------------------
function createUserGameCoins($user_id,$registration_points)
{
   $createdAt=  date("Y-m-d");
   $query="insert into user_game_coins (user_id,registration_coins,createdAt,total_coins) values ($user_id,$registration_points,'$createdAt',$registration_points)";
   mysql_query($query) or die(mysql_error());
}
//-------------------------------get last insert user----------------------------------------------------
function getLastRegisterUser()
{
   $query="SELECT id FROM glogin_users ORDER BY id DESC LIMIT 1"; 
   $result =  mysql_query($query) or die(mysql_error());
   return $result; 
}
//--------------------------update user points-------------------------------------------------------------
function updateUserCoins($user_id,$heightest_score_point,$total_points)
{
  $updatedAt= date("Y-m-d");   
  $query="update user_game_coins set heightest_score_coins=$heightest_score_point,heightest_score_coins_date='$updatedAt',total_coins=$total_points where user_id=$user_id";
  mysql_query($query) or die(mysql_error());
}
//----------------------------create user high score points----------------------------------------------
function createUserHightScoreCoins($user_id,$heightest_score_point,$total_points)
{
   $createdAt=  date("Y-m-d");
   $query="insert into user_game_coins (user_id,heightest_score_coins,createdAt,heightest_score_coins_date,total_coins) values ($user_id,$heightest_score_point,'$createdAt','$createdAt',$total_points)";
   mysql_query($query) or die(mysql_error());
}
//-----------------------------get heightest score-----------------------------------------------------------
function getGameHightestScore()
{
    $query  ="SELECT MAX(game_score) AS game_score FROM game_scores";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//------------------------------get user by max score--------------------------------------------
function getUserByMaxScore($max_score)
{
    $query  ="SELECT user_id,updateAt FROM game_scores where game_score=$max_score";
    $result = mysql_query($query) or die(mysql_error());
    return $result;  
}
//-----------------------------get game price by id-----------------------------------------------
function getGameCoinById($game_id)
{
    $query="select game_id,game_price from silverhat_games where game_id=$game_id";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//-----------------------------update game coins after utilize-------------------------------------
function updateUtilizeGameCoins($user_id,$utilize_coins,$total_coins)
{
  $updatedAt= date("Y-m-d");   
  $query="update user_game_coins set utilize_coins=$utilize_coins,utilize_coins_date='$updatedAt',total_coins=$total_coins where user_id=$user_id";
  mysql_query($query) or die(mysql_error());
}
//------------------------------get points by user and game-----------------------------------------
function getPointsByUserGame($game_id,$user_id)
{
   $query="select user_id,game_id,user_point_id,total_points,utilize_points,createdAt,updatedAt,utilize_points_date,over_all_points from user_points where user_id=$user_id AND game_id=$game_id";
   $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------add new user game points------------------------------------------------
function addNewUserPoints($user_id,$game_id,$total_points,$over_all_points)
{
   $createdAt = date("Y-m-d");
   $updatedAt = date("Y-m-d");
   $query="insert into user_points(user_id,game_id,total_points,over_all_points,createdAt,updatedAt) values ($user_id,$game_id,$total_points,$over_all_points,'$createdAt','$updatedAt')";
   mysql_query($query) or die(mysql_error());
}
//---------------------------------update user game points-------------------------------------------
function updateUserPoints($user_id,$game_id,$total_points,$over_all_points)
{
    $updatedAt = date("Y-m-d");
    $query="update user_points set total_points=$total_points,over_all_points=$over_all_points ,updatedAt='$updatedAt' where user_id=$user_id and game_id=$game_id";
    mysql_query($query) or die(mysql_error());
}
//---------------------------------set points after redeem award-----------------------------------------
function updateUserPointsReward($user_id,$utlize_points,$total_points)
{
    $updatedAt = date("Y-m-d");
    $query="update user_points set utilize_points=$utlize_points , total_points=$total_points , updatedAt='$updatedAt' where user_id=$user_id";
    mysql_query($query) or die(mysql_error());
}
//---------------------------------get user points by user id-----------------------------------------------
function getUserPointsByUserId($user_id)
{
    $query="select user_id,game_id,user_point_id,total_points,utilize_points,createdAt,updatedAt from user_points where user_id=$user_id order by user_point_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//-------------------------------get points leader board---------------------------------------------------
function getUserPointsLeaderBoard()
{
    $query="select user_id,game_id,user_point_id,total_points,utilize_points,createdAt,updatedAt,utilize_points_date,over_all_points from user_points order by total_points DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------get maverick games list for games------------------------------------------------------
function getMaverickGamesList()
{
    $query="select game_id,game_name from silverhat_games";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------get Score By Id-----------------------------------------------------------------
function getGameWebScoreByScoreId($game_id)
{
   $query="SELECT gu.id AS user_id,gu.photo AS user_image,gu.user_name AS user_name,gs.game_score AS game_score
FROM
    game_scores gs
     INNER JOIN glogin_users gu
        ON (gs.user_id = gu.id) WHERE gs.game_id=$game_id order by game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//--------------------------get Score By Id-----------------------------------------------------------------
function getGameWebUserId($user_id)
{
   $query="select id,photo,user_name from glogin_users where id=$user_id";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//-----------------------get coins by user id---------------------------------------------------------------
function getCoinsByUserId($user_id)
{
    $query="select total_coins from user_game_coins where user_id=$user_id";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//-------------------------count user points--------------------------------------------------------------------
function countUserPointsByUserId($user_id)
{
    $query="select user_id,updatedAt,SUM(total_points) AS total_points from user_points where user_id=$user_id";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get Score By Id-----------------------------------------------------------------
function getLeadderBoard($game_id)
{
   $query="SELECT gu.name as name,gu.id AS user_id,gu.photo AS user_image,gu.user_name AS user_name,gu.gender as gender,gs.game_score AS game_score
   FROM game_scores gs
   INNER JOIN glogin_users gu
   ON (gs.user_id = gu.id) WHERE gs.game_id=$game_id order by game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//----------------------------get all games leader board----------------------------------------------------
function getAllGamesLeaderBoard()
{
    $query="SELECT gu.name as name,gu.id AS user_id,gu.photo AS user_image,gu.user_name AS user_name,gu.gender as gender,gs.game_score AS game_score
   FROM game_scores gs
   INNER JOIN glogin_users gu
   ON (gs.user_id = gu.id) order by game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//---------------------get distinct user from score board-----------------------------------------------
function getDistinctGameScoreUser()
{
    $query="SELECT DISTINCT(gs.user_id) AS user_id FROM
    game_scores gs
    INNER JOIN glogin_users gu
        ON (gs.user_id = gu.id)
    INNER JOIN silverhat_games sg 
        ON (gs.game_id = sg.game_id)  ORDER BY gs.game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------------------------count games score from user-------------------------------
function countGameScoreByUserId($user_id)
{
   $query="select sum(game_score) as game_score from game_scores where user_id=$user_id order by game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-------------------------count scor by game id and user id----------------------------------------
function countGameScoreByGameIdUserId($user_id,$game_id)
{
    $query="select user_id,sum(game_score) as game_score from game_scores where user_id=$user_id and game_id=$game_id order by game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-------------------------------count distints user from point--------------------------------------
function getDistinctUserPoints()
{
    $query="SELECT DISTINCT(up.user_id) AS user_id
FROM
    user_points up
    INNER JOIN glogin_users gu 
        ON (up.user_id = gu.id)
    INNER JOIN silverhat_games sg
        ON (up.game_id = sg.game_id) order by over_all_points DESC";
    $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//---------------------------------count user points by user id------------------------------------
//--------------------------------------------count games score from user-------------------------------
function countUserPointByUserId($user_id)
{
   $query="select user_id,sum(total_points) as over_all_points from points_score_leaderboard where user_id=$user_id order by total_points DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//----------------------count utlize point by user---------------------------------------
function countUtilizeUserPointByUserId($user_id)
{
   $query="select sum(utilize_points) as utilize_points from user_points where user_id=$user_id order by utilize_points DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------------------------count games score from user-------------------------------
function countWeekUserPointByUserId($user_id,$week_date)
{
   $query="select sum(over_all_points) as over_all_points from user_points where user_id=$user_id and (updatedAt > '$week_date' or createdAt>'$week_date') order by over_all_points DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-----------------------get daily leader board-------------------------------------------
function countDailyUserPointByUserId($user_id,$current_date)
{
   $query="select sum(over_all_points) as over_all_points from user_points where user_id=$user_id AND (updatedAt ='$current_date' or createdAt='$current_date') order by over_all_points DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-------------------------------count distints user from point--------------------------------------
function getWeeklyDistinctUserPoints()
{
    $week_date=date('Y-m-d', strtotime('-7 days'));
    $query="SELECT DISTINCT(up.user_id) AS user_id
FROM
    user_points up
    INNER JOIN glogin_users gu 
        ON (up.user_id = gu.id)
    INNER JOIN silverhat_games sg
        ON (up.game_id = sg.game_id) where up.createdAt>'$week_date' or up.updatedAt>'$week_date' order by over_all_points DESC";
    $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------get daily distinct user points-------------------------------------------
function getDailyDistinctUserPoints()
{
    $week_date=date("Y-m-d");
    $query="SELECT DISTINCT(up.user_id) AS user_id
FROM
    user_points up
    INNER JOIN glogin_users gu 
        ON (up.user_id = gu.id)
    INNER JOIN silverhat_games sg
        ON (up.game_id = sg.game_id) where up.createdAt='$week_date' or up.updatedAt='$week_date' order by over_all_points DESC";
    $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//---------------------------get all rewards list---------------------------------------------------
function getAllRewardList()
{
   $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward order by reward_id desc";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-----------------count user for redem rewards---------------------------------------------
function countUserRedemRewardPoints($user_id)
{
    $query="select sum(total_points) as total_points from user_points where user_id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}


//-----------------------------------get user redeem points------------------------------------------
function getUserRedeemPointByUserId($user_id)
{
    $query="SELECT mgr.reward_name AS reward_name,rp.utilize_points AS utilize_points,rp.utilize_points_date AS utilize_points_date
FROM
    reward_redeem_point rp
    INNER JOIN maverick_game_reward mgr 
        ON (rp.reward_id = mgr.reward_id) WHERE rp.user_id=$user_id order by rp.reward_redeem_points_id desc";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------count user redeem points--------------------------------------------------
function countUserRedeemPointsByUserId($user_id)
{
    $query="select utilize_points_date,sum(utilize_points) as utilize_points from reward_redeem_point where user_id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------get user leader board-------------------------------------------------------
function getGameScoreLeaderBoardByUserId($user_id)
{
   $query="select user_id,leader_board_id,createdAt,updatedAt,leader_board_score from game_score_leaderboard where user_id=$user_id";
   $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//-------------------------add new game score leader board-----------------------------------------------------------------
function addNewGameScoreLeaderBoard($user_id,$game_score)
{
    $createdAt = date("Y-m-d");
    $updatedAt = date("Y-m-d");
    $query="insert into game_score_leaderboard(user_id,createdAt,updatedAt,leader_board_score) values ($user_id,'$createdAt','$updatedAt',$game_score)";
    mysql_query($query)or die(mysql_error());    
}
//-------------------------update game score leader board----------------------------------------------------
function updateGameScoreLeaderBoard($user_id,$game_score)
{
    $updatedAt = date("Y-m-d h:i:s");
    $query="update game_score_leaderboard set leader_board_score=$game_score, updatedAt='$updatedAt' where user_id=$user_id";
     mysql_query($query)or die(mysql_error());
}
//-----------------------get points leader board by user id--------------------------------------------------
function getPointsLeaderBoardByUserId($user_id)
{
   $query="select user_id,point_leader_id,createdAt,updatedAt,total_points,current_point,week_points from points_score_leaderboard where user_id=$user_id";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//------------------------------------ add new point leader board---------------------------------------------
function addNewPointLeaderBoard($user_id,$leader_borad_score,$current_point,$week_points)
{
    $createdAt = date("Y-m-d");
    $updatedAt = date("Y-m-d");
    $query="insert into points_score_leaderboard(user_id,createdAt,updatedAt,total_points,current_point,week_points) values ($user_id,'$createdAt','$updatedAt',$leader_borad_score,$current_point,$week_points)";
    mysql_query($query)or die(mysql_error());     
}
//----------------------------update points leader board-----------------------------------------------------
function updatePointLeaderBoard($user_id,$leader_borad_score,$current_point,$week_points)
{
    $updatedAt = date("Y-m-d");
    $query="update points_score_leaderboard set total_points=$leader_borad_score,current_point=$current_point,week_points=$week_points,updatedAt='$updatedAt' where user_id=$user_id";
    mysql_query($query)or die(mysql_error());
}//----------------------------get game score leader board------------------------------------------------------
function getHightestGameScoreLeaderBoard()
{
    $query="SELECT gsl.user_id as user_id,gu.user_name AS user_name,gu.photo AS user_image,gsl.leader_board_score AS game_score
    FROM
    game_score_leaderboard gsl
    INNER JOIN glogin_users gu 
        ON (gsl.user_id = gu.id) ORDER BY game_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-------------------------get all time leader board-------------------------------------------------------
function getAllTimeLeaderBoard()
{
    $query="SELECT gs.user_id AS user_id,gu.user_name AS user_name,gu.photo AS user_image,sg.game_name as game_name,gs.game_score  as game_score 
    FROM
    game_scores gs
    INNER JOIN glogin_users gu 
        ON (gs.user_id = gu.id)
    INNER JOIN silverhat_games sg 
        ON (gs.game_id = sg.game_id) order by game_score DESC";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------get all time point leader board---------------------------------------------
function getAllTimePointsLeaderBoard()
{
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.total_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) ORDER BY total_points DESC LIMIT 0,10";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------get weekly leader board----------------------------------------------------
function getWeeklyPointLeaderBoard()
{
    $week_date=date('Y-m-d', strtotime('-7 days'));
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.week_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where (psl.createdAt>'$week_date' or psl.updatedAt>'$week_date') and week_points!=0  ORDER BY total_points DESC LIMIT 0,10";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------get today points leader board---------------------------------------------------
function getDailyPointsLeaderBoard()
{
    $week_date=date("Y-m-d");
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.current_point AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where (psl.createdAt='$week_date' or psl.updatedAt='$week_date') and current_point!=0 ORDER BY current_point DESC LIMIT 0,10";
    $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-----------------------------maintain rank---------------------------------------------------------------
function getUserRank($userId,$game_id){
   // no limit they did the query to get all result
   $sql     =  "SELECT user_id FROM game_scores where game_id=$game_id and isgarbeg='no' ORDER BY game_score DESC";
   $result =  mysql_query($sql);
   $rows  =  '';
 
   $data = array();
   if (!empty($result))
        $rows      =  mysql_num_rows($result);
   else
        $rows      =  ''; 
    if (!empty($rows)){
        while ($rows = mysql_fetch_assoc($result)){
                $data[]   = $rows;
        }
    } 
   $rank = 1;
   foreach($data as $item){
       if ($item['user_id'] == $userId){
           return $rank;
       }
       ++$rank;
   }
   return 1;
}

//-----------------------------maintain point rank---------------------------------------------------------------
function getPointsUserRank($userId){
   // no limit they did the query to get all result
   $sql     =  "SELECT user_id FROM points_score_leaderboard ORDER BY total_points DESC";
   $result =  mysql_query($sql);
   $rows  =  '';
 
   $data = array();
   if (!empty($result))
        $rows      =  mysql_num_rows($result);
   else
        $rows      =  ''; 
    if (!empty($rows)){
        while ($rows = mysql_fetch_assoc($result)){
                $data[]   = $rows;
        }
    } 
   $rank = 1;
   foreach($data as $item){
       if ($item['user_id'] == $userId){
           return $rank;
       }
       ++$rank;
   }
   return 1;
}

//--------------------------------------------count games score from user-------------------------------
function countWeeklyUserPointByUserId($user_id)
{
   $week_date=date('Y-m-d h:i:s', strtotime('-7 days'));
   $query="select user_id,sum(week_points) as over_all_points from points_score_leaderboard where user_id=$user_id AND (createdAt>'$week_date' or updatedAt>'$week_date') and week_points!=0 order by week_points DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------------------------count games score from user-------------------------------
function countDailyUserDailyPointByUserId($user_id)
{
   $week_date=date("Y-m-d"); 
   $query="select updatedAt,user_id,sum(current_point) as over_all_points from points_score_leaderboard where user_id=$user_id AND (createdAt='$week_date' or updatedAt='$week_date') and current_point!=0  order by current_point DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------------------------count games score from user-------------------------------
function countHightestGameScoreByUserId($user_id)
{
   $query="select user_id,sum(leader_board_score) as game_score from game_score_leaderboard where user_id=$user_id order by leader_board_score DESC";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-----------------------------maintain point rank---------------------------------------------------------------
function getHigehestScoreUserRank($userId){
   // no limit they did the query to get all result
   $sql     =  "SELECT user_id FROM game_score_leaderboard ORDER BY leader_board_score DESC";
   $result =  mysql_query($sql);
   $rows  =  '';
 
   $data = array();
   if (!empty($result))
        $rows      =  mysql_num_rows($result);
   else
        $rows      =  ''; 
    if (!empty($rows)){
        while ($rows = mysql_fetch_assoc($result)){
                $data[]   = $rows;
        }
    } 
   $rank = 1;
   foreach($data as $item){
       if ($item['user_id'] == $userId){
           return $rank;
       }
       ++$rank;
   }
   return 1;
}

//-----------------------------maintain point rank---------------------------------------------------------------
function getWeelyPointsUserRank($userId){
    $week_date=date('Y-m-d', strtotime('-7 days'));
   // no limit they did the query to get all result
  $sql     =  "SELECT user_id FROM points_score_leaderboard where (createdAt>'$week_date' or updatedAt>'$week_date') and week_points!=0  ORDER BY week_points DESC";
   $result =  mysql_query($sql);
   $rows  =  ''; 
   $data = array();
   if (!empty($result))
        $rows      =  mysql_num_rows($result);
   else
        $rows      =  ''; 
    if (!empty($rows)){
        while ($rows = mysql_fetch_assoc($result)){
                $data[]   = $rows;
        }
    } 
   $rank = 1;
   foreach($data as $item){
       if ($item['user_id'] == $userId){
           return $rank;
       }
       ++$rank;
   }
   return 1;
}
//-----------------------------maintain point rank---------------------------------------------------------------
function geDailyPointsUserRank($userId){
    $week_date=date('Y-m-d');
   // no limit they did the query to get all result
  $sql     =  "SELECT user_id FROM points_score_leaderboard where (createdAt='$week_date' or updatedAt='$week_date') and current_point!=0   ORDER BY current_point DESC";
   $result =  mysql_query($sql);
   $rows  =  ''; 
   $data = array();
   if (!empty($result))
        $rows      =  mysql_num_rows($result);
   else
        $rows      =  ''; 
    if (!empty($rows)){
        while ($rows = mysql_fetch_assoc($result)){
                $data[]   = $rows;
        }
    } 
   $rank = 1;
   foreach($data as $item){
       if ($item['user_id'] == $userId){
           return $rank;
       }
       ++$rank;
   }
   return 1;
}
//----------------------------------get rewards by reward id--------------------------------------------------
function getRewardById($reward_id)
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_id=$reward_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------update utilize points----------------------------------------------------------
function addNewReedemPoints($user_id,$reward_id,$utilize_points)
{
    $utilize_points_date=date("Y-m-d"); 
    $query="insert into reward_redeem_point (user_id,reward_id,utilize_points,utilize_points_date) values ($user_id,$reward_id,$utilize_points,'$utilize_points_date')";
    mysql_query($query) or die(mysql_error());
}
//-----------------------get reedem points by user id------------------------------------------------------------
function getRedeemPointsByUserId($user_id)
{
    $query="select user_id,reward_id,reward_redeem_points_id,utilize_points,utilize_points_date from reward_redeem_point where user_id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

function getRewardsUserId($user_id)
{
    $query="SELECT mg.reward_name as reward_name,rp.utilize_points as utilize_points,rp.utilize_points_date as utilize_points_date
    FROM
    reward_redeem_point rp
    INNER JOIN maverick_game_reward mg 
        ON (rp.reward_id = mg.reward_id) where user_id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//------------------------------------get award redeem user points--------------------------------------------
function countAwardRedeemPointByUserId($user_id)
{
    $query="SELECT utilize_points_date,SUM(utilize_points) AS utilize_points
FROM
    reward_redeem_point where user_id=$user_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//------------------create new user order--------------------------------------------------------------
function addNewOrders($user_id,$package_id,$unique)
{
  $createdAt = date("Y-m-d");
  $updatedAt = date("Y-m-d");
  $query="insert into user_orders(user_id,package_id,order_number,createdAt,updatedAt,order_status) values($user_id,$package_id,'$unique','$createdAt','$updatedAt','no')";
  mysql_query($query) or die(mysql_error());
}

//----------------get user order number by user id package id------------------------------------------
function getUserOrderByUser($user_id,$package_id)
{
   $query="select user_order_id, order_number from user_orders where user_id=$user_id and package_id=$package_id order by user_order_id DESC limit 0,1";
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//-------------------------function get user game score by user id and game id--------------------------------
function getGameScoreByUserId($user_id,$game_id)
{
    $query="select user_id,game_id,user_game_score_id,createdAt,updatedAt,user_game_score from user_game_score where user_id=$user_id AND game_id=$game_id order by user_game_score_id DESC limit 0,15";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//-------------------------verify scratch card number--------------------------------------
function getScratchCardByNumber($scratch_card_number)
{
    $query="select card_id,card_number,reference_number,number_of_coins,card_price,isActive,createdAt,expiredAt,cardactivatedAt,isused from maverick_game_card where card_number='$scratch_card_number'";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------add new user game score---------------------------------------------------------
function addNewUserGameScore($user_id,$game_id,$user_game_score)
{
    $createdAt = date("Y-m-d h:i:s");
    $updatedAt = date("Y-m-d h:i:s");
    $query="insert into user_game_score(user_id,game_id,createdAt,updatedAt,user_game_score) values($user_id,$game_id,'$createdAt','$updatedAt',$user_game_score)";
    mysql_query($query) or die(mysql_error());
}
//------------------------get logged user fortomo coins----------------------------------------
function getLogedUserCoins($session_id)
{
    $query="select fortomo_coins from user_game_coins where user_id=$session_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

//-------------------------count user points--------------------------------------------------------------------
function countUserLeaderPointsByUserId($user_id)
{
    $query="select user_id,updatedAt,SUM(total_points) AS total_points from user_points where user_id=$user_id";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//------------------------------get today leader board-------------------------------------------------
function getCurrentPointsLeaderBoard()
{
    $query="select user_id,point_leader_id,createdAt,updatedAt,total_points,current_point from points_score_leaderboard";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//----------------------------update points leader board--------------------------------------------
function updateCurrentLeaderBoard()
{
    $query="update points_score_leaderboard set current_point=0";
    mysql_query($query) or die(mysql_error());
}
//--------------------get 1000 points rewards-----------------------------------------------------
function getThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=1000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get 5000 rewards point------------------------------------------------
function getFiveThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=5000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}

//--------------------------get 5000 rewards point------------------------------------------------
function getTenThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=10000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get 5000 rewards point------------------------------------------------
function getFiftyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=50000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}

//--------------------------get 80000 rewards point------------------------------------------------
function getEightyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=80000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get one lakh rewards point------------------------------------------------
function getOneLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=100000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get one lakh twenty rewards point------------------------------------------------
function getOneLakhTwentyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=120000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get one lakh thirty rewards point------------------------------------------------
function getOneLakhThirtyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=130000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get one lakh fifty rewards point------------------------------------------------
function getOneLakhFiftyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=150000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get two lakh fifty rewards point------------------------------------------------
function getTwoLakhFiftyThousandPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=250000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get Five lakh fifty rewards point------------------------------------------------
function getFiveLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=500000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get Five lakh fifty rewards point------------------------------------------------
function getSevenLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=750000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//----------------------get new slider games---------------------------------------------------
function getAllSliderGames()
{
    $query="SELECT game_id,game_name, game_description, game_seo,game_slider FROM silverhat_games where isActive='yes' order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//------------------------------get home slider games-------------------------------------------------
//-----------------------get All Games-------------------------------------------------------------------
function getAllHomeSliderGames()
{
   $query="SELECT game_id, game_name,game_background_image, game_file, game_seo FROM silverhat_games where isActive='yes' order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//---------------------------get all footer games-------------------------------------------------
function getAllFooterGames()
{
    $query="SELECT game_id,game_name,game_seo FROM silverhat_games where isActive='yes' order by game_id"; 
   $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//----------------------------update points leader board-----------------------------------------------------
function updatePointRedemLeaderBoard($user_id,$leader_borad_score)
{
    $updatedAt = date("Y-m-d");
    $query="update points_score_leaderboard set total_points=$leader_borad_score,updatedAt='$updatedAt' where user_id=$user_id";
    mysql_query($query)or die(mysql_error());
}
//----------------set user is login session---------------------------------------------------------
function setUserLogin($email)
{
    $query="update glogin_users set islogin='yes' where email='$email' or user_name='$email'";
    mysql_query($query)or die(mysql_error());
}
//------------------set user logout-----------------------------------------------------------------
function setUserLogout($email)
{
    $query="update glogin_users set islogin='no' where email='$email' or user_name='$email'";
    mysql_query($query)or die(mysql_error());
}
function Logoutwhenbrowserclose($id)
{
    $query="UPDATE glogin_users SET islogin='no' WHERE id=$id"; 
    mysql_query($query) or die(mysql_error());
   
}
//---------------------------------get user game points by user id-----------------------------------------------
function getUserGamePointsByUserId($user_id)
{
    $query="SELECT up.total_points AS total_points,up.updatedAt AS updatedAt,sg.game_name AS game_name
FROM
    user_points up
    INNER JOIN silverhat_games sg 
        ON (up.game_id = sg.game_id)
    INNER JOIN glogin_users gu 
        ON (up.user_id = gu.id) where user_id=$user_id ORDER BY up.user_point_id DESC limit 0,15";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//------------------------------user scratch card------------------------------------------------------
function addUserScratchCard($card_id,$session_id)
{
    $createdAt=date("Y-m-d H:i:s");
    $query="insert into user_scratch_cards (card_id,user_id,card_use_date) values($card_id,$session_id,'$createdAt')";
    mysql_query($query) or die(mysql_error());
}
//--------------------------get 5000 rewards point------------------------------------------------
function getTwentyLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=2000000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get 5000 rewards point------------------------------------------------
function getFitenLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=1500000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------get 5000 rewards point------------------------------------------------
function getTenLakhPointsRewards()
{
    $query="select reward_id,reward_name,reward_points,reward_image from maverick_game_reward where reward_points=1000000 order by reward_id DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}
//--------------------------------reirect function------------------------------------------------
function redirectPageUrl($actual_link)
{
 if($actual_link=='http://www.maverickgame.com/maverick-game-do-the-dive')
{
  return header("location: https://www.maverickgame.com/maverick-game-do-the-dive");
}
if($actual_link=='http://www.maverickgame.com/maverick-game-master-cook')
{
  return header("location: https://www.maverickgame.com/maverick-game-master-cook");
}
if($actual_link=='http://www.maverickgame.com/maverick-game-word-ster')
{
   return header("location: https://www.maverickgame.com/maverick-game-word-ster");
}
if($actual_link=='http://www.maverickgame.com/maverick-game-dragon-draft')
{
   return header("location: https://www.maverickgame.com/maverick-game-dragon-draft");
}
if($actual_link=='http://www.maverickgame.com/maverick-game-crisis')
{
   return header("location: https://www.maverickgame.com/maverick-game-crisis");
}
}
//-------------------------------------get all countries---------------------------------------------------
function getAllCountries()
{
    $query="select country_id,country_code,country_name from maverick_countries";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------get all cities by country------------------------------------------------
function getAllCitiesByCountryId($country_id)
{
    $query="select country_id,city_id,city_name,createdAt,updatedAt,isActive from maverick_cities where country_id=$country_id";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------get All cities------------------------------------------------------------
function getAllCities()
{
    $query="select country_id,city_id,city_name, createdAt,updatedAt,isActive from maverick_cities";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------add new city------------------------------------------------------------
function  addNewCity($country_id,$city_id)
{
    $createdAt = date("Y-m-d");
    $updatedAt = date("Y-m-d");
    $query="insert into maverick_cities (country_id,city_name,createdAt,updatedAt,isActive) values($country_id,'$city_id','$createdAt','$updatedAt','yes')";
    mysql_query($query) or die(mysql_error());    
}
//------------------------------------get city by Id--------------------------------------------------
function getCityById($city_id)
{
    $query="select country_id,city_id,city_name, createdAt,updatedAt,isActive from maverick_cities where city_id=$city_id";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//---------------------------------------get top five game score in leader board---------------------------------
function getTopFiveGameScoreByScoreId($game_id)
{
   $query="select game_id,user_id,score_id,game_score as game_score,createdAt,updateAt,isgarbeg from game_scores where game_id=$game_id and isgarbeg='no' order by game_score DESC limit 0,5";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}
//---------------------------get top five points leaderboard--------------------------------------------------
function getTopFiveAllTimePointsLeaderBoard()
{
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.total_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) ORDER BY total_points DESC limit 0,5";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

//--------------------------All Game Score pagination-----------------------------------------------------------------
function getAllGameScorePagination($starting,$ending,$game_id)
{
	$starting = $starting-1;
   $query="select game_id,user_id,score_id,game_score as game_score,createdAt,updateAt,isgarbeg from game_scores where game_id=$game_id and isgarbeg='no' order by game_score DESC LIMIT 10 OFFSET $starting";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}

//--------------------------No Of Index pagination-----------------------------------------------------------------
function getNoOfIndex($game_id)
{
   $query="select game_id,user_id,score_id,game_score as game_score,createdAt,updateAt,isgarbeg from game_scores where game_id=$game_id and isgarbeg='no' order by game_score DESC ";
   $result=  mysql_query($query) or die(mysql_error());
   return $result; 
}

//--------------------------No Of Points Index pagination-----------------------------------------------------------------
function getPointsNoOfIndex()
{
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.total_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) ORDER BY total_points DESC";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

//--------------------------------get all time point leader board---------------------------------------------
function getPointPagination($starting,$ending)
{
	$starting = $starting-1;
   $week_date=date('Y-m-d h:i:s', strtotime('-7 days'));
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.total_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where psl.createdAt>'$week_date' or psl.updatedAt>'$week_date' ORDER BY total_points DESC LIMIT 10 OFFSET $starting";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}

//----------------------------get Daily points leader board---------------------------------------------------
function getDailyPointsPagination($starting,$ending)
{
	$starting = $starting-1;
    $week_date=date("Y-m-d");
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.current_point AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where (psl.createdAt='$week_date' or psl.updatedAt='$week_date') and current_point!=0 ORDER BY current_point DESC LIMIT 10 OFFSET $starting";
    $result=  mysql_query($query) or die(mysql_error());
   return $result;
}
//--------------------------------get all time point leader board---------------------------------------------
function getAllTimePointsLeaderBoardPagination($starting,$ending)
{
    $starting = $starting-1;
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.total_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) ORDER BY total_points DESC LIMIT 10 OFFSET $starting";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------get weekly leader board Index----------------------------------------------------
function getWeeklyPointLeaderBoardIndex()
{
    $week_date=date('Y-m-d', strtotime('-7 days'));
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.week_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where (psl.createdAt>'$week_date' or psl.updatedAt>'$week_date') and week_points!=0  ORDER BY week_points DESC";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//--------------------------------get all time point leader board---------------------------------------------
function getWeekPointPagination($starting,$ending)
{
   $starting = $starting-1;
   $week_date=date('Y-m-d', strtotime('-7 days'));
    $query="SELECT psl.user_id AS user_id,gu.user_name AS user_name,gu.photo  AS user_image,psl.week_points AS total_points
    FROM
    points_score_leaderboard psl
    INNER JOIN glogin_users gu
        ON (psl.user_id = gu.id) where (psl.createdAt>'$week_date' or psl.updatedAt>'$week_date') and week_points!=0 ORDER BY total_points DESC LIMIT 10 OFFSET $starting";
    $result=  mysql_query($query) or die(mysql_error());
    return $result;
}
//-----------------------get update current points database-----------------------------------------------------
//------------------------------get today leader board-------------------------------------------------
function getUpdateCurrentPointsLeaderBoard()
{
    $createdAt = date("Y-m-d");
    $updatedAt = date("Y-m-d");
    $query="select user_id,point_leader_id,createdAt,updatedAt,total_points,current_point from points_score_leaderboard where createdAt='$createdAt' or updatedAt='$updatedAt'"; 
    $result = mysql_query($query) or die(mysql_error());
    return $result; 
}

//--------------------------------get weekly leader board----------------------------------------------------
function getUpdateWeekPointsLeaderBoard($today)
{
    $query="select user_id,point_leader_id,createdAt,updatedAt,total_points,current_point,week_points from points_score_leaderboard where createdAt>='$today' or updatedAt>='$today' order by week_points DESC";
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
//----------------------------update points leader board--------------------------------------------
function updateWeekLeaderBoard($week_date)
{
    $query="update points_score_leaderboard set week_points=0 where  createdAt<='$week_date' and updatedAt<='$week_date' ";
    mysql_query($query) or die(mysql_error());
}
//-------------------update fortomo coins-------------------------------------------------------------
function updateFortomoCoins()
{
    $query="update user_game_coins set fortomo_coins=0";
    mysql_query($query) or die(mysql_error());
}
?>