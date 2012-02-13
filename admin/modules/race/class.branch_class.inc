<?php
class branch_class extends atkMetaNode
{
    protected $table      = "branch_class";   
//    protected $index      = "name";
   // protected $order      = "list_branch_code";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD,NF_NO_EXTENDED_SEARCH, NF_EXPORT, NF_MRA,);
    protected $descriptor = "[list_class_id.name]";
    
    public static function meta($policy)
    {
	
	$policy->hasone("list_branch");
	$policy->hasone("list_class");
	$policy->hasMany("academic_subject");
  	}
	
	
	
 }
?>