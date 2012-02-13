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
	    
	    $policy->setTypeAndParams("stu_image","atkFileAttribute",array("images/Ratnam_student/"));
		$policy->get("stu_image")->addFlag(AF_FILE_POPUP);
		
		
	    $policy->get("id")->addFlag(AF_PRIMARY);
	    $policy->get("admission_no")->addFlag(AF_READONLY_ADD|AF_READONLY_EDIT);
	    $policy->setTabs("permenant_add", "local_add", "Address_Details");
	    $policy->hasMany("student_academic_details");
		$policy->setTab("student_academic_details", "Previous_School_Details");
	    $policy->get("admission_date")->addFlag(AF_DATE);
	    //$policy->hasone("list_class")->addFlag(AF_SEARCHABLE);
		$policy->hasone("list_branch");
		$policy->hasone("fee.list_orientation");
		
		$policy->setTabs("health_condition", "severity","precautions","medicine","hospital_name","doctor_name","emergency_ph_no", "Health_condition");
		
	    $policy->addFlag("last_name","mothertongue","transport","dob","father_name","mother_name","family_income","father_phno","mother_phno","nationality","list_religion_id","identification_marks","list_reservation_id","ex_curr_act","stu_image","section_id","list_orientation_id","guardian","guardian_phno","age","father_profession","mother_profession","father_designation","mother_designation","health_condition","severity","precautions","medicine","hospital_name","doctor_name","emergency_ph_no",AF_HIDE_LIST);
	    $policy->hasone("section",array('filter'=>"list_class_id= '[list_class_id.id]'"));
		$policy->hasone("list_class",array('filter'=>"list_branch_id= '[list_branch_id.id]'"));
	    $policy->hasone("list_religion")->addFlag(AF_RELATION_AUTOLINK);
	    $policy->hasone("list_reservation")->addFlag(AF_RELATION_AUTOLINK);
	    $policy->setTabs("father_name","mother_name","father_phno","mother_phno","list_religion_id","family_income","mothertongue","guardian","guardian_phno","father_profession","mother_profession","father_designation","mother_designation","Family_Details");
		
	    $policy->get("admission_no")->addFlag(AF_SEARCHABLE);
	    $policy->get("last_name")->addFlag(AF_FORCE_LOAD);
	    //$policy->setTypeAndParams("full_name","atkExpressionAttribute",array ("select concat(first_name,' ',last_name) as fullname FROM student st where st.id=student.id "));	
     }
	
	public function postMeta()
	{
	 $this->addListener(new examplelistener());
	 $this->addUniqueFieldset(array("first_name","last_name"));
	 $this->add(new atkRadioAttribute("gender",array('Male','Female'),array('Male','Female')))->addFlag(AF_HIDE_LIST|AF_OBLIGATORY);
	 $this->add(new atkRadioAttribute("severity",array('Intermittent','Moderate Persistent',' Mild Persistent','Severe Persistent'),array('Intermittent','Moderate Persistent',' Mild Persistent','Severe Persistent' )))->addFlag(AF_HIDE_LIST|AF_DISPLAY_VERT);
	 $this->getAttribute("list_class_id")->addDependee("section_id");
	 
	 $this->add(new atkAttribute("country"));
	 $this->getAttribute("list_branch_id")->addDependee("list_class_id");
	 
	 $this->getAttribute("admission_no")->setColumn(1);
	 $this->getAttribute("last_name")->setColumn(1);
	 $this->getAttribute("guardian_phno")->setColumn(1);
	 $this->getAttribute("nationality")->setColumn("1");
	 $this->getAttribute("transport")->setColumn(1);
	 $this->getAttribute("ex_curr_act")->setColumn(1);
	 $this->getAttribute("gender")->setColumn(1);
	 $this->getAttribute("mother_name")->setColumn(1);
	 $this->getAttribute("mother_phno")->setColumn(1);
	 $this->getAttribute("mother_profession")->setColumn(1);
	 $this->getAttribute("mother_designation")->setColumn(1);
	 $this->getAttribute("mothertongue")->setColumn(1);
	 $this->getAttribute("section_id")->setColumn(1);
	 $this->getAttribute("age")->setColumn(1);
	 $this->getAttribute("identification_marks")->setColumn(1);
	 $this->getAttribute("transport")->addFlag(AF_HIDE);
	 //$this->setAttributeOrder("first_name",10);
	 
	 $this->attribSort();
	 
	 $this->getAttribute('stu_image')->setFilenameTemplate('student_[admission_no]');
	 //$this->getAttribute(array("list_class_id","last_name","mothertongue","transport","dob","father_name"))->setColumn(1);
	
	
	
	
	
	//$this->addFieldSet("test_group","<strong>[first_name.label]</strong>[first_name.field]   [last_name.label][last_name.field]",AF_BLANK_LABEL|AF_OBLIGATORY,null);
	
	$this->getAttribute("admission_date")->atkDateAttribute("admission_date", "d-m-y", $format_view="", $min=0, $max=0, AF_DATE_EMPTYFIELD|AF_DATE_EDIT_NO_DAY|AF_OBLIGATORY);
	$this->getAttribute("dob")->atkDateAttribute("dob", "d-m-y", $format_view="", $min=0, $max=0, AF_DATE_EMPTYFIELD|AF_DATE_EDIT_NO_DAY|AF_HIDE_LIST|AF_OBLIGATORY);
	
		 $this->setTabIndex("general",0,$action="");

	}
	
	/* function preAdd(&$record) 
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