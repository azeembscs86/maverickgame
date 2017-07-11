<?php
session_start();
include("dbconnection.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Purchase Coins | Maverick Game</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="shortcut icon" href="favicon.png" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<style type="text/css">
.error {
	color: #FF0000;
	font-size: 15px;
	font-weight: normal;
	padding-left: 5px;
}
.error1 {
	color: #FF0000;
	font-size: 14px;
	font-weight: bold;
	padding-left: 29px;
}
</style>
<meta name="google-site-verification" content="ywXjYOYCEEAo7oFbxaG3VU1x2uA4yI9q1PHhRNGTtxY" />
</head>
<body>
<?php
include("user-login-menus.php");
?>
<?php
include("sidebarlinks.php");
?>
<div class="baninner">
<?php
	include("navigation.php");
?>
<div class="bgshadow"></div>
<img src="assets/images/baninner/wordster.jpg" width="1366" height="230" class="banpic" alt="">
</div>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-sm-9">
     <div class="box-inner">
        <h2 class="hd-main">Card Payment</h2>       
        <p>Scratch cards available in following denominations:</p>
        <div class="col-md-10 nopad-left">
        <table class="table table-bordered">
            <thead>
			<tr>
                <th>Cost</th>               
                <th>Value</th>
            </tr>
			</thead>
             <tbody>
			<tr>
                <td>50 Rs</td>
                <td>10 Coins</td>
            </tr>
             <tr>
                <td>100 Rs</td>                
                <td> 20 Coins</td>
            </tr>
             <tr>
                <td>500 Rs</td>               
                <td> 100 Coins</td>
            </tr>
		</tbody>
        </table></div>
<div class="clearfix"></div><br>
<p>Please enter code in the below bar, in case your card do not work, expired or giving error please contact us at <a href="mailto:info@maverickgame.com">info@maverickgame.com</a>. </p>
        <div class="clearfix"></div>
        <hr>
                <?php
                if(isset($_REQUEST['err']))
                {
                ?>
                <div class="error">You have enter invalid card number</div>                
                <?php
                }
                ?>
                <?php
                if(isset($_REQUEST['coins']))
                {
                ?>
                <div class="">You have successfully purchase <?php echo $_REQUEST['coins']; ?> Coins</div>                
                <?php
                }
                ?> 
                <?php
                if(isset($_REQUEST['used']))
                {
                ?>
                <div class="error">Scratch card you have entered has been already used.</div>                
                <?php
                }
                ?>               
        <div class="col-md-10">
          <form action="scratchcardverify.php" method="post" id="sctrachcardform" name="sctrachcardform">
                  <div class="row">
                  <div class="col-md-3 nopad">
                  <label style="margin:20px 0 0">Scratch Card Number :</label>
                  </div>
                  <div class="col-md-7 nopad-left">
                  <input style="margin:10px 0 0; height:43px;" type="text" class="form-control" placeholder="Enter Scratch Card Number" value="" name="scratch_card_number" id="scratch_card_number"/>
                  </div>                
             <div class="col-md-2"><input type="submit" value="Submit" name="" class="btnread pull-right" /> </div>
             </div>
           </form>
        </div>
        <div class="clearfix"></div><hr>
        <div role="alert" class="alert alert-info"><strong>Note:</strong> Scratch cards currently are only available at selected outlets and gaming center</div>
       </div>
    </div>
	<div class="col-md-3">
      <div class="sidebar">
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
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
            $().ready(function() {
                $("#sctrachcardform").validate({
                    rules: {
                        scratch_card_number: {
                            required: true,
                            minlength:14,  
                            maxlength:14,                               
                        }
                    },
                    messages: {
                        scratch_card_number: {
                            required: "Please enter card number",
                             minlength: "card number must be 14 letter",  
                             maxlength: "card number must be 14 letter",                              
                        }
                    }
                });
                $("#scratch_card_number").focus(function() {
                    var scratch_card_number = $("#scratch_card_number").val();
                    if(scratch_card_number && !this.value) {
                        this.value = scratch_card_number;
                    }
                });
            });
        </script>
</body>
</html>