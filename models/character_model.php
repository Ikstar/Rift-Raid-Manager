<?php
class character_model extends CI_Model{
    

function character_model(){
    parent::__construct();
    $this->load->helper('url');               
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
  function modifyCharacter($CharId, $data)
  {
      $this->db->set('chars',$data);
      $this->db->where('idchars',$CharId);
      
  }
  function general() {
						   
	$data['name']	 	= 'Character Name';
        $data['class']          = "Class";
	$data['classes']	= array('1'=>'Warrior', '2'=>'Mage','3'=>'Cleric','4'=>'Rogue');
        return $data;
  }
};
?>
