<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class main extends CI_Controller {
    
    function index()
    {
       
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $data['Characters'] = $this->main_model->getCharacters();
        
        $this->load->view('main_view',$data);
    }
    function characteradd()
    {
        $this->load->helper('form');
        
        $this->load->model('main_model');
        $data = $this->main_model->general();
        $this->load->model('character_model');
        
        if($this->input->post('charadd')){
		$this->character_model->addEntry();
	}	
        
        $data = array_merge($data,$this->character_model->general());
       
        
        
        $this->load->view('character_input',$data);
    }
}

?>
