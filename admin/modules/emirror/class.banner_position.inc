<?php

class banner_position extends atkmetanode
{
	protected $table      = "banner_position";
	protected $index      = "name";
	protected $order      = "name";
	protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
	protected $descriptor = "[name]";
	public static function meta($policy)
    {
	$policy->hasmany("banner");
	}
	public function postMeta()
	{
	}	
}
?>