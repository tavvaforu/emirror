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
	$policy->hasone("list_class")->addFlag(AF_OBLIGATORY);
    $policy->hasone("list_syllabus");
	$policy->hasone("list_medium");
	$policy->hasMany("chapter");
  	//$policy->hasMany("topic");
	//$policy->get("list_class_id")->addFlag(AF_OBLIGATORY);
	}
	
	
	
	
 }
?>