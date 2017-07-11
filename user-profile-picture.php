<?php
session_start();
include("dbconnection.php");
$session_id=$_SESSION['user_loged_id'];
$path = "user_images/";
 ?>
<!DOCTYPE HTML>
<html>
<head>

<title>Upload Picture | Maverick Game</title>
<meta name="description" content="" />
<meta name="keywords" content="" />

<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>

<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/imgareaselect-default.css" />
<link rel="stylesheet" href="css/imgareaselect-default.css" />
</head>

<body>
<?php
            include("user-login-menus.php");
            ?>
<?php
include("sidebarlinks.php");
?>

<?php
$image='';
$err='';
if(isset($_POST['submit'])){
	//error variable to hold your error message 
	$err="";
	$path = "user_images/";
	//alled image format will be used for filter	
	$allowed_formats = array("jpg", "png", "gif", "bmp");
	$imgname = $_FILES['img']['name'];
	$tmpname = $_FILES['img']['tmp_name'];
	$size = $_FILES['img']['size'];
	//validate image
	if(!$imgname){
		$err="<strong>Oh snap!</strong>Please select image..!";
		return false;
	}
	if($size > (2048*2048)){
		$err="<strong>Oh snap!</strong>File Size is too large..!";
	}
	list($name, $ext) = explode(".", $imgname);
	if(!in_array($ext,$allowed_formats)){
			$err="<strong>Oh snap!</strong>Invalid file formats only use jpg,png,gif";
			return false;					
	}
	if($ext=="jpg" || $ext=="jpeg" ){
		$src = imagecreatefromjpeg($tmpname);
	}
	else if($ext=="png"){
		$src = imagecreatefrompng($tmpname);
	}
	else {
		$src = imagecreatefromgif($tmpname);
	}
	list($width,$height)=getimagesize($tmpname);
	if($width > 400){
		$newwidth=399;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$image = $path.$imgname;
		imagejpeg($tmp,$path.$imgname,100);
		
		move_uploaded_file($image,$path.$imgname);
	}
	else{
		if(move_uploaded_file($tmpname,$path.$imgname)){
			$image="user_images/".$imgname;			
			
			
			
		}
		
		else{
			$err="<strong>Oh snap!</strong>failed";
		}
	
	
		
	}	
	
	
}

?>
<div class="baninner">
<?php
	include("navigation.php");
?>
<div class="bgshadow"></div>
<img src="assets/images/baninner/master-cook.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="box-inner">
        <h2 class="hd-main">Update Picture</h2>
        <div class="score-tabs">
  <ul>
   <li><a href="maverick-user-profile">Personal Information</a></li>
    <li><a href="update-password">Update Password</a></li>
    <li><a href="user-games-point">User Points</a></li>
    <li><a href="user-game-score">User Score</a></li> 
    <!--<li><a href="user-rewards">User Rewards</a></li>-->
    <li><a class="active" href="user-profile-picture.php">Upload Image</a></li>
  </ul>
  </div>
        <div class="row">
  <div class="col-md-3"> 
          <div class="current-picture">
            <div class="display-img">
              <?php 
			if(isset($_SESSION['loged_user_image']))
			{
			?>
              <img src="user_images/<?php echo $_SESSION['loged_user_image']; ?>">
              <?php 
			}             
			else{
			?>
              <img src="user_images/pro_03.png">
              <?php
			}
			?>
            </div>
          </div>
          </div>  
			
          <div class="col-md-9">
          <div class="left image-editor">
<?php  if($image){ echo "<p><br> <strong>Note: Drag on image to select the crop area and then press button.</strong></p>"; }?>
<?php  if($image){ echo '<button id="cropbtn" class="button btnread" onclick="return showUpdateButton()">Crop</button>'; } ?>
<div class='clearfix'></div>
<br>
<?php if($image){ echo "<img style='' src='".$image."' id=\"imgc\" style='width:100%' >";}?></div>

          
          <div class="image-output">
            
            <form action="" method="post" id="imgcrop_update" enctype="multipart/form-data">
              <?php if($image){	echo "<div id='output' class='output'></div>";} ?>
              <?php if($image != ''){ ?>
              <input type="submit" name="update" value="update" class="button btnread" style="display:none;" id="update_button" />
              <?php } ?>
            </form>
            <div class="clearfix"></div><br>
          </div>
          

          <?php
				//if any error while uploading
				if($err){
					echo '<div class="alert alert-error">'.$err.'</div>';
				}
				?>
          <form action="" method="post" id="imgcrop" enctype="multipart/form-data" class="imgcrop">
            <?php
						if($image == '')
						{
							
						?>
                        
                        
            <input type="file" name="img" id="img" style="float:left; margin-right:15px;" />
            <div class="clearfix"></div><br>
            <label class="note">Note: The maximum size of your custom image is 400 by 400 pixels or 48.8 KB (whichever is smaller)</label>
            <div class="clearfix"></div><br>
            <input type="submit" name="submit" value="submit" style="float:left; margin-top:5px;" class="imgupdate btnread" />
            <?php } ?>
            <input type="hidden" name="imgName" id="imgName" value="<?php if(isset($imgname)) echo($imgname) ?>" />
          </form>
          <?php 
				if(isset($_REQUEST['update'])){
						
					$imgNames = $_POST['imgNames'];
					$user_crop_image=$imgNames;
					$user_crop_image=explode("/",$imgNames);					
					
					  $profile_img_query= mysql_query("UPDATE glogin_users SET photo='$user_crop_image[1]' WHERE id='$session_id'");
					
					unset($_SESSION['loged_user_image']);
					$users=  getUserById($session_id);
					$user=  mysql_fetch_array($users);
					$_SESSION['loged_user_image']=$user['photo'];
					
					
					 //echo "<strong style='background-color:green'; color:#fff; font-size:12px; padding:3px 5px'>Your Profile Picture has been Update Sucessfully</strong>";
						echo "<script type='text/javascript'>
						top.location.href = 'user-profile.php';
						</script>";
					}
					    

					
					?>
                    
           </div>         
        </div>
      </div>
    </div>
	<div class="col-md-3">
      <div class="sidebar">
      <?php
		include("includes/sidebarpoints.php");
	  ?>
      <?php
		include("includes/sidebarscore.php");
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
<script type="text/javascript" src="js/jquery.imgareaselect.js"></script> 
<script type="text/javascript" src="js/process.js"></script>
<script>
function showUpdateButton()
{
    document.getElementById('update_button').style.display="block";    
}
</script>
</body>
</html>