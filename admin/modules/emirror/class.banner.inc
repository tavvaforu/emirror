<?php
class banner extends atkmetanode
{
	protected $table      = "banner";
	protected $index      = "banner_name";
	protected $order      = "banner_name";
	protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
	protected $descriptor = "banner_name";
	public static function meta($policy)
    {
		
		$policy->hasone("banner_position");
		$policy->get("status")->setType("atkboolattribute");
		
	}
	public function postMeta()
	{
	}
		
}
?>