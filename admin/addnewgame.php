<?php
session_start();
include("dbconnection.php");
$game_name   = mysql_real_escape_string($_REQUEST['game_name']);
$game_price   = mysql_real_escape_string($_REQUEST['game_price']);
$game_points  = mysql_real_escape_string($_REQUEST['game_points']);
$game_filename   = mysql_real_escape_string($_REQUEST['game_filename']);
$game_seo_title  = mysql_real_escape_string($_REQUEST['game_seo_title']);
$game_description  = mysql_real_escape_string($_REQUEST['game_description']);
$meta_tag_description  = mysql_real_escape_string($_REQUEST['meta_tag_description']);
$meta_tag_keywords   = mysql_real_escape_string($_REQUEST['meta_tag_keywords']);
$game_seo=  str_replace(" ","-", strtolower($game_name));
$smallimage           = $_FILES['game_image'];
$game_image  = $smallimage['name'];    
    if (!$smallimage['error']) 
		{
			if (!@move_uploaded_file($smallimage['tmp_name'],"../silverhat_games/game_image/".$smallimage['name']) ) 
			{
				header("location:add-new-reward.php?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../silverhat_games/game_image/". $smallimage['name']);
	 		}
		} 
$small_image           = $_FILES['game_slider_image'];
$game_slider_image  = $small_image['name'];    
    if (!$small_image['error']) 
		{
			if (!@move_uploaded_file($small_image['tmp_name'],"../silverhat_games/game_slider/".$small_image['name']) ) 
			{
				header("location:add-new-reward.php?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../silverhat_games/game_slider/". $small_image['name']);
	 		}
		} 
$small_home_image           = $_FILES['game_home_image'];
$game_home_image  = $small_home_image['name'];    
    if (!$small_home_image['error']) 
		{
			if (!@move_uploaded_file($small_home_image['tmp_name'],"../silverhat_games/game_home_image/".$small_home_image['name']) ) 
			{
				header("location:add-new-reward.php?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../silverhat_games/game_home_image/". $small_home_image['name']);
	 		}
		}
$small_background_image           = $_FILES['game_background_image'];
$game_background_image  = $small_background_image['name'];    
    if (!$small_background_image['error']) 
		{
			if (!@move_uploaded_file($small_background_image['tmp_name'],"../silverhat_games/game_background_image/".$small_background_image['name']) ) 
			{
				header("location:add-new-reward.php?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../silverhat_games/game_background_image/". $small_background_image['name']);
	 		}
		}
$small_instruction_image           = $_FILES['game_instrustion_image'];
$game_instrustion_image  = $small_instruction_image['name'];    
    if (!$small_instruction_image['error']) 
		{
			if (!@move_uploaded_file($small_instruction_image['tmp_name'],"../silverhat_games/game_instrustion_image/".$small_instruction_image['name']) ) 
			{
				header("location:add-new-reward.php?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("../silverhat_games/game_instrustion_image/". $small_instruction_image['name']);
	 		}
		}        
                
addNewGame($game_name,$game_price,$game_points,$game_filename,$game_seo_title,$game_description,$meta_tag_description,$meta_tag_keywords,$game_image,$game_slider_image,$game_home_image,$game_background_image,$game_instrustion_image,rtrim($game_seo,"-"));                
header("location:maverick-games.php?added");                
class ImgResizer {
	var $originalFile = '';
	function ImgResizer($originalFile = '') {
		$this -> originalFile = $originalFile;
	}
	function resize($newWidth, $targetFile) {
		if (empty($newWidth) || empty($targetFile)) {
			return false;
		}
		$src = imagecreatefromjpeg($this -> originalFile);
		list($width, $height) = getimagesize($this -> originalFile);
		$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		if (file_exists($targetFile)) {
			unlink($targetFile);
		}
		imagejpeg($tmp, $targetFile, 85);
	}
}