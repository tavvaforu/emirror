
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
   
    	    <li><a href="index.php?file=m-messages" ><img src="{IMG_URL}expression.gif" width="16" height="11" />Expressions</a></li>

            <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>

            <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>

            <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>

         </ul>

       </div>

      <div><h3>APPLICATIONS</h3></div>

     <div class="favor">

	  <ul>

    	<li><a href="index.php?file=p-photos" class="actv" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>

        <li><a href="index.php?file=v-videos"><img src="{IMG_URL}video.gif" width="16" height="16" />Videos</a></li>

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
    <div class="dailytriggertabs">
   <form action="index.php?file=p-album" name="albumform" method="POST" enctype="multipart/form-data">
   <input type="hidden" name="alid" value="{ALBUM_ID}">
    <input type="hidden" name="mode" id="mode" value="{MODE}">
	<input type="hidden" name="Aphoto" value="{ALBUMPHOTO}">
	
    <div class="clear"></div>
    <div style="width:500px; float:left; padding:10px 0;">	
	<h3>{MODE1} Album</h3><br>
      <span>Album Title&nbsp;&nbsp;</span>
	  <input name="album_title" id="album_title" type="text" value="{ALBUM_TITLE}" style="width:200px;  margin-left:10px;" />
      <br /><br />
	  <!-- <span>Album Photo</span>
	  <input name="album_photo" id="album_photo" type="file" style="width:200px;margin-left:10px;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{IMGVIEW}
      <br /><br />
	  -->
        {BTN}
        <input id="Cancel" name="Cancel" class="inr_btn" type="button" value="Cancel" onclick="window.location.href='index.php?file=p-photos';" />
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