/*
Strip whitespace from the beginning and end of a string
Input : a string
*/
function trim(str)
{
	return str.replace(/^\s+|\s+$/g,'');
}

/*
Make sure that textBox only contain number
*/
function checkNumber(textBox)
{
	while (textBox.value.length > 0 && isNaN(textBox.value)) {
		textBox.value = textBox.value.substring(0, textBox.value.length - 1)
	}
	
	textBox.value = trim(textBox.value);
/*	if (textBox.value.length == 0) {
		textBox.value = 0;		
	} else {
		textBox.value = parseInt(textBox.value);
	}*/
}
function validInput(string,messages)
{
_valdval = true;
re=/[<>]/;
var res=re.test(string);
 if(res==true)
 {
   _valdval = false;
   jAlert(messages);
 } 
 //alert(_valdval);return false;	
 return _valdval;
}
/*
	Check if a form element is empty.
	If it is display an alert box and focus
	on the element
*/
function isEmpty(formElement,message) {
	formElement.value = trim(formElement.value);	
	_isEmpty = false;
	if (formElement.value =='') {
		_isEmpty = true;
		jAlert(message);
	//return _isEmpty;
	}
	
	return _isEmpty;
}


/*
	Set one value in combo box as the selected value
*/
function setSelect(listElement, listValue)
{
	for (i=0; i < listElement.options.length; i++) {
		if (listElement.options[i].value == listValue)	{
			listElement.selectedIndex = i;
		}
	}	
}

function isEmail(formElement,nullmessage,message) {
	formElement.value = trim(formElement.value);
	_isEmpty = false;

	var AtSym=formElement.value.indexOf('@');				
	var Period=formElement.value.lastIndexOf('.');		
	var Space=formElement.value.indexOf(' ');				
	var Length=formElement.value.length-1;
	var index = formElement.value.indexOf('@');
	var substr = formElement.value.substring(index+1);
   var index2 = substr.indexOf('@');
	var count=0;
	if (formElement.value == '') {
		_isEmpty = true;
		jAlert(nullmessage);
		formElement.focus();
	} else {
		if((AtSym<1)||(formElement.value.charAt(0)=='_')||(formElement.value.charAt(Length)=="_")||	//'@' can't be in first position
		(formElement.value.indexOf("_")==AtSym+1)||(formElement.value.charAt(AtSym-1)=="_")||
		(Period<=AtSym+1)||					//Must be atleast one valid char between '@' and '.'
		(Period==Length)||					//Must be atleast one valid char after '.'
		((Space>0) && (Space!=Length))||
		(index2 != -1))                       //No empty spaces permitted
		{
			_isEmpty = true;
			jAlert(message);
			formElement.focus();
		}
	}
	return _isEmpty;
}
function checkRadio (frmName, rbGroupName) {
 var radios = document[frmName].elements[rbGroupName];
 for (var i=0; i <radios.length; i++) {
  if (radios[i].checked) {
   return true;
  }
 }
 return false;
}

function isMatching(str1,str2,name)
{
 var retval=true;
 if (str1.value != str2.value)
 {
  jAlert(name);
  str2.focus();
  retval=false;
 }
 return retval;
}
function isEmptyLbox(str,name)
{
 var retval=true;
 if (str.value=="0")
 {
  jAlert(name);
  str.focus();
  retval=false;
 }
 return retval;
}



function valid_messageform(frm,strmsg)
{
//alert(frm);
	var result = false;
	var result1 = false;
	result = !isEmpty(frm.sname, "Please Enter Name") ;
	if(result){
	  result = validInput(frm.sname.value, "Please Enter Valid Input in Receiver Name") ;
	}
	if(result) result = !isEmpty(frm.email, "Please Enter Email") ;
	if(result) 
	{
	if(frm.email.value!='')
	{
	result=!isEmail(frm.email,"","Please Enter valid Email");
	//result=false;
	}
	}
		if(result) result = !isEmpty(frm.color_id, "Please Select Emotion type") ;
	if(result) result = !isEmpty(frm.message, "Please Enter Message") ;
	if(result){
	  result = validInput(frm.message.value, "You might have entered symbols(<>[]) in your message please remove them") ;
	}
       if(result){
	 result= checkdera("'"+frm.message.value+"'","'"+strmsg+"'");
	}
	//alert(result);
	return result;
}

function valid_albumvideoform(frm){

//alert(frm);return false;
	var result = false;
	result = !isEmpty(frm.video_title,"Please Enter Video title") ;

	if(result) result =!isEmpty(frm.video_code, "Please Enter Video Url") ;
	return result;
}
function valid_albumform(frm)
{
mode=document.getElementById("mode").value;
var albumtitle=trim(frm.album_title.value)
	if(albumtitle=="")
	{
		 jAlert("Please Enter Album Title");return false;
	}

}
function valid_videoalbumform(frm)
{
mode=document.getElementById("mode").value;
var albumtitle=trim(frm.video_title.value)
	if(albumtitle=="")
	{
		 jAlert("Please Enter Album Title");return false;
	}
if(mode=="Add"){
	if(frm.video_photo.value=="")
	{
		 jAlert("Please select Album Photo");return false;
	}
}
	if(frm.video_photo.value!=""){
    result = CheckImageExtension(frm.video_photo, "Invalid Extension file") ;
	return result;
	}

}

function valid_photoform(frm)
{
	mode=document.getElementById("mode").value;
var phototitle=trim(frm.photo_title.value)
	if(phototitle=="")
	{
		 jAlert("Please Enter Photo Title");return false;
	}
	if(mode=="Add"){
	if(document.getElementById('galphoto').value=="")
	{
		 jAlert("Please select Photo");return false;
	}
	}
	if(document.getElementById('galphoto').value!=""){
    result = CheckImageExtension(document.getElementById('galphoto').value, "Invalid Extension file") ;
	return result;
	}
 
}
function valid_journalform(frm,strmsg)
{
//alert(frm);
	var result = false;
	var result1 = false;
//	alert(frm.sname.value);return false;
	
	result = !isEmpty(frm.color_id, "Please Select Emotion type") ;
	if(result)
	result = !isEmpty(frm.title_journal, "Please Enter title") ;
	if(result){
	  result = validInput(frm.title_journal.value, "Please Enter Valid Input in Title Box") ;
	}
	if(result) result = !isEmpty(frm.message, "Please Enter Message") ;
	if(result){
	  result = validInput(frm.message.value, "You might have entered symbols(<>[]) in your message please remove them") ;
	}
if(result){
	 result= checkdera("'"+frm.message.value+"'","'"+strmsg+"'");
	}
	//alert(result);
	return result;
}

function valid_memoryform(frm,strmsg)
{
//alert(frm);
	var result = false;
	var result1 = false;
//	alert(frm.sname.value);return false;
	
	result = !isEmpty(frm.color_id, "Please Select Emotion type") ;
	
	if(result) result = !isEmpty(frm.title_memory, "Please Enter title") ;
	if(result){
	  result = validInput(frm.title_memory.value, "Please Enter Valid Input in Title Box") ;
	}
	if(result) result = !isEmpty(frm.message, "Please Enter Message") ;
	if(result){
	  result = validInput(frm.message.value, "You might have entered symbols(<>[]) in your message please remove them") ;
	}
if(result){
	 result= checkdera("'"+frm.message.value+"'","'"+strmsg+"'");
	}
	//alert(result);
	return result;
}
function valid_triggerform(frm,strmsg)
{
    var tid=document.getElementById("faceid").checked.value;
	//alert(tid);return false;
	var result = false;
	var result1 = false;
	result = !isEmpty(frm.color_id, "Please Select Emotion type") ;
	if(result) result = !isEmpty(frm.title_trigger, "Please Enter Title") ;
	if(result){
	  result = validInput(frm.title_trigger.value, "Please Enter Valid Input in Title Box") ;
	}
	if(result) result = !isEmpty(frm.message, "Please Enter Message") ;
	if(result){
	  result = validInput(frm.message.value, "You might have entered symbols(<>[]) in your message please remove them") ;
	}
     if(result){
	 result= checkdera("'"+frm.message.value+"'","'"+strmsg+"'");
	}
	return result;
}


function validate_registerform(frm)
{

	var result = false;
	var result1 = false;
	result = !isEmpty(frm.firstname,"Please Enter First Name") ; 
	if(result) result = !isEmpty(frm.email, "Please Enter Email") ;
	if(result) result = validateEmail(frm.email,"Please Enter Valid Email");
    if(result) result = !isEmpty(frm.username, "Please Enter Username") ;
	if(result) result = !isEmpty(frm.pwd, "Please Enter password") ;
	if(result)
	{
		if(frm.terms.checked == true)
		{
		
		} else {
			jAlert('Please accept terms and conditions');
			result = false;
		}
	}

	/*if(result)
	{

		send_values_to_register(frm);
		result=false;
	}*/
	return result;
}


// Validate Required
function validateRequired(field, msg, min, max){
	var test = "pass";
	if(field.value.length == 0) {
		test = "fail";
	}else if(min && field.value.length < min) {
		msg = msg + "\nMin Lenght should be " + min;
		test = "fail";
	}else if(max && field.value.length > max) {
		msg = msg + "\nMax Lenght should be " + max;
		test = "fail";
	}
	
	if(test == "fail"){
		if (msg) jAlert(msg);
		field.focus();
		field.select();
		return false;
	}
	return true;
}
// Validate Extension
function CheckExtension(field, msg){
	
	var ext = field.value.split(".")
	if(ext[1] == 'doc' || ext[1] == 'rar' || ext[1] == 'pdf'){
		return true;
	}
	else {
		if (msg != ''){
			jAlert(msg);
		}
		field.focus();
		return false;
	}

}
// Validate Extension
function CheckImageExtension(field, msg){
	
	var ext = field.value.split(".")
	if(ext[1] == 'jpg' || ext[1] == 'jpeg' || ext[1] == 'gif' || ext[1] == 'png'){
		return true;
	}
	else {
		if (msg != ''){
			jAlert(msg);
		}
		//field.focus();
		return false;
	}

}
// Validate word count
function count_words(field, msg, min, max)
{
    var test = "pass";
	var no_words = field.value.split(" ");
	
	if(field.value.length == 0) {
		test = "fail";
	}else if(min && no_words.length < min) {
		msg = msg + "\nMin Word should be " + min;
		test = "fail";
	}else if(max && no_words.length > max) {
		msg = msg + "\nMax Word should be " + max;
		test = "fail";
	}
	
	if(test == "fail"){
		if (msg) jAlert(msg);
		field.focus();
		field.select();
		return false;
	}
	return true;
}

// Validate Number
function validateNumber(field, msg, min, max){
	if (!min) { min = 0 }
	if (!max) { max = 255 }

	if ( (parseInt(field.value) != field.value) ||
             field.value.length < min ||
             field.value.length > max) {
		jAlert(msg);
		field.focus();
		field.select();
		return false;
	}

	return true;
}

// Validate Mail IDs
function validateEmail(field, msg){
	var re_mail = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if (!re_mail.test(field.value)) {
		if (msg != '') { jAlert(msg); }
		field.focus();
		field.select();
		return false;
	}

	return true;
}


// Validate Alpha-Numeric
function validateAlphaNumeric(field, msg){
	var numaric = field.value;
	for(var j=0; j<numaric.length; j++) {
		var alphaa = numaric.charAt(j);
		var hh = alphaa.charCodeAt(0);
		
		if(!(hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123)){
			if (msg != ''){
				jAlert(msg);
			}
			field.focus();
			field.select();
			return false;
		}
	}
	return true;
}

// Validate Alpha-Numeric
function validateCombo(field, msg){
	
	if(field.selectedIndex == 0){
		if (msg != ''){
			jAlert(msg);
		}
		field.focus();
		return false;
	}

	return true;
}

function ValidateAnyOne(field1, field2, msg, msg1) {
	if(field1.value || field2.value) {
		if (field1.value != ''){
			if(parseInt(field1.value) != field1.value) {
				jAlert(msg);
				return false;
			}
			
		}
		return true	;
	}
	jAlert(msg1);
	return false;
}

function compareFields(field1, field2, msg) {
	if(field1.value != field2.value) {
		if (msg != ''){
			jAlert(msg);
		}
		return false;
	}

	return true;
}
function compareFields2(field1, field2, msg) {
	if(field1.value == field2.value) {
		if (msg != ''){
			jAlert(msg);
		}
		return false;
	}

	return true;
}

// to check value as true
function checkValue(field, msg, val) {
	if (!val) val = 'true';
	if(field.value != val) {
		if (msg != ''){
			jAlert(msg);	
		}
		return false;
	}
	return true;
}

function validatePhoneno(field,msg) {
		if((field.value==null) ||(field.value=="")) {
			jAlert('Please enter your phone number');
			field.focus();
			return false;
		}
		//else if(field.value.search(/^[0-9]+$/ == -1) {
		else if((field.value.search(/\d{3}\-\d{8}/) ==-1) || (field.value.search(/\d{3}\ \d{8}/) ==-1)) {
			jAlert("Phone Number Should be xxx-xxxxxxxx or xxx xxxxxxxx");
			field.focus();
			return false;
		}
}

function confirmjAlert(msg) {
	return confirm(msg);
}
var monthtext=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sept','Oct','Nov','Dec'];

function populatedropdown(dayfield, monthfield, yearfield){
var today=new Date()
var dayfield=document.getElementById(dayfield)
var monthfield=document.getElementById(monthfield)
var yearfield=document.getElementById(yearfield)
for (var i=0; i<31; i++)
dayfield.options[i]=new Option(i, i+1)
dayfield.options[today.getDate()]=new Option(today.getDate(), today.getDate(), true, true) //select today's day
for (var m=0; m<12; m++)
monthfield.options[m]=new Option(monthtext[m], m+1)
monthfield.options[today.getMonth()]=new Option(monthtext[today.getMonth()], today.getMonth()+1, true, true) //select today's month
var thisyear=today.getFullYear()
for (var y=0; y<20; y++){
yearfield.options[y]=new Option(thisyear, thisyear)
thisyear-=1
}
yearfield.options[0]=new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
}










var xmlHttp=false;

// Build Req
function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
 

return xmlHttp;
}



function send_values_to_register(frm)
{ 
	
		
xmlHttp=GetXmlHttpObject();

if (xmlHttp==null)
 {
 jAlert("Browser does not support HTTP Request")
 return
 }
var url="http://192.168.1.160/sunitha/emirror/index.php?file=u-signup";
url=url+"?email="+frm.email.value+"&pwd="+frm.pwd.value+"&username="+frm.username.value+"&firstname="+frm.firstname.value

xmlHttp.onreadystatechange=stateChanged 
xmlHttp.open("POST",url,true)
xmlHttp.send(null)
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
	//alert(xmlHttp.responseText);return false;
     jAlert(xmlHttp.responseText); 

 } 
}



function getSelectedRadio(buttonGroup) {
   // returns the array number of the selected radio button or -1 if no button is selected
   if (buttonGroup[0]) { // if the button group is an array (one button is not an array)
      for (var i=0; i<buttonGroup.length; i++) {
         if (buttonGroup[i].checked) {
            return i
         }
      }
   } else {
      if (buttonGroup.checked) { return 0; } // if the one button is checked, return zero
   }
   // if we get to this point, no radio button is selected
   return -1;
} // Ends the "getSelectedRadio" function

function getSelectedRadioValue(buttonGroup) {
   // returns the value of the selected radio button or "" if no button is selected
   var i = getSelectedRadio(buttonGroup);
   if (i == -1) {
      return "";
   } else {
      if (buttonGroup[i]) { // Make sure the button group is an array (not just one button)
         return buttonGroup[i].value;
      } else { // The button group is just the one button, and it is checked
         return buttonGroup.value;
      }
   }
} // Ends the "getSelectedRadioValue" function

//added by sunitha
//videoalbum delete
function validate_login(frm)
{
	var result = false;
    result = !isEmpty(frm.Username, "Please Enter Username") ;
    if(result) result = !isEmpty(frm.pawd, "Please Enter password") ;
	return result;
}
function videoalbumdelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Album ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=v-videos&action=Delete&delvideo="+id;
			
		}
		else
		{return false;}
	
}
//album deletion
function albumdelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Album ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=p-photos&action=Delete&delalbumid="+id;
			
		}
		else
		{return false;}
	
}
//photo deletion
function photodelete(alid,id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Photo ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=p-photos_display&action=Delete&albumid="+alid+"&delphotoid="+id;
			
		}
		else
		{return false;}
	
}
//videodelete

function videodelete(alid,id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Video ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=v-videos_display&action=Delete&valbumid="+alid+"&delvideoid="+id;
			
		}
		else
		{return false;}
	
}
function checkDelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Record(s) ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=m-messages&action=Delete&delid="+id+"#page=page-2";
			
		}
		else
		{return false;}
	
}
function checkblock(id)
{
	var actionvalue='Block';
	ans =confirm("Confirm Block of message from Selected User ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=m-open_message&action=Block&blid="+id+"#page=page-2";
			
		}
		else
		{return false;}
	
}
function removefile(id,iid)
{
//alert(id);return false;
var stype1=document.getElementById("stype").value;
	var actionvalue='Remove';
	ans =confirm("Confirm Deletion of Selected Attachment ?");
		if(ans == true)
		{
            window.location="index.php?file=m-open_message&action=Remove&iid="+iid+"&stype="+stype1+"&Reid="+id;
			
		}
		else
		{return false;}
	
}
function removetriggerfile(id,iid)
{
//alert(id);return false;
var stype1=document.getElementById("stype").value;
	var actionvalue='Remove';
	ans =confirm("Confirm Deletion of Selected Attachment ?");
		if(ans == true)
		{
            window.location="index.php?file=t-open_trigger&action=Remove&iid="+iid+"&stype="+stype1+"&Reid="+id;
			
		}
		else
		{return false;}
	
}
function removememoryfile(id,iid)
{
//alert(id);return false;
var stype1=document.getElementById("stype").value;
	var actionvalue='Remove';
	ans =confirm("Confirm Deletion of Selected Attachment ?");
		if(ans == true)
		{
            window.location="index.php?file=me-open_memories&action=Remove&iid="+iid+"&stype="+stype1+"&Reid="+id;
			
		}
		else
		{return false;}
	
}

function removejournalfile(id,iid)
{
   var stype1=document.getElementById("stype").value;
	var actionvalue='Remove';
	ans =confirm("Confirm Deletion of Selected Attachment ?");
		if(ans == true)
		{
            window.location="index.php?file=j-open_journal&action=Remove&iid="+iid+"&stype="+stype1+"&Reid="+id;
			
		}
		else
		{return false;}
}


function checktriggerDelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Record(s) ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=t-trigger&action=Delete&delid="+id+"#page=page-2";
			
		}
		else
		{return false;}
	
}

function checkmemoryDelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Record(s) ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=me-memories&action=Delete&delid="+id+"#page=page-2";
			
		}
		else
		{return false;}
	
}
function checkjournalDelete(id)
{
	var actionvalue='Delete';
	ans =confirm("Confirm Deletion of Selected Record(s) ?");
	//alert(ans);return false;
		if(ans == true)
		{
            window.location="index.php?file=j-journal&action=Delete&delid="+id+"#page=page-2";
			
		}
		else
		{return false;}
	
}
function mypopup(formName)
{
//alert("hi");return false;
	var res = valid_journalform(document.messageform);
	if(res)
	{
	   var color_id=document.getElementById('color_id').value;
		//alert(document.getElementById('color_id').value);return false;
		mywindow = window.open("journalpreview.php?colorid="+color_id, "mywindow", "location=1,status=1,  width=700,height=400");
	   // mywindow.moveTo(0, 0);
		return false;
	}
}

function mypopupMessagePrint(id,stype)
{
//alert("hi");return false;
			mywindow = window.open("printpreview.php?messageid="+id+"&stype="+stype, "mywindow", "location=1,status=1,  width=700,height=400");
	   // mywindow.moveTo(0, 0);
		return false;
}
function mypopupMessage(formName,type)
{
//alert("hi");return false;
	var res = valid_messageform(document.messageform);
	if(res)
	{
	   var color_id=document.getElementById('color_id').value;
		//alert(document.getElementById('color_id').value);return false;
		if(type == 'prv')
		{
			mywindow = window.open("preview1.php?colorid="+color_id, "mywindow", "location=1,status=1,  width=700,height=400");
		} else {
			mywindow = window.open("printpreview.php?messageid="+type, "mywindow", "location=1,status=1,  width=700,height=400");
		}
	   // mywindow.moveTo(0, 0);
		return false;
	}
}
function mypopup_memory(formName)
{
//alert("hi");return false;
	var res = valid_memoryform(document.messageform);
	if(res)
	{
	   var color_id=document.getElementById('color_id').value;
		//alert(document.getElementById('color_id').value);return false;
		mywindow = window.open("memoriespreview.php?colorid="+color_id, "mywindow", "location=1,status=1,  width=700,height=400");
	   // mywindow.moveTo(0, 0);
		return false;
	}
}
function valid_feedbackform(frm)
{
	var result = false;
	result = !isEmpty(frm.message,"Please Enter Message") ;
	return result;
}
function mytriggerpopup(formName)
{
	var res = valid_triggerform(document.messageform);
	if(res)
	{
	   var color_id=document.getElementById('color_id').value;
		//alert(document.getElementById('color_id').value);return false;
		mywindow = window.open("triggerpreview.php?colorid="+color_id, "mywindow", "location=1,status=1,  width=700,height=400");
	   // mywindow.moveTo(0, 0);
		return false;
	}
}
function checkdera(inpstr,str)
{
	var strar;

	if(str!=null)
	{
		strar=str.split(",");
		for(var i=0;i<strar.length;i++){
			if(inpstr.search(strar[i])!=-1)
			    {
					  jAlert("You are using abusing words");return false;
				}
		}
	}
	return true;
}
function validate_chpform(frm,opass)
{
	if(frm.password.value=="")
	{
		jAlert("Please Enter Old Password");
		return false;
	}
	if(calcMD5(frm.password.value)!=opass)
	{
			jAlert("Old Password You Entered is Wrong");
		return false;
	}
	if(frm.newpassword.value=="")
	{
		jAlert("Please Enter new Password");

		return false;
	}
	if(frm.retypepassword.value=="")
	{
		jAlert("Please Enter retype Password");

		return false;
	}
	if(frm.retypepassword.value!=frm.newpassword.value)
	{
		jAlert("Passwords Doesnot match");
		return false;
	}
	else{
	return true;
	}
}
function calcMD5(str)
{
  x = str2blks_MD5(str);
  a =  1732584193;
  b = -271733879;
  c = -1732584194;
  d =  271733878;

  for(i = 0; i < x.length; i += 16)
  {
    olda = a;
    oldb = b;
    oldc = c;
    oldd = d;

    a = ff(a, b, c, d, x[i+ 0], 7 , -680876936);
    d = ff(d, a, b, c, x[i+ 1], 12, -389564586);
    c = ff(c, d, a, b, x[i+ 2], 17,  606105819);
    b = ff(b, c, d, a, x[i+ 3], 22, -1044525330);
    a = ff(a, b, c, d, x[i+ 4], 7 , -176418897);
    d = ff(d, a, b, c, x[i+ 5], 12,  1200080426);
    c = ff(c, d, a, b, x[i+ 6], 17, -1473231341);
    b = ff(b, c, d, a, x[i+ 7], 22, -45705983);
    a = ff(a, b, c, d, x[i+ 8], 7 ,  1770035416);
    d = ff(d, a, b, c, x[i+ 9], 12, -1958414417);
    c = ff(c, d, a, b, x[i+10], 17, -42063);
    b = ff(b, c, d, a, x[i+11], 22, -1990404162);
    a = ff(a, b, c, d, x[i+12], 7 ,  1804603682);
    d = ff(d, a, b, c, x[i+13], 12, -40341101);
    c = ff(c, d, a, b, x[i+14], 17, -1502002290);
    b = ff(b, c, d, a, x[i+15], 22,  1236535329);    

    a = gg(a, b, c, d, x[i+ 1], 5 , -165796510);
    d = gg(d, a, b, c, x[i+ 6], 9 , -1069501632);
    c = gg(c, d, a, b, x[i+11], 14,  643717713);
    b = gg(b, c, d, a, x[i+ 0], 20, -373897302);
    a = gg(a, b, c, d, x[i+ 5], 5 , -701558691);
    d = gg(d, a, b, c, x[i+10], 9 ,  38016083);
    c = gg(c, d, a, b, x[i+15], 14, -660478335);
    b = gg(b, c, d, a, x[i+ 4], 20, -405537848);
    a = gg(a, b, c, d, x[i+ 9], 5 ,  568446438);
    d = gg(d, a, b, c, x[i+14], 9 , -1019803690);
    c = gg(c, d, a, b, x[i+ 3], 14, -187363961);
    b = gg(b, c, d, a, x[i+ 8], 20,  1163531501);
    a = gg(a, b, c, d, x[i+13], 5 , -1444681467);
    d = gg(d, a, b, c, x[i+ 2], 9 , -51403784);
    c = gg(c, d, a, b, x[i+ 7], 14,  1735328473);
    b = gg(b, c, d, a, x[i+12], 20, -1926607734);
    
    a = hh(a, b, c, d, x[i+ 5], 4 , -378558);
    d = hh(d, a, b, c, x[i+ 8], 11, -2022574463);
    c = hh(c, d, a, b, x[i+11], 16,  1839030562);
    b = hh(b, c, d, a, x[i+14], 23, -35309556);
    a = hh(a, b, c, d, x[i+ 1], 4 , -1530992060);
    d = hh(d, a, b, c, x[i+ 4], 11,  1272893353);
    c = hh(c, d, a, b, x[i+ 7], 16, -155497632);
    b = hh(b, c, d, a, x[i+10], 23, -1094730640);
    a = hh(a, b, c, d, x[i+13], 4 ,  681279174);
    d = hh(d, a, b, c, x[i+ 0], 11, -358537222);
    c = hh(c, d, a, b, x[i+ 3], 16, -722521979);
    b = hh(b, c, d, a, x[i+ 6], 23,  76029189);
    a = hh(a, b, c, d, x[i+ 9], 4 , -640364487);
    d = hh(d, a, b, c, x[i+12], 11, -421815835);
    c = hh(c, d, a, b, x[i+15], 16,  530742520);
    b = hh(b, c, d, a, x[i+ 2], 23, -995338651);

    a = ii(a, b, c, d, x[i+ 0], 6 , -198630844);
    d = ii(d, a, b, c, x[i+ 7], 10,  1126891415);
    c = ii(c, d, a, b, x[i+14], 15, -1416354905);
    b = ii(b, c, d, a, x[i+ 5], 21, -57434055);
    a = ii(a, b, c, d, x[i+12], 6 ,  1700485571);
    d = ii(d, a, b, c, x[i+ 3], 10, -1894986606);
    c = ii(c, d, a, b, x[i+10], 15, -1051523);
    b = ii(b, c, d, a, x[i+ 1], 21, -2054922799);
    a = ii(a, b, c, d, x[i+ 8], 6 ,  1873313359);
    d = ii(d, a, b, c, x[i+15], 10, -30611744);
    c = ii(c, d, a, b, x[i+ 6], 15, -1560198380);
    b = ii(b, c, d, a, x[i+13], 21,  1309151649);
    a = ii(a, b, c, d, x[i+ 4], 6 , -145523070);
    d = ii(d, a, b, c, x[i+11], 10, -1120210379);
    c = ii(c, d, a, b, x[i+ 2], 15,  718787259);
    b = ii(b, c, d, a, x[i+ 9], 21, -343485551);

    a = add(a, olda);
    b = add(b, oldb);
    c = add(c, oldc);
    d = add(d, oldd);
  }
  return rhex(a) + rhex(b) + rhex(c) + rhex(d);
}
var hex_chr = "0123456789abcdef";
function rhex(num)
{
  str = "";
  for(j = 0; j <= 3; j++)
    str += hex_chr.charAt((num >> (j * 8 + 4)) & 0x0F) +
           hex_chr.charAt((num >> (j * 8)) & 0x0F);
  return str;
}

/*
 * Convert a string to a sequence of 16-word blocks, stored as an array.
 * Append padding bits and the length, as described in the MD5 standard.
 */
function str2blks_MD5(str)
{
  nblk = ((str.length + 8) >> 6) + 1;
  blks = new Array(nblk * 16);
  for(i = 0; i < nblk * 16; i++) blks[i] = 0;
  for(i = 0; i < str.length; i++)
    blks[i >> 2] |= str.charCodeAt(i) << ((i % 4) * 8);
  blks[i >> 2] |= 0x80 << ((i % 4) * 8);
  blks[nblk * 16 - 2] = str.length * 8;
  return blks;
}

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally 
 * to work around bugs in some JS interpreters.
 */
function add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF);
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
  return (msw << 16) | (lsw & 0xFFFF);
}

/*
 * Bitwise rotate a 32-bit number to the left
 */
function rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt));
}

/*
 * These functions implement the basic operation for each round of the
 * algorithm.
 */
function cmn(q, a, b, x, s, t)
{
  return add(rol(add(add(a, q), add(x, t)), s), b);
}
function ff(a, b, c, d, x, s, t)
{
  return cmn((b & c) | ((~b) & d), a, b, x, s, t);
}
function gg(a, b, c, d, x, s, t)
{
  return cmn((b & d) | (c & (~d)), a, b, x, s, t);
}
function hh(a, b, c, d, x, s, t)
{
  return cmn(b ^ c ^ d, a, b, x, s, t);
}
function ii(a, b, c, d, x, s, t)
{
  return cmn(c ^ (b | (~d)), a, b, x, s, t);
}
function nonumbers(e,cur,nex,mnum)
{
	
var keynum
var keychar
var numcheck
var numarr=new Array(0,8,9);

if(window.event) // IE
{
keynum = e.keyCode
}
else if(e.which) // Netscape/Firefox/Opera
{
keynum = e.which
}

if( containsElement(numarr,keynum) )
{
	return true;
}
keychar = String.fromCharCode(keynum)
var ee=keychar;
numcheck = /\d/

if(numcheck.test(ee) && !isNaN(ee))
{
if(cur==nex)
{
	if(mnum)
	{
		if(cur.value.length < mnum)
	{
		//cur.value+=ee; 
		return true;
	}
	else
		{
			ee="";
			return false;
		}
	}
	else
		{
	//cur.value+=ee;
	return true;
   }
   return false;
}
else
	{
		
	if(cur.value.length < mnum)
	{
		// cur.value+=ee;
		
		 return true;
	
	}
	else
		{
					nex.focus();
			if(nex.value=="")
			{
		nex.value+=ee;
		}
		return true;
		}
	}
}
else
	{
		return false
	}
	return false;

}

function containsElement(arr, ele) {
    var found = false, index = 0;
    while(!found && index < arr.length)
    {
    if(arr[index] == ele)
    found = true;
    else
    index++;
   }
    return found;
  }