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
            show_error('No Groups!');
        }   
            else
                return $query->result();
        
    }
    function getRoster($Gid)
    {
        
        $this->db->select('idchars, chars.name, role , class, attendance, DKP, joined, groups.updated');
        $this->db->join('chars', 'idchars = chars_idchars','inner');
        $this->db->join('groups', 'idgroups = groups_idgroups','left');
        $this->db->group_by('role');
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
    function addUsertoRoster($GroupId, $UserId, $Role)
    {
        $data = array(
                  'groups_groupsid' => $GroupId,
	          'chars_idchars'=>  $UserId,
                  'role' => $Role,
                  'joined' => "CURRENT_TIMESTAMP",
                  'attendance' => 0,
	        );
	$this->db->insert('chars',$data);  
    }
    function removerUserFromRoster($UserId)
    {
        
    }
    function UpdateRoster($Roster)
    {
        
    }
    function getUserId($Name)
    {
        
    }
    function deleteGroup($GroupId)
    {
        //Delete Roster
        
        //Delete Group
        
    }
} 
?>
