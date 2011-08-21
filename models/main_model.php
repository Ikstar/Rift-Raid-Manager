<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */


Class main_model extends CI_Model {
    function main_model()
    {
        parent::__construct();
    }
    function general()
    {
        $this->load->library('Menu');
        $menu = new Menu;
        $data['menu'] = $menu->show_menu();
        $data['webtitle'] = "Raid Manager";
        $data['websubtitle'] = "Manage Your Raid Group Today";
        $data['webfooter'] = 'Created by Ikstars.com';
        return $data;
    }
    function getCharacters()
    {
        
         $this->db->order_by('DKP','desc');
         $query = $this->db->get('chars', 5);
        if($query->num_rows() < 0)
        {
            show_error('Database is empty!');
        }   
            else
                return $query->result();
        
    }
    
    
}
?>
