<?php
class character_model extends CI_Model{
    

function character_model(){
    parent::__construct();
    $this->load->helper('url');               
  }
  function GetAutocomplete($options=array())
  {
      $this->db->select('idchars, name');
      $this->db->like('name',$options['keyword'],'after');
      $query = $this->db->get('chars');
      return $query->result();
  }
  function addEntry()
  {
   $this->load->database();
	$data = array(
	          'name'=>$this->input->post('name'),
                  'class'=>$this->input->post('class'),				  
	        );
	$this->db->insert('chars',$data);   
      
  }
  
  function addEntrySafe($Name,$Class)
  {
   $Name = $this->db->escape_str($Name);
	$data = array(
	          'name'=>$Name,
                  'class'=>$Class
	        );
        $this->db->select('idchars');
               $this->db->where('name',$Name);
               $this->db->from('chars');
               $query = $this->db->get();
               if ($query->num_rows() != 0)
                       return;
               else
            $this->db->insert('chars',$data);   
      
  }
  
  function addCharacter($name,$class)
  {
      $this->load->database();
      $name = $this->escape_str($name);
      $data = array(
	          'name'=>  $this->escape_str($name),
                  'class'=> $class,				  
	        );
	$this->db->insert('chars',$data);   
        $this->db->select('idchars');
        $this->db->from('chars');
        $this->db->where('name',$name);
        $query = $this->db->get();
        return $query->result();
      
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
    function getCharRaids($CharId)
    {
        $this->db->select('raidid, role, loot, raiddate, groups.name');
        $this->db->join('attendance', 'raidid = raid_raidid');
        $this->db->join('groups','groups_idgroups = idgroups');
        $this->db->where('chars_idchars', $CharId);
        $this->db->from('raid');
        $query = $this->db->get();
        if($query->num_rows() < 1)
        {
            return false;
        }   
            else
                return $query;
    }
    function getCharGroups($CharId)
    {
               $this->db->select('idgroups, name, role, status, size, groups.updated, groups.created ,roster.joined');
        $this->db->join('roster', 'idgroups = groups_idgroups');
        $this->db->where('chars_idchars', $CharId);
        $this->db->from('groups');
        $query = $this->db->get();
        if($query->num_rows() < 1)
        {
            show_error(" Character is not listed on any roster");
        }   
            else
                return $query; 
    }
    function getCharInfo($CharId)
    {
         $query =$this->db->query("SELECT name, class, dkp  from chars WHERE idchars = $CharId");
       //= $this->db->get();
               if($query->num_rows() < 1)
        {
            show_error(" Character details are not available");
        }   
            else
                return $query; 
    }
    function getTotalAttendance($CharId)
    {
        $query = $this->db->query("SELECT count(raid_raidid) as TotalAttendance from attendance WHERE chars_idchars = $CharId");
                       if($query->num_rows() < 1)
        {
                return 0;
        }   
            else
                return $query->row()->TotalAttendance; 
    }
  function general() {
		
         $this->load->library('Menu');
        $menu = new Menu;
	$data['name']	 	= 'Character Name';
        $data['class']          = "Class";
	$data['classes']	= array('1'=>'Warrior', '2'=>'Mage','3'=>'Cleric','4'=>'Rogue');
        $data['menu'] = $menu->show_menu();
        $data['webtitle'] = "Raid Manager";
        $data['websubtitle'] = "Character View";
        $data['webfooter'] = 'Created by Ikstars.com';
        return $data;
  }
};
?>
