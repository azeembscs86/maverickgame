<?php
/*--------------------------------------------------------------------------------------------
|	@desc:		live image crop script with php jquery-proces on ajax 
|	@author:	Aravind Buddha
|	@url:		http://www.techumber.com
|	@date:		16 September 2012
|	@email:     aravind@techumber.com
|	@license:	Free! to Share,copy, distribute and transmit , 
|               but i'll be glad if my name listed in the credits'
---------------------------------------------------------------------------------------------*/
// This will be name of croped image
$newImgName = rand(10,100).".jpg"; 
//uploads path
$path = "user_images/";
if($_GET){
	//to get all $_GET values
	extract($_GET);
	//to get extenction of the image
	function getExt($img) {
   $pos = strrpos($img,".");
   if (!$pos) { 
   	return "null"; 
   }
   $len = strlen($img) - $pos;
   $ext = substr($img,$pos+1,$len);
   return strtolower($ext);
 	}
	
	$wratio = ($rw/$w); 
	$hratio = ($rh/$h); 
	$newW = ceil($w * $wratio);
	$newH = ceil($h * $hratio);
	$newimg = imagecreatetruecolor($newW,$newH);
	$ext=getExt($img);
	if($ext=="jpg" || $ext=="jpeg" ){
		$source = imagecreatefromjpeg($path.$img);
	}
	else if($ext=="png"){
		$source = imagecreatefrompng($path.$img);
	}
	else {
		$source = imagecreatefromgif($path.$img);
	}
	imagecopyresampled($newimg,$source,0,0,$x1,$y1,$newW,$newH,$w,$h);
	imagejpeg($newimg,$path.$newImgName,90);
	echo "user_images/".$newImgName;
	exit;
	
}
	

