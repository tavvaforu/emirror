<?php


class derogatory_words extends atkMetaNode
{
    protected $table      = "derogatory_words";   
    protected $index      = "name";
    //protected $order      = "name";
    protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_MRA);
    protected $descriptor = "[name]";
    
    public static function meta($policy)
    {

	
  	}
	

	
 }
?>