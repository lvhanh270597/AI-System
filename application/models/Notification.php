<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Notification extends CI_Model
{
        
        function __construct()
        {
                parent::__construct();
        }      
        public function insertData($data){
            $data['notiID'] = RandomString(10);
            $this->db->insert('notification', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('notification', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('notification', array('notiID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result()[0];
        }
        public function getName($id){            
            return get($id)->name;
        }
        public function update($id, $data){            
            $this->db->where('notiID', $id);
            $this->db->update('notification', $data); 
        }
}
