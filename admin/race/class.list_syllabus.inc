<?php


class list_syllabus extends atkMetaNode
{
    protected $table      = "list_syllabus";   
    
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
   protected $descriptor = "[name]";
    
    public static function meta($policy)
    {
	
	  
	  //$policy->hasone("list_branch");
	  
  	}
	
	public function postMeta()
    {
        
   
	
		
    }
 }
?>