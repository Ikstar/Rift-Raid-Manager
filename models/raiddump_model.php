<?php

class raiddump_model extends CI_Model{
    

function raiddump_model(){
    parent::__construct();
    $this->load->helper('url');               
    $this->load->helper('date');               
  }
  function general (){
              $this->load->library('Menu');
        $menu = new Menu;
        $data['menu'] = $menu->show_menu();
        $data['webtitle'] = "Raid Manager";
        $data['websubtitle'] = "Manage Raids";
        $data['webfooter'] = 'Created by Ikstars.com';
        return $data;
  }
  
 function getGroups()
    {
        $query = $this->db->get('groups');
        if($query->num_rows() == 0)
        {
            show_error('No Groups!');
        }   
            else
                return $query->result();
        
    }  
    
function  getRaids($RaidDate,$GID)
{
    $result = $this->db->get('raid');
    return $result;
}

function addRaid($RaidDate, $GID)
{
    $DateString = "%Y-%m-%d 00:00:00";
    $RaidDate = mdate($DateString,strtotime($RaidDate));
    //$SQL = "INSERT INTO raid(`raiddate`,`groups_idgroups`) VALUES(?,?)";
    //$this->db->query($SQL, array($RaidDate, $GID));
    //echo $RaidDate . "  ". $GID;
    $this->db->insert('raid', array('raiddate'=>$RaidDate,'groups_idgroups'=>$GID));
    $sql = 'select last_insert_id() as raidid';
    $query = $this->db->query($sql);
    $row = $query->row();
    //print_r($row);
    return $row->raidid;
}
function addAttendees($data)
{
    $this->db->insert_batch('attendance',$data);  
    
}
function incrementAttendance($RaidId,$idGroups)
{
    $CharIds = array();
    $this->db->select('chars_idchars');
    $this->db->where('raid_raidid', $RaidId);
    $this->db->from('attendance');
    $query = $this->db->get();
    foreach($query->result() as $row)
    $CharIds[] = $row->chars_idchars;
    
    $this->db->set('attendance', 'attendance+1', FALSE);
    $this->db->where_in('chars_idchars',$CharIds);
    $this->db->where('groups_idgroups',$idGroups);
    $this->db->update('roster');
    echo $this->db->last_query();
      
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
function matchAttendees($Attendees,$IdGroups )
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
        
        if($query->num_rows() < 1)
        {
           $row = $this->addCharacter($Attendee,0);
           $Characters[$count] =  array($Attendee,NULL,$row->idchars,NULL);
           
        }   
            else {
                $result = $query->result();
                $row = $query->row(); 
                $this->db->select('role, status');
                $this->db->where('chars_idchars', $row->idchars);
                $this->db->where('groups_idgroups', $IdGroups);
                $this->db->from('roster');
                $query2 = $this->db->get();
                if($query2->num_rows() > 0)
                {
                    //$Rec = $query2->result();
                    $row2 = $query2->row();
                    $Role = $row2->role;
                    $Status = $row2->status;
                }
                else
                {
                    $Role = 0;
                    $Status = 0;
                }
               
                $Characters[$count] =  array($Attendee,$row->class,$row->idchars,$Role,$Status);
            }
         
         $count++;
    }
   
    return $Characters;
}
  
  
}
  
  ?>