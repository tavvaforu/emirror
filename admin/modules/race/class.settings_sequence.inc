<?php


class settings_sequence extends atkMetaNode
{
    protected $table      = "settings_sequence";   
    
    protected $flags      = array(NF_COPY,NF_ADD_DIALOG,NF_EDIT_DIALOG,NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA,);
   protected $descriptor = "[current]";
    
	
	
    public static function meta($policy)
    {
	
 //$policy->setTypeAndParams("admissionno","atkExpressionAttribute",array ("select concat(prefix,current) as admissionno FROM settings_sequence stse where stse.id=settings_sequence.id "));
	  
	}
	
	public function postMeta()
	{
	
	$this->add(new atkCalculatorAttribute("current", "[from]+1"));
	
	
	}
	
 }
?>