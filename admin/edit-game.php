<?php
session_start();
if(isset($_SESSION['admin_email']))
{
    include("dbconnection.php");
}  else {
   header("location:index.php");  
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>The Maverick game | Admin | Games</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

       <?php 
          include("momforumnotification.php");
          ?>
          
          
      <!-- Left side column. contains the logo and sidebar -->
      
      <?php
      include_once("includes/leftnavigation.php");
      ?>

      <?php
        if(isset($_REQUEST['id']))
        {
            $game_id=  mysql_real_escape_string($_REQUEST['id']);
            $maerickgames=  getGameById($game_id);
            $maverickgame=  mysql_fetch_array($maerickgames);
        }
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Update Game <?php echo $maverickgame['game_name']; ?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="maverick-games.php"><i class="fa fa-dashboard"></i> Games</a></li>
            <li class="active">update game <?php echo $maverickgame['game_name']; ?> </li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
         

          

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              <!-- /.box -->
              <!-- /.row -->

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                   
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="updategame.php" enctype="multipart/form-data" name="LoginForrm" id="LoginForrm">                                  
                    <input type="hidden" name="game_id" value="<?php echo $maverickgame['game_id']; ?>" readonly="readonly">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game Name</label>
                      <input type="text" name="game_name" class="form-control" value="<?php echo $maverickgame['game_name']; ?>" id="game_name" placeholder="Enter game name">
                    </div>
                    
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game Price</label>
                      <input type="text" name="game_price" class="form-control" value="<?php echo $maverickgame['game_price']; ?>" id="game_price" placeholder="Enter game price in coins">
                    </div>
                           
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game Points Ratio</label>
                     <input type="text" name="game_points" class="form-control" value="<?php echo $maverickgame['game_point_ratio']; ?>" id="game_points" placeholder="Enter point ratio">
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game File Name</label>
                      <input type="text" name="game_filename" value="<?php echo $maverickgame['game_file']; ?>" class="form-control" id="game_filename" placeholder="Enter File name">
                      <span><strong>Enter File name like Folder/dothedrive.php</strong></span>
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game Seo Title</label>
                      <input type="text" name="game_seo_title" value="<?php echo $maverickgame['game_seo_title']; ?>" class="form-control" id="game_seo_title" placeholder="Enter File name">
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Game Description</label>
                      <textarea class="form-control" rows="3" name="game_description" id="game_description"><?php echo $maverickgame['game_description']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta Tag Description</label>
                      <textarea class="form-control" rows="3" name="meta_tag_description" id="meta_tag_description"><?php echo $maverickgame['meta_tag_description']; ?></textarea>
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Meta tag keywords</label>
                      <textarea class="form-control" rows="3" name="meta_tag_keywords" id="meta_tag_keywords"><?php echo $maverickgame['meta_tag_keywords']; ?></textarea>
                    </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Game Home Image</label>
                      <input type="file" name="game_home_image" id="game_home_image">
                      <?php
			if(isset($maverickgame['game_home_image'])) 
			echo "<img src = '../silverhat_games/game_home_image/" . $maverickgame['game_home_image']. "'  witdht='100px' height='50'/>";
		       ?>
		<input type='hidden' name='prev_image' value='<?php if(isset($maverickgame['game_home_image'])) echo $maverickgame['game_home_image'];?>'/>
                      
                    </div> 
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Game Background Image</label>
                      <input type="file" name="game_background_image" id="game_background_image">
                      <?php
			if(isset($maverickgame['game_background_image'])) 
			echo "<img src = '../silverhat_games/game_background_image/" . $maverickgame['game_background_image']. "' witdht='100px' height='50'  />";
		       ?>
		<input type='hidden' name='prev_image1' value='<?php if(isset($maverickgame['game_background_image'])) echo $maverickgame['game_background_image'];?>'/>
                      
                    </div> 
                    
                   <div class="form-group">
                      <label for="exampleInputFile">Game Image</label>
                      <input type="file" name="game_image" id="game_image">
                      <?php
			if(isset($maverickgame['game_image'])) 
			echo "<img src = '../silverhat_games/game_image/" . $maverickgame['game_image']. "' witdht='100px' height='50' />";
		       ?>
		<input type='hidden' name='prev_image2' value='<?php if(isset($maverickgame['game_image'])) echo $maverickgame['game_image'];?>'/>
                      
                    </div> 
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Game Slider</label>
                      <input type="file" name="game_slider_image" id="game_slider_image">
                      <?php
			if(isset($maverickgame['game_slider'])) 
			echo "<img src = '../silverhat_games/game_slider/" . $maverickgame['game_slider']. "'  witdht='100px' height='50'/>";
		       ?>
		<input type='hidden' name='prev_image3' value='<?php if(isset($maverickgame['game_slider'])) echo $maverickgame['game_slider'];?>'/>
                      
                    </div> 
                    
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Game Instruction Image</label>
                      <input type="file" name="game_instrustion_image" id="game_instrustion_image">
                      <?php
			if(isset($maverickgame['game_instrustion_image'])) 
			echo "<img src = '../silverhat_games/game_instrustion_image/" . $maverickgame['game_instrustion_image']. "'  witdht='100px' height='50'/>";
		       ?>
		<input type='hidden' name='prev_image4' value='<?php if(isset($maverickgame['game_instrustion_image'])) echo $maverickgame['game_instrustion_image'];?>'/>
                      
                    </div> 
                    
                  <!-- /.box-body -->

                  <div class="box-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                      <a href="maverick-games.php" class="btn btn-primary">Back</a>
                  </div>
                </form>
            
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
       <strong>Copyright &copy; 2014-2015 <a href="http://thefunkids.com">The Maverick  Game</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    
    <script src="js/jquery.min.js"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>	
       
                <script type="text/javascript">
            $().ready(function() {
                $("#LoginForrm").validate({
                    rules: {
                        game_name: {
                            required: true                           
                        },
                        game_price: {
                            required: true,
                            digits:true
                        },
                        game_points:{
                            required: true,
                            digits:true
                        },
                        game_filename: {
                            required: true                           
                        },
                        game_seo_title:{
                            required: true
                        },
                        game_description:{
                            required: true
                        },
                        meta_tag_description:{
                            required: true
                        },
                        meta_tag_keywords:{
                            required: true
                        }
                        
                    },
                    messages: {
                        game_name: {
                            required: "Please enter game name"
                        },
                        game_price: {
                            required: "Please enter game price",
                            digits: "Please enter game price in 0-9"
                        },
                        game_filename: {
                           required: "Please enter game file name like  Folder/dothedrive.php"                                   
                        },
                        game_points: {
                           required: "Please enter game points ratio",
                            digits: "Please enter game points in 0-9"         
                        },
                        game_seo_title:{
                           required: "Please enter game seo title"
                        },
                        game_description:{
                            required: "Please enter game description"
                        },
                        meta_tag_description:{
                            required: "Please enter game meta tag description"
                        },
                        meta_tag_keywords:{
                            required: "Please enter game meta tag keywords"
                        }
                    }
                });
                $("#game_name").focus(function() {
                    var game_name = $("#game_name").val();
                    var game_price = $("#game_price").val();
                    if(game_name && game_price && !this.value) {
                        this.value = game_name + "." + game_price;
                    }
                });
            });
        </script>
        <style>
       .error {
       color: #FF0000;
    font-size: 11px;
    font-weight: normal;
    padding-left: 29px;
       }
       
       .error1 {
       color: #FF0000;
    font-size: 14px;
    font-weight: bold;
    padding-left: 29px;
       }
        </style>
  </body>
</html>