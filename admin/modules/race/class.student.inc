<?php
atkimport("module.race.examplelistener");
class student extends atkMetaNode
{
	protected $table      = "student";   
	protected $index      = "first_name";
	protected $order      = "admission_no";
	protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD,NF_EXPORT,NF_NO_EXTENDED_SEARCH, NF_MRA,NF_LOCK,);
	protected $descriptor = "[first_name]=[last_name]";
    
	public static function meta($policy)
	{
	    
		$policy->get("id")->addFlag(AF_PRIMARY);
		$policy->get("identification_marks2")->addFlag(AF_BLANK_LABEL);
		$policy->hasone("list_branch");
		$policy->get("admission_no")->addFlag(AF_SEARCHABLE|AF_READONLY_ADD|AF_READONLY_EDIT);
		$policy->hasone("list_class");
		$policy->hasone("section",array('filter'=>"list_class_id= '[list_class_id.id]'"));
		$policy->get("last_name")->addFlag(AF_FORCE_LOAD);
		$policy->get("dob")->addFlag(AF_DATE_EMPTYFIELD);
		$policy->setDefaultValue(nationality, Indian);
		$policy->setDefaultValue(identification_marks,1);
		$policy->setDefaultValue(identification_marks2,2);
		$policy->hasone("fee.list_orientation");
		$policy->hasone("list_religion")->addFlag(AF_RELATION_AUTOLINK);
		$policy->hasone("list_reservation")->addFlag(AF_RELATION_AUTOLINK);
		$policy->hasMany("student_academic_details");
		$policy->setTab("student_academic_details", "Previous_School_Details");
		$policy->setTypeAndParams("stu_image","atkFileAttribute",array("images/Ratnam_student/"));
		$policy->get("stu_image")->addFlag(AF_FILE_POPUP|AF_FILE_NO_SELECT);
		$policy->setTabs("father_name","mother_name","father_phno","mother_phno","list_religion_id","family_income","mothertongue","guardian","guardian_phno","father_profession","mother_profession","father_designation","mother_designation","email_id","Family_Details");
		
		$policy->setTabs("permenant_add","city1","state1","Address_Details.Permenant_Details");
		$policy->setTabs("local_add","state","city", "Address_Details.local_Details");
		$policy->get("city1")->addFlag(AF_SEARCHABLE|AF_OBLIGATORY);
		//$policy->get("last_name")->addFlag(AF_OBLIGATORY);
		$policy->setTabs("country","Address_Details");
		
		$policy->setTabs("health_condition", "severity","precautions","medicine","hospital_name","doctor_name","emergency_ph_no", "Permanent_address","Health_condition");
		
		 $policy->addFlag("first_name","mothertongue","transport","father_name","mother_name","family_income","father_phno","mother_phno","nationality","list_religion_id","identification_marks","list_reservation_id","ex_curr_act","stu_image","section_id","list_orientation_id","guardian","guardian_phno","age","father_profession","mother_profession","father_designation","mother_designation","health_condition","severity","precautions","medicine","hospital_name","doctor_name","emergency_ph_no","country","roll_no","email","state","state1","email_id","city","identification_marks2",AF_HIDE_LIST);
		
  	}
	
	public function postMeta()
	{
	
	//$this->getAttribute("list_branch_id")->addDependee("list_class_id");
	$this->getAttribute("admission_no")->setColumn(1);
	$this->getAttribute("list_class_id")->setColumn(1);
	$this->getAttribute("list_class_id")->addDependee("section_id");
	$this->getAttribute("roll_no")->setColumn(1);
	$this->getAttribute("last_name")->setColumn(1);
	$this->getAttribute("dob")->atkDateAttribute("dob", "d-m-y", $format_view="", $min=0, $max=0,AF_HIDE_LIST|AF_DATE_EMPTYFIELD|AF_DATE_EDIT_NO_DAY|AF_OBLIGATORY);
	$this->getAttribute("dob")->setInitialValue(null);
	$this->getAttribute("admission_date")->atkDateAttribute("admission_date", "d-m-y", $format_view="", $min=0, $max=0,AF_HIDE_LIST|AF_DATE_EMPTYFIELD|AF_DATE_EDIT_NO_DAY|AF_OBLIGATORY);
	//$this->getAttribute("admission_date")->setInitialValue(null);
	
	//$this->getAttribute("admission_date")->addOnChangeHandler("document.getElementBy;");
	
	
	$this->getAttribute("admission_date")->setDateMax(date('Y-m-d'));

	
	
	
	
	
	$this->getAttribute("age")->setColumn(1);
	
	$this->getAttribute("gender")->setColumn(1);
	$this->add(new atkRadioAttribute("gender",array('Male','Female'),array('Male','Female')))->addFlag(AF_HIDE_LIST|AF_OBLIGATORY);
	$this->getAttribute("transport")->setColumn(1);
	$this->getAttribute("transport")->addFlag(AF_HIDE);
	$this->getAttribute("gender")->setColumn(1);
	$this->getAttribute("list_reservation_id")->setColumn(1);
	$this->getAttribute("identification_marks")->setColumn(1);
	$this->getAttribute("identification_marks2")->setColumn(1);
	$this->getAttribute("mother_name")->setColumn(1);
	$this->getAttribute("guardian_phno")->setColumn(1);
	$this->getAttribute("mother_phno")->setColumn(1);
	$this->getAttribute("mother_profession")->setColumn(1);
	$this->getAttribute("mother_designation")->setColumn(1);
	$this->getAttribute("mothertongue")->setColumn(1);
	$this->addUniqueFieldset(array("govt_admission_no"));
	
	$this->add(new atkRadioAttribute("severity",array('Intermittent','Moderate Persistent',' Mild Persistent','Severe Persistent'),array('Intermittent','Moderate Persistent',' Mild Persistent','Severe Persistent' )))->addFlag(AF_HIDE_LIST|AF_DISPLAY_VERT);
	
	//$this->add(new atkTabbedPane("Permanent_address", array("p_add"=>array("permenant_add","state","city"), "add_com"=>array("local_add","city1","state1","country")) ));
	
	$this->addListener(new examplelistener());
	//$this->addUniqueFieldset(array("first_name","last_name"));
	$this->addUniqueFieldset(array("section_id","roll_no"));
	 
		 
	 $this->getAttribute('stu_image')->setFilenameTemplate('student_[admission_no]');
	 $this->setTabIndex("general",0,$action="");
	  
	 //$this->getAttribute('stu_image')->setAllowedFileTypes('.jpg');
	
	//$this->addFieldSet("test_group","<strong>[first_name.label]</strong>[first_name.field]   [last_name.label][last_name.field]",AF_BLANK_LABEL|AF_OBLIGATORY,null);
	
	//$this->add(new getValidCurrentDate(dob, 1-1-1995, 1-1-2011, add));
	
	
	
     }
   
    
	 
	 /* 	
	function preAdd(&$record) 
	{
	    $seq_num=getsequence($this);
	    $record["admission_no"] = $seq_num;
	    return true;
	}
		
	function postAdd($record)
	{
	  updatesequence($this);
	} */

	public function first_name_display($record)
	{	
		
	  $firstname = $record["first_name"];
	  $lastname = $record["last_name"];
          return "<strong>".$firstname." ".$lastname."</strong>";
	}
	


	
	
}
?>