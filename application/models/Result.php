<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Result extends CI_Model
{       
        function __construct()
        {
                parent::__construct();
        }      
        public function insertData($data){            
            $this->db->insert('result', $data);
        }
        public function checkIn($data){                                                   
            $query = $this->db->get_where('result', $data);         
            return $query->num_rows() == 1;
        }
        public function get($id){
            $query = $this->db->get_where('result', array('resultID' => $id));
            if ($query->num_rows() == 0) return null;
            return $query->result_array()[0];
        }
        public function getName($id){            
            return get($id)->name;
        }
        public function update($id, $data){            
            $this->db->where('resultID', $id);
            $this->db->update('result', $data); 
        }
}
