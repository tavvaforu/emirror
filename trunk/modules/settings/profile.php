<?php
require_once("includes/header.php");
$obj=new emirror_config;
$tpl_object = new Template("templates/profile");
$tp = $tpl_object->getContent();
//echo '<pre>';print_r($_SESSION);exit;
$memid=$_SESSION["sess_memberid"];
$sql=mysql_query("select * from members where member_id='".$_SESSION["sess_memberid"]."'");
$memarray=mysql_fetch_array($sql);
$email=$memarray['email'];
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
 $tag_line=$memarray['tag_line'];
  $description=$memarray['description'];
  $occupation=$memarray['occupation'];
  $employee=$memarray['employee'];
  $employee_title=$memarray['employee_title'];
  $employee_sdate=$memarray['employee_sdate'];
  $employee_edate=$memarray['employee_edate'];
  $education=$memarray['education'];
  $estudy=$memarray['estudy'];
  $education_sdate=$memarray['education_sdate'];
  $education_edate=$memarray['education_edate'];
  $rel_type=$memarray['rel_type'];
  
  //list of secondary emails
  $memdata=$db->memsecemails();
  $sec_email=$memdata[0]['sec_email'];
  
if(count($memdata)>0){

	if($teno!=5){
	  $teno=count($memdata)+1;
	}else{
	  $teno=count($memdata);
	}$n=count($memdata);
}else{
$teno=2;
$n=0;
}
/*echo "<pre>";
print_r($memdata);
echo "</pre>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
echo $memdata[0]['iid'];*/

if($_POST['saveForm']=="Deactivate My Account"){
	$sql=mysql_query("update members set status='0' where member_id=".$_SESSION["sess_memberid"]);
	 header("location:index.php?file=u-logout");
	 exit;
}

//insertion of profile information 
if($_POST['saveForm']=="Save"){
//update profile photo
//echo '<pre>';print_r($_POST);exit;
 if($_FILES['photo']['name']!="")
			{
				$fileName = str_replace(' ', '_', $_FILES['photo']['name']);
				$fsname=date('Ymdhis').'_-_'.$fileName;
				move_uploaded_file($_FILES['photo']['tmp_name'],"media/members/".$fsname);					
			}
	else{
			$fsname=$photo;
	}
	$_SESSION["sess_profilephoto"] = $fsname;
			$no=$_POST['teno'];

		   		if($_POST['teno']>=1)
				{
				if(isset($_POST['sec_email']))
					{
						
						//echo "delete from memberemails where member_id=".$memid;exit;
						mysql_query("delete from memberemails where member_id=".$memid);
						///exit;
						foreach($_POST['sec_email'] as $emails)
						{
							//echo $emails.'<br/>';
							 //$fname1="sec_email".$i;
							 
							if($emails!="")
							{
								mysql_query("insert into memberemails(member_id,sec_email)values($memid,'$emails')");
							}
						}
				//exit;						
					}	
				}
  $tag_line=$_POST['tag_line'];
  $description=$_POST['description'];
  $occupation=$_POST['occupation'];
  $employee=$_POST['employee'];
  $employee_title=$_POST['employee_title'];
  $employee_sdate=date("Y-m-d",strtotime($_POST['employee_sdate']));
  $employee_edate=date("Y-m-d",strtotime($_POST['employee_edate']));
  $education=$_POST['education'];
  $estudy=$_POST['estudy'];
  $education_sdate=date("Y-m-d",strtotime($_POST['education_sdate']));
  $education_edate=date("Y-m-d",strtotime($_POST['education_edate']));
  $rel_type=$_POST['rel_type'];
  
  $sql_update="update members set photo='".$fsname."',tag_line='".$tag_line."',description='".$description."',occupation='".$occupation."',employee='".$employee."',
  employee_title='".$employee_title."',employee_sdate='".$employee_sdate."',employee_edate='".$employee_edate."',education='".$education."',estudy='".$estudy."',
  education_sdate='".$education_sdate."',education_edate='".$education_edate."',rel_type='".$rel_type."' where member_id=".$_SESSION["sess_memberid"];
 
  $db_update=mysql_query($sql_update);

  if($db_update){     
      $msg="Profile saved succesfully";
      header("location:index.php?file=s-profile&msg=$msg");
	  exit;
  }
  else{
	 $msg="Erro-in saving the profile";
      header("location:index.php?file=s-profile&msg=$msg");
     
	  exit;
  }
}
//echo '<pre>';print_r($memdata);exit;
if(count($memdata)>0)
{
for($i=1;$i<=count($memdata);$i++){
$ii=$i-1;
	$med.='<div id="TextBoxDiv'.$i.'" class="field">
			<label for="fname">Alternative Email'.$i.' : </label>
			<input id="textbox'.$i.'" class="xsmall" type="text" value="'.$memdata[$ii]["sec_email"].'" name="sec_email[]"	 size="30">
		   </div>';
}
}
//employee details
if($employee!="")
{
$emp.='<input id="employee" size="15" name="employee"  type="text" class="xsmall"  value="'.$employee.'" >-';
}
else{
$emp.='<input id="employee" size="15" name="employee"  type="text" class="xsmall"  value="Employer Name" onfocus="if(this.value==\'Employer Name\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'Employer Name\';}"  >-';
}
if($employee_title!="")
{
$emp.='<input id="employee_title" size="15" name="employee_title"  type="text" class="xsmall"  value="'.$employee_title.'" >-';
}
else{
$emp.='<input id="employee_title" size="15" name="employee_title"  type="text" class="xsmall"  value="Job Title" onfocus="if(this.value==\'Job Title\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'Job Title\';}"  >-';
}
if($employee_sdate!="")
{
$emp.='<input id="employee_sdate" size="15" name="employee_sdate"  type="text" class="xsmall"  value="'.$employee_sdate.'" ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn1" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>-';
}
else{
$emp.='<input id="employee_sdate" size="15" name="employee_sdate"  type="text" class="xsmall"  value="Start date" onfocus="if(this.value==\'Start date\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'Start date\';}"  ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn1" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>-';
}
if($employee_edate!="")
{
$emp.='<input id="employee_edate" size="15" name="employee_edate"  type="text" class="xsmall"  value="'.$employee_edate.'" ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn2" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>';
}
else{
$emp.='<input id="employee_edate" size="15" name="employee_edate"  type="text" class="xsmall"  value="End date" onfocus="if(this.value==\'End date\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'End date\';}"  ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn2" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>&nbsp;&nbsp;';
}

//education details 
if($education!="")
{
$edu.='<input id="education" size="15" name="education"  type="text" class="xsmall"  value="'.$education.'" >-';
}
else{
$edu.='<input id="education" size="15" name="education"  type="text" class="xsmall"  value="School Name" onfocus="if(this.value==\'School Name\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'School Name\';}"  >-';
}
if($estudy!="")
{
$edu.='<input id="estudy" size="15" name="estudy"  type="text" class="xsmall"  value="'.$estudy.'" >-';
}
else{
$edu.='<input id="estudy" size="15" name="estudy"  type="text" class="xsmall"  value="Major Field of study" onfocus="if(this.value==\'Major Field of study\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'Major Field of study\';}"  >-';
}
if($education_sdate!="")
{
$edu.='<input id="education_sdate" size="15" name="education_sdate"  type="text" class="xsmall"  value="'.$education_sdate.'" ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn3" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>-';
}
else{
$edu.='<input id="education_sdate" size="15" name="education_sdate"  type="text" class="xsmall"  value="Start date" onfocus="if(this.value==\'Start date\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'Start date\';}"  ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn3" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>-';
}
if($education_edate!="")
{
$edu.='<input id="education_edate" size="15" name="education_edate"  type="text" class="xsmall"  value="'.$education_edate.'" ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn4" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>';
}
else{
$edu.='<input id="education_edate" size="15" name="education_edate"  type="text" class="xsmall"  value="End date" onfocus="if(this.value==\'End date\') {this.value=\'\';}" onblur="if(this.value==\'\') {this.value=\'End date\';}"  ><a href="javascript:void(0);" style="margin-right:10px;" id="f_btn4" ><img src="'.IMG_ROOT.'cal1.gif" width="16" height="16" /></a>&nbsp;&nbsp;';
}

if($rel_type==1){
$flag="selected";
}
else{
$flag="";
}
if($rel_type==2){
$flag1="selected";
}
else{
$flag1="";
}
 if($rel_type==3){
$flag2="selected";
}
else{
$flag2="";
}
if($rel_type==4){
$flag3="selected";
}
else{
$flag3="";
}
if($rel_type==5){
$flag4="selected";
}
else{
$flag4="";
}
if($rel_type==6){
$flag5="selected";
}
else{
$flag5="";
}

$reltype='     <div class="field">

								<label for="type">Relationship Type </label>

								<select id="rel_type" name="rel_type" class="medium">

										<option value="-1" >--- Options ---</option>

										<option value="1" '.$flag.' >I don\'t want to say</option>

                                        <option value="2" '.$flag1.' >Single</option>

                                        <option value="3" '.$flag2.' >In an open relationship</option>

                                        <option value="4" '.$flag3.'>Widowed</option>

                                        <option value="5" '.$flag4.' >In a domestic partnership</option>

                                        <option value="6" '.$flag5.' >In a civil union</option>

								</select>
							</div>';
$tp=str_replace("{reltype}",$reltype,$tp);
$tp=str_replace("{teno}",$teno,$tp);						
$tp=str_replace("{employee}",$emp,$tp);
$tp=str_replace("{education}",$edu,$tp);
$tp=str_replace("{email}",$email,$tp);
$tp=str_replace("{tag_line}",$tag_line,$tp);
$tp=str_replace("{description}",$description,$tp);
$tp=str_replace("{occupation}",$occupation,$tp);

$tp=str_replace("{msg}",$msg,$tp);

$tp=str_replace("{employee}",$employee,$tp);
$tp=str_replace("{employee_title}",$employee_title,$tp);
$tp=str_replace("{employee_sdate}",$employee_sdate,$tp);
$tp=str_replace("{employee_edate}",$employee_edate,$tp);
$tp=str_replace("{education}",$education,$tp);
$tp=str_replace("{profilephoto}",$dsphoto,$tp);
$tp=str_replace("{dsImage}",$dsImage,$tp);

$tp=str_replace("{estudy}",$estudy,$tp);
$tp=str_replace("{education_sdate}",$education_sdate,$tp);
$tp=str_replace("{education_edate}",$education_edate,$tp);
$tp=str_replace("{rel_type}",$rel_type,$tp);

$tp=str_replace("{med}",$med,$tp);
$tp=str_replace("{sec_email}",$sec_email,$tp);
?>