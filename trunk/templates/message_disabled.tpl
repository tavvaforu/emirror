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

		<script type="text/javascript">

			$(function() {			

			if(document.getElementById("intensity").value!="")

			{

			   a=document.getElementById("intensity").value;

			}else{

			   a=3;

			 }

		$( "#slider-range-min" ).slider({

			range: "min",

			value: a,

			min: 1,

			max: 5,

			slide: function( event, ui ) {

				$( "#intensity" ).val(ui.value );

			}

		});

		$( "#intensity" ).val( $( "#slider-range-min" ).slider( "value" ) );

	});

		</script>

		<style type="text/css">

			/*demo page css*/

			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}

			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}

			ul#icons {margin: 0; padding: 0;}

			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}

			ul#icons span.ui-icon {float: left; margin: 0 4px;}

		</style>	



<!--[if lte IE 6]>

   <script type="text/javascript" src="{SCRIPT_URL}supersleight-min.js"></script>

<![endif]-->



	<!--<script>

		!window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');

	</script>-->

<!-- Script End-->



<!--divs body section-->



    <div id="inner_screen">

   <div class="login_box">    

    <div id="innerpage-wrap">

       <div id="maincontent">

<!--firstdiv Starts-->

	<div class="firstdiv">    

    	<div class="profilepic"><img src="{dsImage}" width="100" height="100" /></div>

        <div class="edittext"><a href="index.php?file=s-profile">Edit profile pic</a></div>

        <div><h3>FAVORITES</h3></div>

        <div class="favor">

	      <ul>
   
    	    <li><a href="index.php?file=m-messages"><img src="{IMG_URL}expression.gif" width="16" height="11" /><span  class="actv">Expressions</span></a></li>

            <li><a href="index.php?file=t-trigger" ><img src="{IMG_URL}news_feed.gif" width="16" height="16" />Daily Trigger</a></li>

            <li><a href="index.php?file=j-journal" ><img src="{IMG_URL}journalicon.gif" width="16" height="16" />Journal</a></li>

            <li><img src="{IMG_URL}events_icon.gif" width="16" height="16" /><a href="index.php?file=me-memories" >Memories</a></li>

         </ul>

       </div>

      <div><h3>APPLICATIONS</h3></div>

     <div class="favor">

	  <ul>

    	<li><a href="index.php?file=p-photos" ><img src="{IMG_URL}camera.gif" width="16" height="16" />Photos</a></li>

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


  <div class="innerdiv">
  <div class="content" id="page-1">

    <div class="dailytriggertabs">

   

    <div style="width:700px; padding:10px 0;">

      <div style="width:660px; float:left; padding:5px 10px; background:#eceded; margin-bottom:20px;">

        <span style="font-size:12px; font-weight:bold; color:#0075b7;">Profile </span>
        
      </div>   <div > <span> <font color="red"><b>&nbsp;&nbsp;&nbsp;{msg}</b></font></span></div>
      
  <div height="400" align="center"> You disabled Expressions</div>
  </div>
  </div>
  </div>

  </div>



 </div> 

 <!--profiles Ends-->

 <div class="thirdiv"><img src="{IMG_URL}ADD.jpg" width="120" height="450" /></div>

  	

 <!--third div starts-->     

</div>



<div class="clearall"></div>



</div> 

    </div>

    </div>

		<!--- calendar setups-->

  <script src="{SCRIPT_URL}JSCal2-1.9/src/js/jscal2.js"></script>

    <script src="{SCRIPT_URL}JSCal2-1.9/src/js/lang/en.js"></script>

	<link rel="stylesheet" type="text/css" href="{SCRIPT_URL}JSCal2-1.9/src/css/jscal2.css" />

<script src="{SCRIPT_URL}activatables.js" type="text/javascript"></script>

<script type="text/javascript">

activatables('page', ['page-1', 'page-2', 'page-3']);

</script>

<script type="text/javascript" src="{SCRIPT_URL}dropdown.js"></script>

<script type="text/javascript">
cssdropdown.startchrome("chromemenu")
function CheckAll(chk)

{



if(document.getElementById('Check_All').checked)

{

var ids="";

for (i = 0; i < chk.length; i++){

chk[i].checked = true ;

//ids=chk[i].value ;

//ids+=',';

}



}

else

{

for (i = 0; i < chk.length; i++)

chk[i].checked = false ;

}

}



var upload_number = 2;

function addFileInput() {

 	var d = document.createElement("div");

 	var file = document.createElement("input");

 	file.setAttribute("type", "file");

 	file.setAttribute("name", "attachment_"+upload_number);

 	d.appendChild(file);

 	document.getElementById("moreUploads").appendChild(d);

	document.getElementById("unums").value=upload_number;

 	upload_number++;

	

}
//<![CDATA[



      var cal = Calendar.setup({

          onSelect: function(cal) { cal.hide() },

          showTime: true

      });

     // cal.manageFields("f_btn1", "fromdate", "%Y-%m-%d");

     // cal.manageFields("f_btn2", "todate", "%Y-%m-%d");

      cal.manageFields("f_btn1", "fromdate", "%b %e %Y");

      cal.manageFields("f_btn2", "todate", "%b %e %Y");

    //]]

	



</script>

<script>

//alert(document.frmsearch.keyword.value);

function valid_search(actPath)

{

	/*if(document.frmsearch.fromdate.value=="" && document.frmsearch.keyword.value=="" && document.frmsearch.todate.value=="")

	{

		alert("Please Enter alteast one text field for Search.");

		document.frmsearch.keyword.focus();

		return false;

	}

	if(document.frmsearch.keyword.value=="")

	{

		if(document.frmsearch.fromdate.value=="")

		{

			alert("Please Select the From date.");

			document.frmsearch.fromdate.focus();

			return false;

		}

		if(document.frmsearch.todate.value=="")

		{

		 alert("Please Select the Todate.");

		 document.frmsearch.todate.focus();

		 return false;

		}

		var start = document.frmsearch.fromdate.value;

		var end = document.frmsearch.todate.value;

		var stDate = new Date(start);

		var enDate = new Date(end);

		var compDate = enDate - stDate;

		//alert(compDate);

		if(compDate >= 0)

		{

			//alert('true');

			//return true;

		}

		else

		{

		jAlert("Please Enter the correct date ");

		return false;

		}



		

	} else {*/

	

		if(document.frmsearch.fromdate.value!="")

		{

			if(document.frmsearch.todate.value=="")

			{

				alert("Please Select the Todate.");

				document.frmsearch.todate.focus();

				return false;

			}

				var start = document.frmsearch.fromdate.value;

				var end = document.frmsearch.todate.value;

				var stDate = new Date(start);

				var enDate = new Date(end);

				var compDate = enDate - stDate;

				//alert(compDate);

				if(compDate >= 0)

				{

					//alert('true');

					//return true;

				}

				else

				{

				jAlert("Please Enter the correct date ");

				return false;

				}

		}

		if(document.frmsearch.todate.value!="")

		{

			if(document.frmsearch.fromdate.value=="")

			{

				alert("Please Select the From date.");

				document.frmsearch.fromdate.focus();

				return false;

			}

			var start = document.frmsearch.fromdate.value;

			var end = document.frmsearch.todate.value;

			var stDate = new Date(start);

			var enDate = new Date(end);

			var compDate = enDate - stDate;

			//alert(compDate);

			if(compDate >= 0)

			{

				//alert('true');

				//return true;

			}

			else

			{

			jAlert("Please Enter the correct date ");

			return false;

			}

		}

		

		

	

	//}

	//alert(actPath);

	document.frmsearch.mode.value="Search";


var stype=document.getElementById("stype").value;
	if(actPath)

	{

		

		window.location=actPath+"&mode=Search&keyword="+document.frmsearch.keyword.value+"&fromdate="+document.frmsearch.fromdate.value+"&todate="+document.frmsearch.todate.value+"#page=page-2";

		return false;

	}

}	

	



	</script>

	

<script type="text/javascript">

  function change_bg(liid)

  {

	//alert(liid);

	 var arr=document.getElementById("mycolorband").getElementsByTagName("a");

	 //alert(arr.length);

	 for(var i=0;i<arr.length;i++)

	 {

		 aid=arr[i].id;

		 if(aid==liid)

		 {

			 document.getElementById(aid).style.background="url(media/images/color_image/"+aid+".png)";

		 }

		 else

		 {

			 document.getElementById(aid).style.background="";

		 }

	 }

  }
</script>


