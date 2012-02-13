<?php
function getsequence($node)
 {
 $db_table=$node->getTable();
 
  $db = atkGetDb();
	   
    // $this->add(new atkCalculatorAttribute("[settings_sequence.from]+1"));
    $rows=$db->query("SELECT seq_prefix,seq_current FROM settings_sequence WHERE settings_sequence.seq_table='$db_table' for update");
	
	$db->next_record();
	$value = $db->m_record;
	$record = $value[seq_prefix]."-".$value['seq_current'];		

 return $record;
 }
 function updatesequence($node)
 {
 $db_table=$node->getTable();
 $db = atkGetDb();
 $db->query("update settings_sequence set seq_current = seq_current + 1 WHERE settings_sequence.seq_table='$db_table'");
 }
 
 
 
 
?>