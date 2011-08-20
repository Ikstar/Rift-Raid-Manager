<?php

class raiddump_model extends CI_Model{
    

function raiddump_model(){
    parent::__construct();
    $this->load->helper('url');               
  }
  
function  getRaids()
{
    $result = $this->db->get('raid');
    return $result;
}

function addRaid($Group,$Date)
{
    
}
function addAttendees($Raid)
{
    
}
function getAttendees($Raid)
{
    $this->db->select('chars.name, class, loot, date, groups.name as groupname');
    $this->db->join('chars', 'idchars = attendance.chars_idchars');
    $this->db->from('raid, attendance, groups');
    $this->db->where('idraids ', '$Raid');
}
 function addCharacter($name,$class)
  {
      $this->load->database();
      $name = $this->db->escape_str($name);
      $data = array(
	          'name'=>  $this->db->escape_str($name),
                  'class'=> $class,				  
	        );
	$this->db->insert('chars',$data);   
        $this->db->select('idchars');
        $this->db->from('chars');
        $this->db->where('name',$name);
        $query = $this->db->get();
        return $query->result();
      
  }
function matchAttendees($Attendees)
{
   
     $Characters = array();
    $count = 0;
    foreach ($Attendees as $Attendee)
    {
        $Attendee = $this->db->escape_str($Attendee);
       
        $this->db->select('name, class, idchars');
        $this->db->where('name', $Attendee);
        $this->db->from('chars');
        $query = $this->db->get();
        
        if($query->num_rows() != 1)
        {
           $row = $this->addCharacter($Attendee,0);
           $Characters[$count] =  array($Attendee,$row->idchars,NULL);
        }   
            else {
                $result = $query->result();
                $row = $query->row(); 
                $Characters[$count] =  array($Attendee,$row->class,$row->idchars);
            }
         
         $count++;
    }
   
    return $Characters;
}
  
  
}
  
  ?>