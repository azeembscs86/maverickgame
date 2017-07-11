<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>The Maverik Game Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="css/adminstyle.css" />
	 <script src="js/jquery.min.js"></script>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>	
       
                <script type="text/javascript">
            $().ready(function() {
                $("#LoginForrm").validate({
                    rules: {
                        email: {
                            required: true,   
                            email: true
                        },
                        password: {
                            required: true
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter email address",                           
                            email: "Email address must be in the format of name@domain.com"
                        },
                        password: {
                            required: "Please enter a password"
                        }
                    }
                });
                $("#password").focus(function() {
                    var password = $("#password").val();
                    var email = $("#email").val();
                    if(password && email && !this.value) {
                        this.value = password + "." + email;
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
    </head>
    <body>
		<div class="wrapper">
			<h2>The Maverik Game Admin</h2>
			<?php
                if (isset($_REQUEST['msg'])) {
                    ?>    
                    <p class="error1" align="center">Invalid user name or password</p>
                    <?php
                }
                ?>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
					
					<form id="LoginForrm" name="LoginForrm" class="login active" method="POST" action="doadminlogin.php">
						<h3>Login</h3>
						<div>
							<label>Email:</label>
							<input type="text" name="email" id="email" 
                            value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Password: <a href="forgot_password.php" rel="forgot_password" class="forgot linkform">Forgot your password?</a></label>
							<input type="password" id="password" name="password" 
                            value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>" />
							<span class="error">This is an error</span>
						</div>
						<div class="bottom">
							<div class="remember"><input type="checkbox" name="rememberme" value="rememberme" <?php if(isset($_COOKIE['email'])) { ?> checked="checked" <?php }?> /><span>Keep me logged in</span></div>
							<input type="submit" value="Login">
							
							<div class="clear"></div>
						</div>
					</form>
									</div>
				<div class="clear"></div>
			</div>
			
		</div>
		
		
    </body>
</html>