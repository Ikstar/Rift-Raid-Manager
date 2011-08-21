<?php
class character extends CI_Controller {
            function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('character_model') ;
    }
    
function index($error='')
{
   
   $data = $this->character_model->general();  
   $this->load->view('character_lookup_view', $data);
}
function ShowCharacter()
{
   
   $data = $this->character_model->general();
   
   
   $CharName = $this->input->post('name',TRUE);
   $data['CharId'] = $this->character_model->getCharId($CharName);
   
   $data['raids'] = $this->character_model->getCharRaids($data['CharId']);
   $data['groups'] = $this->character_model->getCharGroups($data['CharId']);
   $data['info'] = $this->character_model->getCharInfo($data['CharId']);
   $data['totalAttendance'] = $this->character_model->getTotalAttendance($data['CharId']);
 
   $this->load->view('character_detail_view', $data);
}
function AutoComplete()
{
    
   
    $term = $this->input->get('term',TRUE);
    if (strlen($term) < 2) echo "NO";
    $rows = $this->character_model->GetAutocomplete(array('keyword' => $term));
    $keywords = array();
    foreach ($rows as $row)
         array_push($keywords, $row->name);
    echo json_encode($keywords);
}
}
?>
