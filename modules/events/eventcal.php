<?php
require_once("includes/header.php");
$userid=$_SESSION['sess_memberid'];
//display photo
$photo=$_SESSION['sess_profilephoto'];
	   if($photo!=""){
			$photopath=MEDIA_ROOT.'members/'.$photo;
	   }else{
			$photopath=IMG_ROOT.'profile.jpg';
			}	
	$flname = explode('_-_',$photo);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}
$dsphoto="<a href='media/members/".$photo."' target='_blank' >".$atchName."</a>&nbsp;&nbsp;&nbsp;" ;
$dsImage= $photopath;
$tp=str_replace("{dsImage}",$dsImage,$tp);
//end	
?>
	<script src="<? echo USER_MODULE;?>dhtmlxScheduler/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<? echo USER_MODULE;?>dhtmlxScheduler/codebase/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" charset="utf-8">
   function init() {

		scheduler.config.xml_date="%Y-%m-%d %H:%i";
		scheduler.config.lightbox.sections=[	
			{name:"description", height:130, map_to:"text", type:"textarea" , focus:true},
			{name:"type", height:21, type:"select", map_to:"event_type", options:[
				{ key:0, label:"Private event" },
				{ key:1, label:"Shared event" }
			]},
			{name:"time", height:72, type:"time", map_to:"auto"}
		]
		scheduler.config.first_hour=6;
		scheduler.locale.labels.section_type="Sharing";
		scheduler.config.details_on_create=true;
		scheduler.config.details_on_dblclick=true;
		scheduler.init('scheduler_here',null,"month");
		scheduler.load("<? echo USER_MODULE;?>dhtmlxScheduler/samples/customization/shared_events/events.php?user=<?=$userid?>&uid="+scheduler.uid());
		var dp = new dataProcessor("<? echo USER_MODULE;?>dhtmlxScheduler/samples/customization/shared_events/events.php?user=<?=$userid?>");
		dp.init(scheduler);
	}
    </script>
</head>
<link href="<? echo STYLE_ROOT;?>template.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
 <!--[if lte IE 7]>
<link href="<? echo STYLE_ROOT?>style.ie.css" rel="stylesheet" type="text/css" /><![endif]-->	
<script src="<? echo SCRIPT_ROOT;?>jalerts/jquery.ui.draggable.js" type="text/javascript"></script>
<script src="<? echo SCRIPT_ROOT;?>jalerts/jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="<? echo SCRIPT_ROOT;?>common.js" ></script>
<link href="<? echo SCRIPT_ROOT;?>jalerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
<!-- Arquivos utilizados pelo jQuery lightBox plugin -->
    <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="<? echo SCRIPT_ROOT;?>jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="<? echo SCRIPT_ROOT;?>jquery-ui-1.8.16.custom.min.js"></script>
<body onLoad="init();">
  <div id="inner_screen">
   <div class="login_box">    
    <div id="innerpage-wrap">
       <div id="maincontent">
<!--firstdiv Starts-->
	<div class="firstdiv">    
			<div class="profilepic"><img src="<? echo $dsImage;?>" width="100" height="100" /></div>
        	<div class="edittext"><a href="index.php?file=s-profile">Edit profile pic</a></div>
<div>
  <h3>FAVORITES</h3>
</div>
<div class="favor">
	      <ul>
    	    <li><a href="index.php?file=m-messages" ><img src="<? echo IMG_ROOT;?>expression.gif" width="16" height="11" class="actv" />Expressions</a></li>
            <li><a href="index.php?file=t-trigger" ><img src="<? echo IMG_ROOT;?>news_feed.gif" width="16" height="16" />Daily Trigger</a></li>
            <li><a href="index.php?file=j-journal" ><img src="<? echo IMG_ROOT;?>journalicon.gif" width="16" height="16" />Journal</a></li>
            <li><img src="<? echo IMG_ROOT;?>events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>
         </ul>
       </div>
      <div><h3>APPLICATIONS</h3></div>
     <div class="favor">
	  <ul>
    	<li><a href="index.php?file=p-photos" ><img src="<? echo IMG_ROOT;?>camera.gif" width="16" height="16" />Photos</a></li>
        <li><a href="index.php?file=v-videos"><img src="<? echo IMG_ROOT;?>video.gif" width="16" height="16" />Videos</a></li>
        <li><a href="index.php?file=e-eventcal" ><img src="<? echo IMG_ROOT;?>events.gif" width="16" height="16" /><span  class="actv">Events</span></a></li>
    </ul>
    </div>
    <div><h3>SETTINGS</h3></div>
    <div class="favor">
	<ul>
        <li><a href="index.php?file=s-profile"><img src="<? echo IMG_ROOT;?>profile_pic.gif" width="16" height="16" />Profile</a></li>
    	<li><a href="index.php?file=s-dashboard"  ><img src="<? echo IMG_ROOT;?>dashboard.gif" width="16" height="16" />Dashboard</a></li>
    </ul>

   </div>

  </div>  <!--firstdiv Ends-->
 <!--profiles Starts-->
 <div id="profiles">

  <div class="clear"></div>
  
   <div class="innerdiv">
    <div class="content" id="page-1">
	<span><font color="red"><b></b></font></span>
    <div class="dailytriggertabs">
   <div align="center"><b>Event Calendar</b>	</div><br /><br />
<div class="listwrapper" style="height:450px;">

<div align="center">
<div id="scheduler_here" class="dhx_cal_container" style="width: 95%; height:430px; " >
<div class="dhx_cal_navline">
<div class="dhx_cal_prev_button">&nbsp;</div>
<div class="dhx_cal_next_button">&nbsp;</div>
<div class="dhx_cal_today_button"></div>
<div class="dhx_cal_date"></div>
<div class="dhx_cal_tab" name="day_tab" style="right: 204px;"></div>
<div class="dhx_cal_tab" name="week_tab" style="right: 140px;"></div>
<div class="dhx_cal_tab" name="month_tab" style="right: 76px;"></div>
</div>
<div style="width: 680px; height: 20px; left: -1px; top: 23px;" class="dhx_cal_header">
</div>
<div style="width: 680px; height: 253px; left: 0px; top: 44px;" class="dhx_cal_data"></div>
</div>
</div>

</div>
 </div>
    <div class="clear"></div>
    </div>
    </div>
   </div>

 </div> 
 <!--profiles Ends-->		
 <div class="thirdiv"><img src="<? echo IMG_ROOT;?>ADD.jpg" width="120" height="450" /></div>

  	

 <!--third div starts-->     

</div>
<div class="clearall"></div>
</div> 
    </div>
    </div>
	
</body>

</body>
</html>
 <script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>

<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
</script>