<?php
  
  class mod_race extends atkModule
  {    
 
    function getMenuItems()
    {    
      $this->menuitem("RACE"); 
      
      //$this->menuitem("Organization", dispatch_url("race.organisation", "admin"), "RACE"); 
	 // $this->menuitem("Location", dispatch_url("race.list_location", "admin"), "RACE");
	  //$this->menuitem("Branch", dispatch_url("race.list_branch", "admin"), "RACE");
	  //$this->menuitem("Academic_Year", dispatch_url("race.list_academicyear", "admin"), "RACE");
	  //$this->menuitem("State", dispatch_url("race.list_state", "admin"), "RACE");
	  //$this->menuitem("City", dispatch_url("race.list_city", "admin"), "RACE");
	  
	  //$this->menuitem("Student Academic Details", dispatch_url("race.student_academic_details", "admin"), "RACE");
	  $this->menuitem("Class", dispatch_url("race.list_class", "admin"), "RACE");
	  //$this->menuitem("Section", dispatch_url("race.section", "admin"), "RACE");
	  //$this->menuitem("Syllabus", dispatch_url("race.list_syllabus", "admin"), "RACE"); 
	  $this->menuitem("Subject", dispatch_url("race.academic_subject", "admin"), "RACE"); 
	  //$this->menuitem("Religion", dispatch_url("race.list_religion", "admin"), "RACE");
	  //$this->menuitem("Reservation", dispatch_url("race.list_reservation", "admin"), "RACE");
	  
	 
	  //$this->menuitem("Medium", dispatch_url("race.list_medium", "admin"), "RACE");
	  //$this->menuitem("Student_Address", dispatch_url("race.student_address_details", "admin"), "RACE");
	  
      //$this->menuitem("Sequence_No", dispatch_url("race.settings_sequence", "admin"), "RACE");
      //$this->menuitem("Chapter", dispatch_url("race.chapter", "admin"), "RACE");
      // $this->menuitem("Topic", dispatch_url("race.topic", "admin"), "RACE");
//$this->menuitem("Example", dispatch_url("race.ex_tab", "admin"), "RACE");
       //$this->menuitem("Class Subjects", dispatch_url("race.class_subject", "admin"), "RACE"); 
   

    $this->menuitem("Settings"); 
	 
	 $this->menuitem("Location", dispatch_url("race.list_location", "admin"), "Settings");
	  $this->menuitem("School", dispatch_url("race.list_branch", "admin"), "Settings");
	  
        $this->menuitem("Student");
	$this->menuitem("Admission", dispatch_url("race.student", "admin"), "Student");  
        
 
  }
  
  
  
}

?>
