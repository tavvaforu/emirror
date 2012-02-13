<?php
class class_subject extends atkMetaNode
 {
    protected $table      = "class_subject";   
    protected $index      = "name";
    //protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	 $policy->hasMany("academic_subject");
	 
	}
		
	public function postmeta()
	{
	
	$this->add(new atkListAttribute("name", array("class 1", "class 2","class 3"),array(1,2,3)));
	
	}
	 
 }
?>