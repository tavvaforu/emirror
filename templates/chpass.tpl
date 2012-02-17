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

      <div class="fheading"><img src="{IMG_URL}changepassword.png" width="178" height="28" alt="emotions mirror" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	  <span style="color:#F00;font-weight:bold">{MSG}</span></div>

	  <div class="clear"></div>

      <div class="formleft">

	  <form action="index.php?file=u-chpass" method="POST" onsubmit="return validate_chpform(this,'{oldpass}');" name="changepassword" class="form">
     <h4>Old Password<span style="color:#F00">*</span></h4>

        <input type='password' name='password' id='password' >
		
		 <h4>New Password<span style="color:#F00">*</span></h4>

        <input type='password' name='newpassword' id='newpassword' >

 <h4>Retype Password<span style="color:#F00">*</span></h4>

        <input type='password' name='reptypepassword' id='reptypepassword' >


      <div class="clear"></div>

       
     

      <div style="padding:10px; float:left">

        <input type="submit" name="Signup" id="button" value="Submit" class="submit_btn" />

        </div>
        
        <div style="padding:10px; float:left">

        <input type="button" name="Signup" id="button" value="Cancel" onclick="javascript:history.go(-1);" class="submit_btn" />

        </div>

		</form>

      </div>

      

      <div class="formright">

       

      </div>

    </div>

  </div>

  </div>

  <div class="clear"></div>

    

  <div class="clear"></div>

 <script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>



