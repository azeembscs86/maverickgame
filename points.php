<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>

<title>Maverick Game | Points</title>
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
    <div class="col-md-1"></div>
      <div class="col-md-10">
      <div class="leader-wrap" style="min-height:450px;">
     <h2 class="">Points</h2>
        <div class="row">
      <div class="col-md-9">
          <h3 class="text-uppercase white">My Points Account Balance </h3>
          <p class="white"> Points add up fast so be sure to check your balance! When you've earned enough, you can redeem them for valuable in-game currency on mavericgame.com.*</p>
          <p class="white">Want to earn even faster? Head to our Earn Points Page to see how! </p>
          
          </div>
          
          <div class="col-md-3">
          <div class="points" style="margin:10px 0 0;">
         <p class="white"> Points
          <span>235</span></p>
          
          </div>
          <div class="point-date">Total updated 8/10/15 </div>
          </div>
          
          <div class="col-md-12">
          <table class="table-points table-striped table-responsive table-bordered table-forum">
          <thead>
			<tr>
                <th><span class="tableformyelo">Date </span></th>
                <th><span class="tableform">Activity </span></th>
                <th><span class="tableform">Debit/Credit</span></th>
              </tr>
			</thead>
            <tbody>
              <tr>
                <td>Date</td>
                <td>Activity</td>
                <td>Debit/Credit</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>Activity</td>
                <td>Debit/Credit</td>
              </tr>
            </tbody>
          </table>

          </div>
          </div>
          </div>
          </div>
          
      </div>
      
    </div>
  </div>
</div>
<div class="clearfix"></div>

<?php
include("footer-toparea.php");
?>
<?php
include("footer.php");
?>
</body>
</html>