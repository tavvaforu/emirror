<?php

class article extends atkmetanode
{
	protected $table      = "article";
	protected $index      = "title";
	protected $order      = "title";
	protected $flags      = array(NF_ADD_LINK, NF_ADDAFTERADD, NF_EXPORT, NF_MRA);
	protected $descriptor = "[title]";
	public static function meta($policy)
    {
		//$policy->hasone("title_id");
		//$policy->hasone("article_id");
		$policy->get("status")->setType("atkboolattribute");
		$policy->get("description")->setType("atkfckattribute");
	}
	public function postMeta()
	{
	}
}	
?>