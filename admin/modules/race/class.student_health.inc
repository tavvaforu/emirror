<?php
class student_health extends atkMetaNode
{
    protected $table      = "student_health";   
    //protected $index      = "name";
    //protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
   // protected $descriptor = "[name]";
    
	
	 public static function meta($policy)
        {
	      $policy->setTypeandParams("precautions","atkTextAttribute",array(array("cols"=>15,"rows"=>5)));
		   $policy->setTypeandParams("medicine","atkTextAttribute",array(array("cols"=>15,"rows"=>5)));
		   $policy->setTypeandParams("health_condition","atkTextAttribute",array(array("cols"=>15,"rows"=>5)));
	    }


}
?>