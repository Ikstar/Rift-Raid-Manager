<?php
class rgroups_model extends CI_Model{
    function rgroups_model ()
    {
        parent::__construct();
    }
    
    function getGroups()
    {
        $query = $this->db->get('groups');
        if($query->num_rows() == 0)
        {
            $this->session->set_flashdata('message', "No Groups");
            return NULL;
        }   
            else
                return $query->result();
        
    }
    function getRoster($Gid)
    {
        
        $this->db->select('idRoster, idchars, chars.name, role , class, attendance, DKP, joined, status, roster.updated, roster.joined');
        $this->db->join('chars', 'idchars = chars_idchars','inner');
        $this->db->join('groups', 'idgroups = groups_idgroups','inner');
        $this->db->order_by('status, role, class');
        $this->db->where('groups_idgroups', $Gid);
        $this->db->from('roster');
        $query = $this->db->get();
        //echo $query->num_rows();
        if($query->num_rows() < 0)
        {
            show_error('No Group Matching ID exists');
        }   
            else
                return $query->result();
    }
    function addChartoRoster($data,$IdGroups)
    {
        
	$this->db->insert('roster', $data);  
        $this->db->update('groups', array('updated'=>date('Y-m-d H:i:s')), array('idgroups'=>$IdGroups)); 
    }
    function removeUserFromRoster($IdRoster,$IdGroups)
    {
       $this->db->delete('roster', array('idRoster'=>$IdRoster));
       $this->db->update('groups', array('updated'=> date('Y-m-d H:i:s')), array('idgroups'=>$IdGroups)); 
    }
    function updateUserOnRoster($data,$IdRoster,$IdGroups)
    {
        $this->db->update('roster',$data,array('idRoster'=>$IdRoster));
        $this->db->update('groups',array('updated'=> date('Y-m-d H:i:s')), array('idgroups'=>$IdGroups)); 
    }
   
    function addGroup($Name,$Size)
    {
        $data = array(
            'name'=>$this->db->escape_str($Name),
            'size'=>$Size,
            'created'=>date('Y-m-d H:i:s'),
            'updated'=>date('Y-m-d H:i:s'),
            
        );
      $this->db->insert('groups', $data);  
    }
    function deleteGroup($GroupId)
    {
        //Delete Roster
        
        //Delete Group
        
    }
    function getGroupName($GID)
    {
        $this->db->select('name');
        $this->db->where('idgroups', $GID); 
        $this->db->from('groups');
        $query = $this->db->get();
         if($query->num_rows() < 1)
        {
            show_error(" Group with ID: $GID does not exist");
        }   
            else
                return $query->row()->name;
         
    }
    function getGroupId($Name)
    {
        
        $Name = $this->db->escape_str($Name);
        $this->db->select('idgroups');
        $this->db->where('name', $Name); 
        $this->db->from('groups');
        $query = $this->db->get();
         if($query->num_rows() < 1)
        {
            show_error(" Group with name: $Name does not exist");
        }   
            else
                return $query->row()->idgroups;
    }
    function getCharId($Name)
    {
        $Name = $this->db->escape_str($Name);
        $this->db->select('idchars');
        $this->db->where('name', $Name);
        $this->db->from('chars');
        $query = $this->db->get();
         if($query->num_rows() < 1)
        {
            show_error(" Character &quot;$Name&quot; does not exist");
        }   
            else
                return $query->row()->idchars;
        
    }
} 
?>
