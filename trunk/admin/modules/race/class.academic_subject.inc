<?php


class academic_subject extends atkMetaNode
{
    protected $table      = "academic_subject";   
    protected $index      = "subject_name";
    protected $order      = "subject_name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[subject_name]";
    
    public static function meta($policy)
    {
	$policy->hasone("list_academicyear");
	$policy->hasone("branch_class");
    $policy->hasone("list_syllabus");
	$policy->hasone("list_medium");
	$policy->hasMany("chapter");
  	//$policy->hasMany("topic");
	//$policy->get("list_class_id")->addFlag(AF_OBLIGATORY);
	$policy->get("class_subject_id","list_academicyear_id","list_syllabus_id","list_medium_id","list_class_id")->addFlag(AF_HIDE);
	
	}
	public function postmeta()
	{
	//$this->add(new atkListAttribute("list_class_id", array("class 1", "class 2","class 3","class 4"),array(1,2,3,4)));
	}
	
	
	
 }
?>