<?php
session_start();
include("dbconnection.php");
$user_id=$_SESSION['user_loged_id'];
$smallimage = $_FILES['user_image'];
    $user_image = $smallimage['name'];
    if (!$smallimage['error']) 
		{
			if (!@move_uploaded_file($smallimage['tmp_name'],"user_images/".$smallimage['name']) ) 
			{
				header("location:maverick-user-profile?err=Unknown Error Occured please try again");
				exit();
			}
			else
			{
                            $work = new ImgResizer("userimages/". $smallimage['name']);
	 		}
		}
updateUserImage($user_id,$user_image);
unset($_SESSION['loged_user_image']);
$users=  getUserById($user_id);
$user=  mysql_fetch_array($users);
$_SESSION['loged_user_image']=$user['photo'];
header("location:maverick-user-profile?upload");

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
?>