<?php
atkimport("atk.utils.atktriggerlistener");
class ExampleListener extends atkTriggerListener{

public function preAdd(&$record)
{
$node = atkGetNode("race.student");
$seq_num=getsequence($node);
$record["admission_no"] = $seq_num;
	    return true;
}

function postAdd($record)
{
$node = atkGetNode("race.student");
updatesequence($node);
}


}
?>