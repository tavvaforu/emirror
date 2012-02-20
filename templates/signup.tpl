<link href="{STYLE_URL}template.css" rel="stylesheet" type="text/css" />







<!--[if lte IE 7]>



 <!--[if lte IE 7]>



<link href="{STYLE_URL}style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->	



<script src="{SCRIPT_URL}jalerts/jquery.ui.draggable.js" type="text/javascript"></script>



<script src="{SCRIPT_URL}jalerts/jquery.alerts.js" type="text/javascript"></script>



<script type="text/javascript" src="{SCRIPT_URL}common.js" ></script>



<link href="{SCRIPT_URL}jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />

 

  <div style="clear:both; padding:0; margin:0;"></div>

  

  <div id="login_screen">

   <div class="login_box" style="padding-top:10px;">

     <div id="signup-wrap">

      <div class="fheading"><img src="{IMG_URL}signuptxt.png" width="89" height="23" alt="emotions mirror" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	  <span style="color:#F00;font-weight:bold">{MSG}</span></div>

	  <div class="clear"></div>

      <div class="formleft">

	  <form action="index.php?file=u-signup" method="POST" name="regform" class="form">

        <h4>First Name<span style="color:#F00">*</span></h4>

        <input name="firstname" type="text" id="firstname "value="" />
        <h4>Email Address<span style="color:#F00">*</span></h4>

        <input name="email" type="text" id="email "value="" />

       <h4>User Name<span style="color:#F00">*</span></h4>

        <input name="username" type="text" id="username "value="" />

          

         <h4>Password<span style="color:#F00">*</span></h4>

        <input name="pwd" type="password" id="pwd" value="" />

         <!--<div class="captcha" >{CAPTCHA}

  

      </div>-->

      <div class="clear"></div>

        <div class="trms">

       <input name="terms" type="checkbox"  id="terms" />

       <h4 style="text-decoration:underline; width:520px;">I agree to Terms and Conditions</h4>

       </div>

     

      <div style="padding:10px 0;">

        <input type="submit" name="Signup" id="button" value="Signup" class="submit_btn" onclick="return validate_registerform(document.regform);"/>

        </div>

		</form>

      </div>

      

      <div class="formright">

       

        <span style="font-size:16px; color:#fff; font-weight:bold; text-decoration:underline;">Advantages</span>

       

        
        <ul style="color:#fff;  padding:5px 0px; font-size:13px; list-style-type:none;">

         <li style="color:#fff;  padding:5px 0;">Record,Analyze and Track your life</li>

         <li style="color:#fff;  padding:5px 0;">Freedom to express hidden emotions</li>

         <li style="color:#fff;  padding:5px 0;">Tools to support your feelings</li>
		 <li style="color:#fff;  padding:5px 0;">Strengthen your relationships</li>
		 <li style="color:#fff;  padding:5px 0;">Social Network Integration</li>

        </ul>

         <div style="width:215px; margin:10px 0; background:none;" > <div id="fb-root"></div>
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
         FB.init({ 
            appId:'159043227504373', cookie:true, 
            status:true, xfbml:true 
         });
      </script>
      <fb:login-button>Signup with Facebook</fb:login-button>
</div> 

        <span style=" width:300px; font-size:12px; color:#fff;">Skip the forms by signing in with your Facebook

Account.

</span>

<div style=" width:100px; margin:10px 0;"><a href="#" style=" font-size:16px; color:#fff;">Learn More</a></div>

      </div>

    </div>

  </div>

  </div>

  <div class="clear"></div>

  <div id="scnd_row">

  <div class="scnd_panel">

    <div class="review_wrap">

    <h5>Read and Write Reviews</h5>

    <div class="vimg_holder">

    <img src="{IMG_URL}review_img.png"  width="208" height="151" alt="Read and Write Reviews" />

    </div>

  </div>

  

  <div class="review_wrap">

    <h5>A Quick Introduction</h5>

    <div class="vimg_holder">

    <div id="videoObject" style="height: 150px; width: 208px">

	            <object width="208" height="150">

	                <param name="movie" value="http://www.youtube.com/v/LNE0R3rEe5Q&hl=en&fs=1&amp;rel=0" />

	                <param name="allowFullScreen" value="true" />

	                <param name="allowscriptaccess" value="always" />

	                <embed src="http://www.youtube.com/v/LNE0R3rEe5Q&hl=en&fs=1&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="208" height="150" />

	            </object>

            </div>



    </div>

  </div>

  

  <div class="social_icon_holder">

    <div class="iconholder"><img src="{IMG_URL}twitter_icon.png" width="124" height="41" alt="twitter" /></div>

    <div class="iconholder"><img src="{IMG_URL}facebook_icon.png" width="156" height="41" alt="facebook" /></div>

    <div class="iconholder" style="border:none;"><img src="{IMG_URL}facebooklikes.png" width="213" height="36" alt="FB Likes" /></div>

  </div>

  </div>

  </div>

  

  <div class="clear"></div>





