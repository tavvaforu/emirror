<?php
atkimport("atk.utils.atktriggerlistener");
class listenerbranch extends atkTriggerListener{

public function preAdd(&$record)
{
$node = atkGetNode("race.list_branch");
$seq_num=getsequence($node);
$record["list_branch_code"] = $seq_num;
	    return true;
}

function postAdd($record)
{
$node = atkGetNode("race.list_branch");
updatesequence($node);
}


}
?>