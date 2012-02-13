<?php
atkimport("atk.utils.atktriggerlistener");
class ExampleListener extends atkTriggerListener{

public function preAdd(&$record)
{
$node = atkGetNode("race.student");
$seq_num=getsequence($node);
$record["admission_no"] = $seq_num;

/*
$end = strtotime(date('Y-m-d'));
//print_r($record['dob']);
$mydate= $record['dob'][year]."-".$record['dob'][month]."-".$record['dob'][day];
$start = strtotime($mydate);
$yeardiff = $end-$start;
$yifd = floor($yeardiff/(60*60*24*365));

if($yifd < 15)
{
triggerError($record, "dob","Age Should Not be Less than 15");
}	
*/

	    return true;
}

function postAdd($record)
{
$node = atkGetNode("race.student");
updatesequence($node);
}


}
?>