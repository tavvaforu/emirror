<?php


class student_academic_details extends atkMetaNode
{
    protected $table      = "student_academic_details";   
    //protected $index      = "student_id";
   // protected $order      = "student_id";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    //protected $descriptor = "[student_id]";
    
    public static function meta($policy)
    {
	
	
	//$policy->hasone("list_class");
	//$policy->hasone("academic");
	$policy->hasone("list_syllabus");
	//$policy->hasone("list_medium");
	//$policy->hasone("section",array('filter'=>"list_class_id= '[list_class_id.id]'"));
	
	  //$policy->setTabs("academic_id","class_last_passed","grade","date_leavingschl","exam_lastattnd","leaving_reason","marks","school_recognised","Previous_School_Details");
	  
	  $policy->setType("school_recognised", "atkBoolAttribute");
	  
	  $policy->addFlag("school_recognised","date_leavingschl","exam_lastattnd","leaving_reason","list_medium_id","student_id",AF_HIDE_LIST);
      
	 // $policy->get("admission_no")->addFlag(AF_SEARCHABLE);
	  
	  

	  
	  
    	
  	}
	
	public function postMeta()
	{
	//$this->getAttribute("list_class_id")->addDependee("section_id");
	$this->getAttribute("list_class_id")->addFlag(AF_HIDE);
	$this->getAttribute("section_id")->addFlag(AF_HIDE);
	$this->getAttribute("student_id")->addFlag(AF_HIDE);
	//$this->getAttribute("list_syllabus_id")->addFlag(AF_HIDE);
	$this->getAttribute("academic_id")->addFlag(AF_HIDE);
	$this->getAttribute("admission_no")->addFlag(AF_HIDE);
	$this->getAttribute("admission_date")->addFlag(AF_HIDE);
	$this->getAttribute("list_medium_id")->addFlag(AF_HIDE);
	}
	
	
 }
?>