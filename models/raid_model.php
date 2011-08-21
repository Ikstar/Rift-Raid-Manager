<?php

class raid_model extends CI_Model{
    function raid_model ()
    {
        parent::__construct();
    }
    function general()
    {
       $this->load->library('Menu');
        $menu = new Menu; 
        $data['menu'] = $menu->show_menu();
        $data['webtitle'] = "Raid Manager";
        $data['websubtitle'] = "Raid View";
        $data['webfooter'] = 'Created by Ikstars.com';
        return $data;
    }
    function getRaids()
    {
        $this->db->select('raidid, raiddate, groups_idgroups, groups.name');
        $this->db->join('groups', 'groups_idgroups = idgroups');
        $this->db->from('raid');
        $query = $this->db->get();
            return $query;
    
    }
    
    function getRaid($RaidId)
    {
        $this->db->select('Role, Loot, chars.name, chars_idchars, class');
        $this->db->join('chars','chars_idchars=idchars');
        $this->db->from('attendance');
        $this->db->where('raid_raidid',$RaidId);
        $query = $this->db->get();
            return $query;
           
    }
    function getRaidDetails($RaidId)
    {
        $this->db->select('raidid, raiddate, groups_idgroups, groups.name, groups_idgroups');
        $this->db->join('groups', 'groups_idgroups = idgroups');
        $this->db->where('raidid',$RaidId);
        $this->db->from('raid');
        $query = $this->db->get();
            return $query->row(); 
    }
}
?>
