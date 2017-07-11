<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=481352955356475";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="login-popup" class="popup">
    <div class="popup-body">	
    <span class="popup-exit">X</span>

        <div class="popup-content">
             <h2>LOG IN</h2>
             
             <form action="user_login.php" method="post" id="userLogin" name="userLogin">
             <div class="contact-frm">
             <p>Already have an account? </p>
              <p> 
                  <div class="leftBox">
                  <label>Email</label>
                  <input type="text" plzceholder="" value="" name="user_email" id="user_email"/>
                  </div>
                  <div class="rightBox">
                 <label>Password</label>
                 <input type="password" plzceholder="" value="" id="password" name="user_password"/> 
                 </div>                 
              </p>
              <h3>Sign up Quickly:</h3>
              <div class="social-media-box">
                  <a href="fbconfig.php">  <img src="assets/images/fb-sign.jpg" width="227" height="37" alt=""></a> <br>           
           <a href="<?php echo $client->createAuthUrl()?>" class="googleLoginButton"> <img src="assets/images/google-sign.jpg" width="227" height="37" alt=""></a></a>
	      
             
                 
                <span>it's fast and easy to signup with Facebook and google.</span>
              </div>
              
             </div> 
                 <input type="submit" value="Submit" class="submit" name="submit" /> 
           </form>
   
            
        </div>
    </div>
</div>


<div id="forget-popup" class="popup">
    <div class="popup-body">	
    <span class="popup-exit force-close">X</span>

        <div class="popup-content">
            	

             <h2>Forget Password</h2>
             
             <form action="user_login.php" method="post" id="userLogin" name="userLogin">
             <div class="contact-frm">
             <p>Enter your email address.</p>
             <br/>
              <p> 
                  <div class="">
                  <input type="text" plzceholder="" value="" name="user_email" id="user_email"/>
                  </div>
                  
               
              </p>
         
              
              
             </div> 
                 <input type="submit" value="Submit" class="submit" name="submit" /> 
           </form>
   
            
        </div>
    </div>
</div>


