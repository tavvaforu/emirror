<?php
class list_class extends atkMetaNode
 {
    protected $table      = "list_class";   
    protected $index      = "name";
    //protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	//$policy->setTabs("race.subject","Subject");
	$policy->hasone("list_branch");
	
	//$policy->addFlag("academic_id",AF_RELATION_AUTOCOMPLETE);
	$policy->hasMany("section");
	}
	
	
	
	public function postmeta()
	{
	$this->addUniqueFieldset(array("name","list_branch_id"));
	}
	 
 }
?>