
<link href="{STYLE_URL}template.css" rel="stylesheet" type="text/css" />

<!--[if lte IE 7]>

 <!--[if lte IE 7]>

<link href="{STYLE_URL}style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->	

<script src="{SCRIPT_URL}jalerts/jquery.ui.draggable.js" type="text/javascript"></script>

<script src="{SCRIPT_URL}jalerts/jquery.alerts.js" type="text/javascript"></script>

<script type="text/javascript" src="{SCRIPT_URL}common.js" ></script>

<link href="{SCRIPT_URL}jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />



<!-- Arquivos utilizados pelo jQuery lightBox plugin -->



    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

		<script type="text/javascript" src="{SCRIPT_URL}jquery-1.6.2.min.js"></script>

		<script type="text/javascript" src="{SCRIPT_URL}jquery-ui-1.8.16.custom.min.js"></script>
  <div id="inner_screen">
   <div class="login_box">
    
    
    <div id="innerpage-wrap">
       <div id="maincontent">
<!--firstdiv Starts-->
	<div class="firstdiv">    
    	<div class="profilepic"><img src="{dsImage}" width="100" height="100" /></div>
        	<div class="edittext"><a href="index.php?file=s-profile">Edit profile pic</a></div>
<div>
  <h3>FAVORITES</h3>
</div>
 <div class="favor">

	      <ul>
   
    	    <li><a href="index.php?file=m-messages" ><img src="{IMG_URL}expression.gif" width="16" height="11" class="actv" />Expressions</a></li>

            <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>

            <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>

            <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>

         </ul>

       </div>

      <div><h3>APPLICATIONS</h3></div>

     <div class="favor">

	  <ul>

    	<li><a href="index.php?file=p-photos" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>

        <li><a href="index.php?file=v-videos" class="actv" ><img src="{IMG_URL}video.gif" width="16" height="16" />Videos</a></li>

        <li><a href="index.php?file=e-eventcal"><img src="{IMG_URL}events.gif" width="16" height="16" />Events</a></li>

    </ul>

    </div>

 
    <div><h3>SETTINGS</h3></div>

    <div class="favor">

	<ul>

        <li><a href="index.php?file=s-profile"><img src="{IMG_URL}profile_pic.gif" width="16" height="16" />Profile</a></li>

    	<li><a href="index.php?file=s-dashboard"  ><img src="{IMG_URL}dashboard.gif" width="16" height="16" />Dashboard</a></li>

        <!-- <li><a href="notification.hml"><img src="{IMG_URL}notification.gif" width="16" height="16" />Notification </a></li> -->

    </ul>

   </div>

  </div>
 <!--firstdiv Ends-->
 <!--profiles Starts-->
 <div id="profiles">

  <div class="clear"></div>
  
   <div class="innerdiv">
    <div class="content" id="page-1">
	<span><font color="red"><b>{MSG}</b></font></span>
	<span><font color="red"><b>{PHOTOMSG}</b></font></span>
	
    <div class="dailytriggertabs">
   <form action="index.php?file=v-addalbumvideos" name="albumvideoform" method="POST" enctype="multipart/form-data">
   <input type="hidden" name="videoalbumid" id="videoalbumid" value="{videoalbumid}">
   <input type="hidden" name="videoid" id="videoid" value="{videoid}">
    <input type="hidden" name="mode" id="mode" value="{MODE}">
	<input type="hidden" name="pphoto" value="{PHOTO}">
    <div class="clear"></div>
    <div style="width:500px; float:left; padding:10px 0;">
	<h3>{albumtitle}</h3> <br /><br />
      <span>Video Title&nbsp;&nbsp;</span>
	  <input name="video_title" id="video_title" type="text" value="{videotitle}" style="width:200px;  margin-left:10px;" />
      <br /><br />
	   <span>Video URL</span>
	   <input name="video_code" id="video_code" type="text" value="{video_code}" style="width:200px;  margin-left:10px;" />
      <br /><br />
	  
        {BTN}
        <input id="Cancel" name="Cancel" class="inr_btn" type="button" value="Cancel" onclick="window.location.href='index.php?file=v-videos';" />
    </div>
    </form>
    <div class="clear"></div>
    </div>
    </div>
   </div>

 </div> 
 <!--profiles Ends-->		
 <!--<div class="thirdiv"><img src="{IMG_URL}ADD.jpg" width="120" height="450" /></div>-->

  	

 <!--third div starts-->     

</div>
<div class="clearall"></div>
</div> 
    </div>
    </div>
 <script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>
<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>