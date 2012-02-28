<?php
require_once("includes/header.php");
$checkid=@implode(",",$_POST['check_list']);

$arr=explode(".",$_SERVER['HTTP_HOST']);

//echo '<pre>';print_r($_POST);exit;
//print_r($_GET);
$delid=$_GET['delid'];
$action=$_GET['action'];	
//echo $_POST['keyword'];


$db=new myclass;
$db->myconnect();
$sql_mem=mysql_query("select * from members where member_id='".$_SESSION['sess_memberid']."'");
$memar=mysql_fetch_array($sql_mem);
$nn=$memar['first_name'];
$tmail=$memar['email'];
$tpl_object = new Template("templates/trigger");
$tp = $tpl_object->getContent();
/*if($_POST['mode']=="Delete"){
}*/

if(isset($_GET['id']) && $_GET['id']!="")
{
	$id = $_GET['id'];
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'";
  $my_draft=mysql_query("select a.*,b.message_intensity as color_id,b.desc as motion from messagetrigger a,message_intensity b where a.message_color_id=b.id and a.id='$id'");
  $my_arrdraft=mysql_fetch_array($my_draft);
  $title_trigger=$my_arrdraft['title'];
  $motion= strtolower($my_arrdraft['motion']);
  $id=$my_arrdraft['id'];
 $draftmessage=$my_arrdraft['message'];
$condate=strtotime($my_arrdraft['create_time']);
		$draftdate=date('j M Y',$condate);
$draftmessage_intensity=$my_arrdraft['message_intensity'];
$col_id=$my_arrdraft['color_id'];
$sender=$my_arrdraft['sender_name'];
$attachres=mysql_query("select * from trigger_attachments where trigger_id=$id");
$i=1;
while($ar=mysql_fetch_array($attachres))
{
	$fil=$ar['attachments'];
	$flname = explode('_-_',$fil);
	//echo '<pre>';print_r($flname);exit;
	//echo count($flname);
	if(count($flname)>1)
	{
		$atchName = $flname[1];
	} else {
		$atchName = $fil;
	}
$resattach.="<a href='media/trigger_files/".$fil."' target='_blank' >".$atchName."</a><br>" ;
$i++;

}
}
//echo "select id from messagetrigger where  sender_email='$tmail' and send_type=1  and status!='SDeleted' and status!='Deleted' ";
$r1=mysql_query("select id from messagetrigger where  sender_email='$tmail' and message_type_id=1 and send_type=0  and status!='SDeleted' and status!='Deleted' ");
$tot_sent=mysql_num_rows($r1);
//echo "select id from messagetrigger where  email='$tmail' and status!='RDeleted' and status!='Deleted' ";
$r2=mysql_query("select id from messagetrigger where  email='$tmail' and message_type_id=1 and send_type=0 and status!='RDeleted' and status!='Deleted' ");
$tot_received=mysql_num_rows($r2);


$colorsQuery = mysql_query("SELECT * FROM message_intensity");
$totalColors = mysql_num_rows($colorsQuery);

/////////# of messages sent Graph Code///////////////
$chsent = '';
while($my_colors=mysql_fetch_array($colorsQuery))
{
	$ch1=mysql_query("SELECT message_color_id FROM messagetrigger  where  sender_email='$tmail' and message_type_id=1 and status!='SDeleted' and send_type =0 and status!='Deleted' and message_color_id=".$my_colors['id']);
	
	if(mysql_num_rows($ch1)!=0)
	{
		$nr=mysql_num_rows($ch1);
		if($i1!=$totalColors)
		{
		$chsent.=$nr.",";
		$chcolorCode.=$my_colors['message_intensity'].",";
		$chcolorType.=$my_colors['desc']."|";
		$chcolorcounts.=$nr."|";
		}
		else
		{
		$chsent.=$nr;
		}

	}
}
if($chsent!='')
{
	$chsent = trim($chsent,',');
	$chcolorCode = trim($chcolorCode,',');
	$chcolorType = trim($chcolorType,'|');
	$chcolorcounts = trim($chcolorcounts,'|');
}
/////////////////End//////////////////////


/////////# of messages sent Graph Code///////////////
$chrec = '';
//echo 'inside';exit;
$colorsQuery1 = mysql_query("SELECT * FROM message_intensity");
while($my_colors1=mysql_fetch_array($colorsQuery1))
{
	
	$ch1=mysql_query("SELECT message_color_id FROM messagetrigger  where  email='$tmail' and message_type_id=1 and send_type=0 and status!='SDeleted' and status!='Deleted' and message_color_id=".$my_colors1['id']);
	
	if(mysql_num_rows($ch1)!=0)
	{
		$nr1=mysql_num_rows($ch1);
		if($i1!=$totalColors)
		{
		$chrec.=$nr1.",";
		$chcolorCodeRec.=$my_colors1['message_intensity'].",";
		$chcolorTypeRec.=$my_colors1['desc']."|";
		$chcolorcount.=$nr1."|";
		}
		else
		{
		$chrec.=$nr1;
		}

	}
}
if($chrec!='')
{
	$chrec = trim($chrec,',');
	$chcolorCodeRec = trim($chcolorCodeRec,',');
	$chcolorTypeRec = trim($chcolorTypeRec,'|');
	$chcolorcount = trim($chcolorcount,'|');
}
/////////////////End//////////////////////


//echo $chsent.'----'.$chcolorCode.'------'.$chcolorType;exit;

if($chsent != '')
{
	$sent_cht="<img src='http://chart.apis.google.com/chart?cht=p&chs=300x150&chd=t:".$chsent."&chco=".$chcolorCode."&chl=".$chcolorType."&chdl=".$chcolorcounts."' >";
} else {

	$sent_cht = '&nbsp;&nbsp;&nbsp;No data available';
}



if($chrec != '')
{
	$rec_cht="<img src='http://chart.apis.google.com/chart?cht=p&chs=300x150&chd=t:".$chrec."&chco=".$chcolorCodeRec."&chl=".$chcolorTypeRec."&chdl=".$chcolorcount."' >";
} else {
	$rec_cht="&nbsp;&nbsp;&nbsp;No data available";
}



if($action="Delete" && $delid!="")
{
$sql=mysql_query("update messagetrigger set status='Deleted' where id='".$delid."'");
 $msg="Record deleted succesfully";
  
}

if(isset($_GET['msg']))
{
  $msg=$_GET['msg'];
}
if($msg!='')
{
 echo "<script>alert('$msg');</script>";
}
$tp=str_replace("{msg}",$msg,$tp);
if(!isset($_GET['order']))
{
	$order='create_time';
}else{
$order=$_GET['order'];
}
$otype=$_GET['otype'];
if(!isset($_GET['otype']))
{
	$otype="d";
} else {
	$otype=$_GET['otype'];
}
if($otype=='a')
{
$ot="asc";	
}
else
{
$ot="desc";
}
//echo $otype;
//echo $ot;exit;

//echo  $_POST['saveForm'];exit;


//Insertion of triggers

if($_POST['saveForm']=="Save")
{
//echo '<PRE>';print_r($_POST);exit;
	$title=$_POST['title_trigger'];
	$message=$_POST['message'];
	$message_intensity=$_POST['intensity'];
	$message_color_id=$_POST['color_id'];
	$message_type_id=1;
	$sender_name="$nn";
	$sender_email="$tmail";
		$send_type = "0";
		$msg="Trigger Saved succesfully.";
		$saveType = 0;
	
	//echo "insert into messagetrigger(sender_name,sender_email,message,message_intensity,message_type_id,send_type,message_color_id)values('$nn','$tmail','$message','$message_intensity','$message_type_id','$send_type','$message_color_id')";exit;
	//mysql_query("insert into messagetrigger(sender_name,sender_email,message,message_intensity,message_type_id,send_type,title,message_color_id)values('$nn','$tmail','$message','$message_intensity','$message_type_id','$send_type','$title',$message_color_id)");
	//$insid=mysql_insert_id();
	if(isset($_POST['draftid']) && $_POST['draftid']!=""){
	//echo "update messagetrigger set sender_name='".$nn."',sender_email='".$tmail."',message='".$message."', message_intensity='".$message_intensity."',name='".$name."',email='".$email."',message_type_id='".$message_type_id."',send_type='".$send_type."',message_color_id='".$message_color_id."' where id='".$_POST['draftid']."'";exit;
	mysql_query("update messagetrigger set message='".$message."', message_intensity='".$message_intensity."',message_type_id='".$message_type_id."',title='".$title."',send_type='".$send_type."',message_color_id='".$message_color_id."' where id='".$_POST['draftid']."'");
	$insid=$_POST['draftid'];
	}else{
	//echo 'insert';exit;
	mysql_query("insert into messagetrigger(sender_name,sender_email,message,message_intensity,message_type_id,send_type,title,message_color_id)values('$nn','$tmail','$message','$message_intensity','$message_type_id','$send_type','$title',$message_color_id)");
	$insid=mysql_insert_id();
	}
	if($insid)
	  header("location:index.php?file=t-trigger&msg=$msg&stype=$saveType#page=page-2");
	?>
	
	
	<?php
	
	if($_POST['unums']>=1)
	{
		for($i=1;$i<=$_POST['unums'];$i++)
		{
			 $fname="attachment_".$i;
			if($_FILES[$fname]['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES[$fname]['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES[$fname]['tmp_name'],"media/trigger_files/".$fsname);
				mysql_query("insert into trigger_attachments(trigger_id,attachments)values($insid,'$fsname')");
				//$mail->AddAttachment("media/trigger_files/".$fsname);
				
			}
		}
	}

}

if(isset($_GET['stype']) && $_GET['stype']!="")
{
	$send_type=$_GET['stype'];
}
else
{
	$send_type=0;
}

if($send_type==2)
		{
			$osender="sender_name";
			$tp=str_replace("{SENDER_HEAD}","Sender",$tp);
		}
		else
		{
			$osender="name";
			$tp=str_replace("{SENDER_HEAD}","Receiver",$tp);
		}

	//for searching
	//print_r($_GET);exit;
	

	$keyword=$_GET['keyword'];
	$fromdate=$_GET['fromdate'];
	$todate=$_GET['todate'];
	
	
	if(isset($_GET['keyword']) && $_GET['keyword']!=""){
	////Added By Harinath
	   	if($send_type == 2)
		{
			$msql=" and (a.message like '%".$_GET['keyword']."%' or a.sender_name like '%".$_GET['keyword']."%'  or a.sender_email like '%".$_GET['keyword']."%')";
		} else
		{
			$msql=" and (a.message like '%".$_GET['keyword']."%' or a.name like '%".$_GET['keyword']."%'  or a.email like '%".$_GET['keyword']."%')";
		}
	   //end
	   //$msql=" and a.message like '%".$_GET['keyword']."%'";
	}
	else{
	$msql=" and 1=1";
	}
	if($_GET['fromdate']!="" && $_GET['todate']!=""){
	//$dsql=" and DATE_FORMAT(create_time, '%Y-%m-%d') between '".$_GET['fromdate']."'and '".$_GET['todate']."'";
	$dsql=" and DATE_FORMAT(create_time, '%Y-%m-%d') between '".date("Y-m-d", strtotime($_GET['fromdate']))."'and '".date("Y-m-d", strtotime($_GET['todate']))."'";
	}
	else{
	$dsql=" and 1=1";
	}
	
	//print_r($_POST);
	//print_r($_GET);
	if($_POST['saveForm']=="Delete")
{
  if($checkid!="")
  {
     //echo "update messagetrigger set status='Deleted' where id in ('".$checkid."')";
     $sql=mysql_query("update messagetrigger set status='Deleted' where id in (".$checkid.")");
     $msg="Record(s) deleted succesfully";
	  
  }
  else
  {
    $msg="Error-in deleting the Record";
  }$stype=$_POST['stype'];
  header("location:index.php?file=t-trigger&stype=$stype&msg=$msg#page=page-2");
}

/////Pagination code starts here//////////
/*if($send_type=='2')
{
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='1' and email='$tmail' $msql $dsql and status!='Deleted' and status!='RDeleted'";
$my_res1=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='2' and email='$tmail' and send_type=1  $msql $dsql and status!='Deleted' and status!='RDeleted'");
}else{*/
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='1' and sender_email='$tmail' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted'";
$my_res1=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='1' and sender_email='$tmail' and send_type=0 $msql $dsql and status!='Deleted' and status!='SDeleted'");
//}
/*paging statrs */
$totalRecords = mysql_num_rows($my_res1);
$limit = 10;
$totalPages = ceil ($totalRecords/$limit); 
$page   = intval($_GET['page']);
$start = $page* $limit;
if($page == '')
{
	$start = 0;
} else {
	$start = ($start - $limit);
}


$tpages = ($_GET['tpages']) ? intval($totalPages ) : $totalPages; // 20 by default
$adjacents  = intval($_GET['adjacents']);

if($page<=0)  $page  = 1;
if($adjacents<=0) $adjacents = 4;

$reload = $_SERVER['PHP_SELF'] . "?file=t-trigger&stype=".$stype."&tpages=" . $tpages . "&amp;adjacents=" . $adjacents;

/*  eends*/
//echo $start;
$next=$start+$limit;
//echo $totalRecords.'----'.$next;exit;
if($totalRecords < $next)
{ 
	$last = $totalRecords;
} else {
	$last  = $next;
}
$pagerecords=$start."-". $last." of ".$totalRecords;
//////ENd/////////

/*if($send_type=='2')
{
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='1'  and email='$tmail' $msql $dsql and status!='Deleted' and status!='RDeleted' order by $order $ot LIMIT $start,$limit";
$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and message_type_id='1' and email='$tmail' $msql $dsql and status!='Deleted' and status!='RDeleted' order by $order $ot LIMIT $start,$limit");
}
else
{*/
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='1' and send_type=$send_type $msql $dsql and status!='Deleted' and status!='SDeleted' order by $order $ot LIMIT $start,$limit";
$my_res=mysql_query("select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='1' and sender_email='$tmail' and send_type=0 $msql $dsql and status!='Deleted' and status!='SDeleted' order by $order $ot LIMIT $start,$limit");
//}
//echo "select a.*,b.message_intensity as color_id from messagetrigger a,message_intensity b where a.message_color_id=b.id and  message_type_id='1' and sender_email='$tmail' and send_type=0 $msql $dsql and status!='Deleted' and status!='SDeleted' order by $order $ot LIMIT $start,$limit";
//echo mysql_num_rows($my_res);exit;

if(mysql_num_rows($my_res)>0)
{
	$rcnt=0;
	while($my_arr=mysql_fetch_array($my_res))
	{
		$id=$my_arr['id'];
		$message=substr($my_arr['message'],0,8);
		$id=$my_arr['id'];
		$title=$my_arr['title'];
		//$condate=strtotime($my_arr['create_time']);
		//$date=date('j M Y',$condate);
		$date=$db->displayDateFormat($my_arr['create_time']);
		
		//=displayDateFormat($my_arr['create_time']);
		$message_intensity=$my_arr['message_intensity'];
		$col_id=$my_arr['color_id'];
		$sql_type=mysql_query("select * from message_intensity where message_intensity='".$col_id."'");
		$res_type=mysql_fetch_array($sql_type);
	      $desc=$res_type['desc'];
		/*if($message_color_id==1)
		{
		  $s="<img src='intensity3.gif'>";
		 }if($message_color_id==2)
		{
		  $s="<img src='intensity2.gif'>";
		 }*/
		
		if($send_type==2)
		{
			$sender=$my_arr['sender_name'];
			$osender="sender_name";
			$tp=str_replace("{SENDER_HEAD}","Sender",$tp);
		}
		else
		{
			$sender=$my_arr['name'];
			$osender="name";
			$tp=str_replace("{SENDER_HEAD}","Receiver",$tp);
		}
		
		$attachres=mysql_query("select * from trigger_attachments where trigger_id=$id");
		

$res.='		<div class="clearall"></div>';
$rcnt++;
//echo $id;
if($rcnt % 2=='0')
{
$res.='	<div style="height:26px; background-color:#e0e8ef;">';
}
else
{
	$res.='	<div style="height:26px; background-color:#eeeeee;">';
}
$res.='	<span style="float:left;margin:0px 0px 5px 0px; padding:0px; width:150px;">
  <label class="choice" for="Field0_2" style="padding-left:10px; padding-right:5px; margin:0px; " >
  <input name="check_list[]" type="checkbox"  id="check_list[]"  value="'.$id.'" style="margin-right:5px; margin-top:4px;"/>';
  if(mysql_num_rows($attachres) > 0)
  {
 $res.='<img src="{IMG_URL}attachemtn.gif" width="16" height="14" alt="attachemet" />';
  } else {
	$res.='<img src="{IMG_URL}1.gif" width="16" height="14" alt="attachemet" />';
  }
  if($send_type==0) { 
  $res.='<a href="index.php?file=t-open_trigger&stype='.$send_type.'&id='.$id.'">'.$message.'</a></label>';
   } else{
  $res.='<a href="index.php?file=t-open_trigger&stype='.$send_type.'&id='.$id.'">'.$message.'</a>';
  }
$res.='</label>
</span>
                    <div style="float:left; width:auto; margin:0px 0px 0px 10px; padding:6px 0px 0px 15px" > '.$date.'</div>
					                    <div style="float:left; width:auto; margin:0px 0px 0px 10px; padding:6px 0px 0px 40px" >
							 <a href="#" rel="tooltip" title='.$desc.'> <span style="height:0px;width:10px;background-color:#'.$col_id.'" >&nbsp;</span></a>  
							    
							    </div>

                    <div style="float:left; width:26px; height:20px;margin:0px 0px 0px 70px; padding:6px 0px 0px 22px" >					
					'.$message_intensity.'</div>                
  <div  style="padding:6px 0px 0px 15px;margin-right:55px;" class="socialicons">';
 
  $res.='
  
  
<a href="#" onclick="streamPublish(\''.$my_arr['title'].'\',\''.$message.'....\',\'\');" ><img src="{IMG_URL}facebook_icon.gif" width="16" height="16" border="0"/></a>
  
  <a href="https://twitter.com/share"  data-url="http://emirror.vdevserver.co.cc/" data-text="'.$my_arr['title'].'" data-count="none"><img src="{IMG_URL}twitter_icon.gif" width="16" height="16" /></a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  
  
  <a href="#" onclick="return checktriggerDelete('.$id.')";><img src="{IMG_URL}delete.gif" width="13" flot="right"height="13" /></a></div>
  
</div>';
		
	}
	
}
else{
$res='<div style="text-align:center; padding:30px 0px 0px 0px; font-waight:bold; font-size:12px;" ><strong>No triggers found.</stropng></div>';
}


//echo $send_type;
/*if(isset($_GET['stype']))
{
	if($_GET['stype'] == 2)
	{
		$classR = 'class="active"';
	} else {
		$classR = '';
	}
	if($_GET['stype'] == 0)
	{
		$classD = 'class="active"';
	} else {
		$classD = '';
	}
	if($_GET['stype'] == 1)
	{
		$classS = 'class="active"';
	} else {
		$classS = '';
	}
	if($_GET['stype'] == 3)
	{
		$classP = 'class="active"';
	} else {
		$classP = '';
	}
} else {
	$classS = 'class="active"';
}*/
//echo $order;
$send_type=0;
$res1='<a href="index.php?file=t-trigger&stype='.$send_type.'#page=page-2">All</a>&nbsp;&nbsp;&nbsp;';
$res1.= $pagerecords.paginate_one($reload,$page,$tpages);

if($order=="message" && $otype=="a")
{
$tp=str_replace("{MSG_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message&otype=d#page=page-2" >
<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
else
{
$tp=str_replace("{MSG_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message&otype=a#page=page-2" >
<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
if($order=="$osender" && $otype=="a")
{
$tp=str_replace("{SENDER_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order='.$osender.'&otype=d#page=page-2" >
<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
else
{
$tp=str_replace("{SENDER_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order='.$osender.'&otype=a#page=page-2" >
<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
if($order=="create_time" && $otype=="a")
{
$tp=str_replace("{TIME_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=create_time&otype=d#page=page-2" >
<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
else
{
$tp=str_replace("{TIME_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=create_time&otype=a#page=page-2" >
<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
if($order=="message_intensity" && $otype=="a")
{
$tp=str_replace("{INTENSITY_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message_intensity&otype=d#page=page-2" >
<img src="{IMG_URL}up_arrow.png" width="12" height="6" alt="descendingorder" title="Descending Sort" align="absmiddle"  border="0" /></a>',$tp);
}
else
{
$tp=str_replace("{INTENSITY_SORT}",'<a href="index.php?file=t-trigger&stype='.$send_type.'&keyword='.$keyword.'&fromdate='.$fromdate.'&todate='.$todate.'&order=message_intensity&otype=a#page=page-2" >
<img src="{IMG_URL}down_arrow.png" width="12" height="6" alt="ascendingorder" title="Ascending Sort" align="absmiddle"  border="0" /></a>',$tp);
}

$tp=str_replace("{DRAFT_BTN}",'<input id="saveForm" name="saveForm" class="inr_btn" type="button" value="Preview" onclick="return mytriggerpopup(document.messageform);"/>
<input id="saveForm" onclick="return valid_triggerform(document.messageform,\''.$str_words.'\');" name="saveForm" class="inr_btn" type="submit" value="Save"/>
   ',$tp);

if($my_arrdraft['id']!=""){
 $tp=str_replace("{tab_name}",'<span>Edit</span>',$tp);
}else{
$tp=str_replace("{tab_name}",'<span>Compose</span>',$tp);
}


/*$tp=str_replace("{RECEIVED}","<a href='index.php?file=t-trigger&stype=2&order=$order#page=page-2' ".$classR .">Received</a>",$tp);
$tp=str_replace("{SENT}","<a href='journal.php?stype=1&order=$order#page=page-2' ".$classS .">Sent</a>",$tp);
$tp=str_replace("{DRAFT}","<a href='journal.php?stype=0&order=$order#page=page-2' ".$classD .">Draft</a>",$tp);
$tp=str_replace("{PERSONAL}","<a href='journal.php?stype=3&order=$order#page=page-2' ".$classP .">Personal</a>",$tp);*/
$tp=str_replace("{stype}",$send_type,$tp);
$tp=str_replace("{STYPE}",$send_type,$tp);
$tp=str_replace("{TOT_SENT}",$tot_sent,$tp);
$tp=str_replace("{TOT_RECEIVED}",$tot_received,$tp);
$tp=str_replace("{MESSAGES}",$res,$tp);
$tp=str_replace("{SENT_CHT}",$sent_cht,$tp);
$tp=str_replace("{REC_CHT}",$rec_cht,$tp);
$tp=str_replace("{IMG_URL}",IMG_ROOT,$tp);
$tp=str_replace("{MAIN_ROOT}",MAIN_ROOT,$tp);
$tp=str_replace("{SCRIPT_URL}",SCRIPTS_ROOT,$tp);
$tp=str_replace("{NO_SESSION}",NO_SESSION,$tp);
$tp=str_replace("{NO_SESSION_END}",NO_SESSION_END,$tp);
$tp=str_replace("{LOGIN_PAGE}",USER_MODULE."/login.php",$tp);
$tp=str_replace("{REGISTER_PAGE}",USER_MODULE."/register.php",$tp);
$tp=str_replace("{pagerecords}",$pagerecords,$tp);

//journal messages
$tp=str_replace("{title_trigger}",$title_trigger,$tp);
//draft mesages editing
//echo $message;
$tp=str_replace("{DRAFTID}",$my_arrdraft['id'],$tp);
$tp=str_replace("{MESSAGE}",$draftmessage,$tp);
$tp=str_replace("{DATE}",$draftdate,$tp);
$tp=str_replace("{stype}",$stype,$tp);
$tp=str_replace("{INTENSITY}",$draftmessage_intensity,$tp);
$tp=str_replace("{REC_NAME}",$my_arrdraft['name'],$tp);
$tp=str_replace("{REC_EMAIL}",$my_arrdraft['email'],$tp);
$tp=str_replace("{EMOTION}",$my_arrdraft['message_color_id'],$tp);
$tp=str_replace("{ATTACH}",$resattach,$tp);
if($motion!='')
{
	$motion = '<script>change_bg("'.$motion.'");</script>';
}
$tp=str_replace("{motion}",$motion,$tp);

/*--------*/
//echo $keyword;
$tp=str_replace("{keyword}",$keyword,$tp);
$tp=str_replace("{fromdate}",$fromdate,$tp);
$tp=str_replace("{todate}",$todate,$tp);
//echo $res1;
$tp=str_replace("{PAGING}",$res1,$tp);
//echo "hi";exit;rec_cht
//echo $tp;
//require_once(SITE_ROOT."includes/footer.php");
?>